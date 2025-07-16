<?php
session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['role']==0){
    header("Location: http://localhost/ASS/index.php");
  }
  else{
    header("Location: http://localhost/ASS/admin.php");

  }
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-box">
  <h2>Login</h2>
  <form action='' method='POST'>
    <div class="user-box">
      <input type="text" name="username" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div>
    <input class="sub_btn" type="submit" name="submit" value="Submit">
  </form>
  <?php 
  if (isset($_POST['submit'])) {
    require_once "db1.php";
    $uname =  mysqli_real_escape_string($con, $_POST['username']);
    $pass = $_POST['password'];
    $sql = "SELECT * FROM user WHERE user.username = '{$uname}' AND user.password = '{$pass}'";
    $result = mysqli_query($con, $sql) or die("Query Field");
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      session_start();
      $_SESSION['id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['role'] = $row['role'];
      if($_SESSION['id']==1){
        header("Location: http://localhost/ASS/admin.php");
      }
      else{
        header("Location: http://localhost/ASS/");
      }
    }
  else{
    echo "<h2>Wrong</h2>";
  }
  }
  ?>
</div>
<!-- partial -->
  
</body>
</html>
