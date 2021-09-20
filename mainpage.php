<?php session_start();
    require "db.php";

    $userid = $_SESSION['id'];
    $query = $db->prepare("SELECT hobbies.id,hobbies.hobbie FROM hobbies LEFT JOIN users ON hobbies.userid = users.id WHERE hobbies.userid = '$userid' ");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);  

    if(isset($_POST['save']))
    {
        $hobbie = $_POST['enterhobi'];
        if(enterhobi != "")
        {
            $query = $db->prepare("INSERT INTO hobbies (userid,hobbie) VALUES (?,?)");
            $result = $query->execute(array($userid,$hobbie));
            $msg = "<span style='color:green'>Hobbie Saved</span>";
        }
        else
        {
            $msg = "<span style='color:red'>Hobbie couldn't add</span>";
        }
        $query = $db->prepare("SELECT hobbies.id,hobbies.hobbie FROM hobbies INNER JOIN users ON hobbies.userid = users.id WHERE hobbies.userid = '$userid' ");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);  
    }
    if (isset($_POST['deleteid'])) {
      $id = $_POST['deleteid'];
      echo "id: ".$id;
      $query = $db->prepare("DELETE FROM hobbies WHERE id=".$id);
      $result = $query->execute();
      if($result)
      {
        header('location: mainpage.php');
      }
      else{
        echo "item couln't delete";
      }
      $query = $db->prepare("SELECT hobbies.id,hobbies.hobbie FROM hobbies INNER JOIN users ON hobbies.userid = users.id WHERE hobbies.userid = '$userid' ");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);  
      
    }
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" >
    <link href="./css/style.css" rel="stylesheet">
    <title>Hobbies</title>
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
      </ul>

      <div class="col-md-3 text-end">
        
        <a href="logout.php"><button type="button" class="btn btn-outline-dark me-2">Logout</button></a>
      </div>
    </header>

    <section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">
                <h5><?php echo $msg; ?></h5>
            <h4 class="text-center my-3 pb-3">Hobbies</h4>

            <form method="post" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
              <div class="col-12">
                <div class="form-outline">
                  <input type="text" id="form1" class="form-control" name="enterhobi"/>
                  <label class="form-label" for="form1">Enter a task here</label>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary" name="save">Save</button>
              </div>
              </form>
            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Hobbie</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($result as $key=>$hobi)
                {
                    echo '<tr>';
                    echo '<td>'.($key+1).'</td>';
                    echo '<td>'.$hobi['hobbie'].'</td>';
                    echo '<td>'.$hobi['id'].'</td>';
                    echo '<td class="delete"><form action="mainpage.php" method="post"><button type="submit" name="deleteid" value="'.$hobi['id'].'" class="btn btn-danger">Delete</button></form></td>';
                     echo '</tr>';
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- <div class="wrapper">
		<h2 class="title">hobi App</h2>
		<div class="inputFields">
			<input type="text" id="hobiValue" placeholder="Enter a hobi.">
			<button type="submit" id="addBtn" class="btn"><i class="fa fa-plus"></i></button>
		</div>
		<div class="content">
			<ul id="hobbies">
				
			</ul>
		</div>
	</div>
<!-- 
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			function loadHobbies() {
				$.ajax({
					url: "show-hobi.php",
					type: "POST",
					success: function(data) {
						$("#hobbies").html(data);
					}
				});
			}

			loadHobbies();

			$("#addBtn").on("click", function(e) {
				e.preventDefault();

				var hobbie = $("#hobiValue").val();

				$.ajax({
					url: "add-hobi.php",
					type: "POST",
					data: {hobbie: hobbie},
					success: function(data) {
						loadHobbies();
						$("#hobiValue").val('');
						if (data == 0) {
							alert("Something wrong went. Please try again.");
						}
					}
				});
			});

			$(document).on("click", "#removeBtn", function(e) {
				e.preventDefault();
				var id = $(this).data('id');
				
				$.ajax({
					url: "remove-hobi.php",
					type: "POST",
					data: {id: id},
					success: function(data) {
						loadHobbies();
						if (data == 0) {
							alert("Something wrong went. Please try again.");
						}
					}
				});
			});
		});
	</script>
  </div> -->
</body>
</html>

