<!DOCTYPE html>
<html>
<head>
	<title>Blog Entries</title>
    <link rel="stylesheet" href="blog.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-r2Iyq3C/XE1tPlXDlw8RXdWp9cYmLgHhy/j0m0g8BbMrKPtQdGb2b1+MzWiqjYiX9lN5sm5DCNlQrweyfmqjKg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
	
</head>
<body>
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

	
	<center><h1>Blogs</h1></center>
	
    <?php 

    
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
		$query = "SELECT * FROM blog_entries";
		$result = mysqli_query($conn, $query);
		
		// Display each blog entry
		if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<div class="card-header">' . $row["title"] . '</div>';
                echo '<div class="card-body">';
                echo '<p>' . $row["content"] . '</p>';
                echo '<p>Created at: ' . $row["date_created"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No blog posts found.";
        }
		// Close the database connection
		mysqli_close($conn);
	?>

<footer >
        <p>Copyright © 2023 Agriculture Products Inc.</p>
        <p>
          <a href="feed.php">Contact Us</a> | 
          <a href="process.php">About Us</a> | 
          <a href="#">Terms of Use</a>
        </p>
      </footer>
	</div>
 
</body>

</html>
