<?php

class Model_member extends CI_Model
{
    public function cek_member_toko($id_member, $id_toko)
    {
        return $this->db->get_where('tb_member_toko', ['id_akun' => $id_member, 'id_toko' => $id_toko]);
    }

    public function cek_username($id_member, $username)
    {
        return $this->db->get_where('tb_akun', ['id_akun !=' => $id_member, 'username' => $username]);
    }

    public function cek_komen($id_toko)
    {
        return $this->db->get_where('tb_komen', ['id_toko' => $id_toko, 'status_komentar' => 1]);
    }

    public function hitung_toko()
    {
        $this->db->select('*');
        $where = 'deskripsi IS NOT NULL';
        $this->db->where($where);
        $this->db->where('status_toko', 1);
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_toko.id_akun');
        return $this->db->get('tb_toko');
    }

    public function ambil_data_member($id_member)
    {
        return $this->db->get_where('tb_akun', ['id_akun' => $id_member]);
    }

    public function ambil_data_toko_semua_pag($limit, $start)
    {
        $this->db->select('*');
        $where = 'deskripsi IS NOT NULL';
        $this->db->where($where);
        $this->db->where('status_toko', 1);
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_toko.id_akun');
        $this->db->limit($limit, $start);
        return $this->db->get('tb_toko');
    }

    public function ambil_data_toko_semua()
    {
        $this->db->select('*');
        $where = 'deskripsi IS NOT NULL';
        $this->db->where($where);
        $this->db->where('status_toko', 1);
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_toko.id_akun');
        return $this->db->get('tb_toko');
    }

    public function ambil_data_foto_toko_profil($id_toko)
    {
        $this->db->join('tb_toko', 'tb_foto_toko.id_toko=tb_toko.id_toko');
        return $this->db->get_where('tb_foto_toko', ['tb_foto_toko.id_toko' => $id_toko, 'status_foto' => 1]);
    }

    public function ambil_data_toko($id_toko)
    {
        $this->db->join('tb_akun', 'tb_akun.id_akun=tb_toko.id_akun');
        $this->db->join('tb_foto_toko', 'tb_foto_toko.id_toko=tb_toko.id_toko');
        $this->db->limit(3);
        $this->db->order_by('tgl_upload', 'DESC');
        return $this->db->get_where('tb_toko', ['tb_toko.id_toko' => $id_toko]);
    }

    public function ambil_data_produk($id_toko)
    {
        $this->db->join('tb_produk', 'tb_produk.id_toko=tb_toko.id_toko');
        return $this->db->get_where('tb_toko', ['tb_toko.id_toko' => $id_toko]);
    }

    public function ambil_data_akun($username, $email)
    {
        return $this->db->get_where('tb_akun', ['username' => $username, 'email' => $email]);
    }

    public function ambil_data_akun_status($username)
    {
        return $this->db->get_where('tb_akun', ['username' => $username, 'status_akun' => 1]);
    }

    public function ambil_data_komentar_semua($id_toko)
    {
        return $this->db->get_where('tb_komen', ['id_toko' => $id_toko, 'status_komentar' => 1]);
    }

    public function ambil_data_komentar($id_toko_batik, $parent = 0)
    {
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_komen.id_akun');
        return $this->db->get_where('tb_komen', ['tb_komen.id_toko' => $id_toko_batik, 'parent_id' => $parent, 'status_komentar' => 1])->result();
    }

    public function has_childrens($childrens = array())
    {
        if (empty($childrens)) {
            return false;
        } else {
            return true;
        }
    }

    public function buat_pohon($id_toko)
    {
        $komen = $this->ambil_data_komentar($id_toko);
        $pohon_komen = new stdClass;
        $pohon_komen->items = array();
        $this->buat_pohon_item($pohon_komen, $komen);
        return $pohon_komen;
    }

    public function buat_pohon_item($pohon_komen, $komen)
    {
        if (empty($komen)) {
            return '';
        }

        $catrow = $subcatrow = '';
        foreach ($komen as $kmn) {
            $childrens = $this->ambil_data_komentar($kmn->id_toko, $kmn->id_komentar);
            $kmn->items = array();
            $pohon_komen->items[$kmn->id_komentar] = $kmn;
            $item = $pohon_komen->items[$kmn->id_komentar];
            if ($this->has_childrens($childrens)) {
                $this->buat_pohon_item($item, $childrens);
            }
        }
    }

    public function tambah_akun($insert_akun)
    {
        $this->db->insert('tb_akun', $insert_akun);
    }

    public function tambah_member($id_member, $id_toko)
    {
        $this->db->insert('tb_member_toko', ['id_akun' => $id_member, 'id_toko' => $id_toko]);
    }

    public function simpan_komen($insert_komen)
    {
        $this->db->insert('tb_komen', $insert_komen);
    }

    public function tambah_foto_toko($insert_foto_toko)
    {
        $this->db->insert('tb_foto_toko', $insert_foto_toko);
    }

    public function edit_member($update_member, $where)
    {
        $this->db->where('id_akun', $where);
        $this->db->update('tb_akun', $update_member);
    }

    public function ubah_status_akun($username)
    {
        $this->db->set('status_akun', 1);
        $this->db->where('username', $username);
        $this->db->update('tb_akun');
    }
}
