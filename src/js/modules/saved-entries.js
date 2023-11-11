import FetchWrapper from './fetch-wrapper.js';

const API = new FetchWrapper( window.origin );
const config = {
	'drawerLabelWhenClosed': 'Open Drawer',
	'drawerLabelWhenOpen':   'Close Drawer',
	'addToDrawerText':       'Save',
	'removeFromDrawerText':  'Remove',
};

/* USAGE
	In _layout uncomment:
		{{ craft.vite.script('src/js/modules/saved-entries.js', false) }}

	You'll need to add a button to any entry you want save-able:
		{% include '_partials/save-button.twig' with {
			theEntryId: entry.id
		} %}

	In the screen.pcss file load in the styles:
		@import "components/saved-entries.pcss";

	Ensure there's a Route in /config/routes.php
		'saved-entries' => ['template' => '_partials/saved-entries'],

	And double check /config/blitz.php is set to ignore the `saved-entries` URL
		'excludedUriPatterns' => [
			['siteId' => 2, 'uriPattern' => 'saved-entries']
		],
*/

/**
 * 1. Checks the clicked button has valid properties, or bails.
 * 2. Calls the correct function to perform a save/unsave.
 * 3. Ensures the contents of the "saved drawer" is updated.
 * @param {*} event - The browser's click event
 */
function handleSaveButtonClick( event ) {
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

	// The state has changed, so lets refresh the drawer contents.
	// We do this here because the drawer may be open already, and so need updating now
	populateMySavedDrawer();
}

/**
 * Performs a save action.
 * 1. Adds the EntryId of the clicked button to `localStorage`.
 * 2. Updates the clicked button's properties.
 * 3. Finds any duplicate buttons elsewhere and update those.
 * 4. Marks the loaded Drawer contents as stale.
 * @param {*} clickedButton - a DOM element that is the button which was clicked
 */
function save( clickedButton ) {
	// we know the button has the attributes we need because the handleSaveButtonClick function has enforced that already

	const candidateEntryId = clickedButton.dataset.entryId;
	let savedEntryIds = [];

	// Load in any existing savedEntryIds from localStorage
	if ( localStorage.getItem('savedEntryIds') ) {
		savedEntryIds = JSON.parse( localStorage.getItem('savedEntryIds') );
	}

	// Ensure we don't try to save something that's already saved (shouldn't happen, make sure it can't)
	if( savedEntryIds.includes( candidateEntryId ) ) {
		console.error(`Entry is already saved`);
		return false;
	}

	// add the clicked button's EntryID value to the savedEntryIds array
	savedEntryIds.push(candidateEntryId);

	// update localStorage with the new array of EntryIds
	localStorage.setItem('savedEntryIds', JSON.stringify( savedEntryIds ) );

	// Update the clicked button itself
	clickedButton.dataset.state = 'saved';
	clickedButton.querySelector('span').textContent = config.removeFromDrawerText;

	// There may be other buttons on the page for the same "entryId" which also need updating. Find and update any "duplicate" buttons.
	document.querySelectorAll(`button[data-entry-id='${candidateEntryId}'][data-state='null']`).forEach( otherButton => {
		otherButton.dataset.state = 'saved';
		otherButton.querySelector('span').textContent = config.removeFromDrawerText;
	});

	// set a flag in localStorage so that other functions know that the rendered contents of the Saved Entries pane is now stale, and will need to be refreshed before it's shown again.
	localStorage.setItem('mySavedEntriesPaneStatus', 'stale');
}

/**
 * Performs a remove/unsave action.
 * 1. Removes the EntryId of the clicked button from `localStorage`.
 * 2. Updates the clicked button's properties.
 * 3. Finds any duplicate buttons elsewhere and update those.
 * 4. Marks the loaded Drawer contents as stale.
 * @param {*} clickedButton - a DOM element that is the button which was clicked
 */
function unsave( clickedButton ) {
	// we know the button has the attributes we need because the handleSaveButtonClick function has enforced that already

	const candidateEntryId = clickedButton.dataset.entryId;
	let savedEntries = [];

	// Load in any existing savedEntryIds from localStorage
	if ( localStorage.getItem('savedEntryIds') ) {
		savedEntries = JSON.parse( localStorage.getItem('savedEntryIds') );
	}

	// Ensure we don't try to remove an EntryId that isn't actually saved
	if( ! savedEntries.includes( candidateEntryId ) ) {
		console.error(`Entry is not in the saved list`);
		return false;
	}

	// remove the clicked button's EntryID value to the savedEntryIds array
	savedEntries.splice(savedEntries.indexOf(candidateEntryId), 1);

	// update localStorage with the new array of EntryIds
	localStorage.setItem('savedEntryIds', JSON.stringify( savedEntries ) );

	// Update the clicked button itself
	clickedButton.dataset.state = 'null';
	clickedButton.querySelector('span').textContent = config.addToDrawerText;

	// There may be other buttons on the page for the same "entryId" which also need updating, e.g., if we are un-saving from inside the drawer and are on a URL for the Entry that's *in* the drawer. Find and update any "duplicate" buttons.
	document.querySelectorAll(`button[data-entry-id='${candidateEntryId}'][data-state='saved']`).forEach( otherButton => {
		otherButton.dataset.state = 'null';
		otherButton.querySelector('span').textContent = config.addToDrawerText;
	});

	// set a flag in localStorage so that other functions know that the rendered contents of the Saved Entries pane is now stale, and will need to be refreshed before it's shown again.
	localStorage.setItem('mySavedEntriesPaneStatus', 'stale');
}

