<?php
ob_start();
include 'connection.php';


if (isset($_GET['submit'])) {

    $hibaNev = "";
    $hibaOsszetevo = "";
    $siker = "";

    $nev = $mysqli->real_escape_string(trim($_GET['burgernev']));
    $zsemle = $mysqli->real_escape_string($_GET['zsemle']); //returns normal || szezam || teljes
    $sajt = $_GET['dbSajt'];
    $bacon = $_GET['dbBacon'];
    $hus = $_GET['dbHus'];
    $osszeg = $_GET['osszeg'];

    $valasztott_feltetek = array();
    $feltetek = array('hagyma', 'salata', 'feta', 'paradicsom', 'uborka', 'tojas', 'jalapeno', 'ketchup', 'majonez', 'BBQ', 'chilis', 'mustar', 'hasab', 'hagymakarika', 'kaviar', 'sonka');



    for ($i = 0; $i < count($feltetek); $i++) {
        $j = $feltetek[$i];
        if (isset($_GET[$j])) {
            array_push($valasztott_feltetek, $j);
        }
    }

    if (isset($nev)) {
        if (empty($nev)) {

            $hibaNev = "Nem adtál nevet a hamburgerednek!";
            header("Location: index.php?hibaNev=$hibaNev");
        }
    }



    if (empty($hibaNev)) {
        $siker = "Sikeres Feltöltés";
        $valasztott_feltetek = implode(";", $valasztott_feltetek); // majonez;ketchup;hagyma

        $sql = "INSERT INTO hamburgerek (nev, sajt, bacon, huspogacsa, feltetek, ar) VALUES ('$nev','$sajt','$bacon','$hus','$valasztott_feltetek','$osszeg')";

        if ($mysqli->query($sql) === TRUE) {
            header("Location: index.php?siker=$siker");
        } else {
            echo "Hiba: " . $sql . "<br>" . $mysqli->error;
        }

        $mysqli->close();
    }
    ob_end_flush();
}
