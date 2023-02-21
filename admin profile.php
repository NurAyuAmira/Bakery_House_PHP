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
  <title>Account Information - Admin</title>
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
    .nav-item a, .nav-item i{color: white !important;}
    .nav-item a:hover, .nav-item i:hover{color: rgb(189,189,189)!important;}
    a#active{background-color: rgb(66,66,66)!important;border-radius: 0.5rem;}
    a#active:hover{color: white !important;background-color: black!important;}
    .btn:focus{box-shadow: none;}
    
    .sidebar
    {
        z-index: 99;
        display:flex;
        flex-direction: column;
        flex-wrap: nowrap;
        left:0;
        position:fixed;
        height:100%;
        width:15%;
        padding:1.5rem ;
        text-align: center;
        overflow: auto !important;
    }

    .sidebar .nav-link
    {
        color: black !important;
        font-size: x-large;
        margin:0.8rem;
    }

    .sidebar .nav-link:hover
    {
        color:rgb(189,189,189)!important;
    }

    .content
    {
        margin-left:15%;
        padding:1.5rem;
    }

    .content h3
    {
        text-decoration: underline;
    }

    .form-control, .form-select
    {
        box-shadow: none!important;
    }
    

    @media screen and (max-width:960px){
        .sidebar
        {
            top:6.5rem;
            width: 100%;
            float:none;
            height:auto;
            padding:0.5rem ;
            flex-direction: row;
        }

        .content
        {
            margin:12.5rem 0;
            padding:1.5rem 0;
        }

    }

    #savebtn{display:none;}
    #backbtn{display:none;}
    #changebtn{display:none;color:white;width:150px;}
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
                        <a class="nav-link px-3" href="admin message.php">Message</a>
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
    <div class="container-fluid bg-white" style="padding-top: 6.5rem;">
        <ul class="nav sidebar bg-light shadow" role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#manage">Manage</a>
            </li>
        </ul>
        <div class="content">
            <div class="tab-content">
                <div id="manage" class="tab-pane active">
                    <div class="d-flex justify-content-between">
                        <h3>Personal Information</h3>
                        <button type="button" class="form-control btn btn-secondary" id="editbtn" name="editbtn" style="color: white;width:100px;">Edit</button>
                        <button type="button" class="form-control btn btn-secondary" id="backbtn" name="backbtn" style="color: white;width:100px;">Back</button>
                    </div>
                    <?php
                    $aid = $_SESSION['AdminID'];
                    $aDetails = mysqli_query($connect,"select * from admin where Admin_ID = '$aid'");
                    $row = mysqli_fetch_assoc($aDetails);
                ?>
                    <form action="" method="post" class="bg-white rounded-3" onsubmit="return(validateForm());">
                        <fieldset disabled id="adminform">
                            <div class="mt-3 d-flex justify-content-between">
                                <div>
                                    <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i>&nbsp;Email :</label>
                                    <h6 name="email"><?php echo $row['Admin_Email']?></h6>
                                </div>
                                <button type="button" class="btn btn-secondary mx-1" id="changebtn" data-bs-toggle="modal" data-bs-target="#changePW">Change Password</button>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mt-3">
                                        <label for="fname" class="form-label"><i class="bi bi-person-circle"></i>&nbsp;First Name :</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter Your first name" name="fname" required value="<?php echo $row['Admin_First_Name']?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-3">
                                        <label for="lname" class="form-label"><i class="bi bi-person-circle"></i>&nbsp;Last Name :</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter Your last name" name="lname" required value="<?php echo $row['Admin_Last_Name']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label"><i class="bi bi-gender-trans"></i>&nbsp;Gender :</label><br>
                                <?php 
                                    if($row['Admin_Gender'] == "male")
                                    {
                                ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="Male" name="gender" value="male" checked><i class="bi bi-gender-male"></i>
                                            <label for="Male" class="form-check-label" required>&nbsp Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="Female" name="gender" value="female"><i class="bi bi-gender-female"></i>
                                            <label for="Female" class="form-check-label" required>&nbsp Female</label>
                                        </div>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="Male" name="gender" value="male"><i class="bi bi-gender-male"></i>
                                            <label for="Male" class="form-check-label" required>&nbsp Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="Female" name="gender" value="female" checked><i class="bi bi-gender-female"></i>
                                            <label for="Female" class="form-check-label" required>&nbsp Female</label>
                                        </div>
                                <?php
                                    }
                                ?>
                            </div>  
                            <div class="mt-3">
                                <label for="phone" class="form-label"><i class="bi bi-telephone-fill"></i>&nbsp;Phone number : <span id="spanPhone" class="text-danger"></span></label> 
                                <input type="tel" class="form-control" id="phone" placeholder="Enter Your phone number" name="phone" required value="<?php echo $row['Admin_Contact_No']?>" onchange="checkPhone();">
                            </div>
                            <div class="mt-3">
                                <label for="address" class="form-label"><i class="bi bi-geo-alt-fill"></i>&nbsp;Address :</label>
                                <input id="address" placeholder="Enter Your Address" name="address" type="text" class="form-control" required value="<?php echo $row['Admin_Address']?>">
                                <br>
                                <div id="mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City</label>
                                            <input class="form-control" id="city" name="city" required value="<?php echo $row['Admin_Address_City']?>">
                                        </div>
                                        <div class="col-md-4"> 
                                            <label for="state" class="form-label">State</label>
                                             <input class="form-control" id="state" name="state" required value="<?php echo $row['Admin_Address_State']?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="postcode" class="form-label">Postcode</label>
                                            <input class="form-control" id="postcode" name="postcode" required value="<?php echo $row['Admin_Address_Postcode']?>">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="mt-4">
                                <button type="submit" class="form-control btn btn-secondary" id="savebtn" name="savebtn" style="color: white;">Save</button>
                            </div>
                        </fieldset>
                    </form>
                    <form method="post" onsubmit="return(validatePassword());">
                    <div class="modal fade" id="changePW">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="bi bi-key-fill"></i>&nbsp;Change Password</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="mt-2">
                                        <label for="currPW" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;Current Password :</label>
                                        <input type="password" class="form-control" id="currPW" placeholder="Enter Your Current PassWord" name="currPW" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="newPW" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;New Password :</label>
                                        <input type="password" class="form-control" id="newPW" placeholder="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="newPW" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"required onchange="checkPassword();">
                                    </div>
                                    <div class="my-2">
                                        <label for="confirmPW" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;Confirm New Password : <span id="spanConfirmPW" class="text-danger"></span></label>
                                        <input type="password" class="form-control" id="confirmPW" placeholder="Confirm Your New Password" name="comfirmPW" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required onchange="checkPassword();">
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" name="changebtn" class="btn btn-secondary m-auto">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>  
                </div>    
            </div>
        </div>
    </div>
