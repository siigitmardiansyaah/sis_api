<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lpm_m extends CI_Model {

    function getPalet($id_palet) 
    {
        $this->db->where('idpal',$id_palet);
        $query = $this->db->get('produksi')->result();
        if($query) {
            $response['status']=200;
            $response['error']=false;
            $response['menu_lpm']=$query;
            return $response;
        }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Data Palet Gagal Ditampilkan';
            return $response;
        }
    }

    function updatePalet($iduser,$id_palet,$status_palet)
    {
        $this->db->where('idpal',$id_palet);
        $query = $this->db->get('produksi')->row();
        if($query->status == NULL || $query->status == 'Karantina Reguler' || $query->status == 'Karantina Khusus')
        {
            $this->db->set('status',$status_palet);
            $this->db->set('id_ipc',$iduser);
            $this->db->where('idpal',$id_palet);
            $query1 = $this->db->update('produksi');
            if($query1) {
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data Palet Berhasil Diupdate';
                return $response;
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data Palet Gagal Diupdate';
                return $response;
            }
        }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Status Palet Sudah Lulus Uji';
            return $response;
        } 
    }
}

