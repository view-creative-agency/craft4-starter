import FetchWrapper from './fetch-wrapper.js';
const thisWebsiteAPI = new FetchWrapper(`${window.location.protocol}//${window.location.host}` );

function interactionType() {
	let interactionType = 'mouseover';

	if( window.matchMedia('(hover: hover)') ) { // desktop
		interactionType = 'mouseover'; }
	if( window.matchMedia('(hover: none) and (pointer: coarse)') ) { // touchscreen
		interactionType = 'click'; }
	if( window.matchMedia('(hover: none) and (pointer: fine)') ) { // stylus
		interactionType = 'click'; }
	if( window.matchMedia('(hover: hover) and (pointer: coarse)') ) { // Wii/Kinect/etc
		interactionType = 'mouseover'; }
	if( window.matchMedia('(hover: hover) and (pointer: fine)') ) { // mouse
		interactionType = 'mouseover'; }

	return interactionType;
}

// Add a class "js-scrolled" both on scroll and if the page is scrolled on load (e.g, on a refresh)
function windowHasScrolled() {
	const html = document.querySelector('html');

	if (window.pageYOffset > 0) {
		html.classList.add('js-scrolled');
	} else {
		html.classList.remove('js-scrolled');
	}
}

window.addEventListener('scroll', function() {
	windowHasScrolled();
});

windowHasScrolled();

// Enable animated "intro" on blocks
if(!!window.IntersectionObserver){
	document.querySelector('html').classList.add('js-supportsIntersectionObserver');

	let observer = new IntersectionObserver((watchList, observer) => {
		watchList.forEach(watchedElement => {
			if(watchedElement.isIntersecting){
				// console.log(watchedElement);

				watchedElement.target.classList.add('js-inViewport');
				observer.unobserve(watchedElement.target);
			}
		});
	}, {rootMargin: "0px 0px -20% 0px"});

	document.querySelectorAll('[data-scroll-reveal]').forEach(watchTarget => {
		observer.observe(watchTarget);
	});
}

// Indicate to users that Sprig forms are doing something when submitted
document.querySelectorAll('form[sprig]').forEach(sprigForm => {
	sprigForm.insertAdjacentHTML('beforeend', `
		<dialog class="modal sprigActionFeedback">
			<p>Please wait</p>
			<button>Close</button>
		</dialog>
	`);

	let dialog = sprigForm.querySelector('.sprigActionFeedback');

	dialog.querySelector('button').addEventListener('click', () => {
		dialog.close();
	});

	sprigForm.addEventListener('submit', () => {
		dialog.showModal();
	});
});

// popups
document.querySelectorAll('a.popup').forEach( popupLink => {
	popupLink.addEventListener('click', (e) => {
		e.preventDefault();
		let clickedLink = e.currentTarget;
		let parser = new DOMParser();
		clickedLink.classList.add('js-loading');

		thisWebsiteAPI.getHtml( clickedLink.getAttribute('href') ).then(response => {
			let responseAsDom = parser.parseFromString( response, "text/html" );
			let imageWeWant   = responseAsDom.querySelector('#ajaxcontent').outerHTML;
			let lightbox      = document.querySelector('#lightbox') ?? null;

			if( lightbox ) {
				document.querySelector('#lightbox .content').innerHTML = imageWeWant;
				lightbox.showModal();
				clickedLink.classList.remove('js-loading');
			} else {
				document.querySelector('body').insertAdjacentHTML('afterbegin', `
					<dialog id="lightbox">
						<div class="wrapper">
							<div class="content">
							${imageWeWant}
							</div>
							<form method="dialog">
								<button><img src="/dist/svg/x.svg" alt="Close"></button>
							</form>
						</div>
					</dialog>
				`);

				let lightbox = document.querySelector('#lightbox');
				lightbox.showModal();
				clickedLink.classList.remove('js-loading');
			}
		}).catch(error => {
			console.error( error );
		});

		console.log( clickedLink );
	})
})
