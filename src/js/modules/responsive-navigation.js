"use strict";

// NOTE TO SELF
// Found better example code to reference for improved a11y on drop menus...
// https://www.w3.org/TR/wai-aria-practices/examples/menubar/menubar-1/menubar-1.html
//
// More at
// https://www.w3.org/TR/wai-aria-practices/
// https://www.w3.org/TR/wai-aria-practices/examples/

function doMobileNavigation() {
	document.querySelector('html').classList.add('mobile-nav');

	// create the navigation toggle button
		let templateToggleNav = `
			<button id='mainNavToggle' aria-label="Main Menu">
				Toggle Main Navigation
			</button>
		`;
		document.querySelector('body').insertAdjacentHTML('afterbegin', templateToggleNav);
		let navToggle = document.querySelector('#mainNavToggle');

	// Accessilbity enhancements for the dynamic toggling control
		let theMenu = document.querySelector('#site_navigation');
		theMenu.setAttribute("aria-labelledby", "mainNavToggle");

	// handle clicks on the menu toggle button
		navToggle.addEventListener("click", function (e) {
			let newNavStatus;
			let navIsOpen = document.querySelector('html').classList.contains("nav-active"); // returns true|false
			newNavStatus  = !navIsOpen; // inverts the value
			navToggle.setAttribute("aria-expanded", newNavStatus); // applies new value

			document.querySelector('html').classList.toggle("nav-active");
		});

	// handle keyboard focussing inside the nav
	// NOTE: this could be done in CSS with :focus-within, but then you lose ARIA status updates
		document.querySelector('.site_context').addEventListener('focusin', function(e){
			navToggle.setAttribute("aria-expanded", 'true');
			document.querySelector('html').classList.add("nav-active");
		});
		document.querySelector('.site_context').addEventListener('focusout', function(e){
			navToggle.setAttribute("aria-expanded", 'false');
			document.querySelector('html').classList.remove("nav-active");
		});
}

function undoMobileNavigation() {
	document.querySelector('html').classList.remove('mobile-nav');

	let navMenuToggle = document.querySelector('#mainNavToggle');
	if( navMenuToggle ) {
		document.querySelector('html').classList.remove("nav-active");
		document.querySelector('#mainNavToggle').remove();
		document.querySelector('#site_navigation').removeAttribute('aria-labelledby');
	}
}

let screenWidth = window.matchMedia('(max-width: 680px)');

// initial load
if( screenWidth.matches ) {
	doMobileNavigation();
} else {
	undoMobileNavigation();
}

// watch for changes in window size
screenWidth.addEventListener("change", (e) => {
	if( e.matches ) {
		doMobileNavigation();
	} else {
		undoMobileNavigation();
	}
});