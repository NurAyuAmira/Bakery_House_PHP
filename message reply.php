<?php include("dataconnection.php");
    session_start();

    if(!isset($_SESSION['AdminID']))
    {
        header("Location: admin login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reply Message</title>
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
  <script type="text/javascript">
      function confirmation()
      { 
        var ans = confirm("Do you want to delete this message?");
        return ans;
      }
  </script>    

</head>
<style>
    .nav-item a, .nav-item i{color: white !important;}
    .nav-item a:hover, .nav-item i:hover{color: rgb(189,189,189)!important;}
    a#active{background-color: rgb(66,66,66)!important;border-radius: 0.5rem;}
    a#active:hover{color: white !important;background-color: black!important;}
    .btn:focus{box-shadow: none;}
</style>
<body style="font-family: 'Roboto', sans-serif;">
    <nav class="navbar navbar-expand-lg shadow fixed-top bg-secondary">
        <div class="container-fluid px-3"> 
            <div class="navbar-brand" href="#">
                <img src="img/bakery.png" alt="logo" width="80px" height="80px">
            </div>
            <div class="navbar-brand text-white" style="font-size:xx-large;font-weight: bold;cursor:default;">Bakery House</div>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold;">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="admin menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="admin bulletin.php">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="admin order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="view%20customer.php" >Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="view%20staff.php" >Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="admin message.php" id="active">Message</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="btn nav-link drowpdown-toggle px-3" style="font-size:x-large" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" style="font-size:x-large">
                                <li><a class="dropdown-item" href="admin profile.php">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="admin signout.php">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-white px-4" style="padding-top: 7.5rem;">
        <h3 class="text-decoration-underline">Reply</h3>
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $mid = $_GET["mid"];
                        $result = mysqli_query($connect,"select * from message where Message_ID = '$mid'");
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                        <td><?php echo $row["Message_Name"]?></td>
                        <td><?php echo $row["Message_Email"]?></td>
                        <td><?php echo $row["Message_Type"]?></td>
                        <td><?php echo $row["Message_Detail"]?></td>                        
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <form method="post">
            <div class="mb-3">
                <label for="subject" class="form-label"><i class="bi bi-card-text"></i>&nbsp;Email Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label"><i class="bi bi-chat-right-dots"></i>&nbsp;Email Message</label>
                <textarea class="form-control" name="message" id="text" rows="10" required placeholder="Your Message"></textarea>
            </div>
            <input type="hidden" name="email" id="email" value="<?php echo $row["Message_Email"]?>">
            <div class="mt-5">
                <button type="submit" name="sendbtn" class="btn btn-success">Send Email</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST["sendbtn"]))
    {
        $adminID = $_SESSION["AdminID"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $header = $_POST["header"];
        $message = str_replace("\n",'<br>',$_POST["message"]);
        $status = "Replied";

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
                $mail->Password   = '';                               //SMTP password
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
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();
                mysqli_query($connect,"update message SET Message_Status = '$status', Admin_ID = '$adminID'");
?>
    <script>
        alert('Message Already Sent...');
        location.href="admin message.php";
    </script>
<?php
            } 
            catch (Exception $e) 
            {
?>
                <script>
                    alert("Something error...Please Try Later");
                </script>
<?php
            }
    }
?>
