import '@splidejs/splide/css';
import Splide from '@splidejs/splide';

let elements = document.getElementsByClassName( 'splide',{
});

for ( let i = 0; i < elements.length; i++ ) {
    new Splide( elements[ i ] ).mount();
}


let splide = new Splide("#main-slider", {
    width: 700,
    height: 450,
    pagination: false,
    cover: true,
});

splide.mount();
