<?php

echo 'prosze czekać ...';

?>

<?php

session_start();

if($_SESSION['uid'] == true)
{
  require "danesql.php";
  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

  $success = $connect->query("UPDATE viddle_users SET avatarname='x' WHERE id='$_SESSION['uid']'");
  
  if ($success) 
  {
    $_SESSION['ac'] = true;
    header('location: acfinish.php');
  }
                    
}
else
{
  header('location: index.php');
}



?>
