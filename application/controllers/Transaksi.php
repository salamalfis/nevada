<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
        is_login();
    }

    public function index()
    {

        $data['title'] = 'Transaksi';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->Transaksi_model->getTransaksi();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->Transaksi_model->getTransaksi($id);
        $data['detail'] = $this->Transaksi_model->getDetailTransaksi($id);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapus($id)
    {
        $this->Transaksi_model->hapusDataTransaksi($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('barang');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['keranjang'] = $this->Transaksi_model->getKeranjang(['idTransaksi']);
        $data['total_harga'] = $this->Transaksi_model->getTotalKeranjang(['idTransaksi']);

        $this->form_validation->set_rules('namaPelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamatPelanggan', 'Alamat Pelanggan', 'required');
        $this->form_validation->set_rules('uangBayar', 'Uang Bayar', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/keranjang', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // Data Tabel Transaksi
            $input = $this->input->post(null, true);
            $input['tanggal'] = date('Y-m-d');
            $input['kembalian'] = $input['uangBayar'] - $data['total_harga'];

            // Data Detail Transaksi
            $data_detail = [];
            $i = 0;
            foreach ($data['keranjang'] as $k) {
                $data_detail[$i]['idTransaksi'];
                $data_detail[$i]['barang_id']    = $k->barang_id;
                $data_detail[$i]['qty']         = $k->qty;
                $data_detail[$i]['subtotal']    = $k->harga * $k->qty;
                $i++;
            }

            if ($input['uangBayar'] >= $data['total_harga']) {
                // Simpan transaksi
                $this->Transaksi_model->insert('transaksi', $input);
                // Simpan detail transaksi
                $this->Transaksi_model->insert_batch('transaksi_detail', $data_detail);
                // bersihkan keranjang
                $this->Transaksi_model->delete('keranjang',  $data['idTransaksi']);

                $this->session->set_flashdata('flash', 'Di simpan');
                redirect('transaksi/detail/' . $data['idTransaksi']);
            } else {
                $this->session->set_flashdata('flash', 'Uang Bayar Tidak Cukup');
                redirect('transaksi/tambah');
            }
        }
    }
    public function add_item()
    {
        $data['title'] = "Transaksi";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->Transaksi_model->getBarang();
        $user_id = $this->db->get_where('user');
        $this->form_validation->set_rules('barang_id', 'Kode Barang', 'required|trim');
        $this->form_validation->set_rules('qty', 'Jumlah Beli', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/tambah_barang', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $input = $this->input->post(null, true);
            $input['noItem'] = time();
            $input['user_id'] = $user_id;


            // Cek stok
            $stok = $this->Transaksi_model->get_where('tbbarang', ['id' => $input['barang_id']])->stok;
            if ($stok >= $input['qty']) {
                $cekItem = $this->Transaksi_model->cekItem(['user_id' => $data['user'], 'barang_id' => $input['barang_id']]);

                if ($cekItem > 0) {
                    $this->Transaksi_model->updateQtyKeranjang($input['qty'], ['user_id' => $data['user'], 'barang_id' => $input['barang_id']]);
                } else {
                    $this->Transaksi_model->insert('keranjang', $input);
                    redirect('transaksi/add');
                }
            } else {

                setMsg('danger', "Maaf stok yang tersedia hanya {$stok}");
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('transaksi/add_item', $data);
                $this->load->view('templates/footer', $data);
            }
        }
    }

    public function delete_item($noItem)
    {
        $id = encode_php_tags($noItem);
        $this->Transaksi_model->delete('keranjang', ['noItem' => $id]);

        redirect('transaksi/add');
    }

    public function cetak_detail($getId)
    {
        $this->load->library('Dompdf_gen');

        $id = encode_php_tags($getId);
        $where = ['idKategori' => $id];

        $data['transaksi'] = $this->Transaksi_model->getTransaksi($id);
        $data['detail'] = $this->Transaksi_model->getDetailTransaksi($id);

        $this->load->view('transaksi/cetak_detail', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();

        ob_end_clean();
        $this->dompdf->stream("detail_transaksi_" . time() . ".pdf", array('Attachment' => 0));
    }
}
