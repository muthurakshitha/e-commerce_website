<?php
session_start(); // start the session

// connect to the database
$username = $_COOKIE["name"];
$_SESSION["name"]=$username;

  $host = 'localhost';
  $user = 'root';
  $pass = 'root123';
  $db   = 'ecommerce';
  $port = '3308';

  $conn = mysqli_connect($host, $user, $pass, $db, $port);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// if the "Update Cart" button has been submitted
if(isset($_POST['update_quantity'])) {
    // loop through each product in the cart and update the quantity
  
        $product = $_POST['product'];
        $price = $_POST['price'];
		$quantity = $_POST['quantity'];
        $tp = $price * $quantity;
        $sql = "UPDATE cart SET quantity = '$quantity' , total_price='$tp' WHERE product = '$product' AND user = '{$_SESSION["name"]}'";
        $result= mysqli_query($conn, $sql);
        
    
}

// if the "Remove from Cart" button has been submitted
if(isset($_POST['remove_from_cart'])) {
    $product = $_POST['product'];
    $sql = "DELETE FROM cart WHERE product = '$product' AND user = '{$_SESSION["name"]}'";
    mysqli_query($conn, $sql);
    
}

// get the products in the cart for the current user

$sql = "SELECT * FROM cart WHERE user = '$username'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart.css">
    <title>Document</title>

</head>
<body class="dp">

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
      <?php  if($count>0){?>
<table class="cart-table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
         <tr>
            <td><?php echo $row['product']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <form action="" method="post" class="cart-form">
                   
                <input type="hidden" name="product" value="<?php echo $row['product']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>">
                    <button type="submit" name="update_quantity" class="cart-btn cart-btn-update"><i class="fa fa-refresh" style="font-size:28px;color:green"></i></button>
                </form>
            </td>
            <td><?php echo $row['price'] * $row['quantity']; ?></td>
            <td>
                <form action="" method="post" class="cart-form">
                    <input type="hidden" name="product" value="<?php echo $row['product']; ?>">
                    <button type="submit" name="remove_from_cart" class="cart-btn cart-btn-remove"><i class="fa fa-trash-o" style="font-size:28px;color:red"></i></button>
                </form>
            </td>
                  </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total Price:</td>
            <td><?php
                $sql = "SELECT SUM(price * quantity) AS total FROM cart WHERE user = '{$_SESSION["name"]}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo $row['total'];
            ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

<div id='pur'><a href='payment.php' class='btn btn-outline-dark '>Buy Now</a>
    </div>
<?php mysqli_close($conn);}


else{
    echo "<center><h1 style='margin-top:30px;'>No item in cart</h1></center>";
    echo "<center><script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script><lottie-player src='https://assets5.lottiefiles.com/packages/lf20_xNEYcvnqso.json'  background='transparent'  speed='1'  style='width: 300px; height: 300px;'  loop autoplay></lottie-player>'</center>";
}?>

<footer style="margin-top: 100px;">
        <p>Copyright © 2023 Agriculture Products Inc.</p>
        <p>
          <a href="feed.php">Contact Us</a> | 
          <a href="process.php">About Us</a> | 
          <a href="#">Terms of Use</a>
        </p>
      </footer>
</body>
</html>














