<?php
require 'file/connection.php';
session_start();
if(!isset($_SESSION['rid']))
{
  header('location:login.php');
}
else {
	if(isset($_SESSION['rid'])){
		$id=$_SESSION['rid'];
		$sql = "SELECT * FROM receivers WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
    // echo "<script>alert('$id')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link href="https://fonts.googleapis.com/css?family=Dosis:300,400,700" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>User page</title>
    <style>
      * {
        margin:0;
        padding:0;
      }
      body{
        font-family: "Dosis", sans-serif;
        background-color: black;
      }
      .navbar{
        width:300px;
        height:100%;
        background-color:black;
        position:fixed;
        top:0;
        right:-300px;
        display:flex;
        justify-content: center;
        align-items: center;
        border-radius:20% 0 0 40%;
        transition: right 0.8s cubic-bezier(1, 0, 0, 1);
      }
      .change{
        right:0;
      }

      .hamburger-menu{
        width:35px;
        height:30px;  
        position:fixed;
        top:20px;
        right:50px;
        cursor:pointer;
        display:flex;
        flex-direction: column;
        justify-content: space-around;
      }

      .line{
        width:100%;
        height:3px;
        background-color:white;
        transition: all 0.8s;

      }

      .change .line-1{
        transform:rotateZ(-405deg) translate(-8px, 6px);
      }
      .change .line-2{
        opacity:0;
      }
       .change .line-3{
        transform:rotateZ(405deg) translate(-8px, -6px);
      }

      .nav-list{
        text-align:left;

      }

      .nav-item{
        list-style: none;
        margin:25px;
      }

      .nav-link{
        text-decoration: none;
        font-size: 22px;
        color: #eee;
        font-weight:500;
        letter-spacing: 1px;
        text-transform: uppercase;
        position:relative;
        padding:3px 0;
      }

      .nav-link::before,
      .nav-link::after{
        content: "";
        width:100%;
        height:2px;
        background-color:red;
        position:absolute;
        right:0;
        transform:scalex(0);
        transition:transform 0.5s;
      }
      .nav-link::after{
        bottom:0;
        transform-origin:right;
      }
      .nav-link::before{
        top:0;
        transform-origin:left;
      }
      .nav-link:hover::before,
      .nav-link:hover::after{
        transform: scalex(1);
      }
    </style>

  </head>
  <body>
    <nav>
      <div class="container">
        <h1 style="border:5px solid black; font-size: 35px; background-color:white; text-transform: uppercase; text-align: center; border-radius:15px; margin: 0px 500px 0px 500px; padding: 5px;">User</h1>
      </div>
    </nav>
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        
        <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="image/uSerbbms1.jpg" alt="Los Angeles" width="1100" height="500">
          </div>
          <div class="carousel-item">
            <img src="image/userbbms2.jpeg" alt="Chicago" width="1100" height="500">
          </div>
          <div class="carousel-item">
            <img src="image/Userbbms3.png" alt="New York" width="1100" height="500">
          </div>
        </div>
        <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
      </div>
      <div class="container">
      <nav class="navbar">
        <div class="hamburger-menu">
          <div class="line line-1"></div>
          <div class="line line-2"></div>
          <div class="line line-3"></div>
        </div>

        <ul class="nav-list">
          <li class="nav-item">
            <a href="rprofile.php" class="nav-link">My Account</a>
          </li>
          <li class="nav-item">
            <a href="blooddinfo.php" class="nav-link">Blood info</a>
          </li>
           <li class="nav-item">
            <a href="abs.php" class="nav-link">Blood available</a>
          </li>
           <li class="nav-item">
            <a href="usearchnerby.php" class="nav-link">Search Nereby</a>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">My Community</a>
          </li>
           <li class="nav-item">
            <a href="sentrequest.php" class="nav-link">Status of request</a>
           </li>      
           <li class="nav-item">
            <a href="blooddonate.php" class="nav-link">Blood donation request</a>
          </li>
           <li class="nav-item">
            <a href="ambulance.php" class="nav-link">Call Ambulance</a>
          </li>
           <li class="nav-item">
            <a href="logout.php" class="nav-link">LogOut</a>
          </li>
        </ul>
     </nav>
    </div>
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php 
      $rid = $id;
      $check_donate = "SELECT * FROM blooddonate WHERE rid='$rid' AND status='Pending'";
      $check_result = mysqli_query($conn,$check_donate);
      $count = 0;
      while($check_data = mysqli_fetch_array($check_result)){
        if($row = mysqli_num_rows($check_result)>0){
          // echo "<script>alert($count)</script>";
          $hid = $check_data['hid'];
          $hospital = "SELECT * FROM hospitals WHERE id='$hid'";
          $get_hospital = mysqli_query($conn,$hospital);
          $host = mysqli_fetch_array($get_hospital);
          ++$count;
          ?>
      <script type="text/Javascript">
      Notification.requestPermission().then(perm => {
        if(perm === "granted"){
          new Notification("<?php echo "New Request($count)";?>",{
            body: "You have Blood Request From <?php echo $host['hname']; ?>",
            icon: "image/hospital3.png",
          });
        }else{
          alert("Please Allow Notifications");
        }
      })
      </script>
          <?php
          // echo "<script>alert('fine')</script>";
        }
        else{
          echo "<script>alert('You Don't Have any Blood Request Yet!')</sciprt>";
        }
      }
    ?>
    <?php
      $rid = $id;
      $test = "SELECT * FROM receivers WHERE id='$rid'";
      $push_test = mysqli_query($conn,$test);
      $col = mysqli_fetch_array($push_test);
      $b_grp = $col['rbg'];
      $city = $col['rcity'];
      $r_city = strtoupper($city);
      // echo "<script>alert('$b_grp')</script>";
      // echo "<script>alert('$r_city')</script>";
      $find = "SELECT * FROM hospitals";
      $find_loc = mysqli_query($conn,$find);
      while($loc = mysqli_fetch_array($find_loc)){
        $hcity = $loc['hcity'];
        $h_city = strtoupper($hcity);
        // echo "<script>alert('$h_city')</script>";
        if($r_city==$h_city){
          $hid = $loc['id'];
          // echo "<script>alert('$hid')</script>";
          $check_test = "SELECT * FROM blooddonate WHERE hid='$hid'";
          if($get_test = mysqli_query($conn,$check_test)){
             while($get_data = mysqli_fetch_array($get_test)){
                $grp = $get_data['bg'];
                if($b_grp==$grp){
                  $host_id = $get_data['hid'];
                  ?>
                        <script type="text/Javascript">
      Notification.requestPermission().then(perm => {
        if(perm === "granted"){
          new Notification("<?php echo "Nereby Request";?>",{
            body: "Your Blood is Need in <?php $find_host = "SELECT * FROM hospitals WHERE id='$host_id'"; 
                                               $get_host = mysqli_query($conn,$find_host);
                                               $fetch = mysqli_fetch_array($get_host);
                                               echo $fetch['hname'];
                                          ?>",
            icon: "image/user.png",
          });
        }else{
          alert("Please Allow Notifications");
        }
      })
      </script>
                  <?php
                }
                break;
             }
          }
        }
      }
      
    ?>
  </body>
</html>