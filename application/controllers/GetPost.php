<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GetPost extends CI_Controller {

    public function index()
    {
        $this->load->model("Lomba");
        $this->Lomba->getAllLomba(1,2);
    }

}

/* End of file GetPost.php */


?>