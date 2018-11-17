<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
defined('BASEPATH') OR exit('No direct script access allowed');

class mLomba extends CI_Model {

    public function getAllLomba()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("post");
        $result = $this->db->get()->result();
        return(json_encode($result));
    }

    public function getAllLombaKategori(string $kategori){
         $this->load->database();
        $this->db->select("*");
        $this->db->from("post");
        $this->db->where("kategori",$kategori);
    }

    public function addLomba($image,$isi,$kategori,$judul)
    {
        $config['upload_path']='./uploads/';
        $config['allowed_types']='jpg|png';
        $config['max_size']=20048;
        $this->load->library('upload',$config);
        $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload($image))
        {
        $error = array('error' => $this->upload->display_errors());
        echo json_encode($error);
        }
            else
        {
            $data = array('upload_data' => $this->upload->data());
            // get file name
            $this->load->database();
            $input = array(
                "post" => $isi,
                'waktu' => date("Y/m/d"),
                'userId'=> $_SESSION['userId'],
                'kategori' =>$kategori,
                'gambar' =>base_url('uploads/') . $this->upload->file_name,
                'judul' => $judul
                        );
        $result = $this->db->insert('post',$input);
        $output = array(
            "status" => $result>=1 ? "sukses":"fail",
        );
    echo json_encode($output);
        }

    }
    public function getLombaByKategori($kategori)
    {
        // echo $kategori;
        $this->load->database();
        $this->db->select("*");
        $this->db->from("post");
        $this->db->where("kategori",$kategori);
        return $this->db->get()->result();

    }
    public function getLombaByUsername($userId)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("post");
        $this->db->where("userId =",$userId);
        return $this->db->get()->result();
    }
    public function updateLomba($id,$post)
    {
       $this->load->database();
       $post = html_entity_decode($post,ENT_HTML5);
       $this->db->set("post",$post);
       $this->db->where("idPost",$id);
       return $this->db->update("post");

    }

    public function getLombabyId($id)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("post");
        $this->db->where("idPost",$id);
        $post = $this->db->get()->result_object(); 
       return $post; 
        
    }
}




/* End of file Post_Model.php */

?>