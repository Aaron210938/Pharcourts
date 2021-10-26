<!DOCTYPE html>
<html lang="en">

<?php
include("./Includes/head.php");
include("./Includes/dbconnect.php");

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($dbconnect, $_POST['u']);
    $pass = mysqli_real_escape_string($dbconnect, $_POST['p']);

    $query = "SELECT ID from Login where Username = '$user' and Password = '$pass'";
    $result = mysqli_query($dbconnect, $query);
    $row = mysqli_fetch_array($result);
    $active = $row['active'];
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['logged_user'] = $user;
        header("location: admin.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<body>
    <div class="login">
        <h1>Login</h1> <br />
        <form method="post">
            <input type="text" name="u" placeholder="Username" required="required" /> <br />
            <input type="password" name="p" placeholder="Password" required="required" /> <br />
            <button type="submit">Let me in.</button>
        </form>
        <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
    </div>
</body>

</html>