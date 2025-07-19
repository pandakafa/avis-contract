 <?php
include "ez_sql_core.php";
include "ez_sql_pdo.php";

//veritaban覺 bilgileri
$db_host="localhost";
$db_name="kiralama_panel";
$db_user="kiralama_panel";
$db_pass="19051905@a";
//veritaban覺 bilgileri son

$db = new ezSQL_pdo("mysql:host=$db_host;dbname=$db_name", "$db_user", "$db_pass") or die (mysql_error());
$db->query("SET NAMES 'utf8'");



include "function.php";

