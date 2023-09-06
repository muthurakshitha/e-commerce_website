<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <center><h1 style="margin-top: 50px; color:green">Payment Successful</h1>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets7.lottiefiles.com/packages/lf20_vzhtcqsd.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
</center>
<?php $delay = 5;

// set the redirect URL
$redirect_url = 'http://localhost:8096/fars/input.jsp';

// send a redirect header with a delay
header("refresh:{$delay};url={$redirect_url}");
?>

</body>
</html>
