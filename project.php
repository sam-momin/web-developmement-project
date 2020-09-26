 <!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="project.css">
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
<div class="main">   
<nav>
<ul>
<li><a href="projecthomepage.php">Home</a></li>
<li><a href="#">About</a></li>
<li><a href="project.php">Alumini Registration</a></li>
<li><a href="#">Alumini</a></li>
</ul>
</nav>
</div>

<?php
// define variables and set to empty values
$NameErr = $EmailErr = $mobileErr = $YearofpassingErr = $GenderErr = "";
$Name = $Email = $mobile = $Yearofpassing = $Gender =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Name"])) {
    $NameErr = "Name is required";
  } else {
    $Name = test_input($_POST["Name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Name)) {
      $NameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["Email"])) {
    $EmailErr = "Email is required";
  } else {
    $Email = test_input($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      $EmailErr = "Invalid email format";
    }
  }
  
 if (empty($_POST["mobile"])) {
    $mobileErr = "mobile is required";
  } else {
	  $mobile=test_input($_POST["mobile"]);
$mobile = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
$mobile = str_replace("-", "", $mobile);
if (strlen($mobile) < 10 || strlen($mobile) > 10){
$mobileErr = "Invalid Number";
} 
}

  if (empty($_POST["Yearofpassing"])) {
    $YearofpassingErr = "Year of passing is required";
  } else {
    $Yearofpassing = test_input($_POST["Yearofpassing"]);
    // check if name only contains numbers 
   if (filter_var($Yearofpassing, FILTER_VALIDATE_INT)) {
      $YearofpassingErr = "Only numbers are allowed";
    }
  }


   
   if (empty($_POST["Gender"])) {
    $GenderErr = "Gender is required";
  } else {
    $Gender = test_input($_POST["Gender"]);
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<div class="container-fluid">
<h2>Alumini Registration Form</h2>

<p><span class="error">* required field</span></p>

<form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>  
  
  Name: <input type="text" name="Name" value="<?php echo $Name;?>">
  <span class="error">* <?php echo $NameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="Email" value="<?php echo $Email;?>">
  <span class="error">* <?php echo $EmailErr;?></span>
  <br><br>
  mobile:<input type="number" name="mobile" value="<?php echo $mobile;?>">
  <span class="error">* <?php echo $mobileErr;?></span><br><br>
  
  Yearofpassing:<input type="number" name="Yearofpassing" value="<?php echo $Yearofpassing;?>">
  <span class="error">* <?php echo $YearofpassingErr;?></span><br><br>
  
  Gender:
  <input type="radio" name="Gender" <?php if (isset($Gender) && $Gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="Gender" <?php if (isset($Gender) && $Gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="Gender" <?php if (isset($Gender) && $Gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $GenderErr;?></span>
  <br><br>
  
  

<div class="form-group row">
   <label for="example-date-input" class="col-2 col-form-label">Birth Date</label>
  <div class="col-10">
    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
	</div>
  </div><br>


  
 

 <input type="submit" name="submit" value="Submit">  
 
</form>
</div>






</body>
</html>
