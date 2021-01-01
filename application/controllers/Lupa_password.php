<?php
class Lupa_password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            $this->load->library('form_validation');
            $this->load->library('mail');
            $this->load->library('recaptcha');
            $this->load->model('Model_login');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('inp_email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Lupa Password";
            $this->load->view("templates/header_login", $data);
            $this->load->view("Lupa_password");
            $this->load->view("templates/footer_login");
        } else {
            $email = $_POST['inp_email'];
            $user = $this->Model_login->ambil_data_by_email($email)->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $insert_token = array(
                    'email' => $email,
                    'token' => $token,
                    'date_created' => date('Y-m-d')
                );
                $this->Model_login->tambah_token($insert_token);
                $content = '<p>Klik link ini untuk mengganti password :</p>';
                $content .= '<p><a href="' . base_url() . 'Lupa_password/reset_password?email=' . $email . '&token=' . urlencode($token) . '">Ganti Password</a></p>';
                $this->mail->send_mail('Lupa Password', $email, $content);

                $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Silahkan cek email untuk ganti password!</div>');
                redirect('Lupa_password');
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Email tidak terdaftar atau belum aktivasi!</div>');
                redirect('Lupa_password');
            }
        }
    }

    public function reset_password()
    {
        $email = $_GET['email'];
        $token = $_GET['token'];

        $user = $this->Model_login->ambil_data_by_email($email)->row_array();

        if ($user) {
            $user_token = $this->Model_login->ambil_data_token($token)->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ganti_password();
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                    alert-danger" role="alert">Ganti password gagal! Token Salah</div>');
                redirect(site_url('Login'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Ganti password gagal! Email Salah</div>');
            redirect(site_url('Login'));
        }
    }

    public function ganti_password()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect(site_url('Login'));
        }

        $this->form_validation->set_rules('inp_password1', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('inp_password2', 'Ulangi Password', 'trim|required|min_length[6]|matches[inp_password1]');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Ganti Password";
            $data['captcha'] = $this->recaptcha->getWidget();
            $data['script_captcha'] = $this->recaptcha->getScriptTag();
            $this->load->view("templates/header_login", $data);
            $this->load->view("Ganti_password");
            $this->load->view("templates/footer_login");
        } else {
            $password = md5($_POST['inp_password1']);
            $email = $this->session->userdata('reset_email');

            $this->Model_login->ubah_password($password, $email);
            $this->Model_login->hapus_token($email);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Password berhasil diganti! Silahkan Login.</div>');
            redirect(site_url('Login'));
        }
    }
}
