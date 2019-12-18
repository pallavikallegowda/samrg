<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    $user_id=$_SESSION['user_id'];
    $role=$_SESSION['role'];
    $user=$_SESSION['user'];
    include "tool-css.php";
  include 'automation_db_connect.php';
?>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="images/globe-icon.png"  class="img-fluid"/></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="images/infoholic_white_logo.png"  class="img-fluid"/></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
                <?php
                 $sql1="select notification_status , count(notification_status) as total from notifications where user_id='$user_id' and notification_status='unread'";
                     $result1=$conn->query($sql1);
                    if(!$result1){
                        echo 'MySQL Error: ' . mysqli_error($conn);
                    } 
                 else
                 {
                 $row1=$result1->fetch_assoc();
                     $total=$row1['total'];
                 }
                 ?>
            <a class="dropdown-toggle" data-toggle="dropdown">            
              <i class="fa fa-bell-o"></i><span class="label label-warning"><?php echo $total;?></span>
                </a>
            <ul class="dropdown-menu">
              <li class="header"> <?php echo 'You have '.$total.' new notifications'; ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <?php 
                        $sql="select from_user,title,id from notifications where 
						user_id='$user_id' and notification_status='unread'";
                           $result=$conn->query($sql);
                        if(!$result)
                        {
                        	echo 'MySQL Error: ' . mysqli_error($conn);
						}
                        if ($result ->num_rows > 0) 
                        {
                        	while($row = $result->fetch_assoc())
                        	{
                                $notification_id = $row['id'];
                                $notification_from = $row['from_user'];
                                $notification_message = $row['title'];
                        ?>		
                <li>
                    <a href="notification_update.php?id=<?php echo $notification_id;?>">
                        <!-- <div class="pull-left  w-25">
                            <img src="images/avatar5.png" class='img-circle w-25' alt='User Image'>
                         </div>
                         <small><span class="label label-warning">new</span></small>-->
                         <p> 
                         <strong><?php echo $notification_from;?> - </strong><?php echo $notification_message;?>
                         </p>
                      </a>
                 </li>
                    <?php }}?>
                </ul>
              </li>
              <li class="footer"><a href="notificationlist.php">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if(isset($_SESSION['profile'])){
                 ?>
                  <img src="<?php echo $_SESSION['profile']; ?>" class="user-image" alt="User Image">
                 <?php
               }else{ ?>
                <img src="images/avatar04.png" class="user-image" alt="User Image">
                <?php
                }
                ?>
              <span class="hidden-xs"> <?php echo $_SESSION['user']; ?>  </span>
             </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               <?php if(isset($_SESSION['profile'])){
                 ?>
                  <img src="<?php echo $_SESSION['profile']; ?>" class="img-circle" alt="User Image">
                 <?php
               }else{ ?>
                <img src="images/avatar04.png" class="img-circle" alt="User Image">
                <?php
                }
                ?>
                <p class="mb-1"  class="hidden-xs">
                <?php echo $_SESSION['user']; ?>
                </p>
                <p>
                <span> <?php // echo $_SESSION['designation']; ?>  </span>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>