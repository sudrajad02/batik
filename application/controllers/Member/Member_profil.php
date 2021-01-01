<?php

class Member_profil extends CI_Controller
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
        $this->form_validation->set_rules('inp_nama', 'Nama Member', 'trim|required|min_length[5]|callback_name_space');
        $this->form_validation->set_rules('inp_username', 'Username', 'trim|required|min_length[6]|callback_username_check|callback_username_space');
        $this->form_validation->set_rules('inp_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('inp_alamat', 'Alamat', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('inp_no_hp', 'No Hp', 'trim|required|min_length[12]|max_length[14]|numeric');
        $this->form_validation->set_rules('inp_img', '', 'trim|callback_file_check');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Profil Member";
            $id_member = $this->session->userdata('id_member');
            $data['member'] = $this->Model_member->ambil_data_member($id_member)->row();
            $this->load->view("templates/header_member", $data);
            $this->load->view("Member/Profil_member");
            $this->load->view("templates/footer_member");
        } else {
            $nama_member = htmlspecialchars($_POST['inp_nama']);
            $username_member = htmlspecialchars($_POST['inp_username']);
            $email = htmlspecialchars($_POST['inp_email']);
            $no_hp = htmlspecialchars($_POST['inp_no_hp']);
            $alamat = htmlspecialchars($_POST['inp_alamat']);
            $foto_upload = $_FILES['inp_img']['name'];

            //upload_file
            $config['upload_path'] = './public/image/foto_akun/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $nama_member . rand();
            $config['overwrite'] = true;
            $config['max_size'] = 2024;

            $this->load->library('upload', $config);

            if (!empty($foto_upload)) {
                if ($this->upload->do_upload('inp_img')) {
                    $upload_foto_member = $this->upload->data('file_name');
                }
            } else {
                $upload_foto_member = $_POST['inp_old_img'];
            }

            if (isset($_POST['btn_save'])) {
                $update_member = array(
                    'nama' => $nama_member,
                    'username' => $username_member,
                    'email' => $email,
                    'no_hp' => $no_hp,
                    'alamat' => $alamat,
                    'foto_akun' => $upload_foto_member
                );

                $where = $this->session->userdata('id_member');

                $this->Model_member->edit_member($update_member, $where);
                $this->session->set_flashdata('pesan', '<center><div class="alert 
                                alert-success" role="success">Berhasil Diubah</div></center>');
                redirect(site_url('Member/Member_profil'));
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
        $id_member = $this->session->userdata('id_member');
        $username = $_POST['inp_username'];
        $cek_username = $this->Model_member->cek_username($id_member, $username);
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
