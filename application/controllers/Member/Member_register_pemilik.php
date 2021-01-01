<?php

class Member_register_pemilik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            $this->load->model('Member/Model_member');
            $this->load->library('form_validation');
            $this->load->library('mail');
            $this->load->library('recaptcha');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('inp_nama', 'Nama', 'trim|required|min_length[5]|callback_name_space');
        $this->form_validation->set_rules('inp_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('inp_username', 'Username', 'trim|required|min_length[6]|is_unique[tb_akun.username]|callback_username_space');
        $this->form_validation->set_rules('inp_password1', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('inp_password2', 'Ulangi Password', 'trim|required|min_length[6]|matches[inp_password1]');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Tambah Pemilik Toko Batik";
            $data['captcha'] = $this->recaptcha->getWidget();
            $data['script_captcha'] = $this->recaptcha->getScriptTag();
            $this->load->view("templates/header_login", $data);
            $this->load->view("Member/Tambah_toko_register_pemilik");
            $this->load->view("templates/footer_login");
        } else {
            $nama_pemilik = htmlspecialchars($_POST['inp_nama']);
            $email_pemilik = htmlspecialchars($_POST['inp_email']);
            $username = htmlspecialchars($_POST['inp_username']);
            $password1 = htmlspecialchars($_POST['inp_password1']);

            if (isset($_POST['btn_daftar'])) {
                $insert_akun = array(
                    'username' => $username,
                    'password' => md5($password1),
                    'foto_akun' => 'no-image.png',
                    'nama' => $nama_pemilik,
                    'email' => $email_pemilik,
                    'id_hak_akses' => 2,
                    'status_akun' => 0,
                    'status_blok' => 'N'
                );
                $this->Model_member->tambah_akun($insert_akun);

                $akun = [
                    'nama_pemilik' => $nama_pemilik,
                    'email_pemilik' => $email_pemilik,
                    'username' => $username
                ];

                $content = '<p>Gunakan akun dibawah ini untuk login dan aktivasi akun</p>';
                $content .= '<p>nama = "' . $akun['nama_pemilik'] . '"</p>';
                $content .= '<p>username = "' . $akun['username'] . '"</p>';
                $content .= '<p>email = "' . $akun['email_pemilik'] . '"</p>';
                $content .= '<p>Klik Tombol dibawah ini untuk aktivasi!</p>';
                $content .= '<p><a href="' . base_url() . 'Register/aktivasi_akun?usr=' . $akun['username'] . '&em=' . $akun['email_pemilik'] . '">Klik disini</a></p>';

                $this->mail->send_mail('Aktivasi Akun', $email_pemilik, $content);

                $this->session->set_flashdata('message', '<center><div class="alert 
            alert-success" role="alert">Silahkan cek email untuk aktivasi akun!</div></center>');
                redirect(site_url('Member/Member_register_pemilik'));
            }
        }
    }

    public function aktivasi_akun()
    {
        $username = $_GET['usr'];
        $email = $_GET['em'];

        $akun = $this->Model_member->ambil_data_akun($username, $email)->row_array();
        $status_akun = $this->Model_member->ambil_data_akun_status($username)->row_array();

        if ($akun) {
            if ($status_akun) {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-info" role="alert">Akun Sudah Di Aktivasi!</div>');
                redirect(site_url('Login'));
            } else {
                $this->session->set_userdata('aktivasi_akun', $username);
                $this->aktivasi();
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Username atau Email Belum Terdaftar!</div>');
            redirect(site_url('Login'));
        }
    }

    public function aktivasi()
    {
        if (!$this->session->userdata('aktivasi_akun')) {
            $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Username Terdaftar!</div>');
            redirect(site_url('Login'));
        }

        $data['judul'] = "Aktivasi Akun";
        $this->load->view("templates/header_login", $data);
        $this->load->view("Aktivasi_akun");
        $this->load->view("templates/footer_login");

        if (isset($_POST['btn_aktivasi'])) {
            $username = $this->session->userdata('aktivasi_akun');
            $this->Model_member->ubah_status_akun($username);

            $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Akun Berhasil Di Aktivasi!</div>');
            $this->session->unset_userdata('aktivasi_akun');
            redirect(site_url('Login'));
        }
    }

    function name_space($str = null)
    {
        $str = htmlspecialchars($_POST['inp_nama']);
        $pattern = "/^[a-zA-Z ]*$/";
        if (!preg_match($pattern, $str)) {
            $this->form_validation->set_message('name_space', '%s hanya mengandung huruf dan spasi.');
            return false;
        } else {
            return true;
        }
    }

    function username_space($str = null)
    {
        $str = htmlspecialchars($_POST['inp_username']);
        $pattern = "/^[a-zA-Z0-9]*$/";
        if (!preg_match($pattern, $str)) {
            $this->form_validation->set_message('username_space', '%s hanya mengandung huruf dan angka.');
            return false;
        } else {
            return true;
        }
    }
}
