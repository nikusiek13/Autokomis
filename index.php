<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$serwer='localhost';
$user='root';
$pass='';
$baza = 'autokomis';


$con = mysqli_connect($serwer,$user,$pass,$baza);
if ($con)   echo "<br/>polaczono z baza <br/>".$baza;
 else echo "<br />blad polaczenia z baza";

$q_all = "SELECT * FROM `auto`";
$res_all = mysqli_query($con, $q_all);

?>
<form action="" method="POST">
    <h2>AUTOKOMIS ZSP1 JAROCIN ZAPRASZA</h2>
    jakiego auta szukasz?<br />
    -wybierz z listy marka:
    <?php
    $q_marka="SELECT DISTINCT(marka) FROM `auto`";
    $res_marka=mysqli_query($con,$q_marka);
    echo '<select name="marka">';
    echo '<option value="Wszystkie" selected>'.'Wybierz'.'</option>';
        while($option = mysqli_fetch_assoc($res_marka))
            echo '<option value="'.$option['marka'].'">'.$option['marka'].'</option>';
    echo '</select>';
    $q_model="SELECT DISTINCT(model) FROM `auto`";
    $res_model=mysqli_query($con,$q_model);


    echo "<br> Wpisz model: ";
    echo '<input type="text" size="12" name="model">';

    ?>
<br/><br/>

- zaznacz kolor nadwozia:<br/>
    Czerwony:<input type="checkbox" name="kolor[]" value="Czerwony"/>
    Srebrny:<input type="checkbox" name="kolor[]" value="Srebrny"/>
    Niebieski:<input type="checkbox" name="kolor[]" value="Niebieski"/>
    Szary:<input type="checkbox" name="kolor[]" value="Szary"/>
    Bialy:<input type="checkbox" name="kolor[]" value="Bialy"/>
    Czarny:<input type="checkbox" name="kolor[]" value="Czarny"/>
    Zielony:<input type="checkbox" name="kolor[]" value="Zielony"/>
    Burgundowy:<input type="checkbox" name="kolor[]" value="Burgundowy"/>
<br/><br/>
- czy metalic: 
    <input type="radio" name="metalic" value="1"/>TAK &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="metalic" value="0" />NIE&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="metalic" value="" checked />bez znaczenia
<br/><br/>
- rok produkcji od: 
    <input type="date" name="rok_od" size="4" value="1990-01-01" required>
do:
    <input type="date" name="rok_do" size="4" value="2024-10-28" required>
<br/><br />
    <input type="submit" value="WYSZUKAJ">
    <input type="reset" value="CLEAR">
</form>


<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marka= $_POST['marka'];
    $model = $_POST['model'];
    if (array_key_exists('kolor',$_POST)) { $kolor = $_POST['kolor'];}
    $metalic = $_POST['metalic'];
    $rok_od = $_POST['rok_od'];
    $rok_do = $_POST['rok_do'];

    $q_marka2 = "SELECT * FROM `auto` WHERE 1"; 

    
    if ($marka == 'Wszystkie') {
        $q_marka2 .= " AND marka IS NOT NULL";
    }
    else {  
        $q_marka2 .= " AND marka = '$marka'";
    }
    if (!empty($model)) {
        $q_marka2 .= " AND model = '$model'";
    }
    if (array_key_exists('kolor',$_POST)) { 
        $q_marka2 .= " AND kolor IN ('".implode("','", $kolor)."')";
    } 
    
    if ($metalic !== '') { 
        $q_marka2 .= " AND metalic = '$metalic'";
    }
    if (!empty($rok_od) && !empty($rok_do)) {
        $q_marka2 .= " AND rok BETWEEN '$rok_od' AND '$rok_do'";
    }
    $res_dane=mysqli_query($con,$q_marka2);

    echo "<table border=1>";
    echo"<tr><td>MARKA</td><td>MODEL</td><td>ROK PROD</td><td>KOLOR</td><td>METALIC</td></tr>";
    while($td = mysqli_fetch_assoc($res_dane))
        echo"<tr> <td>". $td['marka']."</td><td>".$td['model']."</td><td>".
                          $td['rok']."</td><td>".$td['kolor']."</td><td>".($td['metalic'] ? 'TAK' : 'NIE')."</td></tr>";
    echo "</table>";
} else {
    echo "<table border=1>";
    echo"<tr><td>MARKA</td><td>MODEL</td><td>ROK PROD</td><td>KOLOR</td><td>METALIC</td></tr>";
    while($td = mysqli_fetch_assoc($res_all))
        echo"<tr> <td>". $td['marka']."</td><td>".$td['model']."</td><td>".
                          $td['rok']."</td><td>".$td['kolor']."</td><td>".($td['metalic'] ? 'TAK' : 'NIE')."</td></tr>";
    echo "</table>";
}
mysqli_close($con);
?>
</form>
</body>
</html>