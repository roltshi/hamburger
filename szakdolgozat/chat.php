<?php
ob_start();
include 'connection.php';

if (isset($_GET['submitchat'])) {

    $nev = $mysqli->real_escape_string(trim($_GET['felhasznalonev']));
    $msg = $mysqli->real_escape_string(strip_tags(trim($_GET['msg'])));


    if (empty($nev)) {
        $hibaFelNev = "Kérlek írd be a neved!";
        header("Location: index.php?hibaFelNev=$hibaFelNev");
    }

    if (strlen($nev) > 18) {
        $hibaFelNev = "Túl hosszú a név!";
        header("Location: index.php?hibaFelNev=$hibaFelNev");
    }

    if (strlen($msg) > 2000) {
        $hibaFelNev = "Túl hosszú az üzenet!";
        header("Location: index.php?hibaFelNev=$hibaFelNev");
    }
    if (strlen($msg) <= 0) {
        $hibaFelNev = "Túl rövid az üzenet!";
        header("Location: index.php?hibaFelNev=$hibaFelNev");
    }

    if (empty($hibaFelNev)) {
        $siker = "Hozzászólás sikeresen elküldve!";

        $sql = "INSERT INTO chat (felhasznalonev, msg) VALUES ('$nev','$msg')";

        if ($mysqli->query($sql) === TRUE) {
            header("Location: index.php?siker=$siker");
        } else {
            echo "Hiba: " . $sql . "<br>" . $mysqli->error;
        }

        $mysqli->close();
    }
}
ob_end_flush();
