<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>NGSI - Registration Form Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <input type="text" class="input" id="email" name="email">
            </div> 
            <div class="inputfield">
                <label>Password</label>
                <input type="password" class="input" id="password" name="password">
            </div>  
            <div class="inputfield">
            <input type="submit" value="Login" class="btn" id="login" name="login"></div>
            <a href="register.php"><div class="inputfield"><input value="Register" class="btn" id="register" name="register"></div></a>
            
        </form>
        </div>
            
            <div><?php echo $msg; ?></div>
</div>
<script>

	$('#login').on('click', function() {
        $("#login").attr("disabled", "disabled");
		var email = $('#email').val();
		var password = $('#password').val();
		if(email!="" && password!="" ){
			$.ajax({
				url: "../func/checkuser.php",
				type: "POST",
				data: {
					type:2,
					email: email,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "../pages/mainpage.php";	
                        $("#login").removeAttr("disabled");
                        $("#success").show();
						$('#success').html('Registration successful !'); 
                        console.log("deneme");						
					}
					else if(dataResult.statusCode==201){
                        console.log("hata");
						$("#error").show();
						$('#error').html('Invalid EmailId or Password !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});

</script>
</body>
</html>
