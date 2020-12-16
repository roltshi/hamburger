<?php
ob_start();
include 'connection.php';


$sql = "SELECT * FROM chat";
$result = $mysqli->query($sql);



if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo ' <div id="' . $row['id'] . '"' . ' class="comment">' .
            '<p class="comment-header">' . '<a onclick="reply(' . "'" .  $row['felhasznalonev'] . "'" . ')" > ' . $row['felhasznalonev'] . '</a>' . " - " . $row['datum'] . '</p>' .
            '<p class="comment-content">' . $row['msg'] . '</p>
            </div>';
    }
} else {
    echo "0 eredmény";
}

$mysqli->close();
ob_end_flush();
