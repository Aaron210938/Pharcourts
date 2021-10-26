<!DOCTYPE html>

<div class="listing_page">
    <?php
    if (isset($_POST['search'])) {
        $city = mysqli_real_escape_string($dbconnect, $_POST['city']);
        $min_price = mysqli_real_escape_string($dbconnect, $_POST['min_price']);
        $max_price = mysqli_real_escape_string($dbconnect, $_POST['max_price']);
        $sort = mysqli_real_escape_string($dbconnect, $_POST['Sort']);

        if (!empty($city)) {
            $city = " Where City LIKE " . "'$city'";
        } else {
            $city = "";
        }
        if (!empty($min_price)) {
            $min_price = " and Price > " . $min_price;
        } else {
            $min_price = "";
        }
        if (!empty($max_price)) {
            $max_price = " and Price < " . $max_price;
        } else {
            $max_price = "";
        }
        if (!empty($sort)) {
            $sort = " and City LIKE " . $sort;
        } else {
            $sort = " ORDER BY City";
        }
    }
    $query = "SELECT * FROM Listings" . $city . $min_price . $max_price . $sort;
    // echo $query;
    $result = mysqli_query($dbconnect, $query);
    ?>
    <div class='listing_content'>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <a href="<?php echo "./listings.php?id=" . $row['ID'] ?>">
                <img src=<?php echo "./Images/listings/" . $row['Image'] ?> alt="house">
                <?php echo $row['Address'] . ", " . $row['Suburb'] . ", " . $row['City'] ?> <br />
                <b><?php echo "Going for $" . $row['Price'] ?></b>
            </a>
        <?php } ?>
    </div>
</div>