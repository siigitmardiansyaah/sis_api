<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      }
    
 function login($nik,$password) 
 {
    if(empty($nik) || empty($password))
    {
        if(empty($nik) || empty($password))
        {
            return $this->empty_response();
        }else if($empty($nik))
        {
            $response['status']=502;
            $response['error']=true;
            $response['message']='NIK harus diisi';
            return $response;
        }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Password harus diisi';
            return $response;
        }
    }else{
        $this->db->where('iduser',$nik);
        $query = $this->db->get('master_user')->row();
        if($password != $query->password)
        {
            $response['status']=502;
            $response['error']=true;
            $response['message']='Password Tidak Sama';
            return $response;
        }else{
            $this->db->where('iduser',$nik);
            if($query->kd_div == 'PPIC' || $query->kd_div === 'GDG')
            {
            $query1 = $this->db->get('master_user')->result();
            }else if ($query->kd_div == 'LPM'){
            $query1 = $this->db->get('master_user')->result();
            }else {
                $response['status']=502;
                $response['error']=true;
                $response['message']='Divisi Anda Tidak Menggunakan App Mobile';
                return $response;
            }
            if($query1){
                $response['status']=200;
                $response['error']=false;
                $response['login']=$query1;
                return $response;
              }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data Pegawai Gagal Ditampilkan';
                return $response;
              }
            }
        }
    }

    function getMenu($nik)
    {
        $this->db->join('usertocabmenu b','a.idmasuser = b.idmasuser');
        $this->db->join('sub_cab_menu c','b.idsubmenu = c.idsubcab');
        $this->db->where('a.iduser',$nik);
        $this->db->where('a.kd_div','LPM');
        $this->db->where('c.idsubcab','925E0975-EC78-4943-A788-6378430A4ED7');
        $query =  $this->db->get('master_user a')->num_rows();
        if($query > 0){
            $response['status']=200;
            $response['error']=false;
            $response['menu_lpm']=$query;
            return $response;
          }else{
            $this->db->join('usertocabmenu b','a.idmasuser = b.idmasuser');
            $this->db->join('sub_cab_menu c','b.idsubmenu = c.idsubcab');
            $this->db->where('a.iduser',$nik);
            $this->db->where('a.kd_div','LPM');
            $this->db->where('c.idsubcab','F34FC72D-C69D-41B2-876E-F7448E6235A6');
            $query1 =  $this->db->get('master_user a')->num_rows();
            if($query1 > 0) {
                $response['status']=200;
                $response['error']=false;
                $response['menu_lpm']=$query1;
            return $response;
            }else{
                $response['status']=200;
                $response['error']=false;
                $response['menu_lpm']= "0";
                return $response;
            }
          }
    }
}

