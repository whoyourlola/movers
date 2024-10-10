//sidebar dropdown menu
const allDropdown = document.querySelectorAll('#h3sidebar .h3side-dropdown');

allDropdown.forEach(item=> {
    const a = item.parentElement.querySelector('a:first-child');
    a.addEventListener('click', function (e) {
        e.preventDefault();

        if(!this.classList.contains('h3side-active')){
            allDropdown.forEach(i=> {
                const aLink = i.parentElement.querySelector('a:first-child');

                aLink.classList.remove('h3side-active');
                i.classList.remove('show');
            })
        }

        this.classList.toggle('h3side-active');
        item.classList.toggle('show');
    })
})


//profile dropdown menu
const profile = document.querySelector('nav .h3profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.h3profile-link');

imgProfile.addEventListener('click', function () {
    dropdownProfile.classList.toggle('show');
})


window.addEventListener('click', function (e) {
    if (e.target !== imgProfile) {
        if (e.target !== dropdownProfile){
            if(dropdownProfile.classList.contains('show')) {
                dropdownProfile.classList.remove('show');
            }
        }
    }
})