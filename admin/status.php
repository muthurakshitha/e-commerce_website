<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
        table {
  border-collapse: collapse;
  width: 80%;
  margin: auto;
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



    form {
  max-width: 50%;
  margin: auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  font-size: 36px;
  margin-bottom: 30px;
  color: #5f5aa5;
}

.input-group {
  margin-bottom: 25px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.input-group label {
  display: block;
  margin-bottom: 10px;
  font-size: 24px;
  color: #5f5aa5;
  margin-right: 10px;
}

.input-group input,
.input-group textarea {
 
  padding: 15px;
  width: 70%;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  color: #333;
  background-color: #f2f2f2;
}

.input-group input:focus,
.input-group textarea:focus {
  outline: none;
  background-color: #fff;
  box-shadow: 0 0 5px rgba(95, 90, 165, 0.5);
}

.input-group input[type="submit"] {
  background-color: #5f5aa5;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
  font-size: 24px;
  padding: 15px 40px;
  border-radius: 30px;
  border: none;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.input-group input[type="submit"]:hover {
  background-color: #48429c;
}

</style></head>
<body>

<table>
			<tr>
				<th>ID</th>
				<th>Product name</th>
				<th>Price</th>
				<th>Image Url</th>
				<th>Action</th>
			</tr>
			<?php
				$conn = mysqli_connect("localhost", "root", "root123", "ecommerce","3308");
                if(!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
				$query = "SELECT * from products";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['price']."</td>";
						echo "<td>".$row['image_url']."</td>";
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
<form method="post" action="">
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
			
				<input type="submit" name="insert"></input>
			
</form>

<?php
		$conn = mysqli_connect("localhost", "root", "root123", "ecommerce","3308");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
	if(isset($_POST['insert'])) {
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

</body>
</html>