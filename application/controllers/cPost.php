<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class cPost extends CI_Controller {
    
        public function getAllLomba()
    {
            $this->load->model("mLomba");
        $this->mLomba->getAllLomba(1,2);
    }

    public function getAllLombaKategori(string $kategori){
       $this->load->model("mLomba");
       $this->lomba->getAllLombaKategori($kategori);
    }

    public function addLomba($image,$isi,$kategori,$judul)
    {
         $this->load->model('Lomba');
        $judul =  $this->input->post("judul");
        $isi = $this->input->post("isi");
        $kategori = $this->input->post("kategori");
        echo $_FILES["gambar"];
        $this->mLomba->addLomba('gambar',$isi,$kategori,$judul);

    }
    public function getLombaByKategori($kategori)
    {
        $this->load->model("mLomba");

       $hasil["hasil"] = json_encode($this->mLomba->getLombaByKategori($kategori));
        // echo $hasil["hasil"];
          $this->load->view("sportest/index.php",$hasil);

    }
    public function getLombaByUsername($userId)
    {
        $this->load->model("mLomba");
        $hasil = $this->mLomba->getLombaByUsername($userId);
        
        $result["data"] = json_encode($hasil);
        $this->load->view("sportest/mypost",$result);
     
        
    }
    public function editLomba($id,$post)
    {
        if(isset($id) && isset($post)){
        $this->load->model("mLomba");
        // echo html_entity_decode($post,ENT_HTML5);
        ($this->mLomba->updateLomba($id,$post));
        }
   
    }

    public function getLombaById($id)
    {

        $this->load->model("mLomba");
        $data["id"]=$id;
        $data["hasil"] = $this->mLomba->getLombaById($id);
        $this->load->model('mKomentar');
        $data["komentar"] =$this->mKomentar->showKomentar($id);
        $result["hasil"] = json_encode($data);
        $this->load->view("sportest/post",$result);

    }
    }
    
    
    
    /* End of file cPost.php */


?>