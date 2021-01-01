<?php

class Model_pemilik extends CI_Model
{
    public function cek_nama_toko($nama_toko, $id_toko)
    {
        return $this->db->get_where('tb_toko', ['id_toko !=' => $id_toko, 'nama_toko' => $nama_toko]);
    }

    public function cek_username($id_pemilik, $username)
    {
        return $this->db->get_where('tb_akun', ['id_akun !=' => $id_pemilik, 'username' => $username]);
    }

    public function cek_aktif_foto($id_toko)
    {
        return $this->db->get_where('tb_foto_toko', ['id_toko' => $id_toko, 'status_foto' => 1]);
    }

    public function hitung_komentar($id_toko)
    {
        return $this->db->get_where('tb_komen', ['id_toko' => $id_toko]);
    }

    public function ambil_data_pemilik($id_pemilik)
    {
        return $this->db->get_where('tb_akun', ['id_akun' => $id_pemilik]);
    }

    public function ambil_data_toko_semua($id_pemilik)
    {
        return $this->db->get_where('tb_toko', ['id_akun' => $id_pemilik, 'status_toko' => 1]);
    }

    public function ambil_data_toko($id_toko)
    {
        return $this->db->get_where('tb_toko', ['id_toko' => $id_toko]);
    }

    public function ambil_data_produk($id_toko)
    {
        return $this->db->get_where('tb_produk', ['id_toko' => $id_toko]);
    }

    public function ambil_data_produk_by_id_produk($id_produk)
    {
        return $this->db->get_where('tb_produk', ['id_produk' => $id_produk]);
    }

    public function ambil_data_foto_by_id_foto($id_foto)
    {
        return $this->db->get_where('tb_foto_toko', ['id_foto_toko' => $id_foto]);
    }

    public function ambil_data_foto_toko($id_toko)
    {
        return $this->db->get_where('tb_foto_toko', ['id_toko' => $id_toko]);
    }

    public function ambil_data_member($id_toko)
    {
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_member_toko.id_akun');
        $query = $this->db->get_where('tb_member_toko', ['id_toko' => $id_toko]);
        return $query;
    }

    public function ambil_data_komentar_semua($id_toko)
    {
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_komen.id_akun');
        $this->db->join('tb_toko', 'tb_toko.id_toko=tb_komen.id_toko');
        $query = $this->db->get_where('tb_komen', ['tb_komen.id_toko' => $id_toko]);
        return $query;
    }

    public function ambil_data_komentar($id_komentar)
    {
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_komen.id_akun');
        $this->db->join('tb_toko', 'tb_toko.id_toko=tb_komen.id_toko');
        $query = $this->db->get_where('tb_komen', ['tb_komen.id_komentar' => $id_komentar]);
        return $query;
    }

    public function tambah_toko($insert_toko)
    {
        $this->db->insert('tb_toko', $insert_toko);
    }

    public function tambah_foto_default($insert_foto)
    {
        $this->db->insert('tb_foto_toko', $insert_foto);
    }

    public function tambah_foto($insert_foto)
    {
        $this->db->insert('tb_foto_toko', $insert_foto);
    }

    public function tambah_produk($insert_produk)
    {
        $this->db->insert('tb_produk', $insert_produk);
    }

    public function balas_komen($insert_reply)
    {
        $this->db->insert('tb_komen', $insert_reply);
    }

    public function edit_toko($update_toko, $where)
    {
        $this->db->where('id_toko', $where);
        $this->db->update('tb_toko', $update_toko);
    }

    public function edit_deskripsi($update_deskripsi, $id_toko_batik)
    {
        $this->db->where('id_toko', $id_toko_batik);
        $this->db->update('tb_toko', $update_deskripsi);
    }

    public function edit_pemilik($update_pemilik, $where)
    {
        $this->db->where('id_akun', $where);
        $this->db->update('tb_akun', $update_pemilik);
    }

    public function edit_foto($update_foto, $id_foto_toko)
    {
        $this->db->where('id_foto_toko', $id_foto_toko);
        $this->db->update('tb_foto_toko', $update_foto);
    }

    public function edit_produk($update_produk, $id_produk_toko)
    {
        $this->db->where('id_produk', $id_produk_toko);
        $this->db->update('tb_produk', $update_produk);
    }

    public function edit_foto_profil_lama($id_foto_toko_lama)
    {
        $this->db->set('status_foto', 0);
        $this->db->where('id_foto_toko', $id_foto_toko_lama);
        $this->db->update('tb_foto_toko');
    }

    public function edit_foto_profil_baru($id_foto_toko)
    {
        $this->db->set('status_foto', 1);
        $this->db->where('id_foto_toko', $id_foto_toko);
        $this->db->update('tb_foto_toko');
    }

    public function hapus_toko($id_toko)
    {
        $this->db->set('status_toko', '0');
        $this->db->where('id_toko', $id_toko);
        $this->db->update('tb_toko');
    }

    public function hapus_produk($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->delete('tb_produk');
    }

    public function hapus_foto_toko($id_foto)
    {
        $this->db->where('id_foto_toko', $id_foto);
        $this->db->delete('tb_foto_toko');
    }
}
