//Progress Bar
const allProgress = document.querySelectorAll('main .h3card .h3progress');

allProgress.forEach(item => {
    item.style.setProperty('--value', item.dataset.value)
})