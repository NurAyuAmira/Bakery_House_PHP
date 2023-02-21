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
  <title>Manage Message - Admin</title>
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
                        <a class="nav-link px-3" href="admin message.php" id="active">Message</a>
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
        </ul>
        <div class="content">
            <div class="tab-content">
                <div id="manage" class="tab-pane active">
                    <div class="d-flex justify-content-between">
                        <h3>Manage Message</h3>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-boxes"></i>&nbsp;Status:</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#Pending">Pending</a></li>
                                <li><a class="dropdown-item" href="#Replied">Replied</a></li>
                            </ul>
                        </div>  
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="Pending">Pending</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact no.</th>
                                    <th>Type</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $result = mysqli_query($connect,"select * from message where Message_Status LIKE '%Pending%'");

                                    if(mysqli_num_rows($result)!=0)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                ?>
                                            <tr>
                                                <td><?php echo $row["Message_ID"]?></td>
                                                <td><?php echo $row["Message_Name"]?></td>
                                                <td><?php echo $row["Message_Email"]?></td>
                                                <td><?php echo $row["Message_Phone"]?></td>
                                                <td><?php echo $row["Message_Type"]?></td>
                                                <td><?php echo $row["Message_Detail"]?></td>
                                                <td><?php echo $row["Message_Status"]?></td>     
                                                <td><a type="button" class="btn btn-primary m-1" href="message reply.php?mid=<?php echo $row["Message_ID"]?>">Reply</a></td>                       
                                            </tr>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <tr>
                                            <td colspan="8">No Pending Message At This Time</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-2">
                        <h4><span class="badge bg-secondary" id="Replied">Replied</span></h4>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact no.</th>
                                    <th>Type</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Managed By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $result = mysqli_query($connect,"select * from message where Message_Status LIKE '%Replied%'");

                                    if(mysqli_num_rows($result)!=0)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                ?>
                                            <tr>
                                                <td><?php echo $row["Message_ID"]?></td>
                                                <td><?php echo $row["Message_Name"]?></td>
                                                <td><?php echo $row["Message_Email"]?></td>
                                                <td><?php echo $row["Message_Phone"]?></td>
                                                <td><?php echo $row["Message_Type"]?></td>
                                                <td><?php echo $row["Message_Detail"]?></td>
                                                <td><?php echo $row["Message_Status"]?></td>     
                                                <td><?php echo $row["Admin_ID"]?></td>
                                                <td><a type="button" class="btn btn-danger m-1" href="admin message.php?action=delete&mid=<?php echo $row["Message_ID"]?>">Delete</a></td>                       
                                            </tr>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <tr>
                                            <td colspan="9">No Replied Message At This Time</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_REQUEST["action"]))
    {
        if($_REQUEST["action"]=="delete")
        {
            $mid = $_GET["mid"];
            mysqli_query($connect,"delete from message where Message_ID LIKE '$mid'");

?>
        <script>
            alert('Message Deleted');
            location.href="admin message.php";
        </script>
<?php
        }
    }
?>
