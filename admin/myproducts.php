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
			<span class="text">Meadowland</span>
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

            <li >
				<a href="myfeed.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Feedback</span>
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
				<a href="http://localhost:8096/fars/logout" class="logout">
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
                <a href="http://localhost:8096/fars/input.jsp" class="btn-download">
					<span class="text">Go to website</span>
				</a>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Products</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table width="100%">
						<thead>
							<tr>
                                <th style='text-align:left; padding-left: 8px;'>ID</th>
                                <th>Image</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
$conn = mysqli_connect("localhost", "root", "root123", "ecommerce", "3308");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * from products";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td> <img src='../" . $row['image_url'] . "' alt=''></td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>
								<a href='editpro.php?id=" . $row['id'] . "' class='edit_btn' style='color:green; margin-right:20px;'><i class='fas fa-pen' style='font-size:14px; margin-right:5px; color:green;'></i>Edit</a>
								<a href='deletepro.php?id=" . $row['id'] . "' class='del_btn' style='color:red;'><i class='fas fa-trash' style='font-size:14px; margin-right:5px; color:red;'></i>Delete</a>
							  </td>";
        echo "</tr>";
    }
}
mysqli_close($conn);
?>
						</tbody>
					</table>
				</div>

			</div>




            <form method="post" action="" class="form">
			<h2>Add Product Entry</h2>
			<div class="input-group">
				<label>ID</label>
				<input type="number" name="id" value="">
			</div>
            <div class="input-group">
				<label>Product Name</label>
				<input type="text" name="product" value="">
			</div>
			<div class="input-group">
				<label>Description</label>
				<textarea name="description"></textarea>
			</div>
            <div class="input-group">
				<label>Price</label>
				<input type="number" name="price" value="50">
			</div>
            <div class="input-group">
				<label>Image url</label>
				<input type="text" name="image_url" value="imgs/">
			</div>
			<div class="input-group">
            <input type="submit" name="insert" class="">
            </div>

</form>

<?php
$conn = mysqli_connect("localhost", "root", "root123", "ecommerce", "3308");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['insert'])) {
    $id = $_POST['id'];
    $product = $_POST['product'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['image_url'];
    $query = "INSERT INTO products(id, `name`, `description`, price, image_url) VALUES($id, '$product', '$desc', $price, '$img')";
    $result = mysqli_query($conn, $query);

    mysqli_close($conn);
}
?>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="script.js"></script>
</body>
</html>