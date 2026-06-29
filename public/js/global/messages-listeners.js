//Messages...
window.addEventListener('load', function() {
    window.addEventListener('success-message', event => {
        let successMessage = document.querySelector('#success-message');
        let textMessage = document.querySelector('#textMessage');
        //
        if( successMessage ) {
            textMessage.innerHTML = event.detail.message;
            successMessage.classList.remove('d-none');
            setTimeout(function(){
                successMessage.classList.add('d-none');
            }, 4000);
        }
    });
    window.addEventListener('error-message', event => {
        let errorMessage = document.querySelector('#error-message');
        let errorTextMessage = document.querySelector('#errorTextMessage');
        //
        if( errorMessage ) {
            errorTextMessage.innerHTML = event.detail.message;
            errorMessage.classList.remove('d-none');
            setTimeout(function(){
                errorMessage.classList.add('d-none');
            }, 4000);
        }
    });
})
