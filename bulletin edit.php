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
  <title>Edit Post</title>
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
                        <a class="nav-link px-3" href="admin bulletin.php" id="active">Post</a>
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
    <div class="container-fluid bg-white px-4" style="padding-top: 7.5rem;">
        <h3 class="text-decoration-underline">Edit Post</h3>
        <?php
        if(isset($_GET["pid"]))
        {
            $postID = $_GET["pid"];
            $result = mysqli_query($connect,"select * from post where Post_ID = '$postID'");
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="postImg" class="form-label"><i class="bi bi-card-image"></i>&nbsp;Post Picture</label>
                <div class="d-flex align-items-center">
                    <img src="bulletin/<?php echo $row["Post_Picture"]?>" width="100px" height="100px" class="img-thumbnail" id="imgPost">
                    <div class="d-flex flex-column ms-3 flex-fill">
                        <p>Update Picture Here ↓</p>
                        <input type="file" name="postImg" id="postPic" class="form-control" onchange="previewFile()">
                    </div>
                </div>
                
            </div>
            <div class="mb-3">
                <label for="postDetail" class="form-label"><i class="bi bi-card-text"></i>&nbsp;Post Detail</label>
                <textarea name="postDetail" id="postDetail" class="form-control" rows="6" required><?php echo $row["Post_Details"]?></textarea>
            </div>
            <div class="mt-5">
                <button type="submit" name="editbtn" class="btn btn-success">Edit Post</button>
            </div>
        </form>
    </div>
</body>
</html>
<script>
    function previewFile() {
        const preview = document.getElementById('imgPost');
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
        preview.src = "bulletin/<?php echo $row["Post_Picture"];?>";
    }
}
</script>
<?php
if(isset($_POST["editbtn"]))
{
    $postDetail = $_POST["postDetail"];
    $postImg = $_FILES['postImg']['name'];
    $adminID = $_SESSION["AdminID"];

    if(empty($postImg))
    {
        mysqli_query($connect,"update post SET Post_Details = '$postDetail', Admin_ID = '$adminID' where Post_ID LIKE '$postID'");
    }
    else
    {
        $filepath = "bulletin/".$row["Post_Picture"];
        unlink($filepath);

        $file = $postID."-".$postImg;
        $file_tmp = $_FILES['postImg']['tmp_name'];
        $folder = "bulletin/";

        $new_file_name = strtolower($file);
        $final_file = str_replace(' ','-',$new_file_name);

        move_uploaded_file($file_tmp,$folder.$final_file);

        mysqli_query($connect,"update post SET Post_Picture = '$final_file',Post_Details = '$postDetail', Admin_ID = '$adminID' where Post_ID LIKE '$postID'");

        
    }
?>
    <script>
        location.href="admin bulletin.php";
        alert("Post Updated!");
    </script>
<?php
}
?>
