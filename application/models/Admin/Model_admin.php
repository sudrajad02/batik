<?php

class Model_admin extends CI_Model
{
    public function cek_username($id_admin, $username)
    {
        return $this->db->get_where('tb_akun', ['id_akun !=' => $id_admin, 'username' => $username]);
    }

    public function hitung_pemilik()
    {
        return $this->db->get_where('tb_akun', ['id_hak_akses' => 2]);
    }

    public function hitung_member()
    {
        return $this->db->get_where('tb_akun', ['id_hak_akses' => 3]);
    }

    public function hitung_komentar()
    {
        return $this->db->get('tb_komen');
    }
    
    public function hitung_toko()
    {
        return $this->db->get('tb_toko');
    }

    public function ambil_data($id_admin)
    {
        return $this->db->get_where('tb_akun', ['id_akun' => $id_admin]);
    }
    
    public function ambil_data_pemilik($limit, $start)
    {
        return $this->db->get_where('tb_akun', ['id_hak_akses' => 2], $limit, $start);
    }
    
    public function ambil_data_member($limit, $start)
    {
        return $this->db->get_where('tb_akun', ['id_hak_akses' => 3], $limit, $start);
    }    

    public function ambil_data_komentar($limit, $start)
    {        
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_komen.id_akun');
        $this->db->limit($limit, $start);
        return $this->db->get_where('tb_komen');
    }

    public function ambil_data_toko()
    {
        return $this->db->get('tb_toko');
    }

    public function ambil_data_toko_semua($limit, $start)
    {
        return $this->db->get('tb_toko', $limit, $start);
    }

    public function edit_admin($update_admin, $where)
    {
        $this->db->where('id_akun', $where);
        $this->db->update('tb_akun', $update_admin);
    }

    public function ubah_status_akun_non_aktif($where)
    {
        $this->db->set('status_akun', '0');
        $this->db->where('id_akun', $where);
        $this->db->update('tb_akun');
    }
    
    public function ubah_status_akun_aktif($where)
    {
        $this->db->set('status_akun', '1');
        $this->db->where('id_akun', $where);
        $this->db->update('tb_akun');
    }

    public function ubah_status_komen_non_aktif($id_komentar)
    {
        $this->db->set('status_komentar', '0');
        $this->db->where('id_komentar', $id_komentar);
        $this->db->update('tb_komen');
    }

    public function ubah_status_komen_aktif($id_komentar)
    {
        $this->db->set('status_komentar', '1');
        $this->db->where('id_komentar', $id_komentar);
        $this->db->update('tb_komen');
    }

    public function ubah_status_toko_non_aktif($id_toko)
    {
        $this->db->set('status_toko', '0');
        $this->db->where('id_toko', $id_toko);
        $this->db->update('tb_toko');
    }

    public function ubah_status_toko_aktif($id_toko)
    {
        $this->db->set('status_toko', '1');
        $this->db->where('id_toko', $id_toko);
        $this->db->update('tb_toko');
    } 
}
