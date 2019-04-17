<?php
session_start();
$successmessage = "";
if(array_key_exists('email',$_SESSION)){
$link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
$query = "SELECT `Name` FROM `users` WHERE Email = '".mysqli_real_escape_string($link, $_SESSION['email'])."' LIMIT 1";
$result = mysqli_query($link,$query);
$fieldinfo = mysqli_fetch_array($result);
$nameseller = $fieldinfo[0];
$nameseller = strtolower($nameseller);
$nameseller = ucfirst($nameseller);
}
if(array_key_exists('medadded',$_POST)){
    $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
$Quantity = $_POST['units'];
$Expirydate = $_POST['date'];
$price = $_POST['price'];
$query = "INSERT INTO `Seller db` (`Seller Name`,`Drug Name`,`Quantity`, `Expiry Date`,`Price`) VALUES ('".mysqli_real_escape_string($link, $nameseller)."','".mysqli_real_escape_string($link, $_POST['Drug'])."',$Quantity,'$Expirydate',$price)";
if(mysqli_query($link,$query)){
    $successmessage="<div>"."Drug Record Successfully added! "."</div>";
}
}
if(array_key_exists('logout',$_POST)){
    header('Location: mysecretdiary.php');
    session_destroy();
}
if(array_key_exists('logout1',$_POST)){
    header('Location: mysecretdiary.php');
    session_destroy();
}
?>
<!DOCTYPE html>
<html style="background: url(img/sellerbg.jpg) no-repeat center center fixed; -webkit-background-size:cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<title>Seller's Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type = "text/css">
    #success{
        background-color: aquamarine;
    }
</style>
<body>
<center>
<form method = "post">
<div class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="margin:0 auto; width: 40%; text-align: left">
    <h2 style="display: inline-block;"><? echo "Hello! ".$nameseller ?></h2>
    <button class="w3-button w3-right w3-section w3-green w3-ripple" name = "logout1"> Logout </button>
</div>
</form>
<form class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="width: 40%" method="post">
<h2 class="w3-row">Add the Details of New Stock:</h2>
 
<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest" style="width:500px">
      <input class="w3-input w3-border" name="Drug" type="text" placeholder="Name of Drug">
    </div>
</div>

<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-heart"></i></div>
    <div class="w3-rest" style="width:500px">
      <input class="w3-input w3-border" name="units" type="Quantity" placeholder="Number of units">
    </div>
</div>

<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-calendar"></i></div>
    <div class="w3-rest" style="width:500px">
      <input class="w3-input w3-border" name="date" type="date" placeholder="Date of Expiry">
    </div>
</div>

<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-dollar"></i></div>
    <div class="w3-rest" style="width:500px">
      <input class="w3-input w3-border" name="price" type="Number" placeholder="Price">
    </div>
</div>
<div id = "success"><? echo $successmessage ?></div>
<div class="w3-col w3-center">
<button class="w3-button w3-section w3-blue w3-ripple" name = "medadded" > Add another medicine </button>
<button class="w3-button w3-section w3-blue w3-ripple" name = "logout"> Done </button>
</div>
</form>

</center>
</body>
</html> 
