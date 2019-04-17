<?php
session_start();
$errormessage= "";
if($_POST){
    if(array_key_exists('signup',$_POST)){


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
        $query = "INSERT INTO `users` (`Email`, `Password`) VALUES ('".mysqli_real_escape_string($link, $_POST['emailto'])."', '".mysqli_real_escape_string($link,$password)."')";
        if(mysqli_query($link,$query)){
            if(array_key_exists('cookie1',$_POST)){
                setcookie("customerID","1234",time()+60*60*1);
            }
            $_SESSION['email'] = $_POST['emailto'];
            header("Location: mainpage.php");
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
        header("Location: mainpage.php");
    }
    else{
        
            $errormessage.="<div class='alert alert-danger' role='alert'>"."Incorrect Email ID or Password"."</div>";
    }
    }
}
}
?>
<!DOCTYPE html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

footer {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  font-size: 130%;
  text-decoration: none;
}

li a:hover {
  background-color: #111;

}
#logo{
    margin-left: 450%;
    font-size: 200%;
    margin-top:-20px;
    margin-bottom: -20px;
}
#X{
    font-size: 160%;
    color: red;
    font-weight: bold;
}
</style>
</head>


<html style="background: url(img/iit.jpg) no-repeat center center fixed; -webkit-background-size:cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">

<title>MedeX</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
<ul>
  <li><a href="mysecretdiary.php">Login/Signup</a></li>
  <li><a href="#footer">Contact</a></li>
  <li><a href="#About">About</a></li>
  <li><a href="" id="logo">Mede<span id = "X">X</span></a>
</ul>

<center>

<br>

<h1>
    <b>Mede<span id = "X">X</span></b>
</h1>

<div class="w3-container w3-white w3-text-black w3-border" style="width: 50%;">
    <h2>
        <b>Did You Know?</b>
    </h2>
    <p style="text-align: left;">
        Improperly disposed-of expired medications pose a significant risk to children. To determine how expired medications are disposed of, 500 callers to our poison information center, 100 community and hospital pharmacies, the state Boards of Pharmacy, and the FDA and EPA were surveyed about medication disposal habits. Of the 500 people polled, 1.4% returned medications to a pharmacy, 54% disposed of medications in the garbage, 35.4% flushed medications down the toilet or sink, 7.2% did not dispose of medications, and 2% related they used all medications before expiration. Of the 100 pharmacies surveyed, all but 3% had specific policies on the disposal of undispensed expired medications, which were usually returned to the producer. Alternative disposal means used for nonreturnable medications were incineration (15%), hazardous waste disposal contracts (17%), and conventional solid waste disposal or down the toilet (68%). Only 5% of the 100 pharmacies had consistent recommendations for their customers on drug disposal; 25% of the pharmacies indicated questions on drug disposal were handled by individual pharmacists only upon consumer request. A variety of drug disposal techniques were encountered in our survey. Pharmacies had specific policies for expired undispensed pharmaceuticals, but lacked uniform guidelines. Little information on the safe disposal of medications was routinely passed on to the public. Uniform guidelines need to be created for the safe disposal of expired medications and should be included in routine consumer education provided by poison information centers and pharmacies.<br><br>

        This lead us to the idea of designing a management system to control the distribution and sales of medicines in a  particular region to ensure that none of the stock is wasted due to expiration.
    </p>

</div>

<br>

<div id=About class="w3-container w3-white w3-text-black w3-border" style="width: 50%;">
    <h2><b>About  Mede<span id = "X">X</span></b> :</h2>
    <p style="text-align: left;">
    MedeX is a product of team KnightsOfKamand, IIT Mandi through which we wish to stop loss of medicines due to their expiration and make it economically available for the weaker sections of the society. From, our web app we intend to sell medicines which are about to expire, to the user at a price lower than their MRP, by using a specific algorithm which will estimate the price of the medicine depending upon the expiry date, quantity, demand of medicine and Customer's review about dealer. In this way. we will possibly be able to provide medicines to the poor at a lower cost than the actual one. This web app will also lower the amount of medicines that are being wasted due to expiration, which indeed will give profit to the customer, retailer, company and even the owner of the web app, i.e. us. This will save environment as well as raw materials.
    </p>
</div>
<br>
</center>

<footer id=footer class="w3-text-white">
<div class="w3l_footer">
        <div class="w3-container">
            <div class="col-md-4 w3ls_footer_grid_left">
                        <div class="w3ls_footer_grid_leftr">
                            <h4>Location:</h4>
                            <p>IIT Mandi, Himachal Pradesh</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-4 w3ls_footer_grid_left">
                        <div class="w3ls_footer_grid_leftr">
                            <h4>Email:</h4>
                            <a href="mailto:b18128@students.iitmandi.ac.in">b18128@students.iitmandi.ac.in</a>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-4 w3ls_footer_grid_left">
                        <div class="w3ls_footer_grid_leftr">
                            <h4>Call Us at:</h4>
                            <p>(+91) 831 863 1214</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
        </div>
    </div>
</footer>
</body>
</html> 