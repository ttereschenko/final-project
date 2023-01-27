import '@splidejs/splide/css';
import Splide from '@splidejs/splide';

let elements = document.getElementsByClassName( 'splide',{
    arrowPath: 'm15.5 0.932-4.3 4.38...',
    classes: {
        pagination: 'splide__pagination ',
        prev  : 'splide__arrow--prev carousel-control-prev carousel-control-prev-icon',
        next  : 'splide__arrow--next carousel-control-next carousel-control-next-icon',
    }
});

for ( let i = 0; i < elements.length; i++ ) {
    new Splide( elements[ i ] ).mount();
}

document.addEventListener( 'DOMContentLoaded', function () {
    new Splide( '#image-carousel', {
        heightRatio: 0.5,
        arrowPath: 'm15.5 0.932-4.3 4.38...',
        classes: {
            pagination: 'splide__pagination ',
            prev  : 'splide__arrow--prev carousel-control-prev carousel-control-prev-icon',
            next  : 'splide__arrow--next carousel-control-next carousel-control-next-icon',
        }
    } ).mount();
} );
