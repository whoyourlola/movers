const allDropdown = document.querySelectorAll('#h3sidebar .h3side-dropdown');

allDropdown.forEach(item=> {
    const a = item.parentElement.querySelector('a:first-child');
    a.addEventListener('click', function (e) {
        e.preventDefault();

        this.classList.toggle('h3active');
        item.classList.toggle('show');
    })
})