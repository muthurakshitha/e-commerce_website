<!DOCTYPE html>
<html>
<head>
	<title>Blog Entries</title>
    <link rel="stylesheet" href="price.css">
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
<script>function calculatePrice() {
  // Get the price and quantity values from the input fields
  var price = document.getElementById("price").value;
  var quantity = document.getElementById("quant").value;

  // Calculate the total price
  var total_price = price * quantity;

  // Display the total price
  document.getElementById("result").innerHTML = "The total price is: Rs " + total_price;

  

}
</script>	


</head>
<body>

<?php
session_start();?>
<div class="dp">
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


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemid = $_POST["itemId"];
    


    $_SESSION["itemid"]=$itemid;
   
    
  }
 
  $itemid = $_SESSION["itemid"];
  $name =  $_COOKIE["name1"];
  $host = 'localhost';
  $user = 'root';
  $pass = 'root123';
  $db   = 'ecommerce';
  $port = '3308';
  $conn = mysqli_connect($host, $user, $pass, $db, $port);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Retrieve blog entries from the database
  $query = "SELECT * FROM products where name='$itemid'";
  $result = mysqli_query($conn, $query);

  // Display each blog entry
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      echo "<div class='container'><br><h2>{$row['name']}</h2><div class='main'>
                
      
        <img  src={$row['image_url']} class='img' alt='...'>
            <div class='car'>
                <h5 class='title'>{$row['name']}</h5>
                <p class='text'>{$row['description']}</p>
                <p class='price'>Rs {$row['price']}</p>
                     
          <div class='raks'>  
         <input type='hidden' id='price' name='price' value='{$row['price']}'>                 
      <label for='quantity'>Quantity:</label>
      <input type='text' id='quant' name='quant' value='1'/><br/>
      
      <button class='btn btn-outline-dark' onclick='calculatePrice()'>Calculate</button>
      </div> 
<p id='result'></p>
  
<form action='insertcart.php' method='post'>
<input type='hidden' name='name' value='$name'>
    <input type='hidden' name='product' value={$row['name']}>
    <input type='hidden' name='price' value={$row['price']}>
    <input type='number' name='quantity' value='1'>
    <button type='submit' class='btn btn-outline-success' name='add_to_cart' id='liveToastBtn'>Add to Cart</button>
    <div class='position-fixed bottom-0 end-0 p-3' style='z-index: 11'>
        <div id='liveToast' class='toast hide' role='alert' aria-live='assertive' aria-atomic='true'>
          <div class='toast-header'>
          <img src='imgs/agri.png' class='rounded-circle me-2' alt='your-alt-text' style='max-height: 50px; max-width: 50px;'>
            <strong class='me-auto'>Meadowland</strong>
            <small>1 sec ago</small>
            <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
          </div>
          <div class='toast-body'>
          Yayy!! Your Item Added To Cart Successfully
        </div>        
        </div>
      </div>
</form>
    
    
    </div> </div>";
    }
  }
  ?>


</div><br><br>
<div class="container">
<h2>Product Reviews</h2><br>
  <?php
    // $commentsXml = simplexml_load_file('');
    

    $xml = new DOMDocument();
$xml->load("comments.xml");

// Get the selection value from the user


// Find the element with the matching id value
$elements = $xml->getElementsByTagName('comment');
foreach ($elements as $element) {
 
  $product = trim($element->getElementsByTagName('product')->item(0)->textContent);

  if (trim($product== $itemid)) {
   
    // Display the other values in the row
    $user = $element->getElementsByTagName('user')->item(0)->textContent;
    $text = $element->getElementsByTagName('text')->item(0)->textContent;
    $rating = $element->getElementsByTagName('rating')->item(0)->textContent;
    $stars_html = '';
    for ($i = 1; $i <= 5; $i++) {
      if ($i <= $rating) {
        $stars_html .= '<span class="star-rating filled"><i class="fa fa-star" aria-hidden="true">&nbsp</i></span>';
      } else {
        $stars_html .= '<span class="star-rating"><i class="fa fa-star-o" aria-hidden="true">&nbsp</i></span>';
      }
    }
  
    // Output the comment with the star rating
    echo '<div class="comment">';
    echo '<h3>' . $user . '</h3>';
    echo '<p class="rating">' . $stars_html .'</p>';
    echo '<p>' . $text . '</p>';
    echo '</div>';
  }


}

    
      // Generate the star rating HTML
   
    
    
  ?>
</div>
  
<div class="container">
    <br>
  <h2>Add a Comment</h2><br>
  <form method="post" action="add_comment.php" class="comment-form ">
  
    <input type="hidden" name="item" id="item" value="<?php echo $itemid ?>">
    <label for="user">Name:</label>
    <input type="text" name="user" id="user">
    <label for="text">Comment:</label>
    <textarea name="text" id="text"></textarea>
    <label for="rating">Rating:</label>
    <select name="rating" id="rating">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <input type="submit" class="dp1" value="Submit">
  </form>
  </div>

  <footer >
        <p>Copyright © 2023 Agriculture Products Inc.</p>
        <p>
          <a href="feed.php">Contact Us</a> | 
          <a href="process.php">About Us</a> | 
          <a href="#">Terms of Use</a>
        </p>
      </footer>
      <script>
    var liveToastBtn = document.getElementById('liveToastBtn');
    var liveToast = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(liveToast);

    liveToastBtn.addEventListener('click', function() {
      toast.show();
      sessionStorage.setItem('itemAddedToCart', 'true'); // set flag when item is added to cart
    });

    window.onload = function() {
      if (sessionStorage.getItem('itemAddedToCart') === 'true') {
        toast.show(); // show toast if flag is set on page load
        sessionStorage.removeItem('itemAddedToCart'); // remove flag to prevent toast from showing again
      }
    };
  </script>
</body>

</html>
