<?php
class Pemilik_toko extends CI_Controller
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
                $this->load->library('form_validation');
            }
        }
    }

    public function index()
    {
        $data['judul'] = "Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['cek_toko'] = $this->Model_pemilik->ambil_data_toko_semua($id_pemilik)->num_rows();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko_semua($id_pemilik)->result();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Toko_pemilik");
        $this->load->view("templates/footer");
    }

    public function tambah_toko()
    {
        $this->form_validation->set_rules('inp_nama', 'Nama Toko', 'required|is_unique[tb_toko.nama_toko]|min_length[5]|callback_name_space');
        $this->form_validation->set_rules('inp_alamat', 'Alamat Toko', 'required|min_length[5]');
        $this->form_validation->set_rules('inp_latitude', 'Latitude Toko', 'required');
        $this->form_validation->set_rules('inp_longitude', 'Longitude Toko', 'required');
        $this->form_validation->set_rules('inp_email', 'Email Toko', 'valid_email');
        $this->form_validation->set_rules('inp_no_hp', 'No Toko', 'min_length[10]|max_length[14]|numeric');
        $this->form_validation->set_rules('inp_website', 'Website', 'valid_url');

        $id_pemilik = $this->session->userdata('id_pemilik');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Tambah Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Tambah_toko_pemilik");
            $this->load->view("templates/footer");
        } else {
            $nama_toko = htmlspecialchars($_POST['inp_nama']);
            $alamat_toko = htmlspecialchars($_POST['inp_alamat']);
            $email = htmlspecialchars($_POST['inp_email']);
            $no_hp = htmlspecialchars($_POST['inp_no_hp']);
            $website = htmlspecialchars($_POST['inp_website']);
            $longitude = $_POST['inp_longitude'];
            $latitude = $_POST['inp_latitude'];
            $tgl_buat = date("Y-m-d");

            if (isset($_POST['btn_save'])) {
                $insert_toko = array(
                    'nama_toko' => $nama_toko,
                    'alamat_toko' => $alamat_toko,
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'no_hp_toko' => $no_hp,
                    'email_toko' => $email,
                    'website_toko' => $website,
                    'tgl_buat' => $tgl_buat,
                    'id_akun' => $id_pemilik,
                    'status_toko' => 1
                );
                $this->Model_pemilik->tambah_toko($insert_toko);
                $id_toko = $this->db->insert_id();

                $insert_foto = array(
                    'nama_foto' => 'default.jpg',
                    'id_toko' => $id_toko,
                    'status_foto' => 1,
                    'tgl_upload' => date('Y-m-d')
                );
                $this->Model_pemilik->tambah_foto_default($insert_foto);

                $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Toko Berhasil Di Tambahkan!</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko'));
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
}
