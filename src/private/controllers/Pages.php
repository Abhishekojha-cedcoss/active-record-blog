<?php
namespace App\Controllers;

use App\Libraries\Controller;
use Exception;

class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('Users');
        $this->blogModel = $this->model('Blog');
    }
    public function index()
    {
        $this->view('pages/sample');
    }
    public function login()
    {
        $this->view('pages/login');
    }
    public function signup()
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
        }
        $data="";
        $postdata= $_POST ?? array();
        if (isset($_POST['username'])&& isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['firstname']) && isset($_POST['lastname'])) {
            try {
                $this->userModel->username= $postdata["username"];
                $this->userModel->email= $postdata["email"];
                $this->userModel->password= $postdata["password"];
                $this->userModel->firstname= $postdata["firstname"];
                $this->userModel->lastname= $postdata["lastname"];
                $this->userModel->status= "pending";
                $this->userModel->role= "user";
                $this->userModel->save();
                $data="Wait for the admin to accept the request";
            } catch (Exception $e) {
                $data="You are already registered! Please Login";
            }
        }
        $this->view("pages/signup", $data);
    }
}
