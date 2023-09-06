<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin-left:10px; margin-right:10px;" src="../imgs/agri.png" alt="" width="50" height="44">
			<span class="text">Meadowland Farm</span>
		</a>
		<ul class="side-menu top">
        <li>
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
                </li>

            <li class="active">
				<a href="myproducts.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Products</span>
				</a>
			</li>

			<li>
				<a href="myblog.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Blog</span>
				</a>
			</li>

		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="Rakshitha_passphoto.jpg">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">My Products</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>



            <?php
// check if form is submitted
if (isset($_POST['submit'])) {

    // connect to the database
    $db = mysqli_connect('localhost', 'root', 'root123', 'ecommerce', '3308');

    // check if connection is successful
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // retrieve form data
    $id = $_POST['id'];
    $product = $_POST['product'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['image_url'];

    // update blog entry in the database
    $query = "UPDATE products SET `name`='$product', `description`='$desc' , price=$price, image_url='$img' WHERE id='$id'";
    mysqli_query($db, $query);

    // close database connection
    mysqli_close($db);

    // redirect to index.php
    header('Location: myproducts.php');
    exit();
}

// retrieve blog entry to edit
$id = $_GET['id'];

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root123', 'ecommerce', '3308');

// check if connection is successful
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// retrieve blog entry from the database
$query = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

// close database connection
mysqli_close($db);
?>



<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form">

<h2>Edit Product Entry</h2>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <div class="input-group">
    <label for="title">Product:</label>
    <input type="text" name="product" value="<?php echo $row['name']; ?>"><br><br>
    </div>

    <div class="input-group">
    <label for="title">Price:</label>
    <input type="number" name="price" value="<?php echo $row['price']; ?>"><br><br>
    </div>

    <div class="input-group">
    <label for="title">Image:</label>
    <input type="text" name="image_url" value="<?php echo $row['image_url']; ?>"><br><br>
    </div>

    <div class="input-group">
    <label for="content">Description:</label><br>
    <textarea name="description" rows="10" cols="50"><?php echo $row['description']; ?></textarea><br><br>
    </div>

    <div class="input-group">
    <input type="submit" name="submit" value="Update">
    </div>
</form>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="script.js"></script>
</body>
</html>