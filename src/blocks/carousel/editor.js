import './editor.scss';
import Swiper, {
	Navigation,
	Pagination,
	A11y,
	Keyboard,
	Lazy,
	Thumbs,
} from 'swiper';

// Make sure everything is loaded first.
if (
	( 'complete' === document.readyState ||
		'loading' !== document.readyState ) &&
	! document.documentElement.doScroll
) {
	demchcoCarousel();
} else {
	document.addEventListener( 'DOMContentLoaded', demchcoCarousel );
}

/**
 * Start Carousel function
 */
function demchcoCarousel() {

	const carouselWrap = document.querySelectorAll( '.carousel-wrap' );

	if ( carouselWrap.length ) {
		carouselWrap.forEach( ( carousel ) => {
			const galleryThumbs = new Swiper(
				carousel.querySelector( '.gallery-slider-bottom' ),
				{
					modules: [
						Navigation,
						Pagination,
						A11y,
						Keyboard,
						Lazy,
						Thumbs,
					],
					spaceBetween: 10,
					slidesPerView: 3,
					touchRatio: 0.2,
					slideToClickedSlide: true,
					height: 'auto',
					a11y: true,
					lazy: true,
          preloadImages: false,
          keyboard: true,
				}
			);

			const galleryTop = new Swiper(
				carousel.querySelector( '.gallery-slider-top' ),
				{
					modules: [
						Navigation,
						Pagination,
						A11y,
						Keyboard,
						Lazy,
						Thumbs,
					],
					spaceBetween: 10,
					slidesPerView: 1,
					navigation: {
						nextEl: carousel.querySelector( '.slider-button-next' ),
						prevEl: carousel.querySelector( '.slider-button-prev' ),
					},
					pagination: {
						el: carousel.querySelector( '.slider-pagination' ),
						type: 'fraction',
					},
					loop: true,
					thumbs: {
						swiper: galleryThumbs,
						slideThumbActiveClass: 'slide-active',
					},
					a11y: true,
					lazy: true,
          preloadImages: false,
          keyboard: true,
				}
			);
		} );

		// lightGallery( document.getElementById( "gallery-slider-top" ), {
		//   selector: ".swiper-slide.gallery-slider-top__item",
		// } );
	}
}
