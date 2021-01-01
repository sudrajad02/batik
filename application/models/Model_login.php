<?php

class Model_login extends CI_Model
{
    public function cek_login($username)
    {
        return $this->db->get_where('tb_akun', ['username' => $username]);
    }
    
    public function cek_hak_akses($username)
    {        
        return $this->db->get_where('tb_akun', ['username' => $username]);
    }

    public function cek_user_counter($id_akun, $tgl_login)
    {
        return $this->db->get_where('tb_users_counter', ['id_akun' => $id_akun, 'tgl_users_counter' => $tgl_login]);
    }    
    
    public function ambil_data_semua_akun($where)
    {
        return $this->db->get_where('tb_akun', $where);
    }

    public function ambil_data_akun_status($username)
    {
        return $this->db->get_where('tb_akun', ['username' => $username, 'status_akun' => 1]);
    }

    public function ambil_data_by_email($email)
    {
        return $this->db->get_where('tb_akun', ['email' => $email, 'status_akun' => 1]);
    }

    public function ambil_data_akun($username, $email)
    {
        return $this->db->get_where('tb_akun', ['username' => $username, 'email' => $email, 'status_akun']);
    }        

    public function ambil_data_token($token)
    {
        return $this->db->get_where('tb_users_token', ['token' => $token]);
    }

    public function register_akun($insert_akun)
    {
        $this->db->insert('tb_akun', $insert_akun);
    }

    public function tambah_token($insert_token)
    {
        $this->db->insert('tb_users_token', $insert_token);
    }

    public function tambah_users_counter($insert_counter)
    {
        $this->db->insert('tb_users_counter', $insert_counter);
    }

    public function ubah_users_counter($update_counter, $id_users_counter)
    {
        $this->db->where('id_users_counter', $id_users_counter);
        $this->db->update('tb_users_counter', $update_counter);
    }

    public function ubah_status_blok($id_akun)
    {
        $this->db->where('id_akun', $id_akun);
        $this->db->update('tb_akun', ['status_blok' => 'Y']);
    }

    public function ubah_password($password, $email)
    {
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $this->db->update('tb_akun');
    }
    
    public function ubah_status_akun($username)
    {
        $this->db->set('status_akun', 1);
        $this->db->where('username', $username);
        $this->db->update('tb_akun');
    }

    public function hapus_token($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('tb_users_token');
    }    
}
