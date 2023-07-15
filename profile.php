<?php include("dataconnection.php");
    session_start();

    if(!isset($_SESSION['CustID']))
    {
        header("Location: user login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account Information</title>
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
    .nav-item a, .nav-item i,.navbar-toggler{color:antiquewhite;font-size: x-large;}
    .nav-item a:hover, .nav-item i:hover,.navbar-toggler:hover{color:maroon!important;} 
    a#active,#active i{color:white!important;background-color: rgb(175, 89, 27)!important;border-radius: 0.5rem;}
    a#active:hover,#active i:hover{background-color: maroon!important;}
    .card{font-size: x-large;}
    .card-header,.card-footer{background-color: antiquewhite;}
    #savebtn{display:none;}
    #backbtn{display:none;}
    #changebtn{display:none;color:white;width:150px;}
    footer a{text-decoration:none;color:rgb(175, 89, 27);font-size:x-large;}
    footer a:hover{color:maroon;}
    .btn:focus{box-shadow: none;}
    .pName{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;width:230px;}
</style>
<body style="font-family: 'Roboto', sans-serif;">
    <div class="offcanvas offcanvas-end py-3" id="cart">
        <div class="offcanvas-header">
            <h1><i class="bi bi-cart-fill" style="color:brown;"></i>&nbsp; My Cart</h1>
            <button type="button" class="btn btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column">
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total =0;
                foreach($_SESSION["shopping_cart"] as $keys =>$values)
                {
                    $prdID = $values["prdID"];
                    $pDetails = mysqli_query($connect,"select * from product where Product_ID Like '$prdID'");
                    $pRow = mysqli_fetch_assoc($pDetails);
            ?>                  
                    <div class="d-flex flex-row align-items-center">
                        <img src="menu/<?php echo $pRow["Product_Thumbnail"]?>" width="70px" height="70px">
                        <div class="d-flex flex-column p-1">
                            <span class="pName"><?php echo $pRow["Product_Name"]?></span>
                            <span class="">RM <?php echo $values["prdPrice"]?></span>
                        </div>
                        <a href="menu.php?action=delete&cid=<?php echo $values["cartID"];?>" class="btn"><i class="bi bi-trash-fill"></i></a>
                    </div>
                    <span class="bg-light"><?php echo $values["prdReq"]?></span>
                    <hr>
            <?php
                        $total += $values["prdPrice"];
                    }
            }
            else
            {
                $total =0;
            ?>
                <h5 class="text-center">Please Order Food...</h5>
            <?php
            }
            ?>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between px-3">
            <div>Total Price</div>
            <div>RM <?php echo number_format($total,2)?></div>
        </div>
        <hr>
        <a class="btn btn-warning" href="checkout.php" style="background: #4d3f32; color:antiquewhite ">Check Out</a>
    </div>
    <nav class="navbar navbar-expand-lg shadow fixed-top" style="background: #4d3f32;">
        <div class="container-fluid px-3">  
            <div class="navbar-brand" href="#">
                <img src="img/bakery.png" alt="logo"  width="80px" height="80px">
            </div>
            <div class="navbar-brand" href="#" style="font-size:xx-large;font-weight: bold; color:antiquewhite;cursor:default;">Bakery House</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold;">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="bulletin.php">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="message.php">Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" data-bs-toggle="offcanvas" data-bs-target="#cart" data-bs-placement="bottom" title="My Cart"><i class="bi bi-cart-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="btn drowpdown-toggle nav-link px-3 " data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" style="color:#4d3f32;">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="user signout.php" style="color:#4d3f32;">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-light">
        <div class="container px-5" style="padding: 10.5rem 0;">
            <div class="d-flex justify-content-between">
                <h3>Personal Information</h3>
                <button type="button" class="btn btn-warning" id="editbtn" name="editbtn" style="background: #4d3f32; color:antiquewhite; width:100px;">Edit</button>
                <button type="button" class="btn btn-warning" id="backbtn" name="backbtn" style="background: #4d3f32; color:antiquewhite;width:100px;">Back</button>
            </div>
            <?php
                $cid = $_SESSION['CustID'];
                $cDetails = mysqli_query($connect,"select * from customer where Customer_ID = '$cid'");
                $row = mysqli_fetch_assoc($cDetails);
            ?>
            <form action="" method="post" class="mt-3 p-4 bg-white shadow-lg rounded-3" onsubmit="return validatePhone();">
                <fieldset disabled id="userform">
                    <div class="mt-3 d-flex justify-content-between">
                        <div>
                            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i>&nbsp; Email :</label>
                            <h6 name="email"><?php echo $row['Customer_Email']?></h6>
                        </div>
                        <button type="button" class="btn btn-warning mx-1" id="changebtn" data-bs-toggle="modal" data-bs-target="#changePW" style="background: #4d3f32; color:antiquewhite;">Change Password</button>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="fname" class="form-label"><i class="bi bi-person-circle"></i>&nbsp; First Name :</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter Your first name" name="fname" required value="<?php echo $row['Customer_First_Name']?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="lname" class="form-label"><i class="bi bi-person-circle"></i>&nbsp; Last Name :</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter Your last name" name="lname" required value="<?php echo $row['Customer_Last_Name']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="mt-3">
                        <label class="form-label"><i class="bi bi-gender-trans"></i>&nbsp; Gender :</label><br>
                        <?php 
                            if($row['Customer_Gender'] == "male")
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
                        </div>
                    <div class="col-lg-6"> 
                        <div class="mt-3">
                            <label for="phone" class="form-label"><i class="bi bi-telephone-fill"></i>&nbsp;Phone number : <span id="spanPhone" class="text-danger"></span></label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter Your phone number" name="phone" required value="<?php echo $row['Customer_Contact_No']?>" onchange="checkPhone();">
                        </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-lg-6">
                    <div class="mt-3">
                        <label for="address" class="form-label"><i class="bi bi-geo-alt-fill"></i>&nbsp Address :</label>
                        <input id="address" placeholder="Enter Your Address" name="address" type="text" class="form-control" required max="255" value="<?php echo $row['Customer_Address']?>">
                    </div>
                        </div>
                <div class="col-lg-6">  
                    <div class="mt-3">
                        <label for="city" class="form-label">City</label>
                        <input class="form-control" id="city" name="city" required max="50" value="<?php echo $row['Customer_Address_City']?>">
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-lg-6">
                    <div class="mt-3">
                        <label for="state" class="form-label"><i class="bi bi-geo-alt-fill"></i>&nbsp State :</label>
                        <label for="state" class="form-label">State</label>
                                        <select  class="form-control" id="state" name="state" required value="<?php echo $row['Customer_Address_State']?>">
                                            <option value="">Select Your State</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Malacca">Malacca</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                        </select>
                    </div>
                        </div>
                    <div class="col-lg-6">
                    <div class="mt-3">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input class="form-control" id="postcode" name="postcode" pattern="[0-9]{5}" required max="5" value="<?php echo $row['Customer_Address_Postcode']?>">
                    </div>
                        </div>
                        </div>
                    <div class="mt-4">
                        <button type="submit" class="form-control btn btn-warning" id="savebtn" name="savebtn" style="background: #4d3f32; color:antiquewhite;">Save</button>
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
                                    <input type="password" class="form-control" id="currPW" placeholder="Enter Your Current PassWord" name="currPW" required>
                                </div>
                                <div class="mt-2">
                                    <label for="newPW" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;New Password :</label>
                                    <input type="password" class="form-control" id="newPW" placeholder="Enter Your New Password" name="newPW" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  required onchange="checkPassword();">
                                </div>
                                <div class="my-2">
                                    <label for="confirmPW" class="form-label"><i class="bi bi-key-fill"></i>&nbsp;Confirm New Password : <span id="spanConfirmPW" class="text-danger"></span></label>
                                    <input type="password" class="form-control" id="confirmPW" placeholder="Confirm Your New Password" name="comfirmPW" required onchange="checkPassword();">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" name="changebtn" class="btn btn-warning m-auto" style="background: #4d3f32; color:antiquewhite;">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <footer class="mt-5 text-center">
            <div style="color:maroon;">
                <div style="font-size:x-large;font-weight:bold"><i class="bi bi-dot"></i><i class="bi bi-dot"></i><i class="bi bi-dot"></i>Bakery House<i class="bi bi-dot"></i><i class="bi bi-dot"></i><i class="bi bi-dot"></i></div>
                <div>- Provide You The Best - </div>
            </div>
            <div class="row my-3">
                <div class="col-lg my-2 border-2 border-top border-bottom">
                    <a href="trackorder.php">Track My Order</a>
                </div>
                <div class="col-lg my-2 border-2 border-top border-bottom">
                    <a href="about us.html">About Us</a>
                </div>
                <div class="col-lg my-2 border-2 border-top border-bottom">
                    <a href="faq.html">FAQ</a>
                </div>
            </div>
        </footer>
        </div> 
    </div>
    <div class="bg-light" style="background:url('bg/footerbread.png');height:150px;"></div>
    <script>
        document.getElementById('editbtn').onclick = function()
        {
            document.getElementById('backbtn').style.display = "block";
            document.getElementById('savebtn').style.display = "block";
            document.getElementById('editbtn').style.display = "none";
            document.getElementById('changebtn').style.display = "block";
            document.getElementById('userform').disabled = false;
        }

        document.getElementById('backbtn').onclick = function()
        {
            document.getElementById('backbtn').style.display = "none";
            document.getElementById('savebtn').style.display = "none";
            document.getElementById('editbtn').style.display = "block";
            document.getElementById('changebtn').style.display = "none";
            document.getElementById('userform').disabled = true;
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

        function validatePhone()
        {
            if(checkPhone())
            {
                return true;
            }
            else
            {
                phone.focus();
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
</body>
</html>
<?php 
    if(isset($_POST['changebtn']))
    {
        $currPW = $_POST['currPW'];
        $newPW = $_POST['newPW'];

        $accPW = $row['Customer_Password'];

        if($currPW == $accPW)
        {
            mysqli_query($connect,"update customer SET Customer_Password = '$newPW' where Customer_ID LIKE '$cid'");
?>
            <script>
                alert('Your Password Updated Successful.');
                location.href="profile.php";
            </script>
<?php
        }
        else
        {
?>
            <script>
                alert('Your Current Password Is Incorrect.\nPassword Update Failed');
                location.href="profile.php";
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

        
        mysqli_query($connect,"update customer SET Customer_First_Name = '$fname', Customer_Last_Name = '$lname', Customer_Gender = '$gender', Customer_Contact_No = '$phone', Customer_Address = '$address', Customer_Address_City = '$city', Customer_Address_State = '$state', Customer_Address_Postcode = '$postcode' where Customer_ID LIKE '$cid'");
?>
        <script>
                alert('Your Profile Updated Successful');
                location.href="profile.php";
        </script>
<?php
    }
?>
<?php
    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["shopping_cart"] as $keys =>$values)
            {
                if($values["cartID"] == $_GET["cid"])
                {
                    unset($_SESSION["shopping_cart"][$keys]);
?>
                    <script>
                        alert('Product Deleted');
                        location.href="profile.php";
                    </script>
<?php
                }
            }
        }
    }
?>
