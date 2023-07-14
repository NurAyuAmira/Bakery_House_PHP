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
  <title>Message / Feedback</title>
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
    footer a{text-decoration:none;color:rgb(175, 89, 27);font-size:x-large;}
    footer a:hover{color:maroon;}
    .btn:focus{box-shadow: none;}
    .pName{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;width:230px;}
</style>
    
<body style="font-family: 'Roboto', sans-serif;">
    <div class="offcanvas offcanvas-end py-3" id="cart">
        <div class="offcanvas-header">
            <h1><i class="bi bi-cart-fill" style="color:brown;"></i>&nbsp;My Cart</h1>
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
                <h5 class="text-center">Your Cart is Empty...</h5>
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
        <a class="btn btn-warning" href="checkout.php" style="background: #4d3f32; color:antiquewhite">Check Out</a>
    </div>
    <nav class="navbar navbar-expand-lg shadow fixed-top" style="background: #4d3f32;">
        <div class="container-fluid px-3">  
            <div class="navbar-brand" href="#">
                <img src="img/bakery.png" alt="logo" width="80px" height="80px">
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
                        <a class="nav-link px-3" id="active" href="message.php">Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" data-bs-toggle="offcanvas" data-bs-target="#cart" data-bs-placement="bottom" title="My Cart"><i class="bi bi-cart-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="btn drowpdown-toggle nav-link px-3" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php" style="color: #4d3f32;">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="user signout.php" style="color: #4d3f32;">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-light ">
        <div class="container px-5" style="padding: 10.5rem 0;">
            <form method="post" class="mt-5">
            <h3>Drop Us a Message</h3>
                <div class="row p-4 bg-white shadow-lg rounded-3">
                    <div class="col-lg-6">
                        <div class="mt-4">
                            <label for="txtName" class="form-label"><i class="bi bi-person-circle" style="color:brown;"></i>&nbsp; Name :</label>
                            <input type="text" id="txtName" name="txtName" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mt-4">
                            <label for="txtEmail" class="form-label"><i class="bi bi-envelope-fill" style="color:brown;"></i>&nbsp; Email :</label>
                            <input type="text" id="txtEmail" name="txtEmail" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mt-4">
                            <label for="txtPhone" class="form-label"><i class="bi bi-telephone-fill" style="color:brown;"></i>&nbsp; Phone :</label>
                            <input type="text" id="txtPhone" name="txtPhone" class="form-control" placeholder="Your Phone Number" required>
                        </div>
                        <div class="mt-4">
                            <label class="form-label"><i class="bi bi-boxes" style="color:brown;"></i>&nbsp; Message Type :</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txtType" id="food" value="Food" required>
                                <label class="form-check-label" for="food">Food</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txtType" id="service" value="Service" required>
                                <label class="form-check-label" for="service">Service</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txtType" id="other" value="Other" required>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-4">
                            <label for="txtMsg" class="form-label"><i class="bi bi-chat-dots-fill" style="color:brown;"></i>&nbsp; Message :</label>
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" rows="12" required></textarea>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="mt-1">
                            <button type="submit" name="submitbtn" class="btn btn-warning" style="background: #4d3f32; color:antiquewhite">Send</button>
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
</body>
</html>
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
                        location.href="message.php";
                    </script>
<?php
                }
            }
        }
    }
?>
<?php
    if(isset($_POST["submitbtn"]))
    {
        $name = $_POST["txtName"];
        $email = $_POST["txtEmail"];
        $phone = $_POST["txtPhone"];
        $type = $_POST["txtType"];
        $msg = $_POST["txtMsg"];
        $status = "Pending";
        $custID = $_SESSION["CustID"];

        $checkid = "select * from message ORDER BY Message_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Message_ID'];
            $getIDNum = str_replace("M","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $msgID = "M".$getstr;
           
 
        }
        else
        {
            $msgID = "M0001";
 
        }

        mysqli_query($connect,"insert into message(Message_ID,Message_Name,Message_Email,Message_Phone,Message_Type,Message_Detail,Message_Status,Customer_ID,Admin_ID)
        values('$msgID','$name','$email','$phone','$type','$msg','$status','$custID',null)");

?>
        <script>
            alert('Your Message Sent Successful\nWe will reply you within 3 working days');
            location.href="message.php";
        </script>
<?php 
    }
?>
