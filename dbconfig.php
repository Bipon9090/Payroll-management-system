<?php
$con=mysqli_connect("localhost","root","","db_payroll") or die("Server not found");
mysqli_select_db($con,"db_payroll") or die("Database not found");
?>