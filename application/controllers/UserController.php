<?php
namespace application\controllers;

class UserController extends Controller {
    public function signin() {        
        return "user/signin.php";
    }

    public function signup() {
        switch(getMethod()){
            case _GET:
                return "user/signup.php";
            case _POST:
                $param = [
                    'email' => $_POST["email"],
                    'pw' => $_POST["pw"],
                    'nm' => $_POST["nm"],
                ];
                $param['upw'] = password_hash($param['upw'], PASSWORD_BCRYPT);
                $this->model->insUser($param);
                return "redirect:signin";
        }
    }
}