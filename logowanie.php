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
        Login:<input type="text" name="login" required><br>
        Hasło:<input type="text" name="haslo" required><br>
<?php
$users = "SELECT COUNT(*) FROM `users` where login like 'aaa' and haslo LIKE 'kkk'";
$ile=mysqli_query($con, $users);
$wiersz = mysqli_fetch_row($ile);
    $ile_znaleziono = $wiersz[0];
    if($ile_znaleziono>0) echo "zalgowano
    <a href='index.php'> ZALOGOWANO - KLIKNIJ </a>";
    else echo "Podano błędny login lub hasło - spróbuj ponownie!";

setcookie("user", "Marian", time()+3600);
setcookie("haslo", "jegoHaslo ", time()+3600);
echo $_COOKIE['user'];
echo $_COOKIE['haslo'];
setcookie("user", "", time());
setcookie("haslo", "", time());
setcookie("test_cookie", "test" , time() + 3600, '/');
if(count($_COOKIE) > 0) 	echo "Cookies są włączone"; 
else 	echo "Cookies są wyłączone.";

                                     













mysqli_close($con);
?>
</form>
</body>
</html>