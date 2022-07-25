<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Login extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_m');
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function index_post()
    {
            $nik = $this->input->post('nik');
            $password = $this->input->post('password');
            $response = $this->login_m->login($nik,$password);
            $this->response($response);
    }

    function getMenu_post()
    {
        $nik = $this->input->post('nik');
        $response = $this->login_m->getMenu($nik);
        $this->response($response);
    }

}
