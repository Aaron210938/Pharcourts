<!DOCTYPE html>

<?php
$query = "SELECT * FROM Agents";
$result = mysqli_query($dbconnect, $query);
while ($row = mysqli_fetch_assoc($result)) { ?>
    <label for=<?php echo $row['ID'] ?>> <?php echo $row['FirstName'] . " " . $row['LastName'] ?> </label>
    <input class="input" type="radio" name="agent" value="<?php echo $row['ID'] ?>"> <br />
<?php } ?>