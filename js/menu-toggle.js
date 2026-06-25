/* Lumio — Mobile menu toggle with keyboard navigation */
document.addEventListener( 'DOMContentLoaded', function () {
	var btn = document.querySelector( '.menu-toggle' );
	var nav = document.getElementById( 'site-navigation' );

	if ( ! btn || ! nav ) return;

	function openMenu() {
		nav.classList.add( 'is-open' );
		btn.setAttribute( 'aria-expanded', 'true' );
		// Move focus to first menu link
		var firstLink = nav.querySelector( 'a' );
		if ( firstLink ) firstLink.focus();
	}

	function closeMenu() {
		nav.classList.remove( 'is-open' );
		btn.setAttribute( 'aria-expanded', 'false' );
		btn.focus();
	}

	btn.addEventListener( 'click', function () {
		if ( nav.classList.contains( 'is-open' ) ) {
			closeMenu();
		} else {
			openMenu();
		}
	} );

	// Close on Escape
	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && nav.classList.contains( 'is-open' ) ) {
			closeMenu();
		}
	} );

	// Close menu when clicking outside
	document.addEventListener( 'click', function ( e ) {
		if ( ! nav.contains( e.target ) && ! btn.contains( e.target ) ) {
			nav.classList.remove( 'is-open' );
			btn.setAttribute( 'aria-expanded', 'false' );
		}
	} );
} );
