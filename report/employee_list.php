<fieldset class='navy'>
    <legend class="success">Manage Report</legend>
    <form action="" method="post">
     

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
               
            
        <input type="submit" value="Search" name="btn">
    </form>
</fieldset>
<br><br>

    <?php
    if(isset($_POST['btn'])){
    $query="Select * from tbl_employee where dept_id='$dept_id'";
    $q=  mysqli_query($con, $query);
    
    $query_report="select SUM(total) as total_salary,AVG(total) as avg_salary,MIN(total) as min_salary,MAX(total) as max_salary from tbl_employee where dept_id='$dept_id'";
    $q1=  mysqli_query($con, $query_report);
    $fetch_total=  mysqli_fetch_assoc($q1);
    ?>
<fieldset>
    <legend class="success">View All Employee</legend>
    <span class="navy strong"><input class="btn btn-primary" type="button" onclick="printDiv('print')" value=" Report Print"></span><br>
    <span class="navy strong">Total Salary: <?php echo $fetch_total['total_salary']; ?>Tk</span><br>
    <span class="navy strong">Average Salary: <?php echo $fetch_total['avg_salary']; ?>Tk</span><br>
    <span class="navy strong">Maximum Salary: <?php echo $fetch_total['max_salary']; ?>Tk</span><br>
    <span class="navy strong">Minimum Salary: <?php echo $fetch_total['min_salary']; ?>Tk</span>
    <table width="100%" cellspacing="1" bgcolor="#d5d5d5">
        <tr bgcolor="#2B8FA6" align="left" class='table_head'>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Join date</th>
            <th>Qualification</th>
            <th>Basic Salary(Tk)</th>
            <th>House Rent(%)</th>
            <th>Medical(%)</th>
            <th>Total</th>
            <th>Status</th>
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
            <td><?php echo $fetch['dept_id']; ?></td>
            <td><?php echo $fetch['designation']; ?></td>
            <td><?php echo $fetch['join_date']; ?></td>
            <td><?php echo $fetch['qualification']; ?></td>
            <td><?php echo $fetch['basic_salary']; ?></td>
            <td><?php echo $fetch['house_rent']; ?></td>
            <td><?php echo $fetch['medical']; ?></td>
            <td><?php echo $fetch['total']; ?></td>
            <td><?php if ($fetch['status'] == 1)
                echo "<b class='success'>Active</b>";
            else
                echo "<b class='danger'>Inactive</b>";
            ?></td>
            
            </tr>
<?php } ?>
    </table>

</fieldset>
    <?php } ?>