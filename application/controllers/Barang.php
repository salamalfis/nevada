<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('Barang_model');

        is_login();
    }

    public function index()
    {

        $data['title'] = 'Daftar Barang';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->Barang_model->getAllBarang();

        $data['kategori'] = $this->Barang_model->get('kategori');

        if ($this->input->post('keyword')) {

            $data['barang'] = $this->Barang_model->cariDataBarang();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->Barang_model->get('kategori');
        // $data['idKategori'] = ['Oven', 'Magic Com', 'Piring', 'Kompor', 'Blender'];


        $this->form_validation->set_rules('idKategori', 'kategori Barang', 'required');
        $this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok Barang', 'required');




        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Barang_model->tambahDataBarang();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('barang');
        }
    }


    public function hapus($id)
    {
        $this->Barang_model->hapusDataBarang($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('barang');
    }



    public function detail($id)
    {
        $data['title'] = 'Detail Data Barang';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->Barang_model->getBarangById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/detail', $data);
        $this->load->view('templates/footer');
    }


    public function ubah($id)
    {
        $data['title'] = 'Form Ubah Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->Barang_model->getBarangById($id);
        $data['kategori'] = $this->Barang_model->get('kategori');
        // $data['kategori'] = ['Oven', 'Magic Com', 'Piring', 'Kompor', 'Blender'];

        $this->form_validation->set_rules('kategori', 'kategori Barang', 'required');
        $this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok Barang', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Barang_model->ubahDataBarang();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('barang');
        }
    }

    // public function penjualan()
    // {
    //     $data['title'] = 'Penjualan';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    //     $data['merk'] = ['Philips', 'Miyako', 'Hock', 'Cosmos', 'Rinnai'];


    //     $this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
    //     $this->form_validation->set_rules('merk', 'Merk Barang', 'required');
    //     $this->form_validation->set_rules('jumlahpembelian', 'Jumlah Barang', 'required|numeric');
    //     $this->form_validation->set_rules('hargajual', 'Harga Jual', 'required|numeric');

    //     if ($this->form_validation->run() == FALSE) {

    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('barang/penjualan', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->Barang_model->tambahDataTransaksi();
    //         $this->session->set_flashdata('flash', 'ditambahkan');
    //         redirect('barang/transaksi');
    //     }
    // }

    // public function transaksi()
    // {
    //     $data['title'] = 'Transaksi';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['transaksi'] = $this->Barang_model->getAllTransaksi();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('barang/transaksi', $data);
    //     $this->load->view('templates/footer');
    // }

    public function kategori()
    {
        $data['title'] = "Kategori";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tambahKategori'] = $this->Barang_model->getAllKategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/kategori', $data);
        $this->load->view('templates/footer');
    }
    public function tambahkategori()
    {
        $data['title'] = "Tambah Kategori";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('namaKategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/tambahkategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Barang_model->tambahDataKategori();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('barang/kategori');
        }
    }
    public function editkategori($id)
    {
        $data['title'] = "Edit Kategori";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategoriBarang'] = $this->Barang_model->getKategoriById($id);

        $this->form_validation->set_rules('namaKategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/editkategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Barang_model->ubahDataKategori();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('barang/kategori');
        }
    }
    public function hapusKategori($id)
    {
        $this->Barang_model->hapusDataKategori($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('barang/kategori');
    }
}
