
<form action="" method="POST">
Wpisz Markę Pojazdu:<input type="text" name="marka" required><br>
Wpisz Model Pojazdu:<input type="text" name="model" required><br>
Wpisz VIN Pojazdu:<input type="text" name="vin" required><br>
Wpisz Rok Produkcji:<input type="text" name="rokProd" required><br>
Zaznacz kolor nadwozia:<br/>
    Czerwony:<input type="radio" name="kolor" value="Czerwony" checked/>
    Srebrny:<input type="radio" name="kolor" value="Srebrny"/>
    Niebieski:<input type="radio" name="kolor" value="Niebieski"/>
    Szary:<input type="radio" name="kolor" value="Szary"/>
    Bialy:<input type="radio" name="kolor" value="Bialy"/>
    Czarny:<input type="radio" name="kolor" value="Czarny"/>
    Zielony:<input type="radio" name="kolor" value="Zielony"/>
    Burgundowy:<input type="radio" name="kolor" value="Burgundowy"/><br>
Metalic: 
    <input type="checkbox" name="metalic" value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;<br>
Wpisz Opis Pojazdu:<input type="text" name="opis" required><br>
Wpisz Właściciela Pojazdu:<input type="number" step="1" min="1" max="2137"  name="fk" required><br>


</form>

<?php
$serwer='localhost';
$user='root';
$pass='';
$baza = 'autokomis';

if(array_key_exists('marka',$_POST)){$marka = $_POST(['marka'];)}
if(array_key_exists('model',$_POST)){$model = $_POST(['model'];)}
if(array_key_exists('vin',$_POST)){$vin = $_POST(['vin'];)}
if(array_key_exists('rokProd',$_POST)){$rokProd = $_POST(['rokProd'];)}
if(array_key_exists('kolor',$_POST)){$kolor = $_POST(['kolor'];)}
if(array_key_exists('metalic',$_POST)){$metalic = $_POST(['metalic'];)}
if(array_key_exists('opis',$_POST)){$opis = $_POST(['opis'];)}
if(array_key_exists('fk',$_POST)){$fk = $_POST(['fk'];)}
$con = mysqli_connect($serwer,$user,$pass,$baza);
if ($con)   echo "<br/>polaczono z baza <br/>".$baza;
 else echo "<br />blad polaczenia z baza";

$q_all = "SELECT * FROM `auto`";
$res_all = mysqli_query($con, $q_all);
$dodaj = "INSERT INTO 'auto' VALUES ('','','','','','','','')"
echo "<table border=1>";
    echo"<tr><td>MARKA</td><td>MODEL</td><td>ROK PROD</td><td>KOLOR</td><td>METALIC</td></tr>";
    while($td = mysqli_fetch_assoc($res_all))
        echo"<tr> <td>". $td['marka']."</td><td>".$td['model']."</td><td>".
                          $td['rok']."</td><td>".$td['kolor']."</td><td>".($td['metalic'] ? 'TAK' : 'NIE')."</td></tr>";
    echo "</table>";

mysqli_close($con);
?>