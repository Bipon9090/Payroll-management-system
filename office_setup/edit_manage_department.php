<?php
$dept_id = $_GET['dept_id'];
$query = "select * from tbl_department where dept_id='$dept_id'";
$q = mysqli_query($con, $query);
$fetch = mysqli_fetch_assoc($q);
?>
<fieldset>
    <legend class="success">Manage Department</legend>
    <form action="" method="post">
        Department Name:<input type="text" name="dept_name" value="<?php echo $fetch['dept_name']; ?>">
        Status:<select name="status">
            <?php if ($fetch['status'] == 1) { ?>
                <option value="1" selected="">Active</option>
                <option value="0">Inactive</option>    
            <?php } else { ?>
                <option value="1">Active</option>
                <option value="0" selected="">Inactive</option>    
            <?php } ?>

        </select>
        <input type="hidden" name="dept_id" value="<?php echo $fetch['dept_id']; ?>">
        <input type="submit" value="Update" name="btn">
    </form>
</fieldset>

<?php
if(isset($_POST['btn'])){
$query="update tbl_department SET dept_name='$dept_name',status='$status',updated_date='$created_date' where dept_id='$dept_id'";
$q=mysqli_query($con, $query);
if($q){
    Header("Location:dashboard.php?page_name=office_setup/manage_department");
}else{
    echo "Error Occured!";
}
    
}
?>