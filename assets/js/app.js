function loadPage(page) {
    $('#content-area').html('Loading...');
    $('#content-area').load('pages/' + page + '.php');
}

$(document).ready(function () {
    loadPage('dashboard'); // default view
});
