<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
			<li class="active">
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
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
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="http://localhost:8096/fars/input.jsp" class="btn-download">
					<span class="text">Go to website</span>
				</a>
			</div>

			<?php
$con1 = mysqli_connect("localhost", "root", "root123", "ecommerce", "3308");
if (!$con1) {
    die("Connection failed: " . mysqli_connect_error());
}
$con2 = mysqli_connect("localhost", "root", "root123", "farm", "3308");
if (!$con2) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT COUNT(*) as total FROM users;";
$result = mysqli_query($con2, $sql);
$row1 = mysqli_fetch_assoc($result);

$sql = "SELECT sum(amount) as amount FROM payments;";
$result = mysqli_query($con2, $sql);
$row2 = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) as num FROM payments;";
$result = mysqli_query($con2, $sql);
$row3 = mysqli_fetch_assoc($result);

?>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $row3['num']; ?></h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $row1['total']; ?></h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>Rs <?php echo $row2['amount']; ?></h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Sl.no</th>
								<th>User</th>
								<th>Amount</th>
								<th>Time</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>

							<?php

$query = "SELECT * from payments";
$result = mysqli_query($con2, $query);
if (mysqli_num_rows($result) > 0) {
    $c = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $c . "</td>";
        $c++;
        echo "<td>" . $row['buyer_id'] . "</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "<td>" . $row['timestamp'] . "</td>";
        echo "<td>";
        if ($row['id'] % 2 == 0) {
            echo "<span class='status completed'>Completed</span>";

        } else {
            echo "<span class='status process'>Processing</span>";
        }
        "</td>";
        echo "</tr>";
    }
}

?>


						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Have to add a blog</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Ten products update</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Verify account details</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Create advertisement</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Meet clients</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="script.js"></script>
</body>
</html>