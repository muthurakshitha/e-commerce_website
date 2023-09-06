<?php
	$conn = mysqli_connect("localhost", "root", "root123", "ecommerce","3308");
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = "DELETE FROM blog_entries WHERE id='$id'";
		$result = mysqli_query($conn, $query);
		if($result) {
			header("Location: myblog.php");
		} else {
			echo "Error: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>
