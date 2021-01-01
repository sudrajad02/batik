<?php

class Pemilik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            if ($this->session->userdata('status') != 'login') {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Harus login terlebih dahulu</div>');
                redirect(base_url('Login'));
            } else if ($this->session->userdata('hak_akses') != 2) {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Akun tidak punya akses</div>');
                redirect(base_url('Login'));
            } else {
                $this->load->model('Pemilik_toko/Model_pemilik');
            }
        }
    }

    public function index()
    {
        $data['judul'] = "Beranda Pemilik Toko";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko_semua($id_pemilik)->result();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Dashboard_pemilik");
        $this->load->view("templates/footer");
    }
}
