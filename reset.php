<?php

$id = $_GET['id'];

 require "danesql.php";
 $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_passreset WHERE rid='%s'",
		    mysqli_real_escape_string($connect,$id))))

$d2 = $result->num_rows;

if($d2 == '1')
{
     
      
  


?>

<?php
  
if($d2 == '0')
{ ?>
  
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Błąd</h5>
            </div>
            <div class="modal-body">
                Link w który weszedłeś został już użyty do odzyskania hasła lub jest niepoprawny. Jeśli wpisywałeś go ręcznie, upewnij się że jest poprawny.
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Powrót na stronę główną</button></a>
            </div>
        </div>
    </div>
</div>
<?php }
?>
