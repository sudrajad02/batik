<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            $this->load->model('Model_login');
            $this->load->model('Member/Model_member');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('inp_username', 'Username', 'trim|required');
        $this->form_validation->set_rules('inp_password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Login";
            $this->load->view("templates/header_login", $data);
            $this->load->view("Login");
            $this->load->view("templates/footer_login");
        } else {
            $username = $_POST['inp_username'];
            $password = md5($_POST['inp_password']);
            $tgl_login = date('Y-m-d');


            $where = array(
                'username' => $username,
                'password' => $password
            );
            $cek = $this->Model_login->cek_login($username)->num_rows();
            $cek_akun = $this->Model_login->cek_login($username)->row_array();
            $data = $this->Model_login->ambil_data_semua_akun($where)->row_array();

            if ($cek > 0) {
                if ($cek_akun['status_akun'] == 1) {
                    if ($cek_akun['status_blok'] == "N") {
                        if ($cek_akun['password'] == $password) {
                            if ($data['id_hak_akses'] == 1) {
                                $data_session = array(
                                    'id_admin' => $data['id_akun'],
                                    'username' => $username,
                                    'nama' => $data['nama'],
                                    'email' => $data['email'],
                                    'hak_akses' => $data['id_hak_akses'],
                                    'status' => 'login'
                                );
                                $this->session->set_userdata($data_session);
                                redirect(site_url('Admin/Admin'));
                            } else if ($data['id_hak_akses'] == 2) {
                                $data_session = array(
                                    'id_pemilik' => $data['id_akun'],
                                    'username' => $username,
                                    'nama' => $data['nama'],
                                    'email' => $data['email'],
                                    'hak_akses' => $data['id_hak_akses'],
                                    'status' => 'login'
                                );
                                $this->session->set_userdata($data_session);
                                redirect(site_url('Pemilik_toko/Pemilik'));
                            } else if ($data['id_hak_akses'] == 3) {
                                $data_session = array(
                                    'id_member' => $data['id_akun'],
                                    'username' => $username,
                                    'nama' => $data['nama'],
                                    'email' => $data['email'],
                                    'hak_akses' => $data['id_hak_akses'],
                                    'status' => 'login_member'
                                );
                                $this->session->set_userdata($data_session);
                                $id_toko = $this->session->userdata('id_toko');
                                $id_member = $data['id_akun'];
                                $komentar = $this->session->userdata('komentar');
                                $id_toko_komen = $this->session->userdata('id_toko_komen');
                                $cek_member = $this->Model_member->cek_member_toko($id_member, $id_toko_komen)->num_rows();
                                if (!empty($id_toko)) {
                                    $this->Model_member->tambah_member($id_member, $id_toko);
                                    redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
                                    $this->session->unset_userdata('id_toko');
                                } else if (!empty($komentar)) {
                                    if ($cek_member > 0) {
                                        $parent_id = $this->session->userdata('parent_id');
                                        if (!empty($parent_id)) {
                                            $insert_komen = array(
                                                'id_toko' => $id_toko_komen,
                                                'komentar' => $komentar,
                                                'id_akun' => $id_member,
                                                'tgl_komen' => date("Y-m-d"),
                                                'status_komentar' => 1,
                                                'parent_id' => $parent_id,
                                                'is_toko' => 'N'
                                            );
                                        } else {
                                            $insert_komen = array(
                                                'id_toko' => $id_toko_komen,
                                                'komentar' => $komentar,
                                                'id_akun' => $id_member,
                                                'tgl_komen' => date("Y-m-d"),
                                                'status_komentar' => 1,
                                                'is_toko' => 'N'
                                            );
                                        }

                                        $this->Model_member->simpan_komen($insert_komen);
                                        redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko_komen));
                                        $this->session->unset_userdata('id_toko', 'komentar', 'id_member', 'tgl_komen', 'status_komentar', 'parent_id');
                                    } else {
                                        if (!empty($parent_id)) {
                                            $komen_member = array(
                                                'id_toko' => $id_toko_komen,
                                                'komentar' => $komentar,
                                                'id_akun' => $id_member,
                                                'tgl_komen' => date("Y-m-d"),
                                                'parent_id' => $parent_id
                                            );
                                        } else {
                                            $komen_member = array(
                                                'id_toko' => $id_toko_komen,
                                                'komentar' => $komentar,
                                                'id_akun' => $id_member,
                                                'tgl_komen' => date("Y-m-d"),
                                            );
                                        }
                                        $this->session->set_flashdata('member_message', '<center><div class="alert 
                                                alert-danger" role="alert">Anda Harus Menjadi Member Telebih Dahulu.</div></center>');
                                        $this->session->set_userdata($komen_member);
                                        redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko_komen));
                                    }
                                }
                                redirect(site_url('Beranda_member'));
                            } else {
                                $this->session->set_flashdata('message', 'Akun Tidak Terdaftar');
                                redirect(site_url('Login'));
                            }
                        } else {
                            $id_akun = $cek_akun['id_akun'];
                            $cek_users_counter = $this->Model_login->cek_user_counter($id_akun, $tgl_login)->num_rows();
                            if ($cek_users_counter > 0) {
                                $jml_users_login = $this->Model_login->cek_user_counter($id_akun, $tgl_login)->row_array();
                                $number_login = intval($jml_users_login['jml_users_counter']) + 1;
                                $id_users_counter = $jml_users_login['id_users_counter'];
                                $update_counter = array(
                                    'jml_users_counter' => $number_login,
                                    'tgl_users_counter' => $tgl_login
                                );
                                $this->Model_login->ubah_users_counter($update_counter, $id_users_counter);

                                if ($number_login == 3) {
                                    $this->Model_login->ubah_status_blok($id_akun);
                                }
                            } else {
                                $number_login = 1;
                                $insert_counter = array(
                                    'jml_users_counter' => $number_login,
                                    'tgl_users_counter' => $tgl_login,
                                    'id_akun' => $id_akun
                                );
                                $this->Model_login->tambah_users_counter($insert_counter);
                            }
                            $this->session->set_flashdata('message', '<div class="alert 
                                alert-danger" role="alert">Password Salah</div>');
                            redirect(site_url('Login'));
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert 
                        alert-danger" role="alert">Akun Diblok Silahkan Hubungi Admin</div>');
                        redirect(site_url('Login'));
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert 
                        alert-danger" role="alert">Akun Belum Aktivasi</div>');
                    redirect(site_url('Login'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Akun Belum Terdaftar</div>');
                redirect(site_url('Login'));
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('Beranda_member'));
    }
}
