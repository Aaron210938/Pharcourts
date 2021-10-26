<!DOCTYPE html>

<div class="search">
    <form method="post" action="./listings.php" encype="multipart/form-data">
        <input class="search" type="text" name="city" value="" placeholder="Search City" /></br>
        <input class="search" type="number" name="min_price" value="" placeholder="Search Min Price" /></br>
        <input class="search" type="number" name="max_price" value="" placeholder="Search Max Price" /></br>

        <input type="radio" id="City" name="sort" value="City" checked>
        <label for="City">Sort by City</label></br>
        <input type="radio" id="Price" name="sort" value="Price">
        <label for="Price">Price</label></br>

        <input type="submit" name="search" value="search" /> </br>
    </form>
</div>