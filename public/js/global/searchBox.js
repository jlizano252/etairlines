window.addEventListener('DOMContentLoaded', function (){
    window.addEventListener('hideDropdown', function() {
        let searchDropdown = document.querySelector('.search-dropdown-menu');
        if(searchDropdown) {
            searchDropdown.classList.remove('show');
        }
    })
})
