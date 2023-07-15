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
  <title>Menu</title>
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
     .nav-item2 a, .nav-item2 i,.navbar-toggler{color:#4d3f32;;font-size: x-large;}
    .nav-item a:hover, .nav-item i:hover,.navbar-toggler:hover{color:maroon!important;}
    a#active{color:white!important;background-color: rgb(175, 89, 27)!important;border-radius: 0.5rem;}
    a#active:hover{background-color: maroon!important;}
    h2{color:rgb(175, 89, 27);}
    .card-title{height: 55px;}
    .card-text{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;}
    .card-top{top:0;right:0;position: absolute;}
    .card-img-top {width:100%;object-fit: cover;}
    button{color:rgb(175, 89, 27)!important; text-transform: uppercase;}
    button:hover{color:maroon!important;}
    .form-control:focus {border-color: rgb(255,199,32);box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(255,199,32,0.5);}
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
                <h5 class="text-center">Your Cart Is Empty ..</h5>
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
        <a class="btn btn-warning" href="checkout.php" style="background: #4d3f32; color:white;">Check Out</a>
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
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold; ">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item" >
                        <a class="nav-link px-3" id="active" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3"  href="bulletin.php">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="message.php">Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" data-bs-toggle="offcanvas" data-bs-target="#cart" data-bs-placement="bottom" title="My Cart" id="cartbtn"><i class="bi bi-cart-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="btn drowpdown-toggle nav-link px-3" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php"  style="color:#4d3f32;">My Profile</a></li>
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
            <div class="row">
                <div class="col-lg-2 py-2 bg-white shadow align-self-start">
                    <div class="input-group rounded mt-3">
                        <input type="search" name="searchItem" id="searchItem" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="searchbtn"/>
                        <button type="button" class="input-group-text btn btn-warning"  name="searchbtn" id="searchbtn" data-bs-toggle="modal" data-bs-target="#searchModal" onclick="searchMenu()" style="background:#4d3f32;">
                            <i class="bi bi-search" style="color:antiquewhite;"></i>
                        </button>
                    </div>
                    <div class="modal fade" id="searchModal">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
   
                                <div class="modal-header">
                                    <h4 class="modal-title" id="searchTitle"></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-1" id="searchResult">
                                    <iframe src="" id="iframeSearch" frameborder="0" width="100%" height="560px"></iframe>
                                </div>
 
                            </div>
                        </div>
                    </div>
                    <ul class="nav flex-column fw-bold text-center">
                        <li class="nav-item2">
                            <a class="nav-link" data-bs-toggle="pill" href="#cake">Cake</a>
                        </li>
                        <li class="nav-item2">
                            <a class="nav-link" data-bs-toggle="pill" href="#bread">Bread</a>
                        </li>
                        <li class="nav-item2">
                            <a class="nav-link" data-bs-toggle="pill" href="#cookies">Cookies</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 mt-4">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="cake">
                            <!-------------------------------------------cake------------------------------------------->
                            <h2>Cake</h2>
                            <div class="row">
                            <?php
                           
                            $result = mysqli_query($connect,"select * from product where Product_Type LIKE '%Cake%' order by Product_Status DESC,Product_Price");
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <div class="col-lg-4 mt-4">
                                    <div class="card">
                                        <img class="card-img-top" src="menu/<?php echo $row["Product_Thumbnail"];?>" alt="<?php echo $row["Product_Name"];?>">
                                        <div class="card-top">
                                            <?php
 
                                                $pstatus = $row["Product_Status"];
 
                                                if($pstatus == "New")
                                                {
                                            ?>        
                                                    <h5><span class="badge bg-danger me-2 mt-2">New</span></h5>
                                            <?php
                                                }
                                                else if($pstatus == "Promo")
                                                {
                                            ?>
                                                    <h5><span class="badge bg-success me-2 mt-2">Promo</span></h5>
                                            <?php
                                                }
                                                else if($pstatus == "New,Promo")
                                                {
                                            ?>
                                                    <h5><span class="badge bg-danger me-2 mt-2">New</span><span class="badge bg-success me-2 mt-2">Promo</span></h5>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $row["Product_Name"];?></h4>
                                            <h5>RM <?php echo $row["Product_Price"];?></h5>
                                            <p class="card-text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row["Product_Ingredients"];?>"><?php echo $row["Product_Ingredients"];?></p>
                                            <a type="button" style="background:#4d3f32; color:white;" class="btn btn-warning" href="cart add.php?pid=<?php echo $row["Product_ID"]?>">Order</a>
                                        </div>
                                    </div>
                                </div>
 
                            <?php
 
                            }
 
                            ?>
 
                            </div>
 
 
                        </div>
                        <div class="tab-pane container" id="bread">
                            <!-------------------------------------------bread------------------------------------------->
                            <h2>Bread</h2>
                            <div class="row">
                            <?php
 
                            $result = mysqli_query($connect,"select * from product where Product_Type LIKE '%Bread%' order by Product_Status DESC,Product_Price");
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <div class="col-lg-4 mt-4">
                                    <div class="card">
                                        <img class="card-img-top" src="menu/<?php echo $row["Product_Thumbnail"];?>" alt="<?php echo $row["Product_Name"];?>">
                                        <div class="card-top">
                                            <?php
 
                                                $pstatus = $row["Product_Status"];
 
                                                if($pstatus == "New")
                                                {
                                            ?>        
                                                    <h5><span class="badge bg-danger me-2 mt-2">New</span></h5>
                                            <?php
                                                }
                                                else if($pstatus == "Promo")
                                                {
                                            ?>
                                                    <h5><span class="badge bg-success me-2 mt-2">Promo</span></h5>
                                            <?php
                                                }
                                                else if($pstatus == "New,Promo")
                                                {
                                            ?>
                                                    <h5><span class="badge bg-danger me-2 mt-2">New</span><span class="badge bg-success me-2 mt-2">Promo</span></h5>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $row["Product_Name"];?></h4>
                                            <h5>RM <?php echo $row["Product_Price"];?></h5>
                                            <p class="card-text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row["Product_Ingredients"];?>"><?php echo $row["Product_Ingredients"];?></p>
                                            <a type="button" style="background:#4d3f32; color:white;"class="btn btn-warning" href="cart add.php?pid=<?php echo $row["Product_ID"]?>">Order</a>
                                        </div>
                                    </div>
                                </div>
 
 
                            <?php
 
                            }
 
                            ?>
 
                            </div>
                        </div>
                        <div class="tab-pane container" id="cookies">
                            <!-------------------------------------------cookies------------------------------------------->
                            <h2>Cookies</h2>
                            <div class="row">
                            <?php
 
                            $result = mysqli_query($connect,"select * from product where Product_Type LIKE '%Cookies%' order by Product_Status DESC,Product_Price");
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <div class="col-lg-4 mt-4">
                                    <div class="card">
                                        <img class="card-img-top" src="menu/<?php echo $row["Product_Thumbnail"];?>" alt="<?php echo $row["Product_Name"];?>">
                                        <div class="card-top">
                                            <?php
 
                                                $pstatus = $row["Product_Status"];
 
                                                if($pstatus == "New")
                                                {
                                            ?>        
                                                    <h5><span class="badge bg-danger me-2 mt-2">New</span></h5>
                                            <?php
                                                }
                                                else if($pstatus == "Promo")
                                                {
                                            ?>
                                                    <h5><span class="badge bg-success me-2 mt-2">Promo</span></h5>
                                            <?php
                                                }
                                                else if($pstatus == "New,Promo")
                                                {
                                            ?>
                                                    <h5><span class="badge bg-danger me-2 mt-2">New</span><span class="badge bg-success me-2 mt-2">Promo</span></h5>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $row["Product_Name"];?></h4>
                                            <h5>RM <?php echo $row["Product_Price"];?></h5>
                                            <p class="card-text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row["Product_Ingredients"];?>"><?php echo $row["Product_Ingredients"];?></p>
                                            <a type="button" style="background:#4d3f32; color:white;" class="btn btn-warning" href="cart add.php?pid=<?php echo $row["Product_ID"]?>">Order</a>
                                        </div>
                                    </div>
                                </div>
 
 
                            <?php
 
                            }
 
                            ?>
 
                            </div>
                        </div>
                    </div>
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
    <div class="bg-light" style="background:url('bg/footerbread.png');height:150px;"></div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl)
        {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
 
        function searchMenu()
        {
            var searchItem = document.getElementById('searchItem').value;
       
            document.getElementById('searchTitle').innerHTML = searchItem;
            document.getElementById('iframeSearch').src = "search.php?search=" + searchItem;
        }
    </script>
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
                        location.href="menu.php";
                    </script>
<?php
                }
            }
        }
    }
?>
