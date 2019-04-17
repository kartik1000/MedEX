<?php
session_start();
$errormessage= "";
if($_POST){
    if(array_key_exists('signup1',$_POST)){

    if($_POST['nameof'] == ''){
        $errormessage.= "Name cannot be empty"."<br>";
    }
    if($_POST['numberof'] == ''){
        $errormessage.= "Number cannot be empty"."<br>";
    }
    if($_POST['emailto'] == ''){
        $errormessage.= "Email field cannot be empty"."<br>";
    }
    if($_POST['password1'] == ''){
        $errormessage.= "Password cannot be empty"."<br>";
    }
        if (!filter_var($_POST['emailto'], FILTER_VALIDATE_EMAIL)) {
    $errormessage.= "Enter Valid Email address"."<br>";
}
    if($errormessage!=""){
        $errormessage = "<div class='alert alert-danger' role='alert'>"."These were error(s) in your form:"."<br>".$errormessage."</div>";
    }
    else{
        $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
        $password = md5($_POST['password1']);
        $query = "INSERT INTO `users` (`Name`,`Number`,`Email`, `Password`,`Seller/User`) VALUES ('".mysqli_real_escape_string($link, $_POST['nameof'])."','".mysqli_real_escape_string($link, $_POST['numberof'])."','".mysqli_real_escape_string($link, $_POST['emailto'])."', '".mysqli_real_escape_string($link,$password)."','User')";
        if(mysqli_query($link,$query)){
            if(array_key_exists('cookie1',$_POST)){
                setcookie("customerID","1234",time()+60*60*1);
            }
            $_SESSION['email'] = $_POST['emailto'];
            $_SESSION['name'] = $_POST['nameof'];
            header("Location: customer.php");
        }
  
    }
}
    else if(array_key_exists('signup2',$_POST)){
        if($_POST['nameof'] == ''){
        $errormessage.= "Name cannot be empty"."<br>";
    }
    if($_POST['numberof'] == ''){
        $errormessage.= "Number cannot be empty"."<br>";
    }
    if($_POST['emailto'] == ''){
        $errormessage.= "Email field cannot be empty"."<br>";
    }
    if($_POST['password1'] == ''){
        $errormessage.= "Password cannot be empty"."<br>";
    }
        if (!filter_var($_POST['emailto'], FILTER_VALIDATE_EMAIL)) {
    $errormessage.= "Enter Valid Email address"."<br>";
}
    if($errormessage!=""){
        $errormessage = "<div class='alert alert-danger' role='alert'>"."These were error(s) in your form:"."<br>".$errormessage."</div>";
    }
    else{
        $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
        $password = md5($_POST['password1']);
        $query = "INSERT INTO `users` (`Name`,`Number`,`Email`, `Password`,`Seller/User`) VALUES ('".mysqli_real_escape_string($link, $_POST['nameof'])."','".mysqli_real_escape_string($link, $_POST['numberof'])."','".mysqli_real_escape_string($link, $_POST['emailto'])."', '".mysqli_real_escape_string($link,$password)."','Seller')";
        if(mysqli_query($link,$query)){
            if(array_key_exists('cookie1',$_POST)){
                setcookie("customerID","1234",time()+60*60*1);
            }
            $_SESSION['email'] = $_POST['emailto'];
            $_SESSION['name'] = $_POST['nameof'];
            header("Location: seller.php");
        }
  
    }
    }
    else if(array_key_exists('login',$_POST)){
        if($_POST['emailto'] == ''){
        $errormessage.= "Email field cannot be empty"."<br>";
    }
    if($_POST['password1'] == ''){
        $errormessage.= "Password cannot be empty"."<br>";
    }
        if (!filter_var($_POST['emailto'], FILTER_VALIDATE_EMAIL)) {
    $errormessage.= "Enter Valid Email address"."<br>";
}
    if($errormessage!=""){
        $errormessage = "These were error(s) in your form:"."<br>".$errormessage;
    }
else{
        $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
    $password = md5($_POST['password1']);
    $query = "SELECT `Id` FROM `users` WHERE Email = '".mysqli_real_escape_string($link,$_POST['emailto'])."' AND Password = '".mysqli_real_escape_string($link,$password)."'";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0){
        if(array_key_exists('cookie1',$_POST)){
                setcookie("customerID","1234",time()+60*60*1);
            }
        $_SESSION['email'] = $_POST['emailto'];
        $query1 = "SELECT `Seller/User` FROM `users` WHERE Email = '".mysqli_real_escape_string($link,$_POST['emailto'])."'";
        $result = mysqli_query($link,$query1);
        $fieldinfo = mysqli_fetch_array($result);
        if($fieldinfo[0] == "User"){
            header('Location: customer.php');
        }
        else if($fieldinfo[0] == "Seller"){
            header('Location: seller.php');
        }
    }
    else{
        
            $errormessage.="<div class='alert alert-danger' role='alert'>"."Incorrect Email ID or Password"."</div>";
    }
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<title>MedeX</title>  
    <style type="text/css">
        html{
            background: url(background2.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
        body{
            background: none;
        }
        .container{text-align: center;
                    margin-top: 75px;
            color: #888de8;
            width:380px;
                    }
        #signpara{
            display: none;
        }
        #signbutton1{
            display: none;
        }
        #signbutton2{
            display: none;
        }
        .interchange{
            color:blue;
            text-decoration: none;
        }
        a:hover{
            color:green;
            text-decoration: none;
        }
        #lo{
            display: none;
        }
        #X{
            font-size: 200%;
            color:red; 
            font-weight: bold;
        }
        #heading{
            font-size:260%;
            color:white;
        }
        #name1{
            display: none;
        }
        #number1{
            display: none;
        }
        
    </style>
