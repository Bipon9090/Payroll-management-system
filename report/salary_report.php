<form action="" method="post">
    <input type="submit" class="btn btn-primary" name="btn_total" value="Click to Generate Salary Report">
	<!-- <input type="submit" class="btn btn-warning" name="btn_date_wise" value="Date wise Report"> -->
</form>
<?php
if(isset($_POST['btn_total'])){
    include "report/total_salary.php";
}elseif(isset($_POST['btn_date_wise'])){
    include "report/date_wise.php";
}