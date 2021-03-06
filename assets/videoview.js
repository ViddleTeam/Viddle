function editVideoInfo() {
    let title = document.getElementById("videoName");
    let alert = document.getElementById("titleBlank");
    if (title.length <= 2) {
        return alert.innerHTML = '<div class="alert alert-warning" role="alert">Tytuł filmu powinien składać się z przynajmniej 2 znaków.</div>';
    } else {
        alert.innerHTML = '';
    }
}