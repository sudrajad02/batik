<?php

class Member_kontak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            $this->load->model('Member/Model_member');
        }
    }

    public function index()
    {
        $data['judul'] = "Kontak";
        $data['toko'] = $this->Model_member->ambil_data_toko_semua()->result();
        $this->load->view("templates/header_member", $data);
        $this->load->view("Member/Kontak_member");
        $this->load->view("templates/footer_member");
    }
}
