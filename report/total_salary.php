<?php
    // if($_SESSION['emp_id']==TRUE){
    //     echo "string";
    // }else{
    //     echo "no";
    // }
error_reporting(0);
?>
<fieldset class='navy'>
    <legend class="success">Total Salary Report</legend>
    <form action="" method="post">
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
        <input type="hidden" name="btn_total" value=" ">
        <input type="submit" value="Next" name="btn_next">
    </form>
    
            
    <?php
        if($_SESSION['emp_id']==TRUE){
        // echo "string";

        $empID = $_SESSION['emp_id'];

        if(isset($_POST['btn_next'])){
        $month_year=$month."/".$year;
        $query="select * from tbl_employee where status=1 and emp_id=$empID";
        $q=  mysqli_query($con, $query);
        $fetch_total=  mysqli_fetch_assoc($q);
        // print_r($fetch_total);
        // exit();
        $query="select * from tbl_salary where month_year='$month_year' and emp_id=$empID";
        $q2=  mysqli_query($con, $query);
        $fetch_payment=  mysqli_fetch_assoc($q2);
        // print_r($fetch_payment);
        // exit();
        $query="select sum(amount) as payment from tbl_salary where month_year='$month_year' and emp_id=$empID";
        $q1=  mysqli_query($con, $query);
        $fetch_total_payment=  mysqli_fetch_assoc($q1);
        ?>
        <!-- <span class="navy strong"> -->
            <table>
                <tr>
                    <td colspan="3"><input class="btn btn-primary" type="button" onclick="printDiv('print')" value=" Report Print"></td>
                </tr>
                <tr>
                    <td>Employee Name:</td>
                    <td>:</td>
                    <td><?php echo $fetch_total['emp_name']; ?></td>
                </tr>
                <tr>
                    <td> Designation:</td>
                    <td>:</td>
                    <td><?php echo $fetch_total['designation']; ?></td>
                </tr>
                <tr>
                    <td>Basic Salary:</td>
                    <td>:</td>
                    <td><?php echo $fetch_total['basic_salary']; ?> Tk</td>
                </tr>
                <tr>
                    <td>This Month Salary</td>
                    <td>:</td>
                    <td><?php echo $fetch_payment['amount'] ?> Tk</td>
                </tr>
                <tr>
                    <td>This Month Due</td>
                    <td>:</td>
                    <td><?php echo ($fetch_total['basic_salary']-$fetch_payment['amount']); ?> Tk</td>
                </tr>
                <tr>
                    <td>Total Salary From Joining</td>
                    <td>:</td>
                    <td><?php echo $fetch_total_payment['payment']; ?> Tk</td>
                </tr>            
            </table>
        <!-- </span> -->

        <?php
        }
    }else{

        // echo "no";
        if(isset($_POST['btn_next'])){
        $month_year=$month."/".$year;
        $query="select count(emp_id)as total_emp,sum(total) as total_amount from tbl_employee where status=1";
        $q=  mysqli_query($con, $query);
        $fetch_total=  mysqli_fetch_assoc($q);

        $query="select sum(amount) as payment from tbl_salary where month_year='$month_year'";
        $q1=  mysqli_query($con, $query);
        $fetch_total_payment=  mysqli_fetch_assoc($q1);
        ?>
        
        <table>
            <tr>
                <td colspan="3"><input class="btn btn-primary" type="button" onclick="printDiv('print')" value=" Report Print"></td>
            </tr>
            <tr>
                <td>Total Active Employee</td>
                <td>:</td>
                <td><?php echo $fetch_total['total_emp']; ?></td>
            </tr>
            <tr>
                <td>Total Paid Salary</td>
                <td>:</td>
                <td><?php echo $fetch_total['total_amount']; ?> Tk</td>
            </tr>
            <tr>
                <td>This Month Total Payment</td>
                <td>:</td>
                <td><?php echo $fetch_total_payment['payment']; ?> Tk</td>
            </tr>
            <tr>
                <td>This Month Total Due</td>
                <td>:</td>
                <td><?php echo ($fetch_total['total_amount']-$fetch_total_payment['payment']); ?> Tk</td>
            </tr>
        </table>

    <?php
        }

        }
    ?>
</fieldset>
