<?php include("dataconnection.php");
    session_start();

    if(!isset($_SESSION['CustID']))
    {
        header("Location: user login.php");
    }

    if(!isset($_SESSION['shopping_cart']))
    {
        header("Location: menu.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Check out</title>
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
    .nav-item a, .nav-item i,.navbar-toggler{color:antiquewhite;!important;font-size: x-large;}
    .nav-item2 a, .nav-item2 i,.navbar-toggler{color:rgb(175, 89, 27)!important;font-size: x-large;}
    .nav-item a:hover, .nav-item i:hover,.navbar-toggler:hover{color:maroon!important;} 
    a#active,#active i{color:white!important;background-color: rgb(175, 89, 27)!important;border-radius: 0.5rem;}
    a#active:hover,#active i:hover{background-color: maroon!important;}}
    .card{font-size: x-large;}
    .card-header,.card-footer{background-color: antiquewhite;}
    footer a{text-decoration:none;color:rgb(175, 89, 27);font-size:x-large;}
    footer a:hover{color:maroon;}
    .btn:focus{box-shadow: none;}
    .pName{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;width:230px;}
</style>
<body style="font-family: 'Roboto', sans-serif;"> 
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
                        <a class="nav-link px-3" href="message.php">Message</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="btn drowpdown-toggle nav-link px-3" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php" style="color:#4d3f32;">My Profile</a></li>
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
        <div class="container p-5" style="margin-top: 6.5rem;">
            <div class="row">
                <div class="col-lg-8 p-4 m-2 bg-white shadow rounded-3">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>Check Out</h3>
                        <hr>
                        <?php
                            $custid = $_SESSION['CustID'];
                            $cDetails = mysqli_query($connect,"select * from customer where Customer_ID = '$custid'");
                            $row = mysqli_fetch_assoc($cDetails);
                        ?>
                        <div style="background:#4d3f32; color:antiquewhite" class="p-2">
                            <b>Please Transfer Money To The Following Account & Upload Your Online Banking Receipt :</b><br>
                            Maybank<br>
                            0123456789
                        </div>
                        <div class="mt-3">
                            <label for="paymentRecep" class="form-label"><i class="bi bi-bank"></i>&nbsp; Online Banking Receipt</label>
                            <input type="file" name="paymentRecep" id="paymentRecep" class="form-control" accept=".jpg, .png, .jpeg, .pdf" required>
                        </div>
                        <hr>
                        <div class="mt-3 text-center">
                            <button type="submit" name="paymentbtn" class="btn btn-warning" style="background:#4d3f32; color:antiquewhite">Make Payment</button>
                        </div>
                        <hr>
                    </form>
                </div>
                <div class="col-lg m-2 p-4 bg-white shadow rounded-3 align-self-start">
                    <h3>Cart Summary</h3>
                    <hr>
                    <div style="overflow-y:auto;height:320px;">
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
                            }
                        ?>
                        </div>
                    </div>
                    <hr>
                    <h4>Total Amount : RM <?php echo number_format($total,2)?></h4>
                    <hr>
                </div>
            </div>
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
    <div class="bg-light" style="background:url('bg/footer.png');height:150px;"></div>
</body>
</html>
<?php  
    if(isset($_POST["paymentbtn"]))
    {
        $checkid = "select * from orders ORDER BY Order_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Order_ID'];
            $getIDNum = str_replace("T","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $orderID = "T".$getstr;
            

        }
        else
        {
            $orderID = "T0001";

        }

        $date = date("Y/m/d");
        $status = "Pending";


        mysqli_query($connect,"insert into orders(Order_ID,Order_Date,Total_Amount,Order_Status,Customer_ID,Admin_ID) 
        values('$orderID','$date','$total','$status','$custid',null)");

        foreach($_SESSION["shopping_cart"] as $keys =>$values)
        {
            $tCost = $values["prdPrice"];
            $prdReq = $values["prdReq"];
            $prdID = $values["prdID"];

            mysqli_query($connect,"insert into cart(Total_Cost,Product_Requirement,Customer_ID,Product_ID,Order_ID) 
            values('$tCost','$prdReq','$custid','$prdID','$orderID')");
        }

        $checkid = "select * from payment ORDER BY Payment_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Payment_ID'];
            $getIDNum = str_replace("R","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $paymentID = "R".$getstr;
            

        }
        else
        {
            $paymentID = "R0001";

        }

        $file = $paymentID."-".$_FILES['paymentRecep']['name'];
        $file_tmp = $_FILES['paymentRecep']['tmp_name'];
        $folder = "receipt/";

        $new_file_name = strtolower($file);
        $final_file = str_replace(' ','-',$new_file_name);

        move_uploaded_file($file_tmp,$folder.$final_file);

        mysqli_query($connect,"insert into payment(Payment_ID,Payment_Receipt,Order_ID,Customer_ID)
        values('$paymentID','$final_file','$orderID','$custid')");

        $checkid = "select * from invoice ORDER BY Invoice_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Invoice_ID'];
            $getIDNum = str_replace("I","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $invoiceID = "I".$getstr;
            

        }
        else
        {
            $invoiceID = "I0001";

        }

        mysqli_query($connect,"insert into invoice(Invoice_ID,Invoice_Date,Amount_Billed,Payment_ID)
        values('$invoiceID','$date','$total','$paymentID')");
        
        unset($_SESSION['shopping_cart']);
        $_SESSION["orderID"] = $orderID;
?>
        <script>
            alert('Order Sucessful \nYour Order ID Is <?php echo $orderID?>');
            location.href="trackorder.php";
        </script>
<?php
    }
?>
