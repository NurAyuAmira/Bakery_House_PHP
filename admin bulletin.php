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
  <title>Manage Post - Admin</title>
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
        var ans = confirm("Do you want to delete this post?");
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
    <div class="container-fluid bg-white" style="padding: 6.5rem 0;">
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
                    <h3>Manage Post</h3>
                    <div class="container-fluid">
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
                                                        <img src="img/bakery.png" alt="logo" class="rounded-circle mx-3" width="70px">
                                                        <div class="d-flex flex-column" >
                                                            <span class="fw-bold" id="pname">
                                                                Bakery House
                                                            </span>
                                                            <small class="text-muted"><?php echo $row["Post_Date"]?></small>
                                                        </div>
                                                    </div>
                                                        <div class="d-flex flex-row ellipsis mx-3 btn dropdown" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></div>
                                                        <ul class="dropdown-menu">
                                                            <li><div class="dropdown-item disabled">Last Edited By</div></li>
                                                            <li><div class="dropdown-item disabled"><?php echo $row["Admin_ID"]?></div></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="admin bulletin.php?pid=<?php echo $row["Post_ID"]?>" onclick="return confirmation();">Delete</a></li>
                                                            <li><a class="dropdown-item" href="bulletin edit.php?pid=<?php echo $row["Post_ID"]?>">Edit</a></li>
                                                        </ul>
                                                </div>
                                                <div class="text-center bg-white">
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
                                                        <img src="img/bakery.png" class="rounded-circle mx-3" width="70px" height="70px">
                                                        <form action="" class="d-flex" method="post">
                                                            <input type="hidden" value="<?php echo $row["Post_ID"]?>" name="postID">
                                                            <textarea class="form-control shadow-none" rows="4" cols="200" placeholder="Add A Comment" id="usercomment" name="text" maxlength="1000" required></textarea>
                                                            <button type="submit" class="btn btn-warning d-flex flex-column mx-3 shadow-none" name="postbtn" style="font-size: x-large;">Post</button>
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
                                    <div class="container bg-light shadow-sm rounded-3 p-3 mt-3 text-center" style="font-size:x-large">No Post At This Time! Please Add Relevant Post</div>
                            <?php
                                }
                            ?>
                               
                    </div>
                </div>
                <div id="add" class="tab-pane">
                    <h3>Add Post</h3>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="getCurrentDate();">
                        <div class="mb-3">
                            <label for="postPic" class="form-label"><i class="bi bi-card-image"></i>&nbsp;Post Picture</label>
                            <input type="file" name="postPic" id="postPic" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="postDetail" class="form-label"><i class="bi bi-card-text"></i>&nbsp;Post Detail</label>
                            <textarea name="postDetail" id="postDetail" class="form-control" rows="6" required></textarea>
                        </div>
                        <input type="hidden" name="postDate" id="postDate">
                        <div class="mt-5">
                            <button type="submit" name="savebtn" class="btn btn-success">Add Post</button>
                            <button type="reset" class="btn btn-warning text-white ms-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeText(n)
        {
            if(n.innerHTML =="Hide All Comments")
                n.innerHTML = "Show All Comments";
            else
                n.innerHTML = "Hide All Comments";
        }

        function getCurrentDate()
        {
            var d = new Date();
            var date = d.getDate();
            var year = d.getFullYear();
            var month = d.getMonth() + 1;

            var postDate = year + "/" + month + "/" + date;
            document.getElementById('postDate').value = postDate;
        }

    </script>
</body>
</html>
<?php
if(isset($_POST["savebtn"]))
{
    $postDetail = $_POST["postDetail"];
    $postDate = $_POST["postDate"];
    $adminID = $_SESSION["AdminID"];

        $checkid = "select * from post ORDER BY Post_ID DESC LIMIT 1";
        $checkresult = mysqli_query($connect,$checkid);
        if(mysqli_num_rows($checkresult)>0)
        {
            if($row = mysqli_fetch_assoc($checkresult))
            $lid = $row['Post_ID'];
            $getIDNum = str_replace("B","",$lid);
            $idPlus = $getIDNum+1;
            $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
            $postID = "B".$getstr;
            

        }
        else
        {
            $postID = "B0001";

        }
            $file = $postID."-".$_FILES['postPic']['name'];
            $file_tmp = $_FILES['postPic']['tmp_name'];
            $folder = "bulletin/";

            $new_file_name = strtolower($file);
            $final_file = str_replace(' ','-',$new_file_name);

            move_uploaded_file($file_tmp,$folder.$final_file);

            mysqli_query($connect,"insert into post(Post_ID,Post_Picture,Post_Details,Post_Date,Admin_ID)
            values('$postID','$final_file','$postDetail','$postDate','$adminID')");
?>
            <script>
                alert("Post Added!");
                location.href="admin bulletin.php";
            </script>

<?php   


}

?>

<?php
if(isset($_REQUEST["pid"]))
{
    $postID = $_REQUEST["pid"];
    $result = mysqli_query($connect,"select * from post where Post_ID LIKE '$postID'");
    $row = mysqli_fetch_assoc($result);
    $filepath = "bulletin/".$row["Post_Picture"];
    unlink($filepath);

    mysqli_query($connect,"delete from comment where Post_ID LIKE '$postID'");
    mysqli_query($connect,"delete from post where Post_ID LIKE '$postID'");

?>
    <script>
        location.href="admin bulletin.php";
    </script>
<?php
}

?>

<?php
    if(isset($_POST['postbtn']))
    {
        $text = $_POST['text'];
        $postID = $_POST['postID'];
        $adminID = $_SESSION['AdminID'];

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
        values('$commID','$text','$postID',null,'$adminID')");

?>
    <script>
        alert('Your comments had post');
        location.href="admin bulletin.php";
    </script>
<?php
    }
?>
