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
  <title>Track My Order</title>
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
    .nav-item2 a, .nav-item2 i,.navbar-toggler{color:#4d3f32;!important;font-size: x-large;}
    .nav-item a:hover, .nav-item i:hover,.navbar-toggler:hover{color:maroon!important;} 
    a#active,#active i{color:white!important;background-color: rgb(175, 89, 27)!important;border-radius: 0.5rem;}
    a#active:hover,#active i:hover{background-color: maroon!important;}}
    .card{font-size: x-large;}
    .card-header,.card-footer{background-color: antiquewhite;}
    footer a{text-decoration:none;color:rgb(175, 89, 27);font-size:x-large;}
    footer a:hover{color:maroon;}
    .btn:focus{box-shadow: none;}
    .pName{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;width:230px;}
    .rfstatus{text-decoration:none;}
    .rfstatus:hover{font-style:italic};
</style>
<body style="font-family: 'Roboto', sans-serif;">
    <div class="offcanvas offcanvas-end py-3" id="cart">
        <div class="offcanvas-header">
            <h1><i class="bi bi-cart-fill" style="color:brown"></i>&nbsp;My Cart</h1>
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
                        <a class="nav-link px-3" href="message.php">Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" data-bs-toggle="offcanvas" data-bs-target="#cart" data-bs-placement="bottom" title="My Cart"><i class="bi bi-cart-fill"></i></a>
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
            <div class="p-4 bg-white shadow rounded-3" style="min-height:600px;">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Track My Order</h3>
                    <a href="trackorder.php" class="rfstatus">Refresh Status</a>
                </div>
                <hr>
                <?php
                    if(isset($_SESSION["orderID"]))
                    {
                        $oid = $_SESSION["orderID"];
                        $custID = $_SESSION["CustID"];
                        $result = mysqli_query($connect,"select * from orders where Order_ID = '$oid' and Customer_ID = '$custID'");
                        $row = mysqli_fetch_assoc($result);
                    ?>
                        <label class="form-label"><i class="bi bi-receipt"></i>&nbsp;Your Order ID : </label><br>
                        <form method="post">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" name="searchID"value="<?php echo $oid?>" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" name="searchbtn" class="input-group-text btn btn-warning" id="search-addon" style="background:#4d3f32">
                                    <i class="bi bi-search" style="color:antiquewhite"></i>
                                </button>
                            </div>
                        </form>
                        <hr>
                    <?php
                        if($row>0)
                        {
                ?>
                            <div class="p-1">
                                <div class="d-flex flex-wrap flex-row justify-content-center">

                <?php
                                    if($row["Order_Status"]=="Pending")
                                    {
                ?>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Pending</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pending" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Preparing</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="preparing"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Food's Ready</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="ready"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Picked up</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pickedup"></div>
                                            </div>
                                        </div>
                <?php
                                    }
                                    elseif($row["Order_Status"]=="Preparing")
                                    {
                ?>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Pending</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pending" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Preparing</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="preparing" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Food's Ready</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="ready"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Picked up</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pickedup"></div>
                                            </div>
                                        </div>
                <?php
                                    }
                                    elseif($row["Order_Status"]=="ReadyFood")
                                    {
                ?>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Pending</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pending" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Preparing</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="preparing" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Food's Ready</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="ready" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Picked up</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pickedup"></div>
                                            </div>
                                        </div>
                <?php
                                    }
                                    elseif($row["Order_Status"]=="Pickedup")
                                    {
                ?>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Pending</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pending" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Preparing</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="preparing" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Food's Ready</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="ready" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-fill align-items-center m-2">
                                            <h6>Picked up</h6>
                                            <div class="progress" style="height:10px;width:100%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="pickedup" style="width:100%;height:10px;"></div>
                                            </div>
                                        </div>
                <?php
                                        }
                ?>
                                </div>
                <?php
                                    $aid = $row["Admin_ID"];
                                    if($aid !=NULL)
                                    {
                                        $adminResult = mysqli_query($connect,"select * from admin where Admin_ID LIKE '$aid'");
                                        $adminRow = mysqli_fetch_assoc($adminResult);
                ?>
                                        <div class="mt-3">
                                            <h4>Cashier ID: <br><b><?php echo $adminRow["Admin_ID"]?></b></h4>
                    
                                            <h4>Cashier Name: <br><b><?php echo $adminRow["Admin_First_Name"]." ".$adminRow["Admin_Last_Name"]?></b></h4>
                                        </div>
                                        <hr>
                <?php
                                        $payresult = mysqli_query($connect,"select * from payment where Order_ID = '$oid'");
                                        $payRow = mysqli_fetch_assoc($payresult);
                                        $payID = $payRow["Payment_ID"];
                                        $invoiceResult = mysqli_query($connect,"select * from invoice where Payment_ID = '$payID'");
                                        $invoiceRow = mysqli_fetch_assoc($invoiceResult);
                                        $invoiceID = $invoiceRow["Invoice_ID"];
                ?>
                                        <div class="text-center mt-4"><a class="btn btn-warning" href="invoice.php?Iid=<?php echo $invoiceID ?>" target="_blank" style="color:antiquewhite; background:#4d3f32">INVOICE</a></div>
                <?php
                                    }
                                    else
                                    {
                ?>
                                        <div class="mt-3">
                                            <h4>Order ID: <br><b><?php echo $row["Order_ID"]?></b></h4>
                                    
                                            <h4>Cashier ID: <br><b>-</b></h4>
                    
                                            <h4>Cashier Name: <br><b>-</b></h4>
                                        
                                        </div>
                                        <hr>
                <?php
                                        $payresult = mysqli_query($connect,"select * from payment where Order_ID = '$oid'");
                                        $payRow = mysqli_fetch_assoc($payresult);
                                        $payID = $payRow["Payment_ID"];
                                        $invoiceResult = mysqli_query($connect,"select * from invoice where Payment_ID = '$payID'");
                                        $invoiceRow = mysqli_fetch_assoc($invoiceResult);
                                        $invoiceID = $invoiceRow["Invoice_ID"];
            ?>
                                        <div class="text-center mt-4"><a class="btn btn-warning" href="invoice.php?Iid=<?php echo $invoiceID ?>" target="_blank">INVOICE</a></div>
                <?php
                                    }
                ?>
                                </div>
                <?php
                        }
                        else
                        {
                ?>
                            <div class="p-1 w-100 d-flex justify-content-center align-items-center" style="font-size:x-large;height:300px;">
                                You Don't Have Permission To Access This Order
                            </div>
                <?php
                        }

                        

                    }
                    else
                    {
                ?>
                        <label class="form-label"><i class="bi bi-receipt"></i>&nbsp;Your Order ID : </label><br>
                        <form method="post">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" name="searchID" value="" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="input-group-text btn btn-warning" name="searchbtn" id="search-addon">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="p-1 w-100 d-flex justify-content-center align-items-center" style="font-size:x-large;height:300px;">
                            Enter Your Order ID To Search...
                        </div>
                <?php
                    }
                ?>
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
                        location.href="trackorder.php";
                    </script>
<?php
                }
            }
        }
    }
?>
<?php
    if(isset($_POST["searchbtn"]))
    {
        $_SESSION["orderID"] = $_POST["searchID"];
?>
        <script>
            location.href="trackorder.php";
        </script>
<?php
    }
?>
