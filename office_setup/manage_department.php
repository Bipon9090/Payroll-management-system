<?php

//create department//
$msg = '';
if (isset($_POST['btn'])) {
    $query_check = "Select * from tbl_department where dept_name='$dept_name'";
    $q_check = mysqli_query($con, $query_check);
    if (mysqli_num_rows($q_check) > 0) {
        $msg = "Error Occured! Duplicate Department Found!";
    } else {

        $query = "Insert into tbl_department (dept_name,status,created_date)values('$dept_name','1','$created_date')";
        $q = mysqli_query($con, $query);
        if ($q) {
            $msg = "Successfully Created!";
        }
    }
}
//end of create department

$query = "Select * from tbl_department";
$q = mysqli_query($con, $query);
?>
<fieldset class='navy'>
    <legend class="success">Manage Department</legend>
    <form action="" method="post">
        Department Name:<input type="text" name="dept_name">
        <input type="submit" value="Create" name="btn">
    </form>
    <?php echo $msg; ?>
</fieldset>
<br><br>
<fieldset>
    <legend class="success">View All Department</legend>
    <table width="100%" cellspacing="1" bgcolor="#d5d5d5">
        <tr bgcolor="#fff" align="left" class="table_head">
            <th>Department Name</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Action</th>
        </tr>
        <?php 
        $i=0;
        while ($fetch = mysqli_fetch_assoc($q)) { 
            $j=($i%2);
            if($j==1){
                echo "<tr bgcolor='#f8f8f8'>";
            }
            else{
                echo "<tr bgcolor='#fff'>";
            }
            $i++;
            ?>
                <td><?php echo $fetch['dept_name']; ?></td>
                <td><?php if($fetch['status']==1) echo "<b class='success'>Active</b>"; else echo "<b class='danger'>Inactive</b>";?></td>
                <td><?php echo $fetch['created_date']; ?></td>
                <td><?php echo $fetch['updated_date']; ?></td>
                <td>
                    <a href="?page_name=office_setup/edit_manage_department&dept_id=<?php echo $fetch['dept_id']; ?>" class="btn btn-primary">Edit</a> |
                    <a href="" class="btn btn-warning">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</fieldset>
