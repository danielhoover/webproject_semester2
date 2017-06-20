<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
/**Einbinden von Datenbank via Datei db_newconnection.php **/

include "db_newconnection.php";
$ordiestring = "<p><strong>PHP Info: </strong>Abfrage war nicht möglich.</p>";

?>

<?php
$rankedlist = "SELECT p.nickname AS nickname,
                      s.score AS score
                      FROM `user` p
                      LEFT JOIN Scores s
                      ON p.userid = s.userid
                      ORDER BY s.score DESC
                      Limit 15";

$result = mysqli_query($tunnel,$rankedlist);

/**
  Fehlerausgabe falls die Ausgabe nicht funktioniert!
 **/


/**
if(!$result)
{
    echo mysqli_error($tunnel);
}
**/
echo "<h1>HIGHSCORE LIST</h1>";
//Ausgabe Name und Score
echo "<table class='table table-bordered'>";
echo "<td>","Th.","</td>";
echo "<td>","NICKNAME","</td>";
echo "<td>","SCORE","</td>";
$highscorenumber=1;
while($row2 = mysqli_fetch_object($result))
{
    echo "<tr>";
    echo "<td>",$highscorenumber++,"</td>";
    echo "<td>",$row2->nickname,"</td>";
    echo "<td>",$row2->score,"</td>";
    echo "</tr>";
}
echo "</table>";
?>
</html>


