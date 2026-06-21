/* Lumio share button: copy link to clipboard */
document.addEventListener( 'DOMContentLoaded', function () {
	document.querySelectorAll( '.share-btn[data-url]' ).forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			navigator.clipboard.writeText( btn.dataset.url ).then( function () {
				/* translators: alert shown after copy */
				alert( lumioShare.copied );
			} );
		} );
	} );
} );
