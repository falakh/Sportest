<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class cRegister extends CI_Controller {

    public function register()
    {
        if(isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password'])  ){
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->load->model('mUser');
        $this->mUser->addUser($email,$password,$userName);
        }else{
            $this->load->view("sportest/signup.php");
        }
               
        
    }

}

/* End of file register.php */

?>