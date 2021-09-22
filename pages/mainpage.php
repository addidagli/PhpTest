<?php session_start();
    require "../database/db.php";
    require "header.php";

    if($_SESSION['loggedIn'] != 1)
    {
      header('Location: index.php');
    }
    else
    {
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
    }
?>
    <div class="container">
    <h5><?php echo $msg; ?></h5>
            <h4 class="text-center my-3 pb-3">Hobbies</h4>

            <form method="post" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
              <div class="row">
              <div class="col-10">
                <div class="form-outline">
                  <input type="text" id="form1" class="form-control" name="enterhobi"/>
                  <label class="form-label" for="form1">Enter a task here</label>
                </div>
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-primary" name="save">Save</button>
              </div>
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
                    echo '<td class="delete"><form action="mainpage.php" method="post"><button type="submit" name="deleteid" value="'.$hobi['id'].'" class="btn btn-danger">Delete</button></form></td>';
                     echo '</tr>';
                }
                ?>
              </tbody>
            </table>
            </div>
            </form>
    </div>
</body>
</html>

