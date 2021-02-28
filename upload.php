<?php
session_start(); 
if($_SESSION['emailver'] == '0') {
    header('location: index.php');
    exit();
}

$title = "Udostępnianie filmów";
require_once ('partials/navbar.php');
?>
<div class="container" style="margin-top:30px;">
    <div class="row">
        <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na Viddle</h4>
            <p style="color: white; margin-bottom: 20px;">Krok 1/2: Wybierz film do udostępnienia</p>
        </div>
    </div>
    <div class="tile" style="margin: auto;">
        <div class="card-upload border border-white;" style="margin: auto; width: 100%; height: auto;">
            <div class="card-body">
                <p style="align-items: center; color: white;">
                    <center>
                        <h2 style="color: white;">Wybierz plik wideo z komputera/telefonu</h2>
                <p style="color: white;">Maksymalny dozwolony rozmiar na jeden film wynosi 1 GB. Chcesz się dowiedzieć, ile dany film może ważyć? Użyj <a href="https://toolstud.io/video/filesize.php?">tego narzędzia.</a></p>
                <p style="color: white; font-weight: bold; margin-top: -10px;">Pamiętaj, że administracja Viddle ma pełne prawo do usunięcia filmu, jeżeli narusza on prawa autorskie i/lub regulamin.</p>
                    <form action="/post.php" method="post" enctype="multipart/form-data">
                    <input type="file" accept="video/mp4, video/mov, video/webm, video/x-ms-wmv, video/3gpp" name="videovid" style="color: white; margin-top: 5px;" />
                    </center>
                    </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="tile-before" style="color:white; margin-top: 40px;"><br></h4>
            <p style="color: white; margin-bottom: 10px;">Krok 2/2: Nadaj nazwę filmowi oraz dodaj opis</p>
        </div>
    </div>
    <div class="container row" style="width: auto; color: white;">
        <div class="form-row" style="justify-content: center;">
            <div class="col-md-12">
                <div class="md-form form-group" style="width: 100%;">
                    <input type="text" style="color: white;" name="titlevid" maxlength="52" class="form-control" id="inputEmail4MD">
                    <label for="inputEmail4MD" style="color: white;">Tytuł filmu</label>
                </div>
            </div>
            <label for="inputEmail4MD" style="color: white;">Maksymalna ilość znaków w tytule to 52.</label>
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form form-group" style="width: 100%;">
                        <textarea id="form7" name="descvid" class="md-textarea form-control" rows="4" maxlength="1024" cols="137" style="color: white; width: 100%; resize: none; margin-top: -10px;"></textarea>
                        <label for="form7" style="color: white;">Opis filmu</label>
                    </div>
                </div>
            </div>
            <label for="inputEmail4MD" style="color: white;">Maksymalna ilość znaków w opisie to 1024.</label>
            <input type="file" accept="image/png, image/jpg, image/bmp, image/jpeg" name="miniaturka" style="color: white; margin-top: 5px;" />
            <div style="justify-content: center;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
            </div>
        </div>
        <center>
            <!-- PROSZE NIE DODAWAC class="btn btn-success" TYMCZASOWO, DZIEKI - lort533 -->
            <input type="submit" value="Rozpocznij przesyłanie">
        </center>
        </form>
    </div>
</div>
</div>
<?php
require_once ('partials/footer.php');
?>

<!-- modal dla niezalogowanych -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Musisz się zalogować, żeby skorzystać z tej funkcji.</h5>
            </div>
            <div class="modal-body">
                Zarejestrowani użytkownicy mogą udostępniać filmy, oddawać głosy, czy pisać komentarze i nie tylko. Zaloguj się, lub zarejestruj, żeby móc skorzystać z tej funkcji.
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-secondary" style="padding: 10px;">Powrót na stronę główną</button></a>
                <a href="login.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Zaloguj się</button></a>
            </div>
        </div>
    </div>
</div>
<script src="script.js"></script>
<?php
require_once ('partials/footer.php');
if ($_SESSION['z1'] == false) {
    echo "<script>$('#staticBackdrop').modal('show');</script>";
}
?>

<div class="hiddendiv common"></div></body></html>
