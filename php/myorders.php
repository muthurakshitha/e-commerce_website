<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="myorders.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-r2Iyq3C/XE1tPlXDlw8RXdWp9cYmLgHhy/j0m0g8BbMrKPtQdGb2b1+MzWiqjYiX9lN5sm5DCNlQrweyfmqjKg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body class="hi">

<div class="cont-fluid">
        <nav id="mainNavbar" class="navbar navbar-dark navbar-expand-md sticky-top "><a class="navbar-brand" href="#">
          <img id = "logo" src="imgs/agri.png" alt="" width="40" height="34">
        </a>
        <a class="navbar-brand" href="http://localhost:8096/fars/input.jsp">Green India</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="http://localhost:8096/fars/input.jsp">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/phppro/process.php">Our Process</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:8096/fars/search.jsp">Shop</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/phppro/blog.php">Blogs</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/phppro/myorders.php">My orders</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/phppro/feed.php">Contact</a>
            </li>
            
          </ul>
        

          <div id="login" class="d-grid gap-2 d-md-flex justify-content-md-end">
      
      <a href="http://localhost/phppro/cart.php">
<i class="fa fa-shopping-cart fa-inverse" style="margin-top:7px; margin-right:15px;"></i>
</a>
      
      <a href="http://localhost:8096/fars/logout" class="btn btn-outline-success " >Logout</a>
  
    </div>
        </div>
      </div>

<?php
session_start();
$name =  $_COOKIE["nam"];
$con1 = mysqli_connect("localhost", "root", "root123", "farm", "3308");
if (!$con1) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM payments WHERE buyer_id = '$name' group by `timestamp`";
$result = mysqli_query($con1, $sql);
$cou = mysqli_num_rows($result);

if($cou==0)
{?>
    <center>
      <h1 style="margin-top: 50px;">No order yet...</h1>  
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_vsaoi7iz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
</center><?php }?> 

<?php
    while ($row1 = mysqli_fetch_assoc($result)) {
?>
<div class="card">
            <div class="title">Purchase Reciept</div>
            <div class="info">
                <div class="row">
                    <div class="col-8">
                        <span id="heading">Date</span><br>
                        <span id="details"><?php echo $row1['timestamp']?></span>
                    </div>
                    <div class="col-4 pull-right">
                        <span id="heading">Order No.</span><br>
                        <span id="details"><?php echo rand(1000000,9999999)?></span>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <span id="heading">Address</span><br>
                        <span id="details"><?php echo $row1['address']?></span>
                    </div>
                </div>
                </div>
           
            <?php

$conn = mysqli_connect("localhost", "root", "root123", "ecommerce", "3308");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "SELECT * FROM placedorders WHERE user = '$name' and timestamp= '{$row1['timestamp']}'";
$result1 = mysqli_query($conn, $sql1);


while ($row = mysqli_fetch_assoc($result1)) {
    ?>
                <div class="pricing">
                <div class="row">
                    <div class="col-9">
                        <span id="name"><?php echo $row['product']?></span>
                    </div>
                    <div class="col-3">
                        <span id="price">Rs <?php echo $row['total']?></span>
                    </div>
                </div>
            </div>

            <?php }?>      
    <div class="total">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-3"><big>Rs <?php echo $row1['amount']?></big></div>
    </div>
</div>

            <div class="tracking">
                <div class="title">Tracking Order</div>
            </div>
            <div class="progress-track">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0 active text-center" id="step2">Shipped</li>
                    <li class="step0 active text-right" id="step3">On the way</li>
                    <li class="step0 text-right" id="step4">Delivered</li>
                </ul>
            </div>


            <div class="footer">
                <div class="row">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/YBWc55P.png"></div>
                    <div class="col-10">Want any help? Please &nbsp;<a href="feed.php"> contact us</a></div>
                </div>


            </div>
        </div>
        <?php }?>
        <footer >
        <p>Copyright © 2023 Agriculture Products Inc.</p>
        <p>
          <a href="feed.php">Contact Us</a> | 
          <a href="process.php">About Us</a> | 
          <a href="#">Terms of Use</a>
        </p>
      </footer>
</body>
</html>