<?php



require_once "classes/Database.php";

/*$host = "127.0.0.1";
$user = "root";
$pw = "";
$database = "Hangman"; -----------> brauche ich eigentlich nicht da ich das schon im Standard Konstruktor habe, oder?*/

$db = new Database(/*$host, $database, $user, $pw*/);//hier die gleich vermutung wie oben, falls ich eine andere Datenbank ansprechen will übergebe ich die Werte den Konstruktor

session_start();

if(isset($_POST['login']))
{
    $username=mysqli_escape_string($db, $_POST['nickname']); //injectionsicherheit
    //$password=$_POST['password'];
    $password = mysqli_escape_string($db, ($_POST['password']));

    $hash = hash('sha256', $password); //verschlüsselung

    $query = "select * from user where nickname='$username' and password='$hash' ";
    //echo $query;



    $query_run = $db->query($query);
    //echo mysql_num_rows($query_run);
    if($query_run)
    {


        if($db->numRows($query_run)>0) //wenn mehr als 0 einträge vorhanden sind
        {

            //$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC); (glaube diese Zeile ist umsonst, kann keinen sinn erkennen, falls login probleme auftreten einfach einfügen)

            $_SESSION['name'] = $username;

            header( "Location: hangman.php");
            mysqli_close($db); //gibt es hierfür eine Methode? --> function __destruct()??

        }
        else
        {
            echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
        }
    }
    else
    {
        echo '<script type="text/javascript">alert("Database Error")</script>';
    }
}
else
{
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/textstyle.css">
    <script type="text/javascript" src="js/login.js"></script>



    <title>Login Page</title>

</head>
<body>

<div class="hit-the-floor"><h1>Hangman Wars!</h1></div>

<div class="login-page">

    <div class="form">
        <form action="index.php" method="post">

            <input type="text" placeholder="Nickname" name="nickname" required/>
            <input type="password" placeholder="Passwort" name="password" required/>
            <button class="btn btn-default" name="login" type="submit">Einloggen</button>
            <p class="message">Noch nicht registriert? <a href="register.php">Werde jetzt Mitglied</a></p>
        </form>
    </div>


    <br>
    <br><br>




</body>
</html>