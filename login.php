<!DOCTYPE html>
<html>
<?php
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>GRADING SYSTEM</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Theme style -->
        <!-- <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> -->
        <link rel="stylesheet" type="text/css" href="pages/CSS/login.css">
        <link rel="stylesheet" type="text/css" href="pages/CSS/master.css">

    </head>
    <body class="skin-black">
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong></strong></h3></div>
            <div class="panel-body">
            <form class="box" role="form" method="POST">
                  <input type="text" name="txt_username" placeholder="username">
                        <input type="password" class="form-control" name="txt_password" placeholder="password">
                      <input type="submit" class="bott" name="btn_login"></input>
                      <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="register.php">Register Now!</a></p>
          </div>  
              </form> 
            </div>
          </div>
          </div>
        </div>

      <?php
        include "pages/connection.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];


            $admin = mysqli_query($con, "SELECT * from tbladmin where username = '$username' and password = '$password' and accounttype = 'Administrator' ");
            $numrow = mysqli_num_rows($admin);

            $teacher = mysqli_query($con, "SELECT * from tblteacher where username = '$username' and password = '$password' ");
            $numrow1 = mysqli_num_rows($teacher);

            $student = mysqli_query($con, "SELECT * from tblstudent where username = '$username' and password = '$password' ");
                $numrow2 = mysqli_num_rows($student);

            if($numrow > 0)
            {
                while($row = mysqli_fetch_array($admin)){
                  $_SESSION['role'] = "Administrator";
                  $_SESSION['userid'] = $row['id'];
                }    
                header ('location: pages/master.php');
            }
            elseif($numrow1 > 0)
              {
                while($row = mysqli_fetch_array($teacher)){
                  $_SESSION['role'] = "Teacher";
                  $_SESSION['userid'] = $row['id'];
                } 
                header ('location: pages/student/student.php');
              }
            elseif($numrow2 > 0)
                {
                  while($row = mysqli_fetch_array($student)){
                    $_SESSION['role'] = "Student";
                    $_SESSION['userid'] = $row['id'];
                  } 
                  header ('location: pages/grade/grade.php');
                }
             else
                {
                   echo'invalid account';
                }
             
        }
        
      ?>

    </body>
</html>