<?php
ini_set('session.gc_maxlifetime', 14400);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(14400);

session_start(); 
     include'automation_db_connect.php';
     
if(isset($_SESSION['user_id'])){
                include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>  
        <?php 
            $sql0 = "select * from user where user_id='".$user_id."'";
            $result0 = $conn->query($sql0);
            if ($result0 ->num_rows > 0) {
                while($row0 = $result0->fetch_assoc()) {
                    if($row0['role']=='Manager')
                    {include 'manager.php';}
                    else if($row0['role']=='Crawler'){
                        include 'crawler.php';
                    }
                    else if($row0['role']=='Analyst')
                    {include 'analyst.php';}
                    else if($row0['role']=='Designer')
                    {include 'designer.php';}
                    else if($row0['role']=='Reviewer')
                    {include 'reviewer.php';}
                    
                }}
     ?>
</body><?php include('footer.php'); }else {
    include('session_expired.php');
} ?>
</html>
