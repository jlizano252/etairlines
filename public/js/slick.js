// slick...
window.addEventListener( 'load', function() {
    let committee = $('.members');
    if( committee ) {
        committee.slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: false,
            variableWidth: true,
            autoplay: true,
            autoplaySpeed: 4000,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    centerMode: true,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },{
                breakpoint: 992,
                settings: {
                    arrows: false,
                    variableWidth: true,
                    centerMode: true,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    variableWidth: true,
                    centerMode: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            }]
        });
    }
})
