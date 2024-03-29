<?php include("dataconnection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register - User</title>
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
    a{text-decoration: none;}
    a:hover{font-style: italic};
</style>
<body>
    <div class="container-fluid" style="font-family: 'Alegreya Sans', sans-serif;">
        <div class="row vh-100">
            <div class="col-5 d-none d-sm-block shadow-lg" style="background-image: url(bg/register.jpeg);background-size: cover;background-position: center;background-repeat: no-repeat"></div>
            <div class="col text-center mt-5 pt-5">
                <img src="img/bakery.png" alt="logo" width="120px" height="100px">
                <div class="container shadow-sm my-5 bg-light py-4" style="max-width: 80%;">
                    <h3><i class="bi bi-people-fill" style="color:brown;"></i> User Registration</h3>
                    <form action="" class="text-start" method="post" onsubmit="return validateForm()">
                        <div class="mt-4">
                            <label for="fname" class="form-label"><i class="bi bi-person-circle" style="color:brown;"></i>&nbsp; First Name :</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter Your First Name" name="fname" required max="50">
                        </div>
                        <div class="mt-4">
                            <label for="lname" class="form-label"><i class="bi bi-person-circle" style="color:brown;"></i>&nbsp; Last Name :</label>
                            <input type="text" class="form-control" id="lname" placeholder="Enter Your Last Name" name="lname" required max="50">
                        </div>
                        <div class="mt-4">
                            <label for="gender" class="form-label"><i class="bi bi-gender-trans" style="color:brown;"></i>&nbsp; Gender :</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="Male" name="gender" value="male" required><i class="bi bi-gender-male" style="color:brown;"></i>
                                <label for="Male" class="form-check-label">&nbsp Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="Female" name="gender" value="female" required><i class="bi bi-gender-female" style="color:brown;"></i>
                                <label for="Female" class="form-check-label">&nbsp  Female</label>
                            </div>
                        </div>   
                        <div class="mt-4">
                            <label for="phone" class="form-label"><i class="bi bi-telephone-fill" style="color:brown;"></i>&nbsp; Phone number : <span id="spanPhone" class="text-danger"></span></label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter Your Phone Number" name="phone" required max="15" onchange="checkPhone();">
                        </div>
                        <div class="mt-4">
                            <label for="email" class="form-label"><i class="bi bi-envelope-fill" style="color:brown;"></i>&nbsp; Email :</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required max="50">
                        </div>
                        <div class="mt-4">
                            <label for="password" class="form-label"><i class="bi bi-key-fill" style="color:brown;"></i>&nbsp; Password :</label>
                            <input type="password" class="form-control" id="userPW" placeholder="Enter Your Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required  onchange="checkPassword();">
                        </div>
                        <div class="mt-4">
                            <label for="confirm" class="form-label"><i class="bi bi-key-fill" style="color:brown;"></i>&nbsp; Confirm Password : <span id="spanConfirmPW" class="text-danger"></span></label>
                            <input type="password" class="form-control" id="userConfirm" placeholder="Enter Your Confirmation Password" name="confirm" required onchange="checkPassword();">
                        </div>
                                                <script src="confirm.js"></script>
                        <div class="mt-4">
                            <label for="address" class="form-label"><i class="bi bi-geo-alt-fill"></i>&nbsp Address :</label>
                            <input id="address" placeholder="Enter Your Address" name="address" type="text" class="form-control" required max="255">
                            <br>
                            <div id="mt-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="city" class="form-label">City</label>
                                        <input class="form-control" id="city" name="city" required max="50">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="state" class="form-label">State</label>
                                        <select  class="form-control" id="state" name="state">
                                            <option value="">Select Your State</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Malacca">Malacca</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="postcode" class="form-label">Postcode</label>
                                        <input class="form-control" id="postcode" name="postcode" pattern="[0-9]{5}" required max="5">
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <div class="mt-5">
                            <button type="submit" class="form-control btn btn-warning" id="register" name="registerbtn" style="background-color:#4d3f32; color: white;">REGISTER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    var password = document.getElementById("userPW");
    var confirm = document.getElementById("userConfirm");
    var spanConfirm = document.getElementById("spanConfirmPW");
    var phone = document.getElementById("phone");
    var spanPhone = document.getElementById("spanPhone");

    function checkPhone()
    {
        if(phone.value.match(/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4,5})$/))
        {
            spanPhone.innerHTML = "";
            return true;
        }
        else
        {
            spanPhone.innerHTML = "Please enter the correct phone number";
            return false;
        }
    }

    function checkPassword()
    {
        if(password.value != confirm.value)
        {
            spanConfirm.innerHTML = "The confirm password confirmation does not match";
            return false;
        }
        else
        {
            spanConfirm.innerHTML = "";
            return true;
        }
    }

    function validateForm()
    {
        if(checkPhone()&&checkPassword())
        {
            return true;
        }
        else
        {
            if(!(checkPhone()))
            {
                phone.focus();
            }
            else if(!(checkPassword()))
            {
                confirm.focus();
            }

            return false;
        }
    }
    </script>  
</body>
</html>
<?php
    if(isset($_POST["registerbtn"]))
    {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $gender = $_POST["gender"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $postcode = $_POST["postcode"];


        $checkresult = mysqli_query($connect,"select * from customer where Customer_Email LIKE '$email'");
        if(mysqli_num_rows($checkresult)==0)
        {
            $checkid = "select * from customer ORDER BY Customer_ID DESC LIMIT 1";
            $checkresult = mysqli_query($connect,$checkid);
            if(mysqli_num_rows($checkresult)>0)
            {
                if($row = mysqli_fetch_assoc($checkresult))
                $lid = $row['Customer_ID'];
                $getIDNum = str_replace("C","",$lid);
                $idPlus = $getIDNum+1;
                $getstr = str_pad($idPlus,4,0,STR_PAD_LEFT);
                $custID = "C".$getstr;
                

            }
            else
            {
                $custID = "C0001";
            }

        mysqli_query($connect,"insert into customer(Customer_ID,Customer_First_Name,Customer_Last_Name,Customer_Email,Customer_Password,Customer_Address,Customer_Address_Postcode,Customer_Address_City,Customer_Address_State,Customer_Gender,Customer_Contact_No)
        values('$custID','$fname','$lname','$email','$password','$address','$postcode','$city','$state','$gender','$phone')");
?>  
        <script>
            alert("Account Registration Is Successful. Please Login.");
            location.href="user login.php";
        </script>    
<?php
    }
    else
    {
?>
    <script>
        alert("The Email Has Already Been Taken. Please Change");
    </script>
<?php
    }
}
?>
