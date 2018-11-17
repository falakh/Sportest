<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class cKomentar extends CI_Controller {

    public function addKomentar( $id_lomba,$userName,$komentar )
    {
        $this->load->model('mKomentar');
        $hasil =   $this->mKomentar->addKomentar($id_lomba,$userName,$komentar);
        echo json_encode($hasil);
        
        # code...
    }

    public function showKomentar($id)
    {
     $this->load->model('mKomentar');
        $hasil =   $this->mKomentar->showKomentar($id);   
        echo json_encode($hasil);
    }

}

/* End of file cKomentar.php */

?>