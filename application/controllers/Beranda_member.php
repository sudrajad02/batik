<?php

class Beranda_member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {            
            $this->load->model('Member/Model_member');
            $this->load->library('form_validation');
        }
    }
    
    public function index()
    {
        $data['judul'] = "Beranda";                
        $data['toko'] = $this->Model_member->ambil_data_toko_semua()->result();        
        $this->load->view("templates/header_member", $data);
        $this->load->view("Member/Dashboard_member");
        $this->load->view("templates/footer_member");
    }
}
