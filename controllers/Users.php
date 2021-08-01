<?php
require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Users {

    private $userModel;

    public function __construct(){
        $this->userModel = new User;
    }

    public function register(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $data = [
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'adress' => trim($_POST['adress']),
            'city' => trim($_POST['city']),
            'phone' => trim($_POST['phone']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'pwdRepeat' => trim($_POST['pwdRepeat']),

        ];


        if(empty($data['first_name']) || empty($data['last_name']) || empty($data['adress']) ||
            empty($data['city']) || empty($data['phone']) || empty($data['email']) ||
            empty($data['password']) || empty($data['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../view/signup.php");
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email");
            redirect("../view/signup.php");
        }

        if(strlen($data['password']) < 6){
            flash("register", "Invalid password");
            redirect("../view/signup.php");
        } else if($data['password'] !== $data['pwdRepeat']){
            flash("register", "Passwords don't match");
            redirect("../view/signup.php");
        }


        if($this->userModel->findUserByEmail($data['email'])){
            flash("register", "Email already taken");
            redirect("../view/signup.php");
        }


        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if($this->userModel->register($data)){
            redirect("../view/login.php");
        }else{
            die("Something went wrong");
        }
    }

    public function login(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $data=[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];

        if(empty($data['email']) || empty($data['password'])){
            flash("login", "Please fill out all inputs");
            header("location: ../view/login.php");
            exit();
        }


        if($this->userModel->findUserByEmail($data['email'])){

            $loggedInUser = $this->userModel->login($data['email'], $data['password']);


            if($loggedInUser){
                $this->createUserSession($loggedInUser);
            }else{

                flash("login", "Password Incorrect");
                redirect("../view/login.php");
            }
        }else{
            flash("login", "No user found");
            redirect("../login.php");
        }
    }

    public function createUserSession($user){
        $_SESSION['id_user'] = $user->usersId;
        $_SESSION['email'] = $user->usersEmail;
        redirect("../view/index.php");
    }

    public function logout(){
        unset($_SESSION['id_user']);
        unset($_SESSION['email']);
        session_destroy();
        redirect("../view/index.php");
    }
}

$init = new Users;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['type']){
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
            redirect("../view/index.php");
    }

}else{
    switch($_GET['q']){
        case 'logout':
            $init->logout();
            break;
        default:
            redirect("../index.php");
    }
}
