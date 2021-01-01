<?php

class Admin_profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('Login'));
            } else if ($this->session->userdata('hak_akses') != 1) {
                redirect(base_url('Login'));
            } else {
                $this->load->model('Admin/Model_admin');
                $this->load->library('form_validation');
            }
        }
    }

    public function index($id_admin = null)
    {
        $this->form_validation->set_rules('inp_nama', 'Nama Admin', 'trim|requiredrequired|min_length[5]|callback_name_space');
        $this->form_validation->set_rules('inp_username', 'Username Admin', 'trim|required|min_length[6]|callback_username_check|callback_username_space');
        $this->form_validation->set_rules('inp_img', '', 'callback_file_check');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Profil Admin";
            $id_admin = $this->session->userdata('id_admin');
            $data['admin'] = $this->Model_admin->ambil_data($id_admin)->row();
            $this->load->view("templates/header", $data);
            $this->load->view("Admin/Profil_admin");
            $this->load->view("templates/footer");
        } else {
            $nama_admin = $_POST['inp_nama'];
            $username_admin = $_POST['inp_username'];
            $foto_upload = $_FILES['inp_img']['name'];

            //upload_file
            $config['upload_path'] = './public/image/foto_akun/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $nama_admin . rand();
            $config['overwrite'] = false;
            $config['max_size'] = 2024;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);
            print_r($this->upload->display_errors());
            if (!empty($foto_upload)) {
                if ($this->upload->do_upload('inp_img')) {
                    $upload_foto_admin = $this->upload->data('file_name');
                } else {
                    $data['error'] = array('error' => $this->upload->display_errors());
                }
            } else {
                $upload_foto_admin = $_POST['inp_old_img'];
            }

            if (isset($_POST['btn_save'])) {

                $update_admin = array(
                    'nama' => $nama_admin,
                    'username' => $username_admin,
                    'foto_akun' => $upload_foto_admin
                );

                $where = $this->session->userdata('id_admin');

                $this->Model_admin->edit_admin($update_admin, $where);
                $this->session->set_flashdata('pesan', '<center><div class="alert 
                                alert-success" role="success">Berhasil Diubah</div></center>');
                redirect(site_url('Admin/Admin_profil'));
            }
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

    public function username_check()
    {
        $id_admin = $this->session->userdata('id_admin');
        $username = $_POST['inp_username'];
        $cek_username = $this->Model_admin->cek_username($id_admin, $username);
        if ($cek_username->num_rows() > 0) {
            $this->form_validation->set_message('username_check', 'Username Sudah Terpakai');
            return false;
        } else {
            return true;
        }
    }

    public function file_check()
    {
        $ekstensi_file = array('image/jpeg', 'image/jpg', 'image/png');
        $file_upload = get_mime_by_extension($_FILES['inp_img']['name']);
        $file_size = $_FILES['inp_img']['size'];
        if (!empty($_FILES['inp_img']['name'])) {
            if (in_array($file_upload, $ekstensi_file)) {
                if ($file_size > 2097152 || $file_size == 00) {
                    $this->form_validation->set_message('file_check', 'Ukuran File Terlalu Besar');
                    return false;
                } else if ($file_size < 2097152) {
                    return true;
                }
            } else {
                $this->form_validation->set_message('file_check', 'Silahkan pilih file yang berekstensi jpeg/jpg/png.');
                return false;
            }
        }
    }
}
