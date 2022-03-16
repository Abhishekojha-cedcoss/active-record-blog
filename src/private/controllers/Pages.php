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
                    header("location: adminHome");
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
    public function adminHome()
    {
        if (isset($_POST["delete"])) {
            $id=$_POST["id"];
            $this->blogModel::table()->delete(array('blog_id' => array($id)));
        }
        $result=$this->blogModel::find("all");
        $this->view("pages/admin/adminHome", $result);
    }
    public function viewBlogAdmin()
    {
        if (isset($_POST["submit"])) {
            $id=$_POST["id"];
            $result1=$this->blogModel::find("all", array("blog_id"=>$id));
            $this->view('pages/admin/viewBlogAdmin', $result1);
        }
    }
    public function editBlog()
    {
        $arr=array();
        if (isset($_POST["edit"])) {
            $pid=$_POST["id"];
            $name=$_POST["name"];
            $image=$_POST["image"];
            $description=$_POST["description"];
            $arr=array("id"=>$pid,"name"=>$name,"image"=>$image,"description"=>$description);
            $this->view('pages/admin/editblog', $arr);
        }
        if (isset($_POST["update"])) {
            $id=$_POST["prodID"];
            $bname=$_POST["bname"];
            $description=$_POST["description"];
            $image=$_POST["image"];
            // $this->blogModel->updateBlog($id, $bname, $description, $image);
            $result=$this->blogModel::find(array('blog_id'=>$id));
            $result->blog_name=$bname;
            $result->blog_description=$description;
            $result->blog_image=$image;
            $result->save();
            header("location:adminHome");
        }
    }
}
