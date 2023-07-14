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
  <title>Post</title>
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
                <h5 class="text-center">Your Cart Is Empty...</h5>
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
            <div class="navbar-brand" href="#" style="font-size:xx-large;font-weight: bold; color:antiquewhite; cursor:default;">Bakery House</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold;">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" id="active" href="bulletin.php">POST</a>
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
                                <li><a class="dropdown-item" href="profile.php" style=" color:#4d3f32;">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="user signout.php" style=" color:#4d3f32;">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-light">
        <div class="container px-5" style="padding: 10.5rem 0;">
        <?php
                                
            $result = mysqli_query($connect,"select * from post order by Post_ID DESC");

            if(mysqli_num_rows($result)!=0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
            ?>
                <div class="pt-3 pb-5">
                    <div class="card shadow" style="background-color: antiquewhite;">
                        <div class="d-flex justify-content-between p-2">
                            <div class="d-flex flex-row align-items-center">
                                <img src="img/bakery.png" alt="logo" class="rounded-circle mx-3 " width="50px">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold" id="pname">Bakery House Official</span>
                                    <small class="text-muted"><?php echo $row["Post_Date"]?></small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center bg-white"">
                            <img src="bulletin/<?php echo $row["Post_Picture"]?>" class="w-50">
                        </div>
                        <div class="p-3"><?php echo $row["Post_Details"]?></div>
                        <div class="card-footer">
                            <a class="btn shadow-none" data-bs-toggle="collapse" href="#collapse<?php echo $row["Post_ID"]?>" id="<?php echo $row["Post_ID"]?>" onclick="changeText(this);">
                                    Show All Comments
                            </a>
                            <div id="collapse<?php echo $row["Post_ID"]?>" class="collapse" data-bs-parent="#<?php echo $row["Post_ID"]?>">
                            <?php
                                $postID = $row['Post_ID'];
                                $commResult = mysqli_query($connect,"select * from comment where Post_ID = '$postID'");
                                if(mysqli_num_rows($commResult)!=0)
                                {
                                    while($commRow = mysqli_fetch_assoc($commResult))
                                    {
                                        $custID = $commRow['Customer_ID'];
                                        $custResult = mysqli_query($connect,"select * from customer where Customer_ID = '$custID'");
                                        $custRow = mysqli_fetch_assoc($custResult);
                                        $adminID = $commRow['Admin_ID'];
                                        $adminResult = mysqli_query($connect,"select * from admin where Admin_ID = '$adminID'");
                                        $adminRow = mysqli_fetch_assoc($adminResult);

                                        if($custID != null)
                                        {
                            ?>
                                            <div class="card-body">
                                                <div class="d-flex flex-row "> 
                            <?php
                                            if($custRow["Customer_Gender"]=="male")
                                            {
                            ?>
                                                <img src="bulletin/male.jpg" class="rounded-circle mx-3" width="50px" height="50px">
                            <?php
                                            }
                                            else
                                            {
                            ?>
                                                <img src="bulletin/female.jpg" class="rounded-circle mx-3" width="50px" height="50px">
                            <?php
                                            }
                            ?>                    
                                                    <div class="d-flex flex-column"> 
                                                        <span class="fw-bold"><?php echo $custRow["Customer_First_Name"]." ".$custRow["Customer_Last_Name"]?></span>
                                                        <small><?php echo $commRow["Comment_Details"]?></small>
                                                    </div>
                                                </div>
                                            </div>
                            <?php
                                        }
                                        else
                                        {
                            ?>
                                            <div class="card-body">
                                                <div class="d-flex flex-row "> <img src="img/bakery.png" class="rounded-circle mx-3" width="50px" height="50px">
                                                    <div class="d-flex flex-column"> 
                                                        <span class="fw-bold"><?php echo $adminRow["Admin_First_Name"]." ".$adminRow["Admin_Last_Name"]." (Admin)"?></span>
                                                        <small><?php echo $commRow["Comment_Details"]?></small>
                                                    </div>
                                                </div>
                                            </div>
                            <?php
                                        }
                                    }
                        
                                }
                                else
                                {
                            ?>
                                    <div class="card-body">
                                        <h6 class="text-center">No Comment At This Time.Be The First One To Comment!</h6>
                                    </div>
                            <?php
                                }
                            ?>            
                            </div>
                            <div class="d-flex flex-row py-2">
                                <?php
                                        $cid = $_SESSION['CustID'];
                                        $cDetails = mysqli_query($connect,"select * from customer where Customer_ID = '$cid'");
                                        $cRow = mysqli_fetch_assoc($cDetails);

                                            if($cRow["Customer_Gender"] == "male")
                                            {
                                ?>
                                                <img src="bulletin/male.jpg" class="rounded-circle mx-3" width="50px" height="50px">
                                <?php
                                            }
                                            else
                                            {
                                ?>
                                                <img src="bulletin/female.jpg" class="rounded-circle mx-3" width="50px" height="50px">
                                <?php
                                            }
                                ?>
                                <form action="" method="post" class="d-flex">
                                    <input type="hidden" value="<?php echo $row["Post_ID"]?>" name="postID">
                                    <textarea class="form-control shadow-none" rows="2" cols="200" placeholder="Add A Comment" id="usercomment" name="text" maxlength="1000" required></textarea>
                                    <button type="submit" class="btn btn-warning d-flex flex-column mx-3 shadow-none" name="postbtn" style="font-size: x-large; background: #4d3f32; color:antiquewhite">Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            else
            {
            ?>
                <div class="py-5" style="margin:10rem 0 ;">
                    <h4 class="text-center p-3" style="background:antiquewhite;color:maroon;">No Post At This Time!</h4>
                </div>
            <?php
            }
            ?>
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
        function changeText(n)
        {
            if(n.innerHTML =="Hide All Comments")
                n.innerHTML = "Show All Comments";
            else
                n.innerHTML = "Hide All Comments";
        }
    </script>
</body>
</html>
<?php
    if(isset($_POST['postbtn']))
    {
        $text = $_POST['text'];
        $postID = $_POST['postID'];
        $custID = $_SESSION['CustID'];

        $checkid = "select * from comment ORDER BY Comment_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Comment_ID'];
            $getIDNum = str_replace("F","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $commID = "F".$getstr;
           
 
        }
        else
        {
            $commID = "F0001";
 
        }
 
        mysqli_query($connect, "insert into comment(Comment_ID,Comment_Details,Post_ID,Customer_ID,Admin_ID) 
        values('$commID','$text','$postID','$custID',null)");

?>
    <script>
        alert('Your comments had post');
        location.href="bulletin.php";
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
                        location.href="bulletin.php";
                    </script>
<?php
                }
            }
        }
    }
?>
