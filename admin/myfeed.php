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

            <li >
				<a href="myproducts.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Feedbacks</span>
				</a>
			</li>

			<li>
				<a href="myblog.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Blog</span>
				</a>
			</li>

            <li class="active">
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
						<h3>Feedback</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table width="100%">
						<thead>
							<tr>

                                <th>Sl.no</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
							</tr>
						</thead>
						<tbody>
                        <?php
// $commentsXml = simplexml_load_file('');

$xml = new DOMDocument();
$xml->load("../feedbacks.xml");

// Get the selection value from the user

// Find the element with the matching id value
$elements = $xml->getElementsByTagName('feedback');
$c = 1;
foreach ($elements as $element) {

    // Display the other values in the row
    $name = $element->getElementsByTagName('name')->item(0)->textContent;
    $email = $element->getElementsByTagName('email')->item(0)->textContent;
    $message = $element->getElementsByTagName('message')->item(0)->textContent;

    // Output the comment with the star rating
    echo '<tr>';
    echo '<td>' . $c . '</td>';
    $c++;
    echo '<td>' . $name . '</td>';
    echo '<td>' . $email . '</td>';
    echo '<td>' . $message . '</td>';
    echo '</tr>';
}

?>
						</tbody>
					</table>
				</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="script.js"></script>
</body>
</html>