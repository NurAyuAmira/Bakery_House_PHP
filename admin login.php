<?php include("dataconnection.php");session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In - Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
</head>
    
<style>
    a{text-decoration: none;}
    a:hover{font-style: italic};
</style>
    
<body>
    <div class="container-fluid" style="font-family: 'Roboto', sans-serif;">
        <div class="row vh-100">
            <div class="col-5 d-none d-sm-block shadow-lg" style="background-image: url(bg/login.jpeg);background-size: cover;background-position: center;background-repeat: no-repeat"></div>
            <div class="col text-center mt-5 pt-5">
                <img src="img/bakery.png" class="rounded" alt="logo" width="120px" height="100px">
                <div class="container shadow-sm mt-5 bg-light py-4" style="max-width: 80%;">
                    <h3><i class="bi bi-people-fill"></i>&nbsp;Admin Login</h3>
                    <form action="" class="text-start" method="post">
                        <div class="mt-4">
                            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i>&nbsp;Email :</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required>
                        </div>
                        <div class="mt-4">
                            <label for="password" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;Password :</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="password" required>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="form-control btn btn-secondary" id="login" name="loginbtn">LOGIN</button>
                        </div>
                    </form>
                    <hr class="my-5">
                    <div class="row">
                        <div class="col text-start"><a href="admin forgotpwd.php?step=1">Forgot password?</a></div>
                        <div class="col text-end"><a href="admin registration.php">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</body>
</html>
<?php
    if(isset($_POST["loginbtn"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
 
        $input = mysqli_query($connect,"select * from admin where Admin_Email = '$email' and Admin_Password = '$password'");
        $row = mysqli_fetch_assoc($input);
        if($row>0)
        {
            header("Location: admin menu.php");
            $_SESSION['AdminID'] = $row['Admin_ID'];
        }
        else
        {
?>
            <script>
                alert("Your Email or Password Is Incorrect!");
            </script>
<?php
        }
    }
?>
