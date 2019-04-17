<?php
session_start();
$finalstring = "";
$nostock = "";
$nameseller = "";
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
if($_POST){
if(array_key_exists('Go',$_POST)){
$username= $_POST["query"];
$link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
}
$query = "SELECT * FROM `Seller db` WHERE `Drug Name` = '".mysqli_real_escape_string($link,$_POST['query'])."'";
$result = mysqli_query($link,$query);
$count = 0;
while($row = mysqli_fetch_array($result)){
    $timearray = getdate();
    $query1 = "SELECT * FROM `Medicines` WHERE `Name` = '".mysqli_real_escape_string($link,$_POST['query'])."'";
    $result1 = mysqli_query($link,$query1);
    if(mysqli_num_rows($result1)>0){
        $details1 = mysqli_fetch_array($result1);
        $currentday = $timearray['yday'];
        $expiredate = $row['Expiry Date'];
        $expire = explode('-',$expiredate);
        if($timearray['year'] == $expire[0]){
            $x = $details1['Expiry'] - ($expire[1]*30 + $expire[2] - $currentday);
            $count++;
        }
        else if($expire[0] > $timearray['year']){
            $x = $details1['Expiry'] - (($expire[1]*30 + $expire[2] - $currentday) + 365*($expire[0] - $timearray['year']));
            $count++;
            
        }
        $x = ($x*365)/$details1['Expiry'];
        if($x<292){
            $price = $details1['MRP'];
            $price = round($price,2);
        }
        else{
            $price = ($details1['MRP']/100)*(1-($row['Quantity']/1000))*(-1432+10.27*$x-0.01723*$x*$x);
            $price = round($price,2);
        }
        $nameseller1 = $row['Seller Name'];
        $nameseller1 = strtolower($nameseller1);
        $nameseller1 = ucfirst($nameseller1);
        $finalstring.='<div class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="margin:0 auto; width: 45%;" id="finalprice">
  <h3 class="w3-col" style="width:500px; text-align: left;">'.$nameseller1.'</h3>
    <div class="w3-rest" style="width:100px">
      <h4 class="w3-input w3-green" >'.'<span>&#8377;'.$price.'</span>'.'</h4>
    </div>
    <br>
  <div class="w4-row w3-section" style="text-align: left;">Sellers Address: TBD</div>
  <div class="w4-row w3-section" style="text-align: left; display: inline-block;">How much would you like to buy:</div>
  <input class="w4-row w3-section" style="text-align: right;" name="quant" type="Number" placeholder="0">
  <button class="w3-button w3-section w3-blue w3-ripple"> Buy </button>
  </br>
</div>';
}
}
    if($count == 0){
        $nostock = "Stock Unavailaible";
    }
}
?>
<!DOCTYPE html>
<html style="background: url(img/customerbg.PNG) no-repeat center center fixed; -webkit-background-size:cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<!-- 
<head>
    <title>Customer's Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head> -->
<title>Seller's Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type = "text/css">
    #nostock{
        background-color: greenyellow;
        width: 50%;
        font-size: 200%
    }
</style>
<body>
<center>
<div class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="margin:0 auto; width: 45%;">
    <div class="w4-row w3-section" style="margin:0 auto; width: 80%; text-align: left">
        <h2 style="display: inline-block;"><? echo "Hello! ".$nameseller ?></h2>
        <button class="w3-button w3-right w3-section w3-green w3-ripple"> Logout </button>
    </div>
    <br>
    <form method="post">
    <div class="w4-row w3-section">
        <h2 class="w3-row">What are you looking for?</h2>
        <div class="w3-rest" style="width:500px">
            <input class="w3-input w3-border" name="query" type="text" placeholder="Name of a Drug">
            <button class="w3-button w3-section w3-blue w3-ripple" name = "Go" id= "go" onClick="onClickCheck();"> Go </button>
        </div>
    </div>
    </form>
</div>
<div id="nostock"><? echo $nostock ?></div>
<div><? echo $finalstring ?></div>
</center>
</body>
</html> 