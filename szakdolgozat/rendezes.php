<?php
ob_start();
include 'connection.php';


$sql = "";
$sub = $_POST['sub'];

function duplaTripla($x)
{
    if ($x == 0) {
        return "Nincs";
    } elseif ($x == 2) {
        return "dupla";
    } elseif ($x == 3) {
        return "tripla";
    } else {
        return $x;
    }
}

if ($sub == "alap") {
    $sql = "SELECT * FROM hamburgerek";
} else if ($sub == "arnov") {
    $sql = "SELECT * FROM hamburgerek ORDER BY ar ASC";
} else if ($sub == "arcsok") {
    $sql = "SELECT * FROM hamburgerek ORDER BY ar DESC";
} else if ($sub == "nevnov") {
    $sql = "SELECT * FROM hamburgerek ORDER BY nev ASC";
} else if ($sub == "nevcsok") {
    $sql = "SELECT * FROM hamburgerek ORDER BY nev DESC";
} else if ($sub == "kedvenc") {
    $sql = "SELECT * FROM hamburgerek WHERE kedvenc = 1";
}

$result = $mysqli->query($sql);

function checkHeart($heart)
{
    if ($heart == "0") {
        return "";
    } else {
        return " filled";
    }
}


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='$row[id]'>" .
            "<td class='editrow'>"
            . '<i class="fas fa-heart fa-lg heart' . checkHeart($row['kedvenc']) . '">' . "</i>"
            . '<i class="fas fa-pencil-alt fa-lg" ' . 'onclick="edit('
            . "'" . $row['nev'] . "',"   //Paraméter név
            . "'" . $row['sajt'] . "',"
            . "'" . $row['bacon'] . "',"
            . "'" . $row['huspogacsa'] . "',"
            . "'" . $row['feltetek'] . "',"
            . "'" . $row['ar'] . "',"
            . ')">' . "</i></td>" .
            "<td>$row[nev]</td>" .
            "<td>" . duplaTripla($row['sajt']) . "</td>" .
            "<td>" . duplaTripla($row['bacon']) . "</td>" .
            "<td>" . duplaTripla($row['huspogacsa']) . "</td>" .
            "<td>" .
            str_replace(";", ", ", $row['feltetek'])
            . "</td>" .
            "<td>$row[ar]</td>" .
            "</tr>";
    }
} else {
    echo "0 eredmény";
}
$mysqli->close();
ob_end_flush();
