//
window.addEventListener('load', function(){
    let menu = document.querySelector('#ivetc-menu');
    if( menu ) {
        let body = document.querySelector('#page-body');
        window.addEventListener('scroll', function() {
            changeMenu();
        });
    }

    function changeMenu() {
        if( window.scrollY > 50 ) {
            menu.classList.add('shadow-menu');
        }else {
            menu.classList.remove('shadow-menu');
        }
    }
});
