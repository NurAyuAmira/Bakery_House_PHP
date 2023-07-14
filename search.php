<!DOCTYPE html>
<html lang="en">
<head>
  <title>SpongeX</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <!--font-family: 'Alegreya Sans', sans-serif-->
</head>
<style>
    body{overflow-x:hidden;}
    .card-title{height: 55px;}
    .card-text{text-overflow: ellipsis!important;white-space: nowrap;overflow: hidden;}
    .card-top{top:0;right:0;position: absolute;}
    .card-img-top {width:100%;object-fit: cover;}
</style>
<body style="font-family: 'Alegreya Sans', sans-serif;">
    <div class="row">
    <?php 
        include("dataconnection.php");
        if(isset($_GET["search"]))
        {
            $search = $_GET["search"];

            $result = mysqli_query($connect,"select * from product where Product_Name LIKE '%$search%' or Product_Type LIKE '%$search%' or Product_Ingredients LIKE '%$search%' order by Product_Status DESC,Product_Price");
            if(mysqli_num_rows($result)!=0 && $search!="")
            {
                while($row = mysqli_fetch_assoc($result))
                {
    ?>  
                <div class="col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="card" style="width:22rem">
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
                                <button type="button" class="btn btn-warning" onclick="locate(this)" id="<?php echo $row["Product_ID"];?>">Order</button>
                            </div>
                            <input type="hidden" id="id" value="<?php echo $row["Product_ID"]?>">
                        </div>
                </div>
    <?php
                }
            }
            else
            {
    ?>
                <div class="d-flex align-items-center justify-content-center"style="height:560px">
                    <div class="display-6">No result found!</div>
                </div>
    <?php
            }
        }
    ?>
    </div>
    <script>
    
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) 
        {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        
        function locate(n)
        {
            id = n.id;
            top.location.href = "cart add.php?pid=" + id;
        }
    </script>
</body>
</html>
