<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['hid']))
  {
  header('location:login.php');
  }
  else {
    $hid = $_SESSION['hid'];
    $sql = "select ambulance.*, receivers.* from ambulance, receivers where hid='$hid' && ambulance.rid=receivers.id";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Ambulance Requests"; ?>
<?php require 'head.php'; ?>
<style>
.login-form{
    width: calc(100% - 20px);
    max-height: 650px;
    max-width: 450px;
    background-color: white;
}
</style>
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php'; ?>

	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="9" class="title">Ambulance requests</th></tr>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Location</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>

		    <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">No one has requested yet. </b>';
            }
            $ambu = "select * from ambulance";
            $inject_ambu = mysqli_query($conn,$ambu);
            ?>
            </div>

		<?php while($row = mysqli_fetch_array($inject_ambu)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['aname'];?></td>
			<td><?php echo $row['aemail'];?></td>
			<td><?php echo $row['aphone'];?></td>
			<td style="width: 400px; height: 200px"><iframe src="https://www.google.com/maps?q=<?php echo $row['alatitude'];?>,<?php echo $row['alongitude'];?>&hl=es;z=14&output=embed"></iframe></td>
			<td><?php echo 'You have '.$row['status'];?></td>
			<td><?php if($row['status'] == 'Accepted'){ ?> <a href="" class="btn btn-success disabled">Accepted</a> <?php }
			else{ ?>
				<a href="file/accept.php?reqid=<?php echo $row['aid'];?>" class="btn btn-success">Accept</a>
			<?php } ?>
			</td>
			<td><?php if($row['status'] == 'Rejected'){ ?> <a href="" class="btn btn-danger disabled">Rejected</a> <?php }
			else{ ?>
				<a href="file/reject.php?reqid=<?php echo $row['aid'];?>" class="btn btn-danger">Reject</a>
			<?php } ?>
			</td>
			
		</tr>
		<?php } ?>
	</table>
</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>