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
  <title>Manage Menu - Admin</title>
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
    .nav-item a, .nav-item i{color: white!important;}
    .nav-item a:hover, .nav-item i:hover{color: rgb(189,189,189)!important;}
    a#active{background-color: rgb(66,66,66)!important;border-radius: 0.5rem;}
    a#active:hover{color: white !important;background-color: black!important;}
    .btn:focus{box-shadow: none;}
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
    <div class="container-fluid bg-white" style="padding-top: 6.5rem;">
        <ul class="nav sidebar bg-light shadow" role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#manage">Manage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#add">Add</a>
            </li>
        </ul>
        <div class="content">
            <div class="tab-content">
                <div id="manage" class="tab-pane active">
                    <div class="d-flex justify-content-between">
                        <h3>Manage Product</h3>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-boxes"></i>&nbsp;Type:</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#typeCake">Cake</a></li>
                                <li><a class="dropdown-item" href="#typeBread">Bread</a></li>
                                <li><a class="dropdown-item" href="#typeCookies">Cookies</a></li>
                            </ul>
                        </div>  
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="typeCake">CAKE</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Ingredients</th>
                                    <th>Price(RM)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $result = mysqli_query($connect,"select * from product where Product_Type LIKE '%Cake%'");

                                if(mysqli_num_rows($result)!=0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {

                                ?>
                                    
                                    <tr>
                                        <td><?php echo $row["Product_ID"];?></td>
                                        <td><img src="menu/<?php echo $row["Product_Thumbnail"];?>" width="100px" height="100px"></td>
                                        <td><?php echo $row["Product_Name"];?></td>
                                        <td><?php echo $row["Product_Type"];?></td>
                                        <td><?php echo $row["Product_Ingredients"];?></td>
                                        <td><?php echo $row["Product_Price"];?></td>
                                        <td><?php echo $row["Product_Status"];?></td>
                                        <td>
                                            <i class='bx bxs-edit-alt'></i>
                                            <a type="button" class="btn btn-primary m-1" href="menu update.php?pid=<?php echo $row["Product_ID"]?>">Edit</a>
                                            <a type="button" class="btn btn-danger m-1" href="admin menu.php?pid=<?php echo $row["Product_ID"]?>" onclick="return confirmation();">Delete</a>
                                        </td>
                                    </tr>

                                <?php
                                    }
                                
                                }
                                else
                                {
                                ?>
                                    <tr>
                                        <td colspan="8">Please Add Relevant Product</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="typeBread">BREAD</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Ingredients</th>
                                    <th>Price(RM)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $result = mysqli_query($connect,"select * from product where Product_Type LIKE '%Bread%'");

                                if(mysqli_num_rows($result)!=0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {

                                ?>
                                    
                                    <tr>
                                        <td><?php echo $row["Product_ID"];?></td>
                                        <td><img src="menu/<?php echo $row["Product_Thumbnail"];?>" width="100px" height="100px"></td>
                                        <td><?php echo $row["Product_Name"];?></td>
                                        <td><?php echo $row["Product_Type"];?></td>
                                        <td><?php echo $row["Product_Ingredients"];?></td>
                                        <td><?php echo $row["Product_Price"];?></td>
                                        <td><?php echo $row["Product_Status"];?></td>
                                        <td>
                                        <a type="button" class="btn btn-primary m-1" href="menu update.php?pid=<?php echo $row["Product_ID"]?>">Edit</a>
                                            <a type="button" class="btn btn-danger m-1" href="admin menu.php?pid=<?php echo $row["Product_ID"]?>" onclick="return confirmation();">Delete</a>
                                        </td>
                                    </tr>

                                <?php
                                    }
                                
                                }
                                else
                                {
                                ?>
                                    <tr>
                                        <td colspan="8">Please Add Relevant Product</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="typeCookies">COOKIES</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Ingredients</th>
                                    <th>Price(RM)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 

                                $result = mysqli_query($connect,"select * from product where Product_Type LIKE '%Cookies%'");

                                if(mysqli_num_rows($result)!=0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {

                                ?>
                                    
                                    <tr>
                                        <td><?php echo $row["Product_ID"];?></td>
                                        <td><img src="menu/<?php echo $row["Product_Thumbnail"];?>" width="100px" height="100px"></td>
                                        <td><?php echo $row["Product_Name"];?></td>
                                        <td><?php echo $row["Product_Type"];?></td>
                                        <td><?php echo $row["Product_Ingredients"];?></td>
                                        <td><?php echo $row["Product_Price"];?></td>
                                        <td><?php echo $row["Product_Status"];?></td>
                                        <td>
                                            <a type="button" class="btn btn-primary m-1" href="menu update.php?pid=<?php echo $row["Product_ID"]?>">Edit</a>
                                            <a type="button" class="btn btn-danger m-1" href="admin menu.php?pid=<?php echo $row["Product_ID"]?>" onclick="return confirmation();">Delete</a>
                                        </td>
                                    </tr>

                                <?php
                                    }

                                }
                                else
                                {
                                ?>
                                    <tr>
                                        <td colspan="8">Please Add Relevant Product</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-----------------------------------add----------------------------------->
                <div id="add" class="tab-pane">
                    <h3>Add Product</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="prdName" class="form-label"><i class="bi bi-card-text"></i>&nbsp;Product Name</label>
                            <input type="text" name="prdName" id="prdName" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="prdIngr" class="form-label"><i class="bi bi-egg-fried"></i>&nbsp;Product Ingredients</label>
                            <textarea class="form-control" rows="4" name="prdIngr" id="prdIngr"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prdThumb" class="form-label"><i class="bi bi-card-image"></i>&nbsp;Product Picture</label>
                            <input type="file" name="prdThumb" id="prdPic" class="form-control" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="prdPrice" class="form-label"><i class="bi bi-currency-dollar"></i>&nbsp;Product Price</label>
                            <input type="number" step="0.10" min="0" name="prdPrice" id="prdPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-boxes"></i>&nbsp;Product Type</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="prdType[]" id="Cake" value="Cake">
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
                            
                        </div>
                        <div class="mb-3">
                            <label for="prdStatus" class="form-label"><i class="bi bi-award"></i>&nbsp;Product Status</label>
                            <select class="form-select" name="prdStatus[]" multiple size="3" multiple>
                                <option value="-">------</option>
                                <option value="New">New</option>
                                <option value="Promo">Promo</option>
                            </select>
                        </div>
                        <div class="mt-5">
                            <button type="submit" name="savebtn" class="btn btn-success">Add Product</button>
                            <button type="reset" class="btn btn-warning text-white ms-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST["savebtn"]))
{
    //$prdID = $_POST["prdID"];
    $prdName = $_POST["prdName"];
    $prdIngr = $_POST["prdIngr"];
    $prdType = implode(',',$_POST["prdType"]);
    $prdPrice = $_POST["prdPrice"];
    $prdStatus = implode(',',$_POST["prdStatus"]);

        $checkid = "select * from product ORDER BY Product_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Product_ID'];
            $getIDNum = str_replace("P","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $prdID = "P".$getstr;
            

        }
        else
        {
            $prdID = "P0001";

        }
            $file = $prdID."-".$_FILES['prdThumb']['name'];
            $file_tmp = $_FILES['prdThumb']['tmp_name'];
            $folder = "menu/";

            $new_file_name = strtolower($file);
            $final_file = str_replace(' ','-',$new_file_name);

            move_uploaded_file($file_tmp,$folder.$final_file);

            mysqli_query($connect,"insert into product(Product_ID,Product_Name,Product_Ingredients,Product_Type,Product_Thumbnail,Product_Price,Product_Status)
            values('$prdID','$prdName','$prdIngr','$prdType','$final_file','$prdPrice','$prdStatus')");
?>
            <script>
                alert("Product saved!");
                location.href="admin menu.php";
            </script>

<?php   


}

?>


<?php

if(isset($_REQUEST["pid"]))
{
    $prdID = $_REQUEST["pid"];
    $result = mysqli_query($connect,"select * from product where Product_ID LIKE '$prdID'");
    $row = mysqli_fetch_assoc($result);
    $filepath = "menu/".$row["Product_Thumbnail"];
    unlink($filepath);

    mysqli_query($connect,"delete from Product where Product_ID LIKE '$prdID'");

?>
    <script>
        alert('Product Deleted');
        location.href="admin menu.php";
    </script>
<?php
}

?>
