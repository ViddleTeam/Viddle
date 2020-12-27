<?php
require_once('partials/navbar.php');
?>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Plik przekroczył limit rozmiaru</h5>
                </div>
                <div class="modal-body">
                    ("<?php echo $_POST["titlevid"] ?>") przekroczył limit rozmiaru pliku. 

                </div>
                <div class="modal-footer">
                    <a href="index.php"><button type="button" class="btn btn-primary" style="padding: 10px;">OK</button></a>
                </div>
            </div>
        </div>
    </div>
<?php
require_once('partials/footer.php');
?>
<script>
    $('#staticBackdrop').modal('show');
</script>
