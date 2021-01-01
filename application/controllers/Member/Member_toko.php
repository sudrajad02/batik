<?php

class Member_toko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); {
            $this->load->model('Member/Model_member');
            $this->load->library('form_validation');
            $this->load->library('Pdf');
        }
    }

    public function index()
    {
        //load library
        $this->load->library('pagination');

        //config
        $config['base_url'] = base_url() . 'Member/Member_toko/index';
        $config['total_rows'] = $this->Model_member->hitung_toko()->num_rows();
        $config['per_page'] = 3;

        //style
        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

        $config['next_link'] = '&raquo';

        $config['prev_link'] = '&laquo';

        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';

        //initialize
        $this->pagination->initialize($config);

        $data['judul'] = "Toko Batik";
        $data['cek_toko'] = $this->Model_member->hitung_toko()->num_rows();
        $data['start'] = $this->uri->segment(4);
        $data['toko'] = $this->Model_member->ambil_data_toko_semua_pag($config['per_page'], $data['start'])->result();
        $this->load->view("templates/header_member", $data);
        $this->load->view("Member/Toko_batik_member");
        $this->load->view("templates/footer_member");
    }

    public function detail_toko($id_toko = null, $id_komentar = null)
    {
        $id_member = $this->session->userdata('id_member');
        $toko_batik = $this->Model_member->ambil_data_toko($id_toko)->row();
        $data['judul'] = $toko_batik->nama_toko;
        $data['toko'] = $toko_batik;
        $data['foto_toko'] = $this->Model_member->ambil_data_toko($id_toko)->result();
        $data['foto_toko_profil'] = $this->Model_member->ambil_data_foto_toko_profil($id_toko)->row();
        $data['cek_member'] = $this->Model_member->cek_member_toko($id_member, $id_toko)->num_rows();
        $data['jml_komentar'] = $this->Model_member->ambil_data_komentar_semua($id_toko)->num_rows();
        $data['cek_produk'] = $this->Model_member->ambil_data_produk($id_toko)->num_rows();
        $data['produk'] = $this->Model_member->ambil_data_produk($id_toko)->result();
        $data['cek_komentar'] = $this->Model_member->cek_komen($id_toko)->num_rows();
        $data['komentar'] = $this->Model_member->buat_pohon($id_toko);
        $data['reply'] = $id_komentar;
        $this->load->view("templates/header_member", $data);
        $this->load->view("Member/Detail_toko_batik");
        $this->load->view("templates/footer_member");
    }

    public function join_member($id_toko = null)
    {
        $id_member = $this->session->userdata('id_member');
        $komentar = $this->session->userdata('komentar');
        $parent_id = $this->session->userdata('parent_id');
        $id_toko_batik = $this->session->userdata('id_toko');
        $id_akun = $this->session->userdata('id_akun');
        $tgl_komen = $this->session->userdata('tgl_komen');
        $id_toko_komen = $this->session->userdata('id_toko_komen');
        $komentar_member = $this->session->userdata('komentar_member');
        $id_akun_member = $this->session->userdata('id_akun_member');
        $tgl_komen_member = $this->session->userdata('tgl_komen_member');
        $parent_id_member = $this->session->userdata('parent_id_member');

        if (!empty($id_member)) {
            if (!empty($komentar)) {
                if (!empty($parent_id)) {
                    $insert_komen = array(
                        'id_toko' => $id_toko_batik,
                        'komentar' => $komentar,
                        'id_akun' => $id_akun,
                        'tgl_komen' => $tgl_komen,
                        'status_komentar' => 1,
                        'parent_id' => $parent_id,
                        'is_toko' => 'N'
                    );
                } else {
                    $insert_komen = array(
                        'id_toko' => $id_toko_batik,
                        'komentar' => $komentar,
                        'id_akun' => $id_akun,
                        'tgl_komen' => $tgl_komen,
                        'status_komentar' => 1,
                        'is_toko' => 'N'
                    );
                }
                $this->Model_member->tambah_member($id_member, $id_toko);
                $this->Model_member->simpan_komen($insert_komen);
                redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
            } else {
                if (!empty($komentar_member)) {
                    if (!empty($parent_id_member)) {
                        $insert_komen = array(
                            'id_toko' => $id_toko_komen,
                            'komentar' => $komentar_member,
                            'id_akun' => $id_akun_member,
                            'tgl_komen' => $tgl_komen_member,
                            'status_komentar' => 1,
                            'parent_id' => $parent_id_member,
                            'is_toko' => 'N'
                        );
                    } else {
                        $insert_komen = array(
                            'id_toko' => $id_toko_komen,
                            'komentar' => $komentar_member,
                            'id_akun' => $id_akun_member,
                            'tgl_komen' => $tgl_komen_member,
                            'status_komentar' => 1,
                            'is_toko' => 'N'
                        );
                    }
                    $this->Model_member->tambah_member($id_akun_member, $id_toko_komen);
                    $this->Model_member->simpan_komen($insert_komen);
                    redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
                } else {
                    $this->Model_member->tambah_member($id_member, $id_toko);
                    redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
                }
            }
        } else {
            $this->session->set_flashdata('message', '<center><div class="alert 
                                alert-danger" role="alert">Anda Harus Login Telebih Dahulu.</div></center>');
            $this->session->set_userdata('id_toko', $id_toko);
            redirect(site_url('Login'));
        }
    }

    public function tambah_komen_proses()
    {
        $this->form_validation->set_rules('inp_nama', 'Nama', 'trim|required');
        $id_member = $this->session->userdata('id_member');
        $id_toko = htmlspecialchars($_POST['inp_id_toko']);
        $komentar_member = htmlspecialchars($_POST['inp_komentar']);
        $parent_id = htmlspecialchars(isset($_POST['inp_parent_id']));
        $data['toko'] = $this->Model_member->ambil_data_toko($id_toko);
        $data['komentar'] = $this->Model_member->ambil_data_komentar_semua($id_toko);
        $cek_member = $this->Model_member->cek_member_toko($id_member, $id_toko)->num_rows();
        $this->load->view("templates/header_member", $data);
        $this->load->view("Member/Detail_toko_batik");
        $this->load->view("templates/footer_member");

        if (isset($_POST['btn_komen'])) {
            if (!empty($komentar_member)) {
                if (!empty($id_member)) {
                    if ($cek_member > 0) {
                        $parent_id = $_POST['inp_parent_id'];
                        if (!empty($parent_id)) {
                            $insert_komen = array(
                                'id_toko' => $id_toko,
                                'komentar' => $komentar_member,
                                'id_akun' => $id_member,
                                'tgl_komen' => date("Y-m-d"),
                                'status_komentar' => 1,
                                'parent_id' => $parent_id
                            );
                        } else {
                            $insert_komen = array(
                                'id_toko' => $id_toko,
                                'komentar' => $komentar_member,
                                'id_akun' => $id_member,
                                'tgl_komen' => date("Y-m-d"),
                                'status_komentar' => 1,
                            );
                        }

                        $this->Model_member->simpan_komen($insert_komen);
                        redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
                    } else {
                        if (!empty($parent_id)) {
                            $komen_member = array(
                                'id_toko_komen' => $id_toko,
                                'komentar_member' => $komentar_member,
                                'id_akun_member' => $id_member,
                                'tgl_komen_member' => date("Y-m-d"),
                                'status_komentar_member' => 1,
                                'parent_id_member' => $parent_id
                            );
                        } else {
                            $komen_member = array(
                                'id_toko_komen' => $id_toko,
                                'komentar_member' => $komentar_member,
                                'id_akun_member' => $id_member,
                                'tgl_komen_member' => date("Y-m-d"),
                                'status_komentar_member' => 1,
                            );
                        }
                        $this->session->set_userdata($komen_member);
                        $this->session->set_flashdata('member_message', '<center><div class="alert 
                                alert-danger" role="alert">Anda Harus Menjadi Member Telebih Dahulu.</div></center>');
                        redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
                    }
                } else {
                    if (!empty($parent_id)) {
                        $komen_member = array(
                            'id_toko_komen' => $id_toko,
                            'komentar' => $komentar_member,
                            'id_akun' => $id_member,
                            'tgl_komen' => date("Y-m-d"),
                            'status_komentar' => 1,
                            'parent_id' => $parent_id
                        );
                    } else {
                        $komen_member = array(
                            'id_toko_komen' => $id_toko,
                            'komentar' => $komentar_member,
                            'id_akun' => $id_member,
                            'tgl_komen' => date("Y-m-d"),
                            'status_komentar' => 1,
                        );
                    }
                }
                $this->session->set_flashdata('member_message', '<center><div class="alert 
                            alert-danger" role="alert">Anda Harus Login Dahulu.</div></center>');
                $this->session->set_userdata($komen_member);
                redirect(site_url('Login'));
            } else {
                $this->session->set_flashdata('eror', '<center><div class="alert 
                                alert-danger" role="alert">Kolom komentar tidak boleh kosong!</div></center>');
                redirect(site_url('Member/Member_toko/detail_toko/' . $id_toko));
            }
        }
    }

    public function print_katalog()
    {
        $data['judul'] = 'Cetak Katalog Batik';
        $data['toko'] = $this->Model_member->ambil_data_toko_semua()->result();
        $this->load->view('Member/Cetak_katalog_member', $data);
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream("Katalog Toko Batik.pdf", array("Attachment" => 0));
    }

    public function print_detail_toko($id_toko = null)
    {
        $data['judul'] = 'Cetak Detail Batik';
        $data['toko'] = $this->Model_member->ambil_data_toko($id_toko)->row_array();
        $this->load->view('Member/Cetak_detail_member', $data);
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream("Detail Toko Batik.pdf", array("Attachment" => 0));
    }
}
