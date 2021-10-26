<!DOCTYPE html>

<html lang="en">

<?php
include("./Includes/head.php");
include("./Includes/dbconnect.php")
?>

<body>
  <?php include("./Includes/header.php") ?>
  <div class="about">
    <p>
    <h1>About Us</h1>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur ullamcorper felis, mattis euismod eros aliquam at. Suspendisse dapibus mi nec luctus imperdiet. Nunc nec elit in nisl consequat dictum. In pretium orci turpis. Aliquam consequat mi a tellus egestas, sit amet porttitor massa finibus. Morbi elementum eros erat, id rhoncus mauris sollicitudin id. Sed consequat finibus pulvinar. In eros ex, fermentum vel bibendum nec, rutrum quis felis. Phasellus suscipit hendrerit erat sed molestie. Sed et ipsum velit. Suspendisse at condimentum mauris, et egestas felis.</br>
    Nulla eget tincidunt nulla. Aliquam tempus odio tortor. Ut diam urna, pharetra in tristique ac, volutpat sit amet nisl. Nam at eleifend quam. Aliquam maximus eros et diam accumsan, vitae maximus massa viverra. Nunc eget rutrum arcu, at ultrices nulla. Donec vitae ullamcorper dolor. In ac vehicula dolor. Nunc in tincidunt felis. Quisque ac augue sed erat fringilla dignissim a vitae odio.
    </p>
  </div>
  <div class="agent_index">
    <h2>Our Agents</h2>
    <div class="agent_mini">
      <?php
      $query = "SELECT * FROM Agents";
      $result =  mysqli_query($dbconnect, $query);
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <div style="width: 300px">
          <?php include("./Includes/mini_agent.php") ?>
        </div>
      <?php } ?>
    </div>

  </div>
</body>


<script src="./Scripts/fixedscroll.js"></script>