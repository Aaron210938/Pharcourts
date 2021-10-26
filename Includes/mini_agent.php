<!DOCTYPE html>
<div class="agent_individual">
    <?php echo $row['FirstName'] . " " . $row['LastName'] . "<br />";
    echo "☎ " . $row['PhoneNumber'] . "<br />";
    echo "📧 " . $row['Email'] ?>
    <img src=<?php echo "./Images/agents/" . $row['Image'] ?> alt="Agent" />
</div>