/* Lumio — Mobile menu toggle */
document.addEventListener( 'DOMContentLoaded', function () {
	var btn = document.querySelector( '.menu-toggle' );
	var nav = document.getElementById( 'site-navigation' );

	if ( ! btn || ! nav ) return;

	btn.addEventListener( 'click', function () {
		var isOpen = nav.classList.toggle( 'is-open' );
		btn.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
	} );

	/* Close menu when clicking outside */
	document.addEventListener( 'click', function ( e ) {
		if ( ! nav.contains( e.target ) && ! btn.contains( e.target ) ) {
			nav.classList.remove( 'is-open' );
			btn.setAttribute( 'aria-expanded', 'false' );
		}
	} );
} );
