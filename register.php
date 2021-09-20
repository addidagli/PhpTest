<?php
   
 require "db.php";

    if(isset($_POST['submit']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $postalcode = $_POST['postalcode'];

    if(!empty($firstname) && !empty($lastname) && !empty($password) && !empty($confirmpassword) && !empty($gender) && !empty($email) && !empty($phone) && !empty($address) && !empty($postalcode) )
    {
        $control = $db->prepare("SELECT * FROM users where email = :email");
        $control->bindParam(":email",$email, PDO::PARAM_STR);
        $control->execute();
        $sayi = $control->rowCount();
        if($sayi == 0)
        {
            if($password == $confirmpassword)
            {
                $query = $db->prepare("INSERT INTO users (firstname,lastname,pass,gender,email,phone,addres,postalcode) VALUES (?,?,?,?,?,?,?,?)");
                $result = $query->execute(array($firstname,$lastname,$password,$gender,$email,$phone,$address,$postalcode));
                $msg = "<span style='color:green'>User Saved</span>";
            }
            else
            {
                $msg = "<span style='color:red'>Passwords don't match</span>";
            }
        }
        else
        {
            $msg = "<span style='color:red'>User already exist</span>";
        }
       
    }
    else
    {
        $msg = "<span style='color:red'>Please fill up all inputs</span>";
    }
}

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>NGSI - Registration Form Test</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<div class="wrapper">
<div> <?php echo $msg; ?></div>
    <div class="title">
      NGSI Registration Form Skill Test
    </div>
        <form class="form" method="post">
            <div class="inputfield">
                <label>First Name</label>
                <input type="text" class="input" name="firstname">
            </div>  
                <div class="inputfield">
                <label>Last Name</label>
                <input type="text" class="input" name="lastname">
            </div>  
            <div class="inputfield">
                <label>Password</label>
                <input type="password" class="input" name="password">
            </div>  
            <div class="inputfield">
                <label>Confirm Password</label>
                <input type="password" class="input" name="confirmpassword">
            </div> 
                <div class="inputfield">
                <label>Gender</label>
                <div class="custom_select">
                    <select name="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </div>
            </div> 
                <div class="inputfield">
                <label>Email Address</label>
                <input type="text" class="input" name="email">
            </div> 
            <div class="inputfield">
                <label>Phone Number</label>
                <input type="text" class="input" name="phone">
            </div> 
            <div class="inputfield">
                <label>Address</label>
                <textarea class="textarea" name="address"></textarea>
            </div> 
             <div class="inputfield">
                <label>Postal Code</label>
                <input type="text" class="input" name="postalcode">
            </div> 
            <div class="inputfield terms">
                <label class="check">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <p>Agreed to terms and conditions</p>
            </div> 
            <div class="inputfield">
                <input type="submit" value="Register" class="btn" id="register" name="submit">
            </div>
        </form>
</div>
<!-- partial 
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#register").on('click', function (){
        var email = $("#email").val();
        var password = $("#password").val();

        if(email == "" || password == ""){
            alert("please fill up all inputs");
        }

        $.ajax(
            {
                url: 'register.php',
                method: 'POST',
                data: {
                    login: 1,
                    email: email,
                    password: password
                },
                success: function(response){
                    console.log(response);
                }
            }
        );
    });
});
</script> 
-->
</body>
</html> 
