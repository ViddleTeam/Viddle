<?php

echo 'Proszę czekać...';

?>

<?php

session_start();

if($_SESSION['z1'] == true)
{
  require "danesql.php";
  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
  
  $uid = $_SESSION['uid'];

  $success = $connect->query("UPDATE viddle_users SET avatarname='x' WHERE uid='$uid'");
  
    $_SESSION['ac'] = true;
    header('location: acfinish.php');
  
                    
}
else
{
  header('location: index.php');
}



?>
