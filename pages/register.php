<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>NGSI - Registration Form Test</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="title">
      NGSI Registration Form Skill Test
    </div>
        <form class="form" method="post">
            <div class="inputfield">
                <label>First Name</label>
                <input type="text" class="input" id="firstname" name="firstname">
            </div>  
                <div class="inputfield">
                <label>Last Name</label>
                <input type="text" class="input"  id="lastname" name="lastname">
            </div>  
            <div class="inputfield">
                <label>Password</label>
                <input type="password" class="input"  id="password" name="password">
            </div>  
            <div class="inputfield">
                <label>Confirm Password</label>
                <input type="password" class="input"  id="confirmpassword" name="confirmpassword">
            </div> 
                <div class="inputfield">
                <label>Gender</label>
                <div class="custom_select">
                    <select name="gender" id="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </div>
            </div> 
                <div class="inputfield">
                <label>Email Address</label>
                <input type="text" class="input"  id="email" name="email">
            </div> 
            <div class="inputfield">
                <label>Phone Number</label>
                <input type="text" class="input"  id="phone" name="phone">
            </div> 
            <div class="inputfield">
                <label>Address</label>
                <textarea class="textarea"  id="address" name="address"></textarea>
            </div> 
             <div class="inputfield">
                <label>Postal Code</label>
                <input type="text" class="input"  id="postalcode" name="postalcode">
            </div> 
            <div class="inputfield terms">
                <label class="check">
                    <input type="checkbox" name="checked" value="ok">
                    <span class="checkmark"></span>
                </label>
                <p>Agreed to terms and conditions</p>
            </div> 
            <div id="warning"></div>
            <div class="inputfield">
                <input type="submit" value="Register" class="btn" id="register" name="submit">
            </div>
            <a href="login.php"><div class="inputfield"><input value="Login" class="btn" id="login" name="login" style="text-align: center;"></div></a>
        </form>
</div>

<script>
    $('#register').on('click', function() {
		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
        var password = $('#password').val();
        var confirmpassword = $('#confirmpassword').val();
		var gender = $('#gender').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var address = $('#address').val();
		var postalcode = $('#postalcode').val();
		
		if(firstname!="" && lastname!="" && password!="" && confirmpassword!=""  && gender!=""
        && email!=""  && phone!=""  && address!=""  && postalcode!=""){
            if(password == confirmpassword)
            {
                $.ajax({
				url: "../func/adduser.php",
				type: "POST",
				data: {
					type: 1,
					firstname: firstname,
					lastname: lastname,
                    password: password,
					confirmpassword: confirmpassword,
                    gender: gender,
					email: email,
					phone: phone,
					address: address,
                    postalcode: postalcode
											
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#register_form').find('input:text').val('');
						$("#success").show();
						$('#success').html('Registration successful !');			
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Email ID already exists !');
                        alert('Email already exists');
					}
                    else{
                        alert('Email already exists');
                    }
					
				}
			});
            }
            else
            {
                alert('Passwords have to be the same');
            }
			
		}
		else{
			alert('Please fill all the field !');
		}
	});
</script>
</body>
</html> 
