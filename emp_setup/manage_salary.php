<?php
//create department//
$msg = '';
?>
<fieldset class='navy'>
    <legend class="success">Manage Salary</legend>
    <form action="" method="post">
        Employee Id:<input type="text" name="emp_id" required=""><br>
        Select Month:
        <select name="month" required="">
            <option value="">Month</option>
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
        </select>
        <select name="year" required="">
            <option value="">Year</option>
            <?php
            $date = date('Y');
            for ($i = $date; $i >= 2000; $i--) {
                echo "<option>" . $i . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Next" name="btn">
    </form>
    <?php echo $msg; ?>
</fieldset>
<?php
if (isset($_POST['btn'])) {
    $query = "select * from tbl_employee where emp_id='$emp_id'";
    $q = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($q);
    ?>
    <br>
    <table bgcolor="#006699" cellspacing="1" height="200" width="250">
        <tr bgcolor="#f8f8f8">
            <td>Employee Id:</td><td><?php echo $fetch['emp_id']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Employee Name:</td><td><?php echo $fetch['emp_name']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Department:</td><td><?php echo $fetch['dept_id']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Designation:</td><td><?php echo $fetch['designation']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Join Date:</td><td><?php echo $fetch['join_date']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Basic:</td><td><?php echo $fetch['basic_salary']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>House Rent(%):</td><td><?php echo $fetch['house_rent']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Medical(%):</td><td><?php echo $fetch['medical']; ?></td>
        </tr>
        <tr bgcolor="#f8f8f8">
            <td>Total:</td><td><?php echo $fetch['total']; ?></td>
        </tr>
    </table>
    <fieldset>
        <legend class="success">View Payment History</legend>
        <table width="100%" cellspacing="1" bgcolor="#d5d5d5">
            <tr bgcolor="#fff" align="left" class="table_head">
                <th>Payment Date:</th>
                <th>Payment Month</th>
                <th>Amount</th>
            </tr>
            <?php
            $month_year = $month . "/" . $year;
            $query1 = "select * from tbl_salary where emp_id='$emp_id' and month_year='$month_year'";
            $q1 = mysqli_query($con, $query1);
            if (mysqli_num_rows($q1) < 1) {
                echo "<tr><td colspan='3' align='center'>No Transaction yet!</td></tr>";
            }
            $i = 0;
            $total_paid = 0;
            while ($fetch1 = mysqli_fetch_assoc($q1)) {
                //for stripped table//
                $j = ($i % 2);
                if ($j == 1) {
                    echo "<tr bgcolor='#f8f8f8'>";
                } else {
                    echo "<tr bgcolor='#fff'>";
                }
                $i++;
                ?>
                <td><?php echo $fetch1['create_date']; ?></td>
                <td><?php echo $fetch1['month_year']; ?></td>
                <td><?php echo $fetch1['amount']; ?></td>
                </tr>
                <?php
                $total_paid+=$fetch1['amount'];
            }
            ?>
            <tr>
                <td></td>
                <td align="right" class="navy strong">Total:</td>
                <td class="strong"><?php echo $total_paid; ?></td>
            </tr>
        </table>
        <?php if ($total_paid != $fetch['total']) { ?>
            <form action="" method="post">
                <span class="navy">Now Pay:</span>
                <input type="text" name="now_pay">
                <input type="hidden" name="emp_id" value="<?php echo $fetch['emp_id']; ?>">
                <input type="hidden" name="month_year" value="<?php echo $month_year; ?>">
                <input type="hidden" name="total_amount" value="<?php echo $fetch['total']; ?>">
                <input type="submit" value="Pay" name="btn_pay">
            </form>
        <?php } else echo "Payment Completed!"; ?>
    </fieldset>
    <?php
}//end of first submit button action
if (isset($_POST['btn_pay'])) {
    if ($now_pay <= $total_amount && $total_amount <= $total_paid) {
        $query2 = "Insert into tbl_salary(emp_id,amount,month_year,create_date)values('$emp_id','$now_pay','$month_year','$created_date')";
        $q2 = mysqli_query($con, $query2);
    }
    else {
        echo "<span class='danger'>You don't pay more than salary!</span>";
    }
}
?>