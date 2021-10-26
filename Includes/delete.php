<?php

include("./dbconnect.php");
if (isset($_POST['delete'])) {
    // echo $_POST['id'];
    $query = "DELETE FROM `Listings` WHERE `ID` = " . $_POST['id'];
    echo $query;
    mysqli_query($dbconnect, $query);
}

header("location: ../admin.php");
