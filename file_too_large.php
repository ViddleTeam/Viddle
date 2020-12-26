<?php
require_once('partials/navbar.php');
?>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Wybrany plik jest zbyt duży</h5>
                </div>
                <div class="modal-body">
                    Przepraszamy, ale wybrany plik ("<?php echo $_POST["titlevid"] ?>") jest zbyt duży, aby można było go wrzucić na Viddle. Możesz spróbować poniższych rozwiązań, aby móc go udostępnić:
                    <ul>
                        <li>Skompresować plik i udostępnić go na Viddle</li>
                        <li>Nagrać, albo zmontować go jeszcze raz, aby ważył mniej niż 10 MB.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <a href="index.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Powrót na stronę główną</button></a>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#staticBackdrop').modal('show');
</script>
<?php
require_once('partials/footer.php');
?>