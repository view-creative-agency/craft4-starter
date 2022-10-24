"use strict";
// https://css-tricks.com/how-to-animate-the-details-element-using-waapi/

// <details open>
//   <summary>clickable element</summary>
//   <div class="content">
//     ...
//   </div>
// </details>

class Accordion {
	constructor(el) {
		this.el          = el;                            // Store the <details> element
		this.summary     = el.querySelector('summary');   // Store the <summary> element
		this.content     = el.querySelector('.content');  // Store the <div class="content"> element
		this.animation   = null;                          // Store the animation object (so we can cancel it if needed)
		this.isClosing   = false;                         // Store if the element is closing
		this.isExpanding = false;                         // Store if the element is expanding

		this.summary.addEventListener('click', (e) => this.onClick(e)); // Detect user clicks on the summary element
	}

	onClick(e) {
		e.preventDefault(); // Stop default behaviour from the browser
		this.el.style.overflow = 'hidden'; // Add an overflow on the <details> to avoid content overflowing

		if (this.isClosing || !this.el.open) { // Check if the element is being closed or is already closed
			this.open();
		} else if (this.isExpanding || this.el.open) { // Check if the element is being openned or is already open
			this.shrink();
		}
	}

	shrink() {
		this.isClosing = true; // Set the element as "being closed"

		const startHeight = `${this.el.offsetHeight}px`;       // Store the current height of the element
		const endHeight   = `${this.summary.offsetHeight}px`;  // Calculate the height of the summary

		if (this.animation) { // If there is already an animation running
			this.animation.cancel(); // Cancel the current animation
		}

		this.animation = this.el.animate({ // Start a WAAPI animation
			height: [startHeight, endHeight] // Set the keyframes from the startHeight to endHeight
		}, {
			duration: 400,
			easing: 'ease-out'
		});

		this.animation.onfinish = () => this.onAnimationFinish(false);  // When the animation is complete, call onAnimationFinish()
		this.animation.oncancel = () => this.isClosing = false;         // If the animation is cancelled, isClosing variable is set to false
	}

	open() {
		this.el.style.height = `${this.el.offsetHeight}px`;  // Apply a fixed height on the element
		this.el.open         = true;                         // Force the [open] attribute on the details element

		window.requestAnimationFrame(() => this.expand());   // Wait for the next frame to call the expand function
	}

	expand() {
		this.isExpanding = true;                                                                // Set the element as "being expanding"
		const startHeight      = `${this.el.offsetHeight}px`;                                   // Get the current fixed height of the element
		const endHeight        = `${this.summary.offsetHeight + this.content.offsetHeight}px`;  // Calculate the open height of the element (summary height + content height)

		if (this.animation) { // If there is already an animation running
			this.animation.cancel(); // Cancel the current animation
		}

		this.animation = this.el.animate({ // Start a WAAPI animation
			height: [startHeight, endHeight] // Set the keyframes from the startHeight to endHeight
		}, {
			duration: 300,
			easing: 'ease-out'
		});

		this.animation.onfinish = () => this.onAnimationFinish(true);  // When the animation is complete, call onAnimationFinish()
		this.animation.oncancel = () => this.isExpanding = false;      // If the animation is cancelled, isExpanding variable is set to false
	}

	onAnimationFinish(open) {
		this.el.open         = open;                         // Set the open attribute based on the parameter
		this.animation       = null;                         // Clear the stored animation
		this.isClosing       = false;                        // Reset isClosing
		this.isExpanding     = false;                        // Reset isExpanding
		this.el.style.height = this.el.style.overflow = '';  // Remove the overflow hidden and the fixed height
	}
}

document.querySelectorAll('details').forEach((el) => {
	new Accordion(el);
});