import FetchWrapper from './fetch-wrapper.js';
const API = new FetchWrapper( window.origin );

// To use this, you'll need to add a button to any entry you want saveable:
// <button
// 	role="button"
// 	data-save-button
// 	data-entry-id="{{ entry.id }}"
// >
// 	Save
// </button>
//
// You'll also need to add the JS and CSS to any page that needs it:
// {{ craft.vite.script('src/js/modules/saved-entries.js', false) }}
//
// In the screen.pcss file:
// @import "components/saved-entries.pcss";

function initialiseSaveButtons() { // Sets the state etc for all save buttons on the page
	const saveButtons   = document.querySelectorAll('button[data-save-button]');
	let   savedEntryIds = [];

	if ( localStorage.getItem('savedEntryIds') ) {
		savedEntryIds = JSON.parse( localStorage.getItem('savedEntryIds') );
	}

	saveButtons.forEach(saveButton => {
		if(!saveButton.dataset.entryId) {
			console.error(`Button is missing a data-entry-id parameter value`);
			return null;
		}

		console.log({savedEntryIds, saveButton});

		if (savedEntryIds.includes( saveButton.dataset.entryId )) {
			// The button we're looking at already has its associated entry in localStorage
			saveButton.dataset.state = 'saved';
			saveButton.setAttribute('aria-label', 'Un-save this');
		} else {
			saveButton.dataset.state = null;
			saveButton.setAttribute('aria-label', 'Save this');
		}

		saveButton.addEventListener('click', handleSaveButtonClick);
	});
}

function handleSaveButtonClick( event ) { // Hand off to the correct action function when clicked
	const clickedButton = event.currentTarget;

	if(!clickedButton.dataset.state || !clickedButton.dataset.entryId) {
		console.error( `Button missing required data attributes` );
		return false;
	}

	if (clickedButton.dataset.state === 'saved') {
		unsave( clickedButton );
	} else {
		save( clickedButton );
	}

	// The state has changed, so lets refresh the drawer contents
	console.log('please repopulate...')
	populateMySavedDrawer();
}

function save( clickedButton ) { // Do what we need when a button is clicked to store a "save/like"
	// we know the button has the attributes we need as the handleSaveClick function has enforced that
	const candidateEntryId = clickedButton.dataset.entryId;
	let savedEntries = [];

	if ( localStorage.getItem('savedEntryIds') ) {
		savedEntries = JSON.parse( localStorage.getItem('savedEntryIds') );
	}

	if( savedEntries.includes( candidateEntryId ) ) {
		console.error(`Entry is already saved`);
		return false;
	}

	savedEntries.push( candidateEntryId );
	localStorage.setItem('savedEntryIds', JSON.stringify( savedEntries) );

	clickedButton.dataset.state = 'saved';
	clickedButton.setAttribute('aria-label', `Remove from saved`);
	// clickedButton.textContent = 'Un-Save';

	localStorage.setItem('mySavedEntriesStatus', 'stale');
}

function unsave( clickedButton ) { // Do what we need when a button is clicked to remove a "like"
	// we know the button has the attributes we need as the handleLikeClick function has enforced that
	const candidateEntryId = clickedButton.dataset.entryId;
	let savedEntries = [];

	if ( localStorage.getItem('savedEntryIds') ) {
		savedEntries = JSON.parse( localStorage.getItem('savedEntryIds') );
	}

	if( ! savedEntries.includes( candidateEntryId ) ) {
		console.error(`Entry is not in the saved list`);
		return false;
	}

	savedEntries.splice( savedEntries.indexOf( candidateEntryId ), 1 );
	localStorage.setItem('savedEntryIds', JSON.stringify( savedEntries) );

	clickedButton.dataset.state = null;
	clickedButton.setAttribute('aria-label', `Add to saved`);
	// clickedButton.textContent = 'Save';

	let parent = clickedButton.closest('.cardListing');
	parent?.classList?.add('js-justRemoved');

	localStorage.setItem('mySavedEntriesStatus', 'stale');
}

function populateMySavedDrawer() {
	let entryIds = JSON.parse( localStorage.getItem('savedEntryIds') ).join(',');
	console.log(`/saved-entries?entryIds=${entryIds}`);

	if (!entryIds) {
		console.log('No entries in local storage');
		document.querySelector('#mySavedEntries .theSavedEntries').innerHTML = `<p>There are no saved items.</p>`;
		return;
	}

	API.getHtml(`/saved-entries?entryIds=${entryIds}`).then(response => {
		let responseAsDOM = document.createRange().createContextualFragment(response);
		document.querySelector('#mySavedEntries .theSavedEntries').replaceChildren(responseAsDOM);

		initialiseSaveButtons(); // Re-initialise, because the loaded content can itself have like buttons inside
		localStorage.setItem('mySavedEntriesStatus', 'fresh');
	});
}

function toggleMySavedDrawer() {
	let myFavRow = document.querySelector('#mySavedEntries');
	myFavRow.classList.toggle('active');
}

function initialiseMySavedDrawer() {
	// First, build and add the drawer to the mark-up
	const drawer = `
		<div id="mySavedEntries">
			<div class="l_constrain">
				<button type="button" class="toggleMySavedEntries">
					<span>
						<img src="/dist/images/x-white.svg" alt="Show Saved Items" />
					</span>
				</button>

				<div class="wrapper">
					<div class="theSavedEntries">
						<p>There are no saved items.</p>
					</div>
				</div>
			</div>
		</div>`;
	document.querySelector('body').insertAdjacentHTML('beforeend', drawer);

	const showHideToggles = document.querySelectorAll('button.toggleMySavedEntries');

	// as this is the initial load, ensure state management knows we have no items dynamically loaded into the drawer yet
	localStorage.setItem('mySavedEntriesStatus', 'stale');

	showHideToggles.forEach( toggle => {
		toggle.addEventListener('click', handleMySavedButtonClick);
	});
}

function handleMySavedButtonClick() {
	let savedEntries = [];

	if (localStorage.getItem('savedEntryIds')) {
		savedEntries = JSON.parse(localStorage.getItem('savedEntryIds'));
	}

	if (
		savedEntries.length > 0
		&&
		localStorage.getItem('mySavedEntriesStatus') !== 'fresh'
	) {
		console.log('You have items saved, but they need to be loaded via fetch');

		// Replace default drawer message with "Loading message"
		document.querySelector('#mySavedEntries .theSavedEntries').innerHTML = `<p>Loading</p>`;

		populateMySavedDrawer();
		toggleMySavedDrawer();
	} else {
		console.log('just show/hide whatever content is in the div at the moment');

		toggleMySavedDrawer();
	}
}

initialiseMySavedDrawer(); // create the panel full of saved items
initialiseSaveButtons(); // the heart toggles on various Entry listing items
