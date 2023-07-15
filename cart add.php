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
  <title>Cart</title>
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
      .nav-item2 a, .nav-item2 i,.navbar-toggler{color:#4d3f32;;font-size: x-large;}
    .nav-item a:hover, .nav-item i:hover,.navbar-toggler:hover{color:maroon!important;} 
    a#active,#active i{color:white!important;background-color: rgb(175, 89, 27)!important;border-radius: 0.5rem;}
    a#active:hover,#active i:hover{background-color: maroon!important;}
    footer a{text-decoration:none;color:rgb(175, 89, 27);font-size:x-large;}
    footer a:hover{color:maroon;}
    .btn:focus{box-shadow: none;}
    .form-control:focus{box-shadow:none;border-color:grey;}
    .img-select{border:2px solid antiquewhite;width:200px;}
    .img-select:hover{border-width:5px;}
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
                <h5 class="text-center">Your Cart is Empty ..</h5>
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
        <a class="btn btn-warning" href="checkout.php" style="background:#4d3f32; color:white;">Check Out</a>
    </div>
    <nav class="navbar navbar-expand-lg shadow fixed-top" style="background: #4d3f32;">
        <div class="container-fluid px-3">  
            <div class="navbar-brand" href="#">
                <img src="img/bakery.png" alt="logo"  width="80px" height="80px">
            </div>
            <div class="navbar-brand" href="#" style="font-size:xx-large;font-weight: bold; color:antiquewhite;cursor:default; ">Bakery House</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold;">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link px-3" id="active" href="menu.php">Menu</a>
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
                                <li><a class="dropdown-item" href="profile.php" style="color:#4d3f32; ">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="user signout.php" style="color:#4d3f32; ">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-light ">
        <div class="container px-5" style="padding: 10.5rem 0;">
            <?php
            if(isset($_GET["pid"]))
            {
                $prdID = $_GET["pid"];
                $result = mysqli_query($connect,"select * from product where Product_ID = '$prdID'");
                $row = mysqli_fetch_assoc($result);
            }
            ?>
            <div class="p-4 bg-white shadow-sm rounded-3">
                <div class="d-flex flex-row align-items-center justify-content-center">
                    <img src="menu/<?php echo $row["Product_Thumbnail"];?>" width="100px" height="100px" class="img-thumbnail">
                    <div class="px-3" style="font-size:x-large"><?php echo $row['Product_Name'];?></div>
                </div>
                <hr>
                <div class="d-flex justify-content-between" style="font-size:large;">
                    <span>Original Price :</span>
                    <div>
                        RM <?php echo $row['Product_Price'];?> 
                    </div>
                </div>
                <hr>
                <form action="" method="post" onsubmit="checkForm();">
                    <input type="hidden" id="prdPrice" name="prdPrice" value="<?php echo $row['Product_Price']?>">
                <?php
                    $ptype = $row["Product_Type"];
                    if($ptype == "Cake" || $ptype == "Bread" || $ptype == "Cookies" )
                    {
                    ?>
                        <div class="mt-3" style="font-size:large"><i class="bi bi-cup-straw" style="color:brown"></i>&nbsp;Drink :</div><br>
                        <div class="d-flex justify-content-center flex-wrap">
                            <div class="d-flex flex-column align-items-center">
                                <label for="100plus"><img src="menu/requirement/100 plus.png" class="img-thumbnail img-select m-1"></label>
                                <input type="radio" class="radio-select" id="100plus" value="100plus" name="drink" onchange="checkDrink(this)" required>
                                <div>100 Plus</div>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <label for="cocacola"><img src="menu/requirement/cocacola.png"  class="img-thumbnail img-select m-1"></label>
                                <input type="radio" class="radio-select" id="cocacola" value="cocacola" name="drink" onchange="checkDrink(this)" required>
                                <div>Coca-cola</div>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <label for="sprite"><img src="menu/requirement/sprite.png"  class="img-thumbnail img-select m-1"></label>
                                <input type="radio" class="radio-select" id="sprite" value="sprite" name="drink" onchange="checkDrink(this)" required>
                                <div>Sprite</div>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <label for="fanta"><img src="menu/requirement/fanta.png"  class="img-thumbnail img-select m-1"></label>
                                <input type="radio" class="radio-select" id="fanta" value="fanta" name="drink" onchange="checkDrink(this)" required>
                                <div>Fanta (+RM 3.00)</div>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <label for="liptontea"><img src="menu/requirement/lipton tea.png"  class="img-thumbnail img-select m-1"></label>
                                <input type="radio" class="radio-select" id="liptontea" value="liptontea" name="drink" onchange="checkDrink(this)" required>
                                <div>Lipton Tea (+RM 3.00)</div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-3" style="font-size:large"><i class="bi bi-cup-straw" style="color:brown"></i>&nbsp;Drink Size:</div><br>
                        <div class="d-flex justify-content-center flex-wrap">
                            <div class="d-flex flex-column align-items-center px-2">
                                <input type="radio" class="radio-select" id="normal" value="normal" name="drinksize" onchange="checkDrinkSize(this)" required>
                                <label for="normal">Normal</label>
                            </div>
                            <div class="d-flex flex-column align-items-center px-2">
                                <input type="radio" class="radio-select" id="large" value="large" name="drinksize" onchange="checkDrinkSize(this)" required>
                                <label for="large">Large (+RM 1.50)</label>
                            </div>
                            <div class="d-flex flex-column align-items-center px-2">
                                <input type="radio" class="radio-select" id="extralarge" value="extraLarge" name="drinksize" onchange="checkDrinkSize(this)" required>
                                <label for="extralarge">Extra Large (+RM 2.00)</label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <hr>
                    <input type="hidden" id="tPrice" name="tPrice" value="">
                    <input type="hidden" id="tReq" name="tReq" value="">
                    <div class="d-flex justify-content-between" style="font-size:large;">
                        <span>Total Price :</span>
                        <div id="totalPrice">
                            RM <?php echo $row['Product_Price'];?> 
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" name="addtocartbtn" class="btn btn-warning" style="background-color:#4d3f32; color:white;">Add To Cart</button>
                    </div>
                </form>
                
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
        var drinkReq="";
        var drinkSizeReq="";
        var totalReq = document.getElementById('tReq');
        var drinkExtra=0;
        var drinkSizeExtra=0;
        var totalPrice = document.getElementById('tPrice');
        var totalPriceDisplay = document.getElementById('totalPrice');
        var prdPrice = parseFloat(document.getElementById('prdPrice').value);
        var total=0.0;
       
        function calcTotal()
        {
            total = prdPrice + drinkExtra + drinkSizeExtra ;
            totalPriceDisplay.innerHTML = "RM " + total.toFixed(2);
        }

        function checkDrink(drink)
        {
            drinkExtra=0;

            if(drink.value=="100plus")
                drinkReq = "-100Plus<br>";
            else if(drink.value=="cocacola")
                drinkReq = "-Coca-Cola<br>";
            else if(drink.value=="sprite")
                drinkReq = "-Sprite<br>";
            else if(drink.value=="fanta")
            {
                drinkReq = "-Fanta (+RM 3.00)<br>";
                drinkExtra = 3.00;
            }
            else if(drink.value=="liptontea")
            {
                drinkReq = "-Lipton Tea (+RM 3.00)<br>";
                drinkExtra = 3.00;
            }
            
            calcTotal();
                
        }

        function checkDrinkSize(drinksize)
        {
            drinkSizeExtra=0;

            if(drinksize.value=="normal")
                drinkSizeReq = "-Normal<br>";
            else if(drinksize.value=="large")
            {
                drinkSizeReq = "-Large (+RM 1.50)<br>";
                drinkSizeExtra = 1.50;
            }
            else if(drinksize.value=="extraLarge")
            {
                drinkSizeReq = "-Extra Large (+RM 2.00)<br>"
                drinkSizeExtra = 2.00;
            }

            calcTotal();
        }
        

        function checkForm()
        {
            totalReq.value = drinkReq + drinkSizeReq ;
            totalPrice.value = total.toFixed(2);
        }
        
    </script>
</body>
</html>
<?php
    if(isset($_POST['addtocartbtn']))
    {
        if(isset($_SESSION["shopping_cart"]))
        {
            $_SESSION["count"] = $_SESSION["count"]+1;
            $prd_array = array(
                'prdID'     => $_GET["pid"],
                'prdPrice'  => $_POST["tPrice"],
                'prdReq'    => $_POST["tReq"],
                'cartID'    => $_SESSION["count"]
            );
            $_SESSION["shopping_cart"][$_SESSION["count"]] = $prd_array;
?>
            <script>
                alert("Product Added To Cart Successful!");
                location.href="menu.php";
            </script>
<?php
        }
        else
        {
            $_SESSION["count"] = 0;
            $prd_array = array(
                'prdID'     => $_GET["pid"],
                'prdPrice'  => $_POST["tPrice"],
                'prdReq'    => $_POST["tReq"],
                'cartID'    => $_SESSION["count"]
            );
            $_SESSION["shopping_cart"][$_SESSION["count"]] = $prd_array;


?>
            <script>
                alert("Product Added To Cart Successful!");
                location.href="menu.php";
            </script>
<?php
        }
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
                        location.href="card add.php";
                    </script>
<?php
                }
            }
        }
    }
?>
