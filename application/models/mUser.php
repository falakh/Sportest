<?php
 session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class mUser extends CI_Model {


    public function validasiLogin($email,$pass)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->where('password',$pass);
        $result["data"] = $this->db->get()->result();
        if(sizeof($result["data"])){
            $_SESSION['userId']=$result["data"][0]->userId;
            $_SESSION['userName']=$result["data"][0]->nama;
            $result["status"]="sukses";
        }else{
              $result["status"]="fail";
        }
        echo json_encode($result);
        
      
    }

    public function addUser($email,$password,$nama)
    {
        $this->load->database();
        $array = array(
            'email' => $email,
            'nama' =>$nama,
            'password' =>$password
        );
        print_r($array);
        $this->db->reset_query();
        $this->db->insert('user',$array);

        echo json_encode($this->db);
    }

}

/* End of file user.php */

?>