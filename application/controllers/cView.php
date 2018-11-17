<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class cView extends CI_Controller {

    public function index()
    {
        $this->load->model("mLomba");
        $data["hasil"] = $this->mLomba->getAllLomba();
        $this->load->view("sportest/index.php",$data);
    }
    public function load($view)
    {
        $this->load->view($view);
    }

}

/* End of file cView.php */

?>