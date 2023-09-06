<!DOCTYPE html>
<html>
<head>
	<title>Blog Page</title>
	<link rel="stylesheet" type="text/css" >
    <style>
        table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #4CAF50;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:nth-child(odd) {
  background-color: lightgray;
}

/* Style for form */

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea {
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 5px;
  border: none;
  border-bottom: 2px solid #ccc;
  width: 100%;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

/* Style for anchor tag */

a {
  color: #4CAF50;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

.app {
  color: #4CAF50;
  text-decoration: none;
  font-size: 40px;
  margin-top: 40px;
  margin-right: 50px;
}

h1{
    margin-left: 50px;
    font-size: 50px;
}
.hi{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
	margin-top: none;
}
body{
    background-color:  rgb(203, 240, 135);
}

    </style>
</head>
<body>
	<div class="header">
	<div class="hi"><h1 >Blog </h1><a class="app" href="blog.php">View Blog</a></div>
	</div>
	<div class="content">
		<table>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
			<?php
				$conn = mysqli_connect("localhost", "root", "root123", "ecommerce","3308");
                if(!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
				$query = "SELECT * from blog_entries";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['title']."</td>";
						echo "<td>".$row['content']."</td>";
						echo "<td>".$row['date_created']."</td>";
						echo "<td>
								<a href='edit.php?id=".$row['id']."' class='edit_btn'>Edit</a>
								<a href='delete.php?id=".$row['id']."' class='del_btn'>Delete</a>
							  </td>";
						echo "</tr>";
					}
				}
				mysqli_close($conn);
			?>
		</table>
		<form method="post" action="insert.php">
			<h2>Add Blog Entry</h2>
			<div class="input-group">
				<label>Title</label>
				<input type="text" name="title" value="">
			</div>
			<div class="input-group">
				<label>Description</label>
				<textarea name="content"></textarea>
			</div>
			
				<input type="submit" name="insert"></input>
			
		</form>
	</div>
</body>
</html>
