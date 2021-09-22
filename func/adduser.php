<?php
	include 'db.php';
	session_start();
	if($_POST['type']==1){

		$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $postalcode = $_POST['postalcode'];

		$control = $db->prepare("SELECT * FROM users where email = :email");
        $control->bindParam(":email",$email, PDO::PARAM_STR);
        $control->execute();
        $sayi = $control->rowCount();
      
		if ($sayi>0)
		{
			echo json_encode(array("birstatusCode"=>201));
		}
		else{
            $query = $db->prepare("INSERT INTO `users` (`firstname`,`lastname`,`pass`,`gender`,`email`,`phone`,`addres`,`postalcode`) VALUES (?,?,?,?,?,?,?,?)");
            $result = $query->execute(array($firstname,$lastname,$password,$gender,$email,$phone,$address,$postalcode));
			if ($result) {
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("ikistatusCode"=>201));
			}
		}
	}
?>
  