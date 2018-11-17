<?php

class cUser extends CI_Controller {

    public function login()
    {
        if(isset($_POST["userName"])&&isset($_POST["password"])){
            $username= $_POST["userName"];
            $password =$_POST["password"];
            $this->load->model("mUser");
            $this->mUser->validasiLogin($username,$password);
        }else{
            session_start();
            if(isset($_SESSION["userId"])){
                
                redirect(base_url(),'refresh');
                
            }else{
                $this->load->view("sportest/login.php");
            }
            session_abort();
        }
    
    }

    public function isLogin()
    {
        session_start();
        if(isset($_SESSION["userId"])){
            $data["hasil"] = "sukses";

        }else{
            $data["hasil"]="fail";
        }
        echo json_encode($data);
        session_abort();
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->isLogin();
    }

}

/* End of file login.php */
?>