
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

$name = $_SESSION['name'];
// Get user's cart from the database

$host = 'localhost';
$user = 'root';
$pass = 'root123';
$db = 'farm';
$port = '3308';

$conn = mysqli_connect($host, $user, $pass, $db, $port);
$con1 = mysqli_connect($host, $user, $pass, 'ecommerce', $port);

$sql = "SELECT * FROM cart WHERE user = '$name'";
$result = mysqli_query($con1, $sql);

// Calculate total cost of items in the cart
$total_cost = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_cost += $row['total_price'];
}

// Check if user has enough balance to make payment
if (isset($_POST['pay'])) {
    // Get user's account number and password from form
    $account_number = $_POST['account_number'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Check if account number and password match records in the database
    $sql = "SELECT * FROM account WHERE account_number = '$account_number' AND password = '$password' and user = '$name'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows == 0) {
        $error_msg = 'Invalid account number or password.';
    } else {
        $user_balance = $row['balance'];
        if ($user_balance < $total_cost) {
            $error_msg = 'You do not have enough balance to make this payment.';
        } else {

            $new_balance = $user_balance - $total_cost;
            $sql = "UPDATE account SET balance = $new_balance WHERE user = '$name'";
            $conn->query($sql);

            // Add payment amount to admin's account
            $admin_id = 'Sankar'; // Replace with your admin's user ID
            $sql = "SELECT * FROM account WHERE user = '$admin_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $admin_balance = $row['balance'];
            $new_balance = $admin_balance + $total_cost;
            $sql = "UPDATE account SET balance = $new_balance WHERE user = '$admin_id'";
            $conn->query($sql);

            // Add payment record to the database
            $sql = "INSERT INTO payments (buyer_id, admin_id, amount, timestamp, address) VALUES ('$name', '$admin_id', $total_cost, NOW(), '$address')";
            $conn->query($sql);

            $sql = "SELECT * FROM cart where user='$name'";
            $result = mysqli_query($con1, $sql);
            if ($result->num_rows > 0) {
                echo "$result->num_rows";
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "INSERT INTO placedorders(user, product, price ,quantity, total) values('$name','{$row['product']}',{$row['price']},{$row['quantity']},{$row['price']}*{$row['quantity']})";
                    $con1->query($sql);
                }
            }
            // Clear user's cart
            $sql = "DELETE FROM cart WHERE user = '$name'";
            $con1->query($sql);

            // set the delay time in seconds

            // Redirect to confirmation page
            header('Location: confirmation.php');
            exit();
        }}
}

// Display error message and payment form
?>

  <!DOCTYPE html>
  <html>
  <head>

    <title>Payment Page</title>
    <link rel="stylesheet" type="text/css" href="pay.css">
  </head>
  <body>




<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>

<main>
  <figure>
    <picture>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_g3ki3g0v.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
    </picture>
  </figure>
  <div class="headline">
    <h2 class="text-headline">Meadowland Farm</h2>
    <h3 class="text-subheadline">Payment Page</h2>
  </div>
  <form action="" method="post">
    <span>
    <label for="account_number" class="text-small-uppercase">Account Number:</label>
      <input type="text" name="account_number" id="account_number" class="text-body" required>
    </span>
    <span>
    <label for="password" class="text-small-uppercase">Password:</label>
      <input type="password" name="password" id="password" class="text-body" required>
    </span>
    <span>
    <label for="address" class="text-small-uppercase">Address:</label>
      <input type="text" name="address" id="address" class="text-body" required>
    </span>

    <p>Total cost: $<?php echo $total_cost; ?></p><br>


    <input type="submit" name="pay" value="Pay" class="text-small-uppercase">
  </form>

</main>
  <?php if (isset($error_msg)) {?>
      <center><p class="error" style="margin-top: 50px;"><?php echo $error_msg; ?></p></center>
    <?php }?>
</body>
</html>