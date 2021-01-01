<?php
class Pemilik_toko_detail extends CI_Controller
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

    public function detail_toko($id_toko = null)
    {
        $data['judul'] = "Detail Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Toko_batik_pemilik");
        $this->load->view("templates/footer");
    }

    public function deskripsi_toko($id_toko = null)
    {
        $data['judul'] = "Deskripsi Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Deskripsi_toko_batik_pemilik");
        $this->load->view("templates/footer");
    }

    public function foto_toko($id_toko = null)
    {
        $data['judul'] = "Foto Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $data['foto_toko'] = $this->Model_pemilik->ambil_data_foto_toko($id_toko)->result();
        $data['foto'] = $this->Model_pemilik->ambil_data_foto_toko($id_toko)->num_rows();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Foto_toko_pemilik");
        $this->load->view("templates/footer");
    }

    public function member_toko($id_toko = null)
    {
        $data['judul'] = "Member Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['cek_member'] = $this->Model_pemilik->ambil_data_member($id_toko)->num_rows();
        $data['member'] = $this->Model_pemilik->ambil_data_member($id_toko)->result();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Member_pemilik");
        $this->load->view("templates/footer");
    }

    public function komentar_toko($id_toko = null)
    {
        $data['judul'] = "Komentar Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['cek_komentar'] = $this->Model_pemilik->hitung_komentar($id_toko)->num_rows();
        $data['komentar'] = $this->Model_pemilik->ambil_data_komentar_semua($id_toko)->result();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Komentar_pemilik");
        $this->load->view("templates/footer");
    }

    public function balas_komentar($id_komentar = null, $id_toko = null)
    {
        $this->form_validation->set_rules('inp_reply', 'Komentar', 'required');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Komentar Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $data['komentar'] = $this->Model_pemilik->ambil_data_komentar($id_komentar)->row();
            $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
            $data['id_komentar'] = $id_komentar;
            $data['id_toko'] = $id_toko;
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Balas_Komentar_toko");
            $this->load->view("templates/footer");
        } else {
            $reply_komen = htmlspecialchars($_POST['inp_reply']);
            $parent_id = $_POST['inp_parent_id'];
            $id_toko = $_POST['inp_id_toko'];
            $id_akun = $this->session->userdata('id_pemilik');

            $insert_reply = array(
                'id_toko' => $id_toko,
                'komentar' => $reply_komen,
                'id_akun' => $id_akun,
                'tgl_komen' => date('Y-m-d'),
                'status_komentar' => 1,
                'parent_id' => $parent_id,
                'is_toko' => 'Y'
            );

            $this->Model_pemilik->balas_komen($insert_reply);
            $this->session->set_flashdata('pesan_komentar', '<div class="alert 
                                alert-success" role="alert">Berhasil Membalas Komentar</div>');
            redirect(site_url('Pemilik_toko/Pemilik_toko_detail/komentar_toko/' . $id_toko));
        }
    }

    public function produk_toko($id_toko = null)
    {
        $data['judul'] = "Produk Toko Batik";
        $id_pemilik = $this->session->userdata('id_pemilik');
        $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
        $data['cek_produk'] = $this->Model_pemilik->ambil_data_produk($id_toko)->num_rows();
        $data['produk'] = $this->Model_pemilik->ambil_data_produk($id_toko)->result();
        $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $this->load->view("templates/header", $data);
        $this->load->view("Pemilik_toko/Produk_toko");
        $this->load->view("templates/footer");
    }

    public function tambah_foto($id_toko = null)
    {
        $this->form_validation->set_rules('inp_img', '', 'callback_file_check_foto');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Tambah Foto Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
            $data['id_toko'] = $id_toko;
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Tambah_foto_toko");
            $this->load->view("templates/footer");
        } else {
            $toko_batik = $this->Model_pemilik->ambil_data_toko($id_toko)->row_array();
            $foto_upload = $_FILES['inp_img']['name'];

            //upload_file
            $config['upload_path'] = './public/image/toko_batik/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $toko_batik['nama_toko'] . rand();
            $config['overwrite'] = true;
            $config['max_size'] = 2024;

            $this->load->library('upload', $config);

            if (!empty($foto_upload)) {
                if ($this->upload->do_upload('inp_img')) {
                    $upload_foto_toko = $this->upload->data('file_name');
                }
            } else {
                $upload_foto_toko = 'default.jpg';
            }

            if (isset($_POST['btn_save'])) {
                $insert_foto = array(
                    'nama_foto' => $upload_foto_toko,
                    'id_toko' => $id_toko,
                    'status_foto' => 0,
                    'tgl_upload' => date('Y-m-d')
                );

                $this->Model_pemilik->tambah_foto($insert_foto);
                $this->session->set_flashdata('pesan_foto', '<div class="alert 
                                alert-success" role="alert">Berhasil Mengubah Foto</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko_detail/foto_toko/' . $id_toko));
            }
        }
    }

    public function edit_foto($id_toko = null, $id_foto = null)
    {
        $this->form_validation->set_rules('inp_img', '', 'callback_file_check_foto');
        $toko = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
        $nama_toko = $toko->nama_toko;

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Edit Foto Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $data['foto'] = $this->Model_pemilik->ambil_data_foto_by_id_foto($id_foto)->row();
            $data['id_toko'] = $id_toko;
            $data['id_foto'] = $id_foto;
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Edit_foto_toko");
            $this->load->view("templates/footer");
        } else {
            $foto_upload = $_FILES['inp_img']['name'];
            $id_foto_toko = $_POST['inp_id_foto_batik'];
            $id_toko_batik = $_POST['inp_id_toko_batik'];

            //upload_file
            $config['upload_path'] = './public/image/toko_batik/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $nama_toko . rand();
            $config['overwrite'] = true;
            $config['max_size'] = 2024;

            $this->load->library('upload', $config);

            if (!empty($foto_upload)) {
                if ($this->upload->do_upload('inp_img')) {
                    $upload_foto_toko = $this->upload->data('file_name');
                }
            } else {
                $upload_foto_toko = $_POST['inp_old_img'];
            }

            if (isset($_POST['btn_save'])) {
                $update_foto = array(
                    'nama_foto' => $upload_foto_toko,
                    'status_foto' => 0,
                    'tgl_upload' => date('Y-m-d')
                );

                $this->Model_pemilik->edit_foto($update_foto, $id_foto_toko);
                $this->session->set_flashdata('pesan_foto', '<div class="alert 
                                alert-success" role="alert">Berhasil Mengubah Foto</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko_detail/foto_toko/' . $id_toko_batik));
            }
        }
    }

    public function edit_deskripsi_toko($id_toko = null)
    {
        $this->form_validation->set_rules('inp_deskripsi', 'Deskripsi Toko', 'required|min_length[5]');
        $this->form_validation->set_rules('inp_hari_buka', 'Hari Buka Toko', 'required|callback_hari_buka_check');
        $this->form_validation->set_rules('inp_hari_tutup', 'Hari Buka Toko', 'required|callback_hari_tutup_check');
        $this->form_validation->set_rules('inp_jam_buka', 'Jam Buka Toko', 'required');
        $this->form_validation->set_rules('inp_jam_tutup', 'Jam Tutup Toko', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Edit Detail Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
            $data['id_toko'] = $id_toko;
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Edit_deskripsi_toko");
            $this->load->view("templates/footer");
        } else {
            $deskripsi_toko = htmlspecialchars($_POST['inp_deskripsi']);
            $hari_buka = htmlspecialchars($_POST['inp_hari_buka']);
            $hari_tutup = htmlspecialchars($_POST['inp_hari_tutup']);
            $jam_buka = htmlspecialchars($_POST['inp_jam_buka']);
            $jam_tutup = htmlspecialchars($_POST['inp_jam_tutup']);
            $id_toko_batik = htmlspecialchars($_POST['inp_id_toko']);

            if (isset($_POST['btn_update'])) {
                $update_deskripsi = array(
                    'deskripsi' => $deskripsi_toko,
                    'hari_buka' => $hari_buka,
                    'hari_tutup' => $hari_tutup,
                    'jam_buka' => $jam_buka,
                    'jam_tutup' => $jam_tutup,
                    'id_toko' => $id_toko_batik
                );

                $this->Model_pemilik->edit_deskripsi($update_deskripsi, $id_toko_batik);
                $this->session->set_flashdata('message', '<div class="alert 
                                alert-success" role="alert">Berhasil Mengubah Deskripsi Toko</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko_detail/deskripsi_toko/' . $id_toko_batik));
            }
        }
    }

    public function edit_toko($id_toko = null)
    {
        $this->form_validation->set_rules('inp_nama', 'Nama Toko', 'required|min_length[5]|callback_name_toko_check|callback_name_space');
        $this->form_validation->set_rules('inp_alamat', 'Alamat Toko', 'required|min_length[5]');
        $this->form_validation->set_rules('inp_latitude', 'Latitude Toko', 'required');
        $this->form_validation->set_rules('inp_longitude', 'Longitude Toko', 'required');
        $this->form_validation->set_rules('inp_email', 'Email Toko', 'valid_email');
        $this->form_validation->set_rules('inp_no_hp', 'No Toko', 'min_length[10]|max_length[14]|numeric');
        $this->form_validation->set_rules('inp_website', 'Website', 'valid_url');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Edit Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $data['toko'] = $this->Model_pemilik->ambil_data_toko($id_toko)->row();
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Edit_toko_pemilik");
            $this->load->view("templates/footer");
        } else {
            $nama_toko = htmlspecialchars($_POST['inp_nama']);
            $alamat_toko = htmlspecialchars($_POST['inp_alamat']);
            $email = htmlspecialchars($_POST['inp_email']);
            $no_hp = htmlspecialchars($_POST['inp_no_hp']);
            $website = htmlspecialchars($_POST['inp_website']);
            $longitude = htmlspecialchars($_POST['inp_longitude']);
            $latitude = htmlspecialchars($_POST['inp_latitude']);

            if (isset($_POST['btn_save'])) {
                $update_toko = array(
                    'nama_toko' => $nama_toko,
                    'alamat_toko' => $alamat_toko,
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'no_hp_toko' => $no_hp,
                    'email_toko' => $email,
                    'website_toko' => $website,
                );

                $where = $_POST['inp_id_toko'];

                $this->Model_pemilik->edit_toko($update_toko, $where);
                $this->session->set_flashdata('message', '<div class="alert 
                                alert-success" role="alert">Berhasil Mengubah Toko</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko_detail/detail_toko/' . $where));
            }
        }
    }

    public function tambah_produk_toko($id_toko = null)
    {
        $this->form_validation->set_rules('inp_nama_batik', 'Nama Batik', 'required|min_length[5]|callback_name_batik_space');
        $this->form_validation->set_rules('inp_foto_produk', '', 'callback_file_check_produk');

        $data['id_toko'] = $id_toko;
        $toko = $this->Model_pemilik->ambil_data_toko($id_toko)->row_array();
        $nama_toko = $toko['nama_toko'];
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Tambah Produk Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Tambah_produk_toko");
            $this->load->view("templates/footer");
        } else {
            $nama_batik = htmlspecialchars($_POST['inp_nama_batik']);
            $foto_upload = $_FILES['inp_foto_produk']['name'];
            $id_toko_batik = $_POST['inp_id_toko'];

            //upload_file
            $config['upload_path'] = './public/image/produk_toko/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $nama_toko . rand();
            $config['overwrite'] = true;
            $config['max_size'] = 2024;

            $this->load->library('upload', $config);

            if (!empty($foto_upload)) {
                if ($this->upload->do_upload('inp_foto_produk')) {
                    $upload_foto_produk = $this->upload->data('file_name');
                }
            } else {
                $upload_foto_produk = 'default.jpg';
            }

            if (isset($_POST['btn_save'])) {
                $insert_produk = array(
                    'foto_batik' => $upload_foto_produk,
                    'nama_batik' => $nama_batik,
                    'id_toko' => $id_toko_batik
                );

                $this->Model_pemilik->tambah_produk($insert_produk);
                $this->session->set_flashdata('pesan_produk', '<div class="alert 
                                alert-success" role="alert">Berhasil Menambahkan Produk</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko_detail/produk_toko/' . $id_toko_batik));
            }
        }
    }

    public function edit_produk_toko($id_produk = null)
    {
        $this->form_validation->set_rules('inp_nama_batik', 'Nama Batik', 'required|min_length[5]|callback_name_batik_space');
        $this->form_validation->set_rules('inp_foto_produk', '', 'callback_file_check_produk');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Edit Produk Toko Batik";
            $id_pemilik = $this->session->userdata('id_pemilik');
            $data['pemilik'] = $this->Model_pemilik->ambil_data_pemilik($id_pemilik)->row();
            $data['id_produk'] = $id_produk;
            $data['produk'] = $this->Model_pemilik->ambil_data_produk_by_id_produk($id_produk)->row();
            $this->load->view("templates/header", $data);
            $this->load->view("Pemilik_toko/Edit_produk_toko");
            $this->load->view("templates/footer");
        } else {
            $nama_batik = htmlspecialchars($_POST['inp_nama_batik']);
            $foto_upload = $_FILES['inp_foto_produk']['name'];
            $id_produk_toko = $_POST['inp_id_toko'];
            $id_toko_batik = $_POST['inp_id_toko_batik'];

            //upload_file
            $config['upload_path'] = './public/image/produk_toko/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $nama_batik . rand();
            $config['overwrite'] = true;
            $config['max_size'] = 2024;

            $this->load->library('upload', $config);

            if (!empty($foto_upload)) {
                if ($this->upload->do_upload('inp_foto_produk')) {
                    $upload_foto_produk = $this->upload->data('file_name');
                }
            } else {
                $upload_foto_produk = $_POST['inp_foto_batik'];
            }

            if (isset($_POST['btn_save'])) {
                $update_produk = array(
                    'foto_batik' => $upload_foto_produk,
                    'nama_batik' => $nama_batik,
                );

                $this->Model_pemilik->edit_produk($update_produk, $id_produk_toko);
                $this->session->set_flashdata('pesan_produk', '<div class="alert 
                                alert-success" role="alert">Berhasil Merubah Produk</div>');
                redirect(site_url('Pemilik_toko/Pemilik_toko_detail/produk_toko/' . $id_toko_batik));
            }
        }
    }

    public function hapus_foto_toko($id_toko = null, $id_foto = null)
    {
        $this->Model_pemilik->hapus_foto_toko($id_foto);
        $this->session->set_flashdata('pesan_foto', '<div class="alert 
                                alert-success" role="alert">Berhasil Menghapus Foto</div>');
        redirect(site_url('Pemilik_toko/Pemilik_toko_detail/foto_toko/' . $id_toko));
    }

    public function hapus_produk_toko($id_toko = null, $id_produk = null)
    {
        $this->Model_pemilik->hapus_produk($id_produk);
        $this->session->set_flashdata('pesan_produk', '<div class="alert 
                                alert-success" role="alert">Berhasil Menghapus Produk</div>');
        redirect(site_url('Pemilik_toko/Pemilik_toko_detail/produk_toko/' . $id_toko));
    }

    public function hapus_toko($id_toko = null)
    {
        $this->Model_pemilik->hapus_toko($id_toko);
        $this->session->set_flashdata('pesan_toko', '<div class="alert 
                                alert-success" role="alert">Berhasil Menghapus Toko</div>');
        redirect(site_url('Pemilik_toko/Pemilik_toko'));
    }

    public function aktif($id_foto_toko = null, $id_toko = null)
    {
        //mematikan foto lama
        $foto_profil = $this->Model_pemilik->cek_aktif_foto($id_toko)->row_array();
        $id_foto_toko_lama = $foto_profil['id_foto_toko'];
        $this->Model_pemilik->edit_foto_profil_lama($id_foto_toko_lama);
        //mengubah foto profil baru
        $this->Model_pemilik->edit_foto_profil_baru($id_foto_toko);
        $this->session->set_flashdata('pesan_foto', '<div class="alert 
                                alert-success" role="alert">Berhasil Mengganti Foto Profil</div>');
        redirect(site_url('Pemilik_toko/Pemilik_toko_detail/foto_toko/' . $id_toko));
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

    function name_batik_space($str = null)
    {
        $str = htmlspecialchars($_POST['inp_nama_batik']);
        $pattern = "/^[a-zA-Z- ]*$/";
        if (!preg_match($pattern, $str)) {
            $this->form_validation->set_message('name_batik_space', '%s hanya mengandung huruf dan spasi.');
            return false;
        } else {
            return true;
        }
    }

    public function name_toko_check()
    {
        $nama_toko = htmlspecialchars($_POST['inp_nama']);
        $id_toko = htmlspecialchars($_POST['inp_id_toko']);
        $cek_nama = $this->Model_pemilik->cek_nama_toko($nama_toko, $id_toko);
        if ($cek_nama->num_rows() > 0) {
            $this->form_validation->set_message('name_toko_check', 'Nama Toko Sudah Terpakai.');
            return false;
        } else {
            return true;
        }
    }

    // public function file_check()
    // {
    //     $file_count = count($_FILES['inp_img']['name']);
    //     $ekstensi_file = array('image/jpeg', 'image/jpg', 'image/png');
    //     for ($i = 0; $i < $file_count; $i++) {
    //         $file_upload = get_mime_by_extension($_FILES['inp_img']['name'][$i]);
    //         $file_size = $_FILES['inp_img']['size'][$i];
    //         if (!empty($_FILES['inp_img']['name'][$i])) {
    //             if (in_array($file_upload, $ekstensi_file) === true) {
    //                 if ($file_size < 2097152) {
    //                     return true;
    //                 } else {
    //                     $this->form_validation->set_message('file_check', 'Ukuran File Terlalu Besar.');
    //                     return false;
    //                 }
    //             } else {
    //                 $this->form_validation->set_message('file_check', 'Silahkan pilih file yang berformat jpg, jpeg, dan png.');
    //                 return false;
    //             }
    //         } else {
    //             $this->form_validation->set_message('file_check', 'Silahkan pilih file terlebih dahulu.');
    //             return false;
    //         }
    //     }
    // }

    public function hari_buka_check()
    {
        $hari_buka = $_POST['inp_hari_buka'];
        // print_r($hari_buka);
        // die;
        if (empty($hari_buka)) {
            $this->form_validation->set_message('hari_buka_check', 'Silahkan pilih hari terlebih dahulu.');
            return false;
        } else {
            return true;
        }
    }

    public function hari_tutup_check()
    {
        $hari_tutup = $_POST['inp_hari_tutup'];
        if (empty($hari_tutup)) {
            $this->form_validation->set_message('hari_tutup_check', 'Silahkan pilih hari terlebih dahulu.');
            return false;
        } else {
            return true;
        }
    }

    public function file_check_foto()
    {
        $ekstensi_file = array('image/jpeg', 'image/jpg', 'image/png');
        $file_upload = get_mime_by_extension($_FILES['inp_img']['name']);
        $file_size = $_FILES['inp_img']['size'];
        if (!empty($_FILES['inp_img']['name'])) {
            if (in_array($file_upload, $ekstensi_file)) {
                if ($file_size > 2097152 || $file_size == 00) {
                    $this->form_validation->set_message('file_check_foto', 'Ukuran File Terlalu Besar');
                    return false;
                } else if ($file_size < 2097152) {
                    return true;
                }
            } else {
                $this->form_validation->set_message('file_check_foto', 'Silahkan pilih file yang berekstensi jpeg/jpg/png.');
                return false;
            }
        }
    }

    public function file_check_produk()
    {
        $ekstensi_file = array('image/jpeg', 'image/jpg', 'image/png');
        $file_upload = get_mime_by_extension($_FILES['inp_foto_produk']['name']);
        $file_size = $_FILES['inp_foto_produk']['size'];
        if (!empty($_FILES['inp_foto_produk']['name'])) {
            if (in_array($file_upload, $ekstensi_file)) {
                if ($file_size > 2097152 || $file_size == 00) {
                    $this->form_validation->set_message('file_check_produk', 'Ukuran File Terlalu Besar');
                    return false;
                } else if ($file_size < 2097152) {
                    return true;
                }
            } else {
                $this->form_validation->set_message('file_check_produk', 'Silahkan pilih file yang berekstensi jpeg/jpg/png.');
                return false;
            }
        }
    }
}
