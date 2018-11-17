<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mKomentar  extends CI_Model {

      public function addKomentar( $id_lomba,$userName,$komentar )
    {
        $result;
        $this->load->database();
        $data = array(
        'idLomba' => $id_lomba,
        'username'=> $userName,
        'komentar'=>$komentar
        );
        $row = $this->db->insert('komentar',$data);
        if ( $row){
            $result["hasil"]='sukses';
            $result["data"] = $this->showKomentar($id_lomba);
        }else{
            $result["hasil"]='fail';
        }
        return $result;
        

        # code...
    }

    public function showKomentar($id)
    {
         $result;
        $this->load->database();
        $this->db->select("idKomentar,komentar,user.nama,waktu");
        $this->db->from("user");
        $this->db->join("komentar","komentar.username = user.userId");
        $this->db->where("idLomba",$id);
        return   $this->db->get()->result();
        
        

    }

}

/* End of file mKomentar .php */


?>