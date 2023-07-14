<?php include("dataconnection.php");session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgot Password - Staff</title>
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
            <div class="col-5 d-none d-sm-block shadow-lg" style="background-image: url(bg/forgot.jpg);background-size: cover;background-position: center;background-repeat: no-repeat"></div>
            <div class="col text-center mt-5 pt-5">
                <img src="img/bakery.png" alt="logo" width="120px" height="100px">
                <div class="container shadow-sm mt-5 bg-light py-4" style="max-width: 80%;">
                    <h3><i class="bi bi-people-fill"></i>&nbsp; Forgot Password</h3>
                        <?php
                        if(isset($_GET["step"]))
                        {
                            if($_GET["step"]=="1")
                            {
                    ?>
                                <form action="" method="post" class="text-start">
                                    <div class="mt-4">
                                        <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i>&nbsp;Verify Your Email :</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" class="form-control btn btn-secondary text-white" id="verify" name="verifybtn">VERIFY</button>
                                    </div>
                                </form>
                                <hr class="my-5">
                                <div class="row">
                                    <div class="col text-start"><a href="staff login.php">Login</a></div>
                                </div>
                    <?php
                            }
                            else if($_GET["step"]=="2" && ($_SESSION["step"]==2||$_SESSION["step"]==3))
                            {
                    ?>
                                <form action="" method="post" class="text-start">
                                    <div class="mt-4">
                                        <label for="text" class="form-label"><i class="bi bi-lock-fill"></i>&nbsp;Verify Your OTP :</label>
                                        <input type="text" class="form-control" id="otp" placeholder="Enter Your OTP" name="otp" required>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" class="form-control btn btn-secondary text-white" id="verifyotp" name="verifyotpbtn">VERIFY</button>
                                    </div>
                                </form>
                                <hr class="my-5">
                                <div class="row">
                                    <div class="col text-start"><a href="staff login.php">Login</a></div>
                                </div>
                    <?php
                            }
                            else if($_GET["step"]=="3" && $_SESSION["step"]==3)
                            {
                    ?>
                                <form action="" method="post" class="text-start" onsubmit="return(validatePassword());">
                                    <div class="mt-4">
                                        <label for="newpwd" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;Enter Your New Password :</label>
                                         <input type="password" class="form-control" id="newpwd" placeholder="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="newpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required onchange="checkPassword();">
                                    </div>
                                    <div class="mt-4">
                                        <label for="confirmpwd" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;Confirm Your Password : <span id="spanConfirmPW" class="text-danger"></span></label>
                                        <input type="password" class="form-control" id="confirmpwd" placeholder="Confirm Your Password" name="confirmpwd" required onchange="checkPassword();">
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" class="form-control btn btn-secondary text-white" id="reset" name="resetbtn">RESET PASSWORD</button>
                                    </div>
                                </form>
                                <hr class="my-5">
                                <div class="row">
                                    <div class="col text-start"><a href="staff login.php">Login</a></div>
                                </div>
                    <?php
                            }
                            else
                            {
                                header("Location: staff forgotpwd.php?step=1");
                            }
                        }
                        else
                        {
                            header("Location: staff forgotpwd.php?step=1");
                        }
                    ?>
                </div>
            </div>
        </div>
    
    </div>
</body>
<script>
    var password = document.getElementById("newpwd");
    var confirm = document.getElementById("confirmpwd");
    var spanConfirm = document.getElementById("spanConfirmPW");

    function checkPassword()
    {
        if(password.value != confirm.value)
        {
            spanConfirm.innerHTML = "The confirm password confirmation does not match";
            return false;
        }
        else
        {
            spanConfirm.innerHTML = "";
            return true;
        }
    }

    function validatePassword()
    {
        if(checkPassword())
        {
            return true;
        }
        else
        {
            confirm.focus();
            return false;
        }
    }
</script>
</html>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST["verifybtn"]))
    {
        $email = $_POST["email"];
        
        $input = mysqli_query($connect,"select * from staff where Staff_Email LIKE '$email' ");
        $row = mysqli_fetch_assoc($input);
        if($row>0)
        {
            $_SESSION["email"] = $email;
            $_SESSION["otp"] = rand(100000,999999);
            $otp = $_SESSION["otp"];

            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function

            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings

                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'yuz9690@gmail.com';                     //SMTP username
                $mail->Password   = 'heqsjassjwxabmjw';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('yuz9690@gmail.com');
                //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
                $mail->addAddress($email);               //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Bakery House- Verify Your OTP";
                        $mail->Body = 
                        "<p>Dear Staff,</p>
                        <br>
                        <p>Your OTP Number Is <b>$otp</b></p>
                        <br>
                        <p>Thank You!</p>";

                $mail->send();
                $_SESSION["step"]=2;
            ?>
                <script>
                    alert('OTP Already Sent To Your Email...\nPlease Check!');
                    location.href="staff forgotpwd.php?step=2";
                </script>
            <?php
            } catch (Exception $e) {
?>
                <script>
                    alert("Something error...Please Try Later");
                </script>
<?php
            }
        }
        else
        {
?>
            <script>
                alert("Your Email Has Not Found!");
                location.href="staff forgotpwd.php?step=1";
            </script>
<?php
        }
    }
?>
<?php
    if(isset($_POST["verifyotpbtn"]))
    {
        $inputOtp = $_POST["otp"];

        if($inputOtp == $_SESSION["otp"])
        {
            $_SESSION["step"]=3;
?>
            <script>
                location.href="staff forgotpwd.php?step=3";
            </script>
<?php
        }
        else
        {
?>
            <script>
                alert('Your OTP Is Not Correct!');
                location.href="staff forgotpwd.php?step=2";
            </script>
<?php
        }
    }
?>
<?php
    if(isset($_POST["resetbtn"]))
    {
        $newPwd = $_POST["newpwd"];
        $email = $_SESSION["email"];

        mysqli_query($connect,"update staff set Staff_Password = '$newPwd' where Staff_Email LIKE '$email'");
        unset($_SESSION["otp"]);
        unset($_SESSION["email"]);
        unset($_SESSION["step"]);
?>
        <script>
            alert("Your Password Already Reset...\nPlease Login");
            location.href="staff login.php";
        </script>
<?php
    }
?>
