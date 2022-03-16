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
        $result="";
        if (isset($_POST["submit"])) {
            $result="Wrong email or password!";
            $postdata= $_POST ?? array();
            $email= $postdata["email"];
            $password= $postdata["password"];
            $result=$this->userModel::find("all");
            foreach ($result as $user) {
                if (($user->email == $email) && ($user->password == $password) && ($user->status == 'approved') &&
                 ($user->role == 'user')) {
                    header("location: userdash");
                } elseif (($user->email == $email) && ($user->password == $password) &&
                ($user->status == 'approved') && ($user->role == 'admin')) {
                    header("location: admindash");
                } elseif (($user->email == $email) && ($user->password == $password) &&
                ($user->status == 'pending') && ($user->role == 'user')) {
                    $result = "You are not approved!";
                }
            }
        }
        $this->view('pages/login', $result);
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
    public function userdash()
    {
        echo "hello User";
        die;
        // $result1=$this->blogModel->showAllBlogs();
        // $this->view('pages/userdash', $result1);
    }
    public function admindash()
    {
        echo "hello admin";
        // if (isset($_POST["submit"])) {
        //     $id = $_POST["id"];
        //     $result1=$this->userModel->updateStatus($id);
        //     foreach ($result1 as $k => $v) {
        //         if ($v["Status"] == "pending") {
        //             $this->userModel->statusApproved($id);
        //         } elseif ($v["Status"] == "approved") {
        //             $this->userModel->statusPending($id);
        //         }
        //     }
        // }
        // if (isset($_POST["submit1"])) {
        //     $id1 = $_POST["del"];
        //     $this->userModel->deleteUser($id1);
        // }
        // $result2=$this->userModel->getAllUsers();
        // $this->view('pages/admin/dashboard', $result2);
    }
}
