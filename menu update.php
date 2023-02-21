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
  <title>Update Menu</title>
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
  <script type="text/javascript">
      function confirmation()
      { 
        var ans = confirm("Do you want to delete this product?");
        return ans;
      }
  </script>    

</head>
<style>
    .nav-item a, .nav-item i{color: white !important;}
    .nav-item a:hover, .nav-item i:hover{color: rgb(189,189,189)!important;}
    a#active{background-color: rgb(66,66,66)!important;border-radius: 0.5rem;}
    a#active:hover{color: white !important;background-color: black!important;}
    .btn:focus{box-shadow: none;}
</style>
<body style="font-family: 'Roboto', sans-serif;">
    <nav class="navbar navbar-expand-lg shadow fixed-top bg-secondary">
        <div class="container-fluid px-3"> 
            <div class="navbar-brand" href="#">
                <img src="img/bakery.png" alt="logo"  width="80px" height="80px">
            </div>
            <div class="navbar-brand text-white" style="font-size:xx-large;font-weight: bold;cursor:default;">Bakery House</div>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="font-size:x-large;font-weight: bold;">
            <ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="admin menu.php" id="active">Menu</a>
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
    <div class="container-fluid bg-white px-4" style="padding-top:7.5rem;">
        <h3 class="text-decoration-underline">Update Product</h3>
        <?php
        if(isset($_GET["pid"]))
        {
            $prdID = $_GET["pid"];
            $result = mysqli_query($connect,"select * from product where Product_ID = '$prdID'");
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="prdName" class="form-label"><i class="bi bi-card-text"></i>&nbsp;Product Name</label>
                <input type="text" name="prdName" id="prdName" class="form-control" value="<?php echo $row['Product_Name'];?>">
            </div>
            <div class="mb-3">
                <label for="prdIngr" class="form-label"><i class="bi bi-egg-fried"></i>&nbsp;Product Ingredients</label>
                <textarea class="form-control" rows="4" name="prdIngr" id="prdIngr"><?php echo $row['Product_Ingredients'];?></textarea>
            </div>
            <div class="mb-3">
                <label for="prdThumb" class="form-label"><i class="bi bi-card-image"></i>&nbsp;Product Picture</label>
                <div class="d-flex align-items-center">
                    <img src="menu/<?php echo $row["Product_Thumbnail"];?>" width="100px" height="100px" class="img-thumbnail" id="imgPrd">
                    <div class="d-flex flex-column ms-3 flex-fill">
                        <p>Update Picture Here ↓</p>
                        <input type="file" name="prdThumb" id="prdPic" class="form-control" onchange="previewFile()" accept=".png, .jpg, .jpeg">
                    </div>
                </div>

                
            </div>
            <div class="mb-3">
                <label for="prdPrice" class="form-label"><i class="bi bi-currency-dollar"></i>&nbsp;Product Price</label>
                <input type="number" step="0.10" min="0" name="prdPrice" id="prdPrice" class="form-control" value="<?php echo $row['Product_Price'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-boxes"></i>&nbsp;Product Type</label><br>
                 <?php 

                        $ptype = $row["Product_Type"];

                        if($ptype == "Cake")
                        {
                    ?>    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Cake" value="Cake" checked>
                            <label class="form-check-label" for="Cake">Cake</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Bread" value="Bread">
                            <label class="form-check-label" for="Bread">Bread</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Cookies" value="Cookies">
                            <label class="form-check-label" for="Cookies">Cookies</label>
                        </div>
                    <?php
                        }
                        else if($ptype == "Bread")
                        {
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Cake" value="Cake">
                            <label class="form-check-label" for="Cake">Cake</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Bread" value="Bread" checked>
                            <label class="form-check-label" for="Bread">Bread</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Cookies" value="Cookies">
                            <label class="form-check-label" for="Cookies">Cookies</label>
                        </div>
                    <?php
                        }
                        else if($ptype == "Cookies")
                        
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Cake" value="Cake">
                            <label class="form-check-label" for="Cake">Cake</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Bread" value="Bread">
                            <label class="form-check-label" for="Bread">Bread</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="prdType[]" id="Cookies" value="Cookies" checked>
                            <label class="form-check-label" for="Cookies">Cookies</label>
                        </div>     
            </div>
            
            <div class="mb-3">
                <label for="prdStatus" class="form-label"><i class="bi bi-award"></i>&nbsp;Product Status</label>
                    <?php 

                        $pstatus = $row["Product_Status"];

                        if($pstatus == "New")
                        {
                    ?>        
                        <select class="form-select" name="prdStatus[]" multiple size="3">
                            <option value="-">------</option>
                            <option value="New" selected>New</option>
                            <option value="Promo">Promo</option>
                        </select>
                    <?php
                        }
                        else if($pstatus == "Promo")
                        {
                    ?>
                        <select class="form-select" name="prdStatus[]" multiple size="3">
                            <option value="-">------</option>
                            <option value="New">New</option>
                            <option value="Promo" selected>Promo</option>
                        </select>
                    <?php
                        }
                        else if($pstatus == "New,Promo")
                        {
                    ?>
                        <select class="form-select" name="prdStatus[]" multiple size="3">
                            <option value="-">------</option>
                            <option value="New" selected>New</option>
                            <option value="Promo" selected>Promo</option>
                        </select>
                    <?php
                        }
                        else if($pstatus =="-")
                        {
                    ?>
                        <select class="form-select" name="prdStatus[]" multiple size="3">
                            <option value="-" selected>------</option>
                            <option value="New">New</option>
                            <option value="Promo">Promo</option>
                        </select>  
                    <?php
                        }
                    ?>
            </div>
            
            <div class="mt-5">
                <button type="submit" name="updatebtn" class="btn btn-success">Update Product</button>
            </div>
        </form>
    </div>
</body>
</html>

<script>
    function previewFile() {
        const preview = document.getElementById('imgPrd');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
    else
    {
        preview.src = "menu/<?php echo $row["Product_Thumbnail"];?>";
    }
}
</script>
<?php
if(isset($_POST["updatebtn"]))
{
    $prdName = $_POST["prdName"];
    $prdIngr = $_POST["prdIngr"];
    $prdType = implode(',',$_POST["prdType"]);
    $prdPrice = $_POST["prdPrice"];
    $prdStatus = implode(',',$_POST["prdStatus"]);
    $prdThumb = $_FILES['prdThumb']['name'];

    if(empty($prdThumb))
    {
        mysqli_query($connect,"update product SET Product_Name = '$prdName',Product_Ingredients = '$prdIngr',Product_Type = '$prdType',Product_Price = '$prdPrice',Product_Status = '$prdStatus' where Product_ID LIKE '$prdID'");
    }
    else
    {
        $filepath = "menu/".$row["Product_Thumbnail"];
        unlink($filepath);

        $file = $prdID."-".$prdThumb;
        $file_tmp = $_FILES['prdThumb']['tmp_name'];
        $folder = "menu/";

        $new_file_name = strtolower($file);
        $final_file = str_replace(' ','-',$new_file_name);

        move_uploaded_file($file_tmp,$folder.$final_file);

        mysqli_query($connect,"update product SET Product_Name = '$prdName',Product_Ingredients = '$prdIngr',Product_Type = '$prdType',Product_Thumbnail ='$final_file',Product_Price = '$prdPrice',Product_Status = '$prdStatus' where Product_ID LIKE '$prdID'");

        
    }
?>
  <script>
        location.href="admin menu.php";
        alert("Product Updated!");
    </script>
<?php
}
?>
