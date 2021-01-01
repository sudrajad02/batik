<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            if ($this->session->userdata('status') != 'login') {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Harus login terlebih dahulu</div>');
                redirect(base_url('Login'));
            } else if ($this->session->userdata('hak_akses') != 1) {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Akun tidak punya akses</div>');
                redirect(base_url('Login'));
            } else {
                $this->load->model('Admin/Model_admin');
            }
        }
    }

    public function index()
    {
        $data['judul'] = "Beranda Admin";
        $id_admin = $this->session->userdata('id_admin');
        $data['admin'] = $this->Model_admin->ambil_data($id_admin)->row();
        $data['toko'] = $this->Model_admin->ambil_data_toko()->result();
        $this->load->view("templates/header", $data);
        $this->load->view("Admin/Dashboard_admin");
        $this->load->view("templates/footer");
    }
}
