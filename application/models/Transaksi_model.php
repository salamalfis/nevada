<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function getBarang()
    {
        return $this->db->get('tbbarang')->result();
    }


    public function getKeranjang($where)
    {

        $query = "SELECT `keranjang`.`noItem`,`tbbarang`.`id`,`tbbarang`.`namabarang`,`tbbarang`.`harga`,`keranjang`.`qty` FROM `keranjang` 
        JOIN `tbbarang` 
        ON `tbbarang`.`id` = `keranjang`.`barang_id`
        ";

        return $this->db->query($query)->result();
    }

    public function getAllBarang()
    {
        return $query = $this->db->get('tbbarang')->result_array();
    }



    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function cekItem($where)
    {
        return $this->db->get_where('keranjang', $where)->num_rows();
    }

    public function updateQtyKeranjang($qty = 0, $where = 0)
    {
        $getQty = $this->db->get_where('keranjang', $where)->row()->qty;
        $result = (int) $getQty + (int) $qty;

        return $this->db->update('keranjang', ['qty' => $result], $where);
    }

    public function getTotalKeranjang($where)
    {
        $this->db->join('tbbarang b', 'b.id=k.barang_id');
        $keranjang = $this->db->get_where('keranjang k', $where)->result();

        $subtotal = [];
        foreach ($keranjang as $k) {
            $subtotal[] = $k->qty * $k->harga;
        }

        return array_sum($subtotal);
    }

    public function getTransaksi($id = null)
    {
        if ($id == null) {
            return $this->db->get('transaksi')->result();
        } else {
            $this->db->join('user u', 'u.id =t.user_id');
            return $this->db->get_where('transaksi t', ['id' => $id])->row();
        }
    }

    public function getDetailTransaksi($id)
    {

        $this->db->select("b.namabarang, td.qty, td.subtotal, (td.subtotal/td.qty) as harga");
        $this->db->join('tbbarang b', 'b.id=td.barang_id');
        $this->db->where('idTransaksi', $id);
        return $this->db->get('transaksi_detail td')->result();
    }

    public function getLaporanTransaksi($tgl1, $tgl2)
    {


        $this->db->join('user u', 'u.id=t.user_id');
        if ($tgl1 != null && $tgl2 != null) {
            $this->db->where('tanggal' . ' >=', $tgl1);
            $this->db->where('tanggal' . ' <=', $tgl2);
        }
        return $this->db->get('transaksi t')->result();
    }

    public function getTotalTransaksi($bln = null, $custom = [])
    {
        if ($bln != null) {
            $this->db->like('tanggal', $bln, 'after');
        }
        if ($custom != null) {
            $this->db->where('tanggal' . ' >=', $custom[0]);
            $this->db->where('tanggal' . ' <=', $custom[1]);
        }
        $this->db->select_sum('totalHarga', 'totalTransaksi');
        return $this->db->get('transaksi')->row()->totalTransaksi;
    }

    public function chartTransaksi($date = null)
    {
        if ($date != null) {
            $this->db->like('tanggal', $date, 'after');
        }
        $this->db->select_sum('totalHarga', 'totalTransaksi');
        return $this->db->get('transaksi')->row()->totalTransaksi;
    }
    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    public function get_where($table, $where)
    {
        $query = $this->db->get_where($table, $where);

        if ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return $query->row();
        }
    }
}