/**
 * 1. Fetches fresh content for the Save drawer and replaces any existing content.
 * 2. Calls `initialiseSaveButtons()` so any buttons inside the Drawer are also initialised.
 * 3. Marks the loaded Drawer contents as fresh.
 */
function populateMySavedDrawer() {
	// get the saved EntryIds from localStorage
	let entryIds = JSON.parse( localStorage.getItem('savedEntryIds') ).join(',');

	if (!entryIds) {
		console.log('No entries in local storage');
		document.querySelector('#mySavedEntries .theSavedEntries').innerHTML = `<p>There are no saved items.</p>`;
		return;
	}

	console.log(`Fetch: /saved-entries?entryIds=${entryIds}`);
	API.getHtml(`/saved-entries?entryIds=${entryIds}`).then(response => {
		// take the string response from the Fetch request and turn it into DOM elements
		let responseAsDOM = document.createRange().createContextualFragment(response);

		// replace the existing DOM node with the new one
		document.querySelector('#mySavedEntries .theSavedEntries').replaceChildren(responseAsDOM);

		// Re-initialise all the save buttons, because the new DOM loaded content can itself have save buttons inside which need initialising
		initialiseSaveButtons();

		// set a flag in localStorage so that other functions know that the rendered contents of the Saved Entries pane is fresh, and does not need to be refreshed before it's shown again.
		localStorage.setItem('mySavedEntriesPaneStatus', 'fresh');
	});
}

/**
 * Show or hide the Saved Entries Drawer
 */
function toggleMySavedDrawer() {
	let mySavedEntriesDrawer = document.querySelector('#mySavedEntries');
	let drawerToggleButton = document.querySelectorAll('.toggleMySavedEntriesDrawer');

	if (mySavedEntriesDrawer.dataset.drawerState == 'open'){
		mySavedEntriesDrawer.dataset.drawerState = 'closed';

		drawerToggleButton.forEach( toggle => {
			toggle.querySelector('span').textContent = config.drawerLabelWhenClosed;
		});
	} else {
		mySavedEntriesDrawer.dataset.drawerState = 'open';

		drawerToggleButton.forEach( toggle => {
			toggle.querySelector('span').textContent = config.drawerLabelWhenOpen;
		});
	}
}

/**
 * Show or hide the drawer, including refreshing the contents if they are stale.
 * 1. Load `savedEntryIds` and `mySavedEntriesPaneStatus` from `localStorage`.
 * 2. If the drawer contents are marked stale call `populateMySavedDrawer()`.
 * 3. Calls `toggleMySavedDrawer()`.
 */
function handleDrawerToggleButtonClick() {
	let savedEntries = [];

	// Load in any existing savedEntryIds from localStorage
	if (localStorage.getItem('savedEntryIds')) {
		savedEntries = JSON.parse(localStorage.getItem('savedEntryIds'));
	}

	// If there are saved Entries, and the drawer contents are stale, reload the contents of the drawer now
	if (
		savedEntries.length > 0
		&&
		localStorage.getItem('mySavedEntriesPaneStatus') !== 'fresh'
	) {
		console.log('You have items saved, but they need to be loaded via fetch');

		// Replace default drawer message with "Loading message"
		document.querySelector('#mySavedEntries .theSavedEntries').innerHTML = `<p>Loading</p>`;

		// Get fresh content for the drawer and add it in
		populateMySavedDrawer();
	}

	// Toggle the visibility of the drawer
	toggleMySavedDrawer();
}

/**
 * Adds the Drawer into the DOM
 * 1. Build the drawer markup and add it to the page.
 * 2. Marks the loaded Drawer contents as stale (there is no content yet).
 * 3. Attaches `handleDrawerToggleButtonClick()` to the drawers show/hide toggle.
 */
export function initialiseMySavedDrawer() {
	const drawer = `
		<div id="mySavedEntries">
			<div class="l_constrain">
				<button type="button" class="toggleMySavedEntriesDrawer">
					<span>${ config.drawerLabelWhenClosed }</span>
				</button>

				<div class="wrapper">
					<div class="theSavedEntries">
						<p>There are no saved items.</p>
					</div>
				</div>
			</div>
		</div>`;
	document.querySelector('body').insertAdjacentHTML('beforeend', drawer);

	const showHideToggles = document.querySelectorAll('button.toggleMySavedEntriesDrawer');

	// as this is the initial load, ensure state management knows we have no items dynamically loaded into the drawer yet
	localStorage.setItem('mySavedEntriesPaneStatus', 'stale');

	showHideToggles.forEach( toggle => {
		toggle.addEventListener('click', handleDrawerToggleButtonClick);
	});
}

/**
 * 1. Finds all `button[data-save-button]` elements.
 * 2. Inspects `localStorage` and updates each button accordingly.
 * 3. Attaches an event listener to handle clicks on each button.
 */
export function initialiseSaveButtons() { // Sets the state etc for all save buttons on the page
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

		if (savedEntryIds.includes( saveButton.dataset.entryId )) {
			// The button we're looking at already has its associated entry in localStorage
			saveButton.dataset.state = 'saved';
			saveButton.querySelector('span').textContent = config.removeFromDrawerText;
		} else {
			saveButton.dataset.state = 'null';
			saveButton.querySelector('span').textContent = config.addToDrawerText;
		}

		saveButton.addEventListener('click', handleSaveButtonClick);
	});
}

initialiseMySavedDrawer();
initialiseSaveButtons();
