<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function get_where($table, $where)
    {
        $query = $this->db->get_where($table, $where);

        if ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return $query->row();
        }
    }
    public function get($table)
    {
        return $this->db->get($table)->result();
    }

    public function getAllBarang()
    {
        return $query = $this->db->get('tbbarang')->result_array();
    }

    public function getAllTransaksi()
    {
        return $query = $this->db->get('transaksi')->result_array();
    }

    public function getAllKategori()
    {
        return $query = $this->db->get('kategori')->result_array();
    }

    public function tambahDataBarang()
    {
        $data = array(
            'idKategori' => $this->input->post('idKategori', true),
            'namabarang' => $this->input->post('namabarang', true),
            'harga' => $this->input->post('harga', true),
            'stok' => $this->input->post('stok', true)
        );

        $this->db->insert('tbbarang', $data);
    }

    // public function tambahDataTransaksi()
    // {
    //     $total = $this->input->post('jumlahpembelian', true) * $this->input->post('hargajual', true);
    //     $data = array(
    //         'namabarang' => $this->input->post('namabarang', true),
    //         'kodebarang' => $this->input->post('kodebarang', true),
    //         'jumlahpembelian' => $this->input->post('jumlahpembelian', true),
    //         'hargajual' => $this->input->post('hargajual', true),
    //         'total' => $total,
    //         'tanggaltransaksi' => time()

    //     );

    //     $this->db->insert('transaksi', $data);
    // }

    public function hapusDataBarang($id)
    {

        $this->db->delete('tbbarang', ['id' => $id]);
    }

    public function hapusDataTransaksi($id)
    {

        $this->db->delete('transaksi', ['id' => $id]);
    }



    public function getBarangById($id)
    {
        return $this->db->get_where('tbbarang', ['id' => $id])->row_array();
    }




    public function cariDataBarang()
    {
        $keyword = $this->input->post('keyword', true);

        $this->db->like('namabarang', $keyword);
        $this->db->or_like('harga', $keyword);

        return $this->db->get('tbbarang')->result_array();
    }

    public function tambahDataKategori()
    {
        $data = array(
            'namaKategori' => $this->input->post('namaKategori', true)
        );
        $this->db->insert('kategori', $data);
    }
    public function hapusDataKategori($id)
    {

        $this->db->delete('kategori', ['idKategori' => $id]);
    }

    public function getKategoriById($id)
    {
        return $this->db->get_where('kategori', ['idKategori' => $id])->row_array();
    }
    public function ubahDataKategori()
    {
        $data = array(

            'namaKategori' => $this->input->post('namaKategori', true)

        );
        $this->db->where('idKategori', $this->input->post('idKategori'));
        $this->db->update('kategori', $data);
    }
    public function ubahDataBarang()
    {
        $data = array(

            'idKategori' => $this->input->post('idKategori', true),
            'namabarang' => $this->input->post('namabarang', true),
            'harga' => $this->input->post('harga', true),
            'stok' => $this->input->post('stok', true)

        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbbarang', $data);
    }
}
