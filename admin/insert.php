<?php
		$conn = mysqli_connect("localhost", "root", "root123", "ecommerce","3308");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
	if(isset($_POST['insert'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];
		$date_created = date('Y-m-d H:i:s');
		$query = "INSERT INTO blog_entries(title, content, date_created) VALUES('$title', '$content', '$date_created')";
		$result = mysqli_query($conn, $query);
		if($result) {
			header("Location: myblog.php");
		} else {
			echo "Error: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>
