<!DOCTYPE html>

<html lang="en">

<?php
include ("./Includes/head.php");
include ("./Includes/dbconnect.php");

$id = mysqli_real_escape_string($dbconnect, $_GET['id']);
$query = "SELECT * FROM `Agents` WHERE `ID` = '$id' LIMIT 1";
$result =  mysqli_query($dbconnect, $query);
$row = mysqli_fetch_assoc($result);
$img = "./Images/agents/".$row['Image'];
/* SELECT COUNT(*) as AgentsCounts FROM Agents; */
?>

<body>
  <?php include ("./Includes/header.php")?>
  <div class="content">
    <div class="profile">
      <div class="name">
        <h1>
          <?php echo $row['FirstName'];?>
          <?php echo $row['LastName'];?>
        </h1>
      </div>
      <ul>
        <li><?php echo $row['PhoneNumber']?></li>
        <li><?php echo $row['Email']?></li>
      </ul>
      <?php echo $row['About'];?>
      <img src=<?php echo $img?> class="portrait" alt="Image of <?php echo $row['FirstName']?>" width="500" height="600">
    </div>
  </div>
</body>


<script src="./Scripts/fixedscroll.js"></script>
