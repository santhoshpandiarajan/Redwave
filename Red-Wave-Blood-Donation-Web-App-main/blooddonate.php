<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['rid']))
  {
  header('location:login.php');
  }
  else {
    $rid = $_SESSION['rid'];
    $sql = "SELECT blooddonate.*, hospitals.* from blooddonate, hospitals where rid='$rid' && blooddonate.hid=hospitals.id";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Blood Donate"; ?>
<?php require 'head.php'; ?>
<style>
	.login-form{
    width: calc(100% - 20px);
    max-height: 650px;
    max-width: 450px;
    background-color: white;
}
.footer {​​
position: fixed;
left: 0;
bottom: 0;
width: 100%;
background-color: white;
color: black;
text-align: center;
}
</style>
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php'; ?>

		<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="9" class="title">Blood Donate</th></tr>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>City</th>
			<th>Phone</th>
			<th>Blood Group</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>

		    <div>
                <?php
                if ($result) {
                    $rows =mysqli_num_rows( $result);
                    if ($rows) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">No one has requested yet. </b>';
            }
            ?>
            </div>

		<?php while($row = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['hname'];?></td>
			<td><?php echo $row['hemail'];?></td>
			<td><?php echo $row['hcity'];?></td>
			<td><?php echo $row['hphone'];?></td>
			<td><?php echo $row['bg'];?></td>
			<td><?php echo 'You have '.$row['status'];?></td>
			<td><?php if($row['status'] == 'Accepted'){ ?> <a href="" class="btn btn-success disabled">Accepted</a> <?php }
			else{ ?>
				<a href="file/acceptd.php?donoid=<?php echo $row['donoid'];?>" class="btn btn-success">Accept</a>
			<?php } ?>
			</td>
			<td><?php if($row['status'] == 'Rejected'){ ?> <a href="" class="btn btn-danger disabled">Rejected</a> <?php }
			else{ ?>
				<a href="file/rejectd.php?donoid=<?php echo $row['donoid'];?>" class="btn btn-danger">Reject</a>
			<?php } ?>
			</td>
			
		</tr>
		<?php } ?>
	</table>
	<?php
        $check = "select * from blooddinfo where rid='$rid'"; 
		$inject_check = mysqli_query($conn, $check); // finding user had a community
		while($init = mysqli_fetch_array($inject_check)){
			$phone = $init['bphone'];
			$user_ids = "select * from receivers where rphone='$phone'";
			if($inject_id = mysqli_query($conn,$user_ids)){
				$init_id = mysqli_fetch_array($inject_id);
				$community = $init_id['id'];
				$request_check = "select * from bloodrequest where rid='$community'";
				$check_request = mysqli_query($conn,$request_check);
				$row_check = mysqli_num_rows($check_request);
				if($row_check>0){
					$count = 0;
					?>
					<table class="table table-responsive table-striped rounded mb-5">
						<tr><th colspan="9" class="title">Urgent Request From Contacts</th></tr>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>City</th>
							<th>Phone</th>
							<th>Hospital</th>
							<th>Blood Group</th>
							<th>Status</th>
							<th colspan="2">Action</th>
						</tr>
						<?php while($init_check = mysqli_fetch_array($check_request)) { ?>
						<tr>
							<td><?php echo ++$count;?></td>
							<td><?php echo $init_id['rname'];?></td>
							<td><?php echo $init_id['rcity'];?></td>
							<td><?php echo $init_id['rphone'];?></td>
							<td><?php 
										$hid = $init_check['hid'];
										$hospital = "select * from hospitals where id='$hid'";
										$inject_host = mysqli_query($conn,$hospital);
										$fetch_host = mysqli_fetch_array($inject_host);
										echo $fetch_host['hname'];
								?>
							</td>
							<td><?php echo $init_check['bg'];?></td>
							<td><?php echo 'Request Status is '.$init_check['status'];?></td>
							<td><?php if($init_check['status'] == 'Accepted'){ ?> <a href="" class="btn btn-success disabled">Accepted</a> <?php }
							else{ ?>
								<a href="file/acceptd.php?donoid=<?php echo $init_check['donoid'];?>" class="btn btn-success">Accept</a>
							<?php } ?>
							</td>
							<td><?php if($init_check['status'] == 'Rejected'){ ?> <a href="" class="btn btn-danger disabled">Rejected</a> <?php }
							else{ ?>
								<a href="file/rejectd.php?donoid=<?php echo $init_check['donoid'];?>" class="btn btn-danger">Reject</a>
							<?php } ?>
							</td>	
						</tr>
					<?php } ?>
					</table>
					<?php
				}
			}
			
		}?>
		
		
	

</div>
<?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>