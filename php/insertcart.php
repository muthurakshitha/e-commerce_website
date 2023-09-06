<?php
		$conn = mysqli_connect("localhost", "root", "root123", "ecommerce","3308");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
	if(isset($_POST['add_to_cart'])) {
        $user = $_POST['name'];
        $product = $_POST['product'];
        $price = $_POST['price'];
		$quantity = $_POST['quantity'];
        $tp = $price * $quantity;
    $sql = "SELECT * FROM cart WHERE product = '$product' AND user = '$user'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    
    if($count > 0) {
        // if the product exists in the cart, update the quantity
        $quantity = $_POST['quantity'];
        $sql = "UPDATE cart SET quantity = '$quantity' , total_price='$tp' WHERE product = '$product' AND user = '$user'";
        $result= mysqli_query($conn, $sql);
       
    } else {
		
		
		$query = "INSERT INTO cart(user, product, price, quantity, total_price) VALUES('$user', '$product', '$price','$quantity','$tp')";
		$result = mysqli_query($conn, $query);
    
		
	}
    if($result) {
        header("Location: product.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