</body>
<script>
        document.getElementById('editbtn').onclick = function()
        {
            document.getElementById('backbtn').style.display = "block";
            document.getElementById('savebtn').style.display = "block";
            document.getElementById('editbtn').style.display = "none";
            document.getElementById('changebtn').style.display = "block";
            document.getElementById('adminform').disabled = false;
        }

        document.getElementById('backbtn').onclick = function()
        {
            document.getElementById('backbtn').style.display = "none";
            document.getElementById('savebtn').style.display = "none";
            document.getElementById('editbtn').style.display = "block";
            document.getElementById('changebtn').style.display = "none";
            document.getElementById('adminform').disabled = true;
        }

        var phone = document.getElementById("phone");
        var spanPhone = document.getElementById("spanPhone");
        var password = document.getElementById("newPW");
        var confirm = document.getElementById("confirmPW");
        var spanConfirm = document.getElementById("spanConfirmPW");



        function checkPhone()
        {
            if(phone.value.match(/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4,5})$/))
            {
                spanPhone.innerHTML = "";
                return true;
            }
            else
            {
                spanPhone.innerHTML = "Please enter correct phone number";
                return false;
            }
        }

        function validateForm()
        {
            if(checkPhone()&&checkIC())
            {
                return true;
            }
            else
            {
                if(!(checkIC()))
                {
                    ic.focus();
                }
                else if(!(checkPhone()))
                {
                    phone.focus();
                }
                return false;
            }
        }

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
    if(isset($_POST['changebtn']))
    {
        $currPW = $_POST['currPW'];
        $newPW = $_POST['newPW'];

        $accPW = $row['Admin_Password'];

        if($currPW == $accPW)
        {
            mysqli_query($connect,"update admin SET Admin_Password = '$newPW' where Admin_ID LIKE '$aid'");
?>
            <script>
                alert('Your Password Updated Successful.');
                location.href="admin profile.php";
            </script>
<?php
        }
        else
        {
?>
            <script>
                alert('Your Current Password Is Incorrect.\nPassword Update Failed');
                location.href="admin profile.php";
            </script>
<?php
        }
    }
 
?>
<?php
    if(isset($_POST['savebtn']))
    {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $gender = $_POST["gender"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $postcode = $_POST["postcode"];

        mysqli_query($connect,"update admin SET Admin_First_Name = '$fname', Admin_Last_Name = '$lname', Admin_Gender = '$gender', Admin_Contact_No = '$phone',Admin_Address = '$address', Admin_Address_Postcode = '$postcode', Admin_Address_City = '$city',Admin_Address_State = '$state'where Admin_ID LIKE '$aid'");
?>
        <script>
                alert('Your Profile Updated Successful');
                location.href="admin profile.php";
        </script>
<?php
    }
?>
