<?php
session_start();
include "dbconfig.php";

if(isset($_POST['btn'])){
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];

	$query="Select * from tbl_admin where user_name='$user_name' and password='$password' and user_type=1";
	$q=mysqli_query($con,$query);
	$rows=mysqli_num_rows($q);
// $z=mysqli_fetch_assoc($q);
// print_r($z);
// exit();
	if($rows==1){
		$_SESSION['user_name']=$user_name;
		$_SESSION['user_type']=1;
		Header("Location:dashboard.php");
	}else{
		$query="Select * from tbl_employee where user_name='$user_name' and password='$password'";
		$q=mysqli_query($con,$query);
		$z=mysqli_fetch_assoc($q);
// print_r($z);
// exit();
		$rows=mysqli_num_rows($q);

		if($rows==1){
			$_SESSION['user_name']=$z['emp_name'];
			$_SESSION['emp_id']=$z['emp_id'];
			$_SESSION['designation']=$z['designation'];
			$_SESSION['user_type']=2;
			Header("Location:dashboard.php");
		}else{
			echo "username or password invalid";
		}
	}


}
?>

<html>
<head>	
	<style type='text/css'>
		#login{
			width:600px;
			margin:10% auto;
			background-image:-moz-linear-gradient(#fff,#A2BBD5);
			box-shadow:1px 1px 15px 10px #888888;
			height:200px;
			padding-top:50px;
		}
		.tbl_design{
			margin-left:30%;
		}
		#login h2,input,label{
			color:#267392;
		}
		.btn{
			padding: 5px 10px;
			border-radius: 5px;
		}
		.btn:hover{
			cursor: pointer;
		}
		.btn-primary{
			background: #3276B1;
			color:#fff;
			text-decoration: none;
			border:0px;
			
		}
		.btn-primary:hover{
			background: #5B9CD4;
		}
	</style>
</head>
<body>
	<div id='login'>
		<center>
			<h2>Login Panel| Payroll Management</h2>
		</center>
		<form action='' method='post'>
			<table class='tbl_design'>
				<tr>
					<td><label>User Name:</label></td>
					<td><input type='text' name='user_name'></td>
				</tr>
				<tr>
					<td><label>Password:</label></td>
					<td><input type='password' name='password'></td>
				</tr>
				<tr>
					<td colspan='2' align='center'><input type='submit' name='btn' value='Login' class='btn btn-primary'></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
