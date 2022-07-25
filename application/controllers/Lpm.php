<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Lpm extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lpm_m');
    }

    function index_post()
    {
            $id_palet = $this->input->post('id_palet');
            $response = $this->lpm_m->getPalet($id_palet);
            $this->response($response);
    }

    function index_put()
    {
        $iduser = $this->input->post('iduser');
        $id_palet = $this->input->post('id_palet');
        $status_palet = $this->input->post('status_palet');
        $response = $this->lpm_m->updatePalet($iduser,$id_palet,$status_palet);
        $this->response($response);
    }

    function qc_post() {

    }

}
