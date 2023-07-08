<?php
session_start();
include('../connection.php');
  if(isset($_GET['id']) && $_GET['id']!==''){
    $id = $_GET['id'];
   $sql = "delete from users where id ='$id'";
   $row1 = mysqli_query($conn, $sql);
    header("Location: users.php?id=deleted");
    exit();
  }
  header('Location:users.php');
?>