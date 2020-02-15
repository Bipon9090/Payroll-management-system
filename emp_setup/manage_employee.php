<?php
//create employee//
$msg = '';
if (isset($_POST['btn'])) {
    $query_check = "Select * from tbl_employee where national_id='$national_id'";
    $q_check = mysqli_query($con, $query_check);
    $join_date=$year."-".$month."-".$day;
    if (mysqli_num_rows($q_check) > 0) {
        $msg = "Error Occured! This employee already registered!";
    } else {
        $query = "Insert into tbl_employee (emp_name,user_name,password,gender,dept_id,designation,join_date,qualification,national_id,basic_salary,house_rent,medical,total,status)values"
                . "('$emp_name','$user_name','$password','$gender','$dept_id','$designation','$join_date','$qualification','$national_id','$b_salary','$house_rent','$medical','$total','1')";
        $q = mysqli_query($con, $query);
 
        if ($q) {
            $msg = "Successfully Created!";
        }
    }
}
//end of create employee

$query = "Select * from tbl_employee";
$q = mysqli_query($con, $query);
?>
<fieldset>
    <legend class="success">Manage Employee</legend>
    <form action="" method="post">
        <table class='strong navy'>
            <tr>
                <td>Employee Id</td><td>
                    <?php $q_emp_id="select max(emp_id) as new_emp_id from tbl_employee";
                    $q_emp=  mysqli_query($con, $q_emp_id);
                    $fetch=  mysqli_fetch_assoc($q_emp);
                    echo $new_emp_id=$fetch['new_emp_id']+1;
                    
                    ?>
                    
                </td>
            </tr>
            <tr>
                <td>Employee Name:</td><td><input type="text" name="emp_name"></td>
            </tr>
            <tr>
                <td>Employee User Name:</td><td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td>Password:</td><td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td>Department Name:</td><td>

                    <select name="dept_id" required="">
                        <option value="">Select Department</option>
                        <?php
                        $query_dept = "select * from tbl_department where status=1";
                        $q1 = mysqli_query($con, $query_dept);
                        while ($fetch_dept = mysqli_fetch_assoc($q1)) {
                            ?>
                            <option value="<?php echo $fetch_dept['dept_id']; ?>"><?php echo $fetch_dept['dept_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Designation:</td><td><input type="text" name="designation"></td>
            </tr>
            <tr>
                <td>National ID:</td><td><input type="text" name="national_id" required="">*</td>
            </tr>
            <tr>
                <td>Join Date:</td>
                <td>
                    <select name="day">
                        <option>Day</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
							$i=($i<10)?"0$i":$i;
                            echo "<option>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <select name="month">
                        <option>Month</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $i=($i<10)?"0$i":$i;
                            echo "<option>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <select name="year">
                        <option>Year</option>
                        <?php
                        $date = date('Y');
                        for ($i = $date; $i >= 2000; $i--) {
                            echo "<option>" . $i . "</option>";
                        }
                        ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td>Qualification:</td><td><input type="text" name="qualification"></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female">Female
                </td>
            </tr>
            <tr>
                <td>Basic Salary:</td><td><input type="text" name="b_salary" id="b_salary">Tk</td>
            </tr>
            <tr>
                <td>House Rent:</td><td><input type="text" name="house_rent" id="h_rent">%</td>
            </tr>
            <tr>
                <td>Medical:</td><td><input type="text" name="medical" id="medical">%</td>
            </tr>
            <tr>
                <td>Total:</td><td><input type="text" name="total" readonly="" id="total"></td>
            </tr>
        </table>
        <span id="result"></span>
        <input type="submit" value="Create" name="btn">
    </form>
<?php echo $msg; ?>
</fieldset>
<br>


<script>
    $(document).ready(function() {


        $("input").keyup(function() {
            var b_salary = parseInt(($("#b_salary").val() < 1) ? '0' : $("#b_salary").val());
            var h_rent = parseInt(($("#h_rent").val() < 1) ? '0' : $("#h_rent").val());
            var medical = parseInt(($("#medical").val() < 1) ? '0' : $("#medical").val());
            
     var   h_rent_per=(b_salary*h_rent)/100;
       var medical_per=(b_salary*medical)/100;
            
            $("#total").val(b_salary+h_rent_per+medical_per);

        });

    });
</script>


<fieldset>
    <legend class="success">View All Employee</legend>
    <table width="100%" cellspacing="1" bgcolor="#d5d5d5">
        <tr bgcolor="#2B8FA6" align="left" class='table_head'>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>User Id</th>
            <th>Password</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Join date</th>
            <th>Qualification</th>
            <th>Basic Salary(Tk)</th>
            <th>House Rent(%)</th>
            <th>Medical(%)</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        $i = 0;
        while ($fetch = mysqli_fetch_assoc($q)) {
            $j = ($i % 2);
            if ($j == 1) {
                echo "<tr bgcolor='#f8f8f8'>";
            } else {
                echo "<tr bgcolor='#fff'>";
            }
            $i++;
            ?>
            <td><?php echo $fetch['emp_id']; ?></td>
            <td><?php echo $fetch['emp_name']; ?></td>
            <td><?php echo $fetch['user_name']; ?></td>
            <td><?php echo $fetch['password']; ?></td>
            <td><?php echo $fetch['dept_id']; ?></td>
            <td><?php echo $fetch['designation']; ?></td>
            <td><?php echo $fetch['join_date']; ?></td>
            <td><?php echo $fetch['qualification']; ?></td>
            <td><?php echo $fetch['basic_salary']; ?></td>
            <td><?php echo $fetch['house_rent']; ?></td>
            <td><?php echo $fetch['medical']; ?></td>
            <td><?php if ($fetch['status'] == 1)
                echo "<b class='success'>Active</b>";
            else
                echo "<b class='danger'>Inactive</b>";
            ?></td>
            <td>
                <a href="?page_name=office_setup/edit_manage_department&dept_id=<?php echo $fetch['dept_id']; ?>" class="btn btn-primary">Edit</a> &nbsp;
                <a href="" class="btn btn-warning">Delete</a>
            </td>
            </tr>
<?php } ?>
    </table>

</fieldset>
