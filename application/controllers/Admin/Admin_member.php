<?php

class Admin_member extends CI_Controller
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
        //load library
        $this->load->library('pagination');

        //config
        $config['base_url'] = base_url() . 'Admin/Admin_member/index';
        $config['total_rows'] = $this->Model_admin->hitung_member()->num_rows();
        $config['per_page'] = 5;

        //style
        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        //initialize
        $this->pagination->initialize($config);

        $data['judul'] = "Member";
        $id_admin = $this->session->userdata('id_admin');
        $data['admin'] = $this->Model_admin->ambil_data($id_admin)->row();
        $data['start'] = $this->uri->segment(4);
        $data['member'] = $this->Model_admin->ambil_data_member($config['per_page'], $data['start'])->result();
        $this->load->view("templates/header", $data);
        $this->load->view("Admin/Member_admin");
        $this->load->view("templates/footer");
    }

    public function non_aktif($id_member = null)
    {
        $this->Model_admin->ubah_status_akun_non_aktif($id_member);
        $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Member Berhasil Di Non Aktifkan!</div>');
        redirect(site_url('Admin/Admin_member'));
    }

    public function aktif($id_member = null)
    {
        $this->Model_admin->ubah_status_akun_aktif($id_member);
        $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Member Berhasil Di Aktifkan!</div>');
        redirect(site_url('Admin/Admin_member'));
    }
}
