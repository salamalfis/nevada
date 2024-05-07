<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }
    public function cetak_transaksi($tgl1, $tgl2)
    {
        $this->load->library('Dompdf_gen');

        $data['tanggal'] = indo_date($tgl1) . " s/d " . indo_date($tgl2);
        $data['transaksi'] = $this->Transaksi_model->getLaporanTransaksi($tgl1, $tgl2);
        $data['jumlah'] = count((array) $data['transaksi']);
        $data['total'] = $this->transaksi->getTotalTransaksi(null, [$tgl1, $tgl2]);
        $this->load->view('laporan/laporan_transaksi', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();

        ob_end_clean();
        $this->dompdf->stream("laporan_transaksi_" . time() . ".pdf", array('Attachment' => 0));
    }
}
