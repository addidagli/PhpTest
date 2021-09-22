<?php 
	include '../database/db.php';
    session_start();
	if($_POST['type']==2){

		$email=$_POST['email'];
		$password=$_POST['password'];

        $login = $db->prepare("SELECT * FROM  `users` WHERE `email`='$email' AND `pass`= '$password'");
        $login->execute();
        $result = $login->fetchAll();  
        $sayi = $login->rowCount();
		if ($sayi>0)
		{
            
            $_SESSION['email']=$email;
            $_SESSION['id']=$result[0]['id'];
            $_SESSION['loggedIn'] = 1;
            echo json_encode(array("statusCode"=>200));
			
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}

		
	}
?>