<!DOCTYPE html>

<html lang="en">

<?php
include("./Includes/head.php");
include("./Includes/dbconnect.php");
include("./Includes/session.php");
?>

<body>
  <?php include("./Includes/header.php") ?>
  <?php if (isset($_GET['id'])) {
    $list_id = mysqli_real_escape_string($dbconnect, $_GET['id']);
    $list_query = "SELECT * FROM `Listings` WHERE `ID` = '$list_id' LIMIT 1";
    $list_result =  mysqli_query($dbconnect, $list_query);
    $list_row = mysqli_fetch_assoc($list_result);
    $list_img = "./Images/listings/" . $list_row['Image']; ?>
    <div class="name">
      <h1>
        <?php echo $list_row['Address']; ?>,
        <?php echo $list_row['Suburb']; ?>,
        <?php echo $list_row['City']; ?>
      </h1>
    </div>
    <div class="listing_info">
      <div class="listing_main">
        <img src=<?php echo $list_img ?> alt="house">
        <p><?php echo $list_row['About']; ?> </p>
      </div>
      <div class="listing_contacts">
        <div class="price">
          <span style="font-size: xx-large">
            Listing Price: <b>$<?php echo $list_row['Price']; ?></b>
          </span> <br />
          <?php echo "Closing: " . $list_row['EndDate'] ?>
        </div>
        <?php
        $query = "SELECT * FROM Agents";
        $result =  mysqli_query($dbconnect, $query);
        $row = mysqli_fetch_assoc($result)
        ?>
        <?php include("./Includes/mini_agent.php") ?>
      </div>
    </div>
  <?php } else { ?>
    <?php include("./Includes/sort.php") ?>
    <div class="admin_pannel">
      <a href="./admin_add.php">Add entry </a>
      <a href="./Includes/logout.php">Sign out </a>
    </div>
  <?php
    include("./Includes/list_listings.php");
  } ?>

</body>