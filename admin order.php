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
  <title>Manage Order - Admin</title>
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
    .pName{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;width:250px;}
    
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
</style>
<body style="font-family: 'Alegreya Sans', sans-serif;">
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
                        <a class="nav-link px-3" href="admin order.php" id="active">Order</a>
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
                <a class="nav-link" data-bs-toggle="pill" href="#task">Task</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#pending">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#view">View</a>
            </li>
        </ul>
        <div class="content">
            <div class="tab-content">
                <div id="task" class="tab-pane active">
                    <h3>Current Task</h3>
                    <div class="container bg-light shadow-sm rounded-3 p-3 mt-3">
                        <?php
                            $adminID = $_SESSION["AdminID"];
                            $result = mysqli_query($connect,"select * from orders where Order_Status LIKE '%Preparing%' or Order_Status LIKE '%ReadyFood%' and Admin_ID = '$adminID'");
                            $row = mysqli_fetch_assoc($result);
                            
                            if($row>0)
                            {
                                $oid = $row["Order_ID"];
                        ?>
                                <div class="row">
                                    <div class="col-lg-6 p-2 border-end">
                                        <h4>Order Status: </h4>
                                        <form class="mb-2" method="post">
                                            <?php
                                                if($row["Order_Status"]=="Preparing")
                                                {
                                            ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="Preparing" name="status" value="Preparing" checked>
                                                        <label for="Preparing" class="form-check-label">Preparing</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="ReadyFood" class="form-check-label">&nbsp; Food's Ready</label>
                                                        <input class="form-check-input" type="radio" id="Ontheway" name="status" value="ReadyFood">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="Picked up" class="form-check-label">&nbsp;Picked up</label>
                                                        <input class="form-check-input" type="radio" id="Picked up" name="status" value="Pickedup">
                                                    </div>
                                            <?php
                                                }
                                                elseif($row["Order_Status"]=="ReadyFood")
                                                {
                                            ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="Preparing" name="status" value="Preparing">
                                                        <label for="Preparing" class="form-check-label">Preparing</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="ReadyFood" class="form-check-label">&nbsp; Food's Ready</label>
                                                        <input class="form-check-input" type="radio" id="Ontheway" name="status" value="ReadyFood" checked>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="Picked up" class="form-check-label">&nbsp;Picked up</label>
                                                        <input class="form-check-input" type="radio" id="Picked up" name="status" value="Pickedup">
                                                    </div>
                                            <?php
                                                }
                                                elseif($row["Order_Status"]=="Pickedup")
                                                {
                                            ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="Preparing" name="status" value="Preparing">
                                                        <label for="Preparing" class="form-check-label">Preparing</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="ReadyFood" class="form-check-label">&nbsp; Food's Ready</label>
                                                        <input class="form-check-input" type="radio" id="Ontheway" name="status" value="ReadyFood">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="Picked up" class="form-check-label">&nbsp;Picked up</label>
                                                        <input class="form-check-input" type="radio" id="Picked up" name="status" value="Pickedup" checked>>
                                                    </div>
                                            <?php
                                                }

                                            ?>
                                            <input type="hidden" name="taskOrder" value="<?php echo $row["Order_ID"]?>"> 
                                            <input type="submit" name="updatebtn" value="Update Status" class="btn btn-success">
                                        </form>
                                        <h4>Order ID: <br><b><?php echo $row["Order_ID"]?></b></h4>
                                        <h4>Order Date:<br> <b><?php echo $row["Order_Date"]?></b></h4>
                                    </div>
                                    <div class="col-lg p-2">
                                        <?php
                                            $custID = $row["Customer_ID"];
                                            $custResult = mysqli_query($connect,"select * from customer where Customer_ID LIKE '$custID'");
                                            $custRow = mysqli_fetch_assoc($custResult);
                                        ?>
                                        <h4>Customer Name: <br><b><?php echo $custRow["Customer_First_Name"]." ".$custRow["Customer_Last_Name"]?></b></h4>
                                        <h4>Customer Tel.: <br><b><?php echo $custRow["Customer_Contact_No"]?></b></h4>
                                        <h4 class="mt-3">Total Amount: <br><b>RM <?php echo $row["Total_Amount"]?></b></h4>
                                        <h3>Cart Summary</h3>
                                        <hr>
                                        <div style="overflow-y:auto;height:380px;" class="bg-white">
                                        <?php
                                             $cartResult = mysqli_query($connect,"select * from cart where Order_ID LIKE '$oid'");
                                             while($cartRow = mysqli_fetch_assoc($cartResult))
                                             {
                                                $prdID = $cartRow["Product_ID"];
                                                $prdResult = mysqli_query($connect,"select * from product where Product_ID LIKE '$prdID'");
                                                $prdRow = mysqli_fetch_assoc($prdResult);
                                        ?>
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" width="70px" height="70px">
                                                        <div class="d-flex flex-column p-1">
                                                            <span class="pName"><?php echo $prdRow["Product_Name"]?></span>
                                                            <span class="" >RM <?php echo $cartRow["Total_Cost"]?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="bg-light"><?php echo $cartRow["Product_Requirement"]?></span>
                                        <?php
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                            else
                            {
                        ?>
                                <div class="text-center" style="font-size:x-large">You Have Not Task At This Time</div>
                        <?php
                            }
                        ?>
                        
                        
                    </div>
                    
                </div>
                <div id="pending" class="tab-pane">
                    <h3>Pending Order</h3>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="Pending">Pending</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Customer Name</th>
                                    <th>Customer Tel.</th>
                                    <th>Cart Summary</th>
                                    <th>Bank Receipt</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                
                                $result = mysqli_query($connect,"select * from orders where Order_Status LIKE '%Pending%'");
                                
                                if(mysqli_num_rows($result)!=0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        $custID = $row["Customer_ID"];
                                        $custResult = mysqli_query($connect,"select * from customer where Customer_ID LIKE '$custID'");
                                        $custRow = mysqli_fetch_assoc($custResult);
                                ?>
                                        <tr>
                                            <th><?php echo $row["Order_ID"]?></th>
                                            <th><?php echo $row["Order_Date"]?></th>
                                            <th>RM <?php echo $row["Total_Amount"]?></th>
                                            <th><?php echo $row["Order_Status"]?></th>
                                            <th><?php echo $custRow["Customer_First_Name"]." ".$custRow["Customer_Last_Name"]?></th>
                                            <th><?php echo $custRow["Customer_Contact_No"]?></th>
                                            <th>
                                                <div style="overflow-y:auto;height:250px;" class="bg-white">
                                <?php
                                                $orderID = $row["Order_ID"];
                                                $cartResult = mysqli_query($connect,"select * from cart where Order_ID LIKE '$orderID'");
                                                while($cartRow = mysqli_fetch_assoc($cartResult))
                                                {
                                                    $prdID = $cartRow["Product_ID"];
                                                    $prdResult = mysqli_query($connect,"select * from product where Product_ID LIKE '$prdID'");
                                                    $prdRow = mysqli_fetch_assoc($prdResult);

                                ?>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex flex-row align-items-center">

                                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" width="70px" height="70px">
                                                            <div class="d-flex flex-column p-1">
                                                                <span class="pName"><?php echo $prdRow["Product_Name"]?></span>
                                                                <span class="" >RM <?php echo $cartRow["Total_Cost"]?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="bg-light"><?php echo $cartRow["Product_Requirement"]?></span>
                                <?php
                                                }
                                ?>
                                                </div>
                                            </th>
                                <?php

                                            $paymentResult = mysqli_query($connect,"select * from payment where Order_ID LIKE '$orderID'");
                                            $paymentRow = mysqli_fetch_assoc($paymentResult);
                                ?>
                                            <th><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pdreceiptModal" value="<?php echo $paymentRow["Payment_Receipt"]?>" onclick="viewReceipt(this);">RECEIPT</button></th>
                                            <th>
                                <?php
                                    $cOrder = mysqli_query($connect,"select * from orders where Order_Status LIKE '%Preparing%' or Order_Status LIKE '%ReadyFood%' and Admin_ID = '$adminID'");
                                    $crow = mysqli_fetch_assoc($cOrder);
                                        if($crow>0)
                                        {
                                ?>
                                            <a type="button" class="btn btn-primary m-1 disabled" href="admin order.php?action=accept&oid=<?php echo $orderID?>">Accept</a>
                                <?php
                                        }
                                        else
                                        {
                                ?>
                                            <a type="button" class="btn btn-primary m-1" href="admin order.php?action=accept&oid=<?php echo $orderID?>">Accept</a>
                                <?php
                                        }
                                ?>
                                            </th>   
                                            
                                        </tr>
                                <?php
                                    }
                                }
                                else
                                {
                                ?>
                                    <tr>
                                        <td colspan="10">No Pending Order At This Time</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- The Modal -->
                    <div class="modal" id="pdreceiptModal">
                        <div class="modal-dialog modal-fullscreen ">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <iframe src="" id="pdreceiptFile" width="100%" height="100%"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->
                    </div>
                </div>
                <div id="view" class="tab-pane">
                    <div class="d-flex justify-content-between">
                        <h3>View Order</h3>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-boxes"></i>&nbsp;Status</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#preparing">Preparing</a></li>
                                <li><a class="dropdown-item" href="#ready">Ready Food</a></li>
                                <li><a class="dropdown-item" href="#pickedup">Picked up</a></li>
                            </ul>
                        </div>  
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="preparing">Preparing</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Customer Name</th>
                                    <th>Customer Tel.</th>
                                    <th>Cart Summary</th>
                                    <th>Bank Receipt</th>
                                    <th>Manager By (Admin ID)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $result = mysqli_query($connect,"select * from orders where Order_Status LIKE '%Preparing%'");
                                    
                                    if(mysqli_num_rows($result)!=0)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $custID = $row["Customer_ID"];
                                            $custResult = mysqli_query($connect,"select * from customer where Customer_ID LIKE '$custID'");
                                            $custRow = mysqli_fetch_assoc($custResult);
                                ?>
                                            <tr>
                                                <th><?php echo $row["Order_ID"]?></th>
                                                <th><?php echo $row["Order_Date"]?></th>
                                                <th>RM <?php echo $row["Total_Amount"]?></th>
                                                <th><?php echo $row["Order_Status"]?></th>
                                                <th><?php echo $custRow["Customer_First_Name"]." ".$custRow["Customer_Last_Name"]?></th>
                                                <th><?php echo $custRow["Customer_Contact_No"]?></th>
                                                <th>
                                                    <div style="overflow-y:auto;height:250px;" class="bg-white">
                                <?php
                                                $orderID = $row["Order_ID"];
                                                $cartResult = mysqli_query($connect,"select * from cart where Order_ID LIKE '$orderID'");
                                                while($cartRow = mysqli_fetch_assoc($cartResult))
                                                {
                                                    $prdID = $cartRow["Product_ID"];
                                                    $prdResult = mysqli_query($connect,"select * from product where Product_ID LIKE '$prdID'");
                                                    $prdRow = mysqli_fetch_assoc($prdResult);

                                ?>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex flex-row align-items-center">

                                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" width="70px" height="70px">
                                                            <div class="d-flex flex-column p-1">
                                                                <span class="pName"><?php echo $prdRow["Product_Name"]?></span>
                                                                <span class="" >RM <?php echo $cartRow["Total_Cost"]?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="bg-light"><?php echo $cartRow["Product_Requirement"]?></span>
                                <?php
                                                }
                                ?>
                                                </th>
                                <?php

                                                $paymentResult = mysqli_query($connect,"select * from payment where Order_ID LIKE '$orderID'");
                                                $paymentRow = mysqli_fetch_assoc($paymentResult);
                                ?>
                                                <th><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewreceiptModal" value="<?php echo $paymentRow["Payment_Receipt"]?>" onclick="viewReceipt(this);">RECEIPT</button></th>
                                                <th><?php echo $row["Admin_ID"]?></th> 
                                            </tr>
                                <?php
                                        }
                                    }
                                    else
                                {
                                ?>
                                    <tr>
                                        <td colspan="10">No Preparing Order At This Time</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="ready">Food's Ready</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Customer Name</th>
                                    <th>Customer Tel.</th>
                                    <th>Cart Summary</th>
                                    <th>Bank Receipt</th>
                                    <th>Manager By (Admin ID)</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $result = mysqli_query($connect,"select * from orders where Order_Status LIKE '%ReadyFood%'");
                                    
                                    if(mysqli_num_rows($result)!=0)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $custID = $row["Customer_ID"];
                                            $custResult = mysqli_query($connect,"select * from customer where Customer_ID LIKE '$custID'");
                                            $custRow = mysqli_fetch_assoc($custResult);
                                ?>
                                            <tr>
                                                <th><?php echo $row["Order_ID"]?></th>
                                                <th><?php echo $row["Order_Date"]?></th>
                                                <th>RM <?php echo $row["Total_Amount"]?></th>
                                                <th><?php echo $row["Order_Status"]?></th>
                                                <th><?php echo $custRow["Customer_First_Name"]." ".$custRow["Customer_Last_Name"]?></th>
                                                <th><?php echo $custRow["Customer_Contact_No"]?></th>
                                                <th>
                                                    <div style="overflow-y:auto;height:250px;" class="bg-white">
                                <?php
                                                $orderID = $row["Order_ID"];
                                                $cartResult = mysqli_query($connect,"select * from cart where Order_ID LIKE '$orderID'");
                                                while($cartRow = mysqli_fetch_assoc($cartResult))
                                                {
                                                    $prdID = $cartRow["Product_ID"];
                                                    $prdResult = mysqli_query($connect,"select * from product where Product_ID LIKE '$prdID'");
                                                    $prdRow = mysqli_fetch_assoc($prdResult);

                                ?>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex flex-row align-items-center">

                                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" width="70px" height="70px">
                                                            <div class="d-flex flex-column p-1">
                                                                <span class="pName"><?php echo $prdRow["Product_Name"]?></span>
                                                                <span class="" >RM <?php echo $cartRow["Total_Cost"]?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="bg-light"><?php echo $cartRow["Product_Requirement"]?></span>
                                <?php
                                                }
                                ?>
                                                </th>
                                <?php

                                                $paymentResult = mysqli_query($connect,"select * from payment where Order_ID LIKE '$orderID'");
                                                $paymentRow = mysqli_fetch_assoc($paymentResult);
                                ?>
                                                <th><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewreceiptModal" value="<?php echo $paymentRow["Payment_Receipt"]?>" onclick="viewReceipt(this);">RECEIPT</button></th>
                                                <th><?php echo $row["Admin_ID"]?></th> 
                                            </tr>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                    <tr>
                                        <td colspan="10">No Food's Ready At This Time</td>
                                    </tr>
                                <?php
                                     }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="pickedup">Picked Up</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Customer Name</th>
                                    <th>Customer Tel.</th>
                                    <th>Cart Summary</th>
                                    <th>Bank Receipt</th>
                                    <th>Manager By (Admin ID)</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $currentDate = date("Y/m/d");
                                    $result = mysqli_query($connect,"select * from orders where Order_Status LIKE '%Pickedup%' and Order_Date = '$currentDate'");
                                    
                                    if(mysqli_num_rows($result)!=0)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $custID = $row["Customer_ID"];
                                            $custResult = mysqli_query($connect,"select * from customer where Customer_ID LIKE '$custID'");
                                            $custRow = mysqli_fetch_assoc($custResult);
                                ?>
                                            <tr>
                                                <th><?php echo $row["Order_ID"]?></th>
                                                <th><?php echo $row["Order_Date"]?></th>
                                                <th>RM <?php echo $row["Total_Amount"]?></th>
                                                <th><?php echo $row["Order_Status"]?></th>
                                                <th><?php echo $custRow["Customer_First_Name"]." ".$custRow["Customer_Last_Name"]?></th>
                                                <th><?php echo $custRow["Customer_Contact_No"]?></th>
                                                <th>
                                                    <div style="overflow-y:auto;height:250px;" class="bg-white">
                                <?php
                                                $orderID = $row["Order_ID"];
                                                $cartResult = mysqli_query($connect,"select * from cart where Order_ID LIKE '$orderID'");
                                                while($cartRow = mysqli_fetch_assoc($cartResult))
                                                {
                                                    $prdID = $cartRow["Product_ID"];
                                                    $prdResult = mysqli_query($connect,"select * from product where Product_ID LIKE '$prdID'");
                                                    $prdRow = mysqli_fetch_assoc($prdResult);

                                ?>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex flex-row align-items-center">

                                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" width="70px" height="70px">
                                                            <div class="d-flex flex-column p-1">
                                                                <span class="pName"><?php echo $prdRow["Product_Name"]?></span>
                                                                <span class="" >RM <?php echo $cartRow["Total_Cost"]?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="bg-light"><?php echo $cartRow["Product_Requirement"]?></span>
                                <?php
                                                }
                                ?>
                                                </th>
                                <?php

                                                $paymentResult = mysqli_query($connect,"select * from payment where Order_ID LIKE '$orderID'");
                                                $paymentRow = mysqli_fetch_assoc($paymentResult);
                                ?>
                                                <th><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewreceiptModal" value="<?php echo $paymentRow["Payment_Receipt"]?>" onclick="viewReceipt(this);">RECEIPT</button></th>
                                                <th><?php echo $row["Admin_ID"]?></th> 
                                            </tr>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                    <tr>
                                        <td colspan="10">No Picked Up Order At This Time</td>
                                    </tr>
                                <?php
                                     }
                                ?>
                            </tbody>
                        </table>
                        <!-- The Modal -->
                        <div class="modal" id="viewreceiptModal">
                            <div class="modal-dialog modal-fullscreen ">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <iframe src="" id="viewreceiptFile" width="100%" height="100%"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function viewReceipt(n)
    {
        document.getElementById("pdreceiptFile").src = "receipt/" + n.value;
        document.getElementById("viewreceiptFile").src = "receipt/" + n.value;
    }
</script>
</html>
<?php
    if(isset($_GET["action"]))
    {
        if($_GET["action"]=="accept")
        {
            $orderID = $_GET["oid"];
            $status = "Preparing";
            $adminID = $_SESSION['AdminID'];
            
            mysqli_query($connect,"update orders SET Order_Status='$status', Admin_ID='$adminID' where Order_ID LIKE '$orderID'");
?>
            <script>
                alert('Accept Work Sucessful...\nPlease Start Your Work')
                location.href="admin order.php";
            </script>
<?php
        }
    }
?>
<?php
    if(isset($_POST["updatebtn"]))
    {
        $orderStatus = $_POST["status"];
        $orderID = $_POST["taskOrder"];
        
        mysqli_query($connect,"update orders SET Order_Status='$orderStatus' where Order_ID LIKE '$orderID'");

        if($orderStatus=="Pickedup")
        {
?>
            <script>
                alert('Status Updated! Task Completed');
            </script>
<?php
        }
        else
        {
?>
            <script>
                alert('Status Updated!');
            </script>
<?php
        }
?>
            <script>
                location.href="admin order.php";
            </script>
<?php
            
    }
?>
        
