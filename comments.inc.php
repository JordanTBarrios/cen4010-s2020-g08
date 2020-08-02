<?php

function setComments($database) {
    if (isset($_POST['commentSubmit'])){
        $uid = $_POST['UID'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
        $result = $database->query($sql);
    }

}

function getComments($database){
    $sql = "SELECT * FROM comments";
    $result = $database-> query($sql);
    while ($row = $result->fetch_assoc()){
        echo "<div class = 'comment-box'><p>";
            echo $row['uid']."<br>";
            echo $row['date']."<br>";
            echo nl2br($row['message']);
        echo "</p></div>";

    }
    
}