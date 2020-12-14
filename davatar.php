<?php

echo 'prosze czekać ...';

?>

<?php

session_start();

if($_SESSION['uid'] == true)
{
  require "danesql.php";
  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
  
  $uid = $_SESSION['uid'];

  $success = $connect->query("UPDATE viddle_users SET avatarname='x' WHERE id='$uid'");
  
    $_SESSION['ac'] = true;
    header('location: acfinish.php');
  
                    
}
else
{
  header('location: index.php');
}



?>
