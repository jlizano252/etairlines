// Preloader...
window.addEventListener( 'load', function() {
    let preloader = document.querySelector('#preloader');
    if( preloader ){
        preloader.classList.add('hide-element')
        setTimeout( function() {
            preloader.classList.add( 'd-none' );
        }, 1500);
    }
})
