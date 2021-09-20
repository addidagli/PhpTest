<?php session_start();

    require "db.php";

    if (isset($_POST['login'])) {
        
        $email = $_POST['email'] ? $_POST['email'] : '';
        $password = $_POST['password'] ? $_POST['password'] : '';

        if($email != "" && $password != "")
        {
            $login = $db->prepare("SELECT * FROM users WHERE email='$email' AND pass= '$password'");
            $login->execute();
            $result = $login->fetchAll();  
            //print_r("result: ".$result);


            
            if(($result[0]['email'] == $email) && ($result[0]['pass'] == $password))
            {

                $_SESSION['email']=$email;
                $_SESSION['id']=$result[0]['id'];
                $msg="<span style='color:green'>Success</span>";
                header("Location:mainpage.php");
                exit;

            }
            else
            {
                $msg="<span style='color:red'>Username or Password is incorrect</span>";
            }
        }
        else
        {
            $msg="<span style='color:red'>Please fill up all inputs</span>";
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
<!-- partial:index.partial.html -->
<div class="wrapper">
    <div class="title">
      NGSI Login Form Skill Test
    </div>
        <form method="post" class="form">
            <div class="inputfield">
                <label>Email Address</label>
                <input type="text" class="input" name="email">
            </div> 
            <div class="inputfield">
                <label>Password</label>
                <input type="password" class="input" name="password">
            </div>  
            <div class="inputfield">
            <input type="submit" value="Login" class="btn" id="login" name="login">
            </div>
            <div><?php echo $msg; ?></div>
        </form>
</div>
<!-- partial
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#register").on('click', function (){
        var email = $("#email").val();
        var password = $("#password").val();
        console.log(email);

        if(email == "" || password == ""){
            alert("please fill up all inputs");
        }
     
    });
});
</script>
 -->
</body>
</html>
