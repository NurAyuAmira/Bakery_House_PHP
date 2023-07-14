<?php include("dataconnection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bakery House</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
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
    .card{width:100%;}
    .card-img-top {width:100%; height: 400px; object-fit: cover;}
    .btn:focus{box-shadow: none;}
    .navbar{background-color: #B4B8A6;}
    .nav>li>a{color:black;}
    .nav>li>a.active,
    .nav>li>a:hover,
    .nav>li>a:focus {
    background-color: #7a4c21!important;
    color:white;
    }
</style>
    
<body style="font-family: 'Roboto', sans-serif;">
  <nav class="navbar navbar-expand-sm navbar-light fixed-top ">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold;">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="about us.html">ABOUT US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faq.html">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user registration.php">SIGN UP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user login.php">SIGN IN</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid p-0" style="background-color:#4d3f32;">
    <div class="container bg-light px-0 " >
      <img src="bg/landing.png" class="w-100">
      <div class=" text-center p-5 bg-white" >
        <div class="row">
            <div class="col-md-6">
                <a type="button" class="btn btn-warning my-3" style="font-size: x-large; color: white; background-color:#B07C3B;" href="menu.php">Order Now !</a>
                <div class="text-uppercase my-3">
                    <h1 class="display-1 fw-bold" style="color:black;">Bakery House</h1>
                    <h3 style="color:#B07C3B;">We love to bake. Through baking, we connect with our community by creating great  cake, bread and pastry, feeding our family, friends and neighbors, teaching and sharing our craft  and practicing responsibility to the environment. </h3>
                </div>
            </div>
            <div class="col-md-6">
            <div class="container">
                    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
                        <?php
                            $slide=0;
                            $result=mysqli_query($connect,"select * from post");
                            while($row=mysqli_fetch_assoc($result))
                            {     
                                $slide++;
                        ?>
                                <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?php echo $slide?>"></button>
                        <?php
                            }
                        ?>
                        </div>
                        <div class="carousel-inner img-thumbnail text-center">
                            <div class="carousel-item active">
                            <img src="img/welcome.jpeg" class="d-block w-100" style="object-fit: cover;">
                        </div>
                        <?php
                            $result=mysqli_query($connect,"select * from post");
                            while($row=mysqli_fetch_assoc($result))
                            {
                                $img = $row["Post_Picture"];
                        ?>
                                <div class="carousel-item">
                                    <img src="bulletin/<?php echo $img?>" class="d-block w-100" style="object-fit: cover;">
                                </div>
                        <?php
                            }
                        ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="text-center mt-5">
        <h2>MENU</h2>
      </div>
      <hr>
      <div>
          
      <ul class="nav nav-pills m-4 justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#Cake">Cake</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#Bread">Bread</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#Cookies">Cookies</a>
        </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content m-4">
            <div class="tab-pane container active" id="Cake">
                <div class="row">
                    <?php
                        $prdResult = mysqli_query($connect,"select * from product where Product_Type LIKE '%Cake%' ORDER by Product_Price");
                        while($prdRow=mysqli_fetch_assoc($prdResult))
                        {
                    ?>
                            <div class="col-md-4 mt-2">
                                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" class="img-fluid p-1">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $prdRow["Product_Name"]?></h5>
                                                <p class="card-text">RM <?php echo $prdRow["Product_Price"]?></p>
                                                <small class="card-text"><?php echo $prdRow["Product_Ingredients"]?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="tab-pane container fade" id="Bread">
                <div class="row">
                    <?php
                        $prdResult = mysqli_query($connect,"select * from product where Product_Type LIKE '%Bread%' ORDER by Product_Price");
                        while($prdRow=mysqli_fetch_assoc($prdResult))
                        {
                    ?>
                            <div class="col-md-4 mt-2">
                                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" class="img-fluid p-1">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $prdRow["Product_Name"]?></h5>
                                                <p class="card-text">RM <?php echo $prdRow["Product_Price"]?></p>
                                                <small class="card-text"><?php echo $prdRow["Product_Ingredients"]?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="tab-pane container fade" id="Cookies">
                <div class="row">
                    <?php
                        $prdResult = mysqli_query($connect,"select * from product where Product_Type LIKE '%Cookies%' ORDER by Product_Price");
                        while($prdRow=mysqli_fetch_assoc($prdResult))
                        {
                    ?>
                            <div class="col-md-4 mt-2">
                                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="menu/<?php echo $prdRow["Product_Thumbnail"]?>" class="img-fluid p-1">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $prdRow["Product_Name"]?></h5>
                                                <p class="card-text">RM <?php echo $prdRow["Product_Price"]?></p>
                                                <small class="card-text"><?php echo $prdRow["Product_Ingredients"]?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
          
        <!--step-->    
        <div class="text-center p-5 bg-white mt-5">
        <h1 class="display-5 fw-bold">How To Order Food?</h1>
        <div class="row mt-5">
            <div class="col-md mt-2">
                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="guide/step1.png" class="img-fluid p-1">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Step 1</h5>
                          <p class="card-text">Sign Up An Account & Log In</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md mt-2">
                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="guide/step2.png" class="img-fluid p-1">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Step 2</h5>
                          <p class="card-text">Browse The Menu & Order Food</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md mt-2">
                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="guide/step3.png" class="img-fluid p-1">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Step 3</h5>
                          <p class="card-text">Make A Payment</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md mt-2">
                <div class="card mb-3 rounded-3 shadow-sm" style="width:100%; height:100%">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="guide/step4.png" class="img-fluid p-1">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Step 4</h5>
                          <p class="card-text">Pickup Food & Enjoy Your Food!</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>  
        </div>
      </div>
    </div>
  </div>
</body>
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script>
  $(document).ready(function(){
     $(window).scroll(function(){
         $('.navbar').css("opacity", 1 - $(window).scrollTop()/700)
         if($('.navbar').css("opacity") == 0)
         {
            $('.navbar').hide();
         }
         else
         {
             $('.navbar').show();
         }
     })
 })
</script>
</html>
