<?php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"restaurant_management");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ut-8">
<title>EK Technologies</title>
<link rel="stylesheet" href="styles/index_style.css">
</head>
<body>
<div class="title"><h1>Welcome to mama's restaurant</h1></div>
<div class="container">
<div class="left"></div>
<div class="right">
<div class="formBox">
<form action "<?= $_SERVER['PHP_SELF'] ?>" method="post">
<p>Username</p>
<input type="text" name="username" placeholder="Enter Username">
<p>Password</p>
<input type="password" name="password" placeholder="Enter Password">
<input type="submit" name="submit" value="Sign In">
</form>
<?php
  extract($_POST) or die();
  $pswd=SHA1($password);
  $sq1="SELECT * FROM user WHERE UserName='$username' AND Password='$pswd'";
  $result=mysqli_query($link,$sq1) or die(mysqli_error($query));
  $array=mysqli_fetch_array( $result);
  session_regenerate_id();
  $_SESSION['Name']=$array['Name'];
  $_SESSION['role']=$array['UserType'];
  session_write_close();
  if(mysqli_num_rows($result)){
	  $sql2="SELECT status FROM user WHERE UserName='$username' AND Password='$pswd'";
	  $res=mysqli_query($link,$sql2);
	  $row=mysqli_fetch_array($res);
	  if($row['status']==="Active"){
		 $sql3="SELECT UserType FROM user WHERE UserName='$username' AND Password='$pswd'";
	     $rs=mysqli_query($link,$sql3);
	     $line=mysqli_fetch_array($rs); 
		 if($line['UserType']==="Admin"){
			 echo "Successfully logged in as Admin";
			 header("location:admin.php");
		 }else{
			 echo "Successfully logged in as User";
			 header("location:POS.php");
		 }
	  }else{
	  echo "Your account is ";
	  echo $row['status'];
	  echo " contact your Administrator";
	  exit();
	  }
  }else{
	  echo "Incorrect username or password";
	  exit();
  }
  
?>
</div>
</div>
</div>

</body>


</html>