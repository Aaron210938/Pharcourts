<!DOCTYPE html>

<html lang="en">

<?php
include("./Includes/head.php");
include("./Includes/dbconnect.php");
include("./Includes/session.php");

// This is some hot garbage that somehow works
$target_dir = __DIR__ . "/Images/listings/";
$target_file = $target_dir . basename($_FILES["house_image"]["name"]);
$tmp_file = $_FILES["house_image"]["tmp_name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//echo "$tmp_file";
//echo "$target_dir";
#echo "$target_file";

if (isset($_POST['add_new'])) {
  $check = getimagesize($tmp_file);
  if ($check !== false) {
    /* echo "File is an image - " . $check["mime"] . "."; */
    /* echo $_FILES["house_image"]["tmp_name"]; */
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  if ($_FILES["house_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    #echo "Uploading file";
    if (move_uploaded_file($tmp_file, $target_file)) {
      #echo "The file " . htmlspecialchars(basename($target_file)) . " has been uploaded.";

      $address = mysqli_real_escape_string($dbconnect, $_POST['address']);
      $suburb = mysqli_real_escape_string($dbconnect, $_POST['suburb']);
      $city = mysqli_real_escape_string($dbconnect, $_POST['city']);
      $price = mysqli_real_escape_string($dbconnect, $_POST['price']);
      $blurb = mysqli_real_escape_string($dbconnect, $_POST['blurb']);
      $date = mysqli_real_escape_string($dbconnect, $_POST['date']);
      $agent = mysqli_real_escape_string($dbconnect, $_POST['agent']);
      $house_image = mysqli_real_escape_string($dbconnect, $_FILES['house_image']['name']);

      #echo $house_image;
      // Count results before new record
      $sqlOld = "SELECT * FROM `Listings` WHERE 1";
      // Run query
      $result = mysqli_query($dbconnect, $sqlOld);
      // Count current results
      $numOld = mysqli_num_rows($result);

      // Create the SQL
      $sql = "INSERT INTO `Listings` (`ID`, `Address`, `Suburb`, `City`, `Price`, `About`, `EndDate`, `Agent`, `Image`)
        VALUES (NULL, '$address','$suburb', '$city', '$price', '$blurb', '$date', '$agent', '$house_image')";
      // Set the last ID
      $lastID = mysqli_insert_id($dbconnect);
      // Run the query
      $result = mysqli_query($dbconnect, $sql);

      // Count results before new record
      $sqlNew = "SELECT * FROM `Listings` WHERE 1";
      // Run query
      $result = mysqli_query($dbconnect, $sqlNew);
      // Count current results
      $numNew = mysqli_num_rows($result);
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>

<body>
  <?php include("./Includes/header.php") ?>
  <div class="add_entry">
    <form method="post" action="admin_add.php" enctype="multipart/form-data">
      <input class="input" type="text" name="address" value="" required placeholder="Address" /> <br />
      <input class="input" type="text" name="suburb" value="" required placeholder="Suburb" /> <br />
      <input class="input" type="text" name="city" value="" required placeholder="City" /> <br />
      <label for="quantity">Price:</label> <br />
      <input type="number" name="price" min="1"> <br />
      <textarea rows="6" cols="72" name="blurb" placeholder="Add review here..."></textarea> <br />

      <input class="input" type="date" name="date" value="" required placeholder="date" /> <br />

      <?php include("./Includes/agent_list_radio.php") ?>

      <input class="input" type="file" name="house_image" value="" required /> <br />

      <input type="submit" name="add_new" value="Submit">
      <input type="reset">
    </form>
    I don't want to edit the css of this

    <!-- STATUS TEXT  -->
    <?php
    if (isset($_POST['add_new'])) {
      if ($numNew > $numOld) {
    ?>
        <div class="success">
          Successfully submitted review
        </div>
      <?php
      } else {
      ?>
        <div class="error">Unsuccessfully submitted review</div>
    <?php
      }
    }
    ?>
  </div>
</body>