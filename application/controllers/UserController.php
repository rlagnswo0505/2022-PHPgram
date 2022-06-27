<?php
namespace application\controllers;

// GET은 쿼리스트링으로 값을 보냄
// POST는 은닉화하여 body에 담아서 보냄

// 쿼리스트링은 순서가 중요하지 않다. [sequence X] node 스타일 읽기 속도가 느리나 수정속도가 빠름
// 배열은 순서가 중요하다. [sequence O] 읽기 속도가 빠르나 수정속도가 느림
class UserController extends Controller {
    public function signin() {        
        switch(getMethod()){
            case _GET:
                return "user/signin.php";
            case _POST:
                $email = $_POST['email'];
                $pw = $_POST['pw'];
                $param = ['email' => $email,];

                $dbUser = $this->model->selUser($param);
                if (!$dbUser && !password_verify($pw, $dbUser->pw)) {
                    return "redirect: signin?email={$email}&err";
                }
                // 메모리값을 줄일려고 null
                $dbUser->pw = null;
                $dbUser->regdt = null;
                $this->flash(_LOGINUSER,$dbUser);
                
                return "redirect:/feed/index";
        }
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
                $param['pw'] = password_hash($param['pw'], PASSWORD_BCRYPT);
                $this->model->insUser($param);
                return "redirect:signin";
        }
    }
}