</head>
<body>
<div class = "container">
<h1 id = "heading">Mede<span id="X">X</span></h1>
    <p>Share your thoughts permanently and securely.</p>
    <p id = "logpara">Log in using email id and password</p>
    <p id = "signpara">Interested? Sign up now.</p>
    <form method = "post">
    <div class="form-group">      
<input type="name" class="form-control" placeholder="Enter name" name = "nameof" id = "name1">
    </div>
    <div class="form-group">      
<input type="number" class="form-control" placeholder="Enter Number" name = "numberof" id="number1">
    </div>
  <div class="form-group">      
<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name = "emailto">
    </div>
<div class="form-group">
<input type = "password" class="form-control" placeholder = "Password" name = "password1">
        </div>
        <p><? echo $errormessage ?></p>
    <p id="emailHelp" class="form-text">We'll never share your email with anyone else.</p>
        <p><input type = "checkbox" name = "cookie1" value = "setcookie"> Stay Logged in</p>
       <p> <input type="submit" name = "signup1" class="btn btn-success" value = "Sign Up as User! " id="signbutton1"></p>
        <p> <input type="submit" name = "signup2" class="btn btn-success" value = "Sign Up as Seller! " id="signbutton2"></p>
        <p><input type="submit" class="btn btn-primary" value = "Login" id="loginbutton" name = "login">
        </p>
    </form>
    <p>
    <button class = "interchange btn btn-secondary" id = "lo" >Log in</button>
    </p>
    <p>
    <button class = "interchange btn btn-secondary" id = "si">Sign up as Customer</button>
    </p>
    <p>
    <button class = "interchange btn btn-secondary" id = "si1">Sign up as Seller</button>
    </p>
 </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script type = "text/javascript">
        $("#si").click(function(){
            $("#logpara").fadeOut("fast");
            $("#signpara").fadeIn("fast");
            $("#loginbutton").fadeOut("fast");
            $("#signbutton1").fadeIn("fast");
            $("#signbutton2").fadeOut("fast");
            $(this).fadeOut("fast");
            $("#si1").fadeIn("fast");
            $("#lo").fadeIn("fast");
            $("#name1").fadeIn("fast");
            $("#number1").fadeIn("fast");
        })
        $("#lo").click(function(){
            $("#signpara").fadeOut("fast");
            $("#logpara").fadeIn("fast");
            $("#signbutton1").fadeOut("fast");
            $("#signbutton2").fadeOut("fast");
            $("#loginbutton").fadeIn("fast");
            $(this).fadeOut("fast");
            $("#si").fadeIn("fast");
            $("#name1").fadeOut("fast");
            $("#number1").fadeOut("fast");
            
        })
        $("#si1").click(function(){
            $("#logpara").fadeOut("fast");
            $("#signpara").fadeIn("fast");
            $("#loginbutton").fadeOut("fast");
            $("#signbutton2").fadeIn("fast");
            $("#signbutton1").fadeOut("fast");
            $(this).fadeOut("fast");
            $("#si").fadeIn("fast");
            $("#lo").fadeIn("fast");
            $("#name1").fadeIn("fast");
            $("#number1").fadeIn("fast");
          
        })
    </script>
</body>
</html>