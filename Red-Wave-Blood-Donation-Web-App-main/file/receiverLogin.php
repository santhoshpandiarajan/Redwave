<?php
session_start();
    require 'connection.php';
    if(isset($_POST['rlogin'])){
    $remail=$_POST['remail'];
    $rpassword=$_POST['rpassword'];
    $update_lat = $_POST['latitude'];
    $update_long = $_POST['longitude'];
    // echo "<script>alert('$update_lat')</script>";
    // echo "<script>alert('$update_long')</script>";
    $sql="select * from receivers where remail='$remail' and rpassword='$rpassword'";
    $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rows_fetched=mysqli_num_rows($result);
    if($rows_fetched==0){
        $error= "Wrong email or password. Please try again.";
        header( "location:../login.php?error=".$error);
    }else{
        $row=mysqli_fetch_array($result);
        $id = $row['id'];
        if($update_lat>0 AND $update_long>0){
        $update = "UPDATE receivers SET rlatitude='$update_lat',rlongitude='$update_long' WHERE id='$id'";
        $updating = mysqli_query($conn,$update);
        if($updating){
            echo "<script>alert('Location Updated Successfully')</script>";
            }
        }
        $_SESSION['remail']=$row['remail'];
        $_SESSION['rname']=$row['rname'];
        $_SESSION['rid']=$id;
        // $id = $_SESSION['rid'];
        $msg= $_SESSION['rname'].' have logged in.';
        header( "location:../Userpage.php?msg=".$msg);
    } 
  }
?>