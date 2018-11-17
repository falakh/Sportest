<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AddPost   extends CI_Controller {

    public function index()
    {
        $this->load->model('mLomba');
        $judul =  $this->input->post("judul");
        $isi = $this->input->post("isi");
        $kategori = $this->input->post("kategori");
        $this->mLomba->addLomba('gambar',$isi,$kategori,$judul);
    }

}

/* End of file AddPost .php */
