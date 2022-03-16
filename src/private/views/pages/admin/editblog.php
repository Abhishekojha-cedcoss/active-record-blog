<?php
global $settings;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $settings['siteurl']?>node_modules/bootstrap/dist/css/bootstrap.min.css" 
    rel="stylesheet" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      #sidebarMenu li a:hover {
        color: #1abc9c !important;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?php echo $settings['siteurl']?>assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" 
  data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" 
  aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="signout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo $settings['siteurl'] ?>pages/adminHome">
              <span data-feather="shopping-cart"></span>
              Blogs
            </a>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center 
      pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Blog</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
       

      <form class="row g-3" action="<?php echo $settings['siteurl']?>pages/editblog" method="POST">

        <div class="col-md-6">
          <label for="pname" class="form-label">Blog Name</label>
          <input type="text" class="form-control" id="bname" name="bname" required value="<?php echo $data["name"]; ?>">
        </div>
        <div class="col-md-3">
          <label for="list" class="form-label">Blog Image</label>
          <input type="text" class="form-control" id="image" name="image" 
          required value="<?php echo $data["image"]; ?>">
        </div>
        <div class="col-md-12">
          <label for="sale" class="form-label">Blog Description</label>
          <textarea name="description" id="sale" cols="50" rows="10">
            <?php echo $data["description"];
?></textarea>
        </div>
        <div class="col-md-12">
          <input type="hidden" class="form-control" name="prodID" value="<?php echo $data["id"]; ?>">
        </div>

        <div class="col-2">
          <button type="submit" class="btn btn-primary" name="update">Update Blog</button>
        </div>
        <div class="col-2">
          <a href="<?php echo URLROOT ?>pages/adminHome" class="btn btn-success">cancel</a>
        </div>
      </form>      
    </main>
  </div>
</div>


    <script src="<?php echo $settings['siteurl']?>node_modules/bootstrap/dist/js/bootstrap.bundle.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
  </body>
</html>