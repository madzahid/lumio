/* Lumio — Table of Contents */
document.addEventListener( 'DOMContentLoaded', function () {
	var content      = document.querySelector( '.entry-content' );
	var tocContainer = document.getElementById( 'toc-container' );

	if ( ! content || ! tocContainer ) return;

	var headers = content.querySelectorAll( 'h2, h3' );
	if ( headers.length === 0 ) {
		tocContainer.style.display = 'none';
		return;
	}

	/* Sticky wrapper (used on desktop) */
	var stickyWrap = document.createElement( 'div' );
	stickyWrap.className = 'toc-inner-sticky';

	/* Header row — title + chevron */
	var tocHeader = document.createElement( 'div' );
	tocHeader.className = 'toc-header';
	tocHeader.innerHTML =
		'<span class="toc-header-title">Contents</span>' +
		'<span class="toc-header-arrow">' +
			'<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>' +
		'</span>';

	/* Collapsible body */
	var tocBody = document.createElement( 'div' );
	tocBody.className = 'toc-body';

	var tocList = document.createElement( 'ul' );
	tocList.className = 'toc-list';

	headers.forEach( function ( header, index ) {
		var id = 'toc-heading-' + index;
		header.id = id;

		var li = document.createElement( 'li' );
		li.className = 'toc-item toc-' + header.tagName.toLowerCase();

		var a = document.createElement( 'a' );
		a.href = '#' + id;
		a.textContent = header.textContent;

		a.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			var target = document.getElementById( id );
			if ( target ) {
				var top = target.getBoundingClientRect().top + window.pageYOffset - 80;
				window.scrollTo( { top: top, behavior: 'smooth' } );
			}
			/* Close on mobile after click */
			if ( window.innerWidth < 1280 ) {
				tocContainer.classList.remove( 'is-open' );
			}
		} );

		li.appendChild( a );
		tocList.appendChild( li );
	} );

	tocBody.appendChild( tocList );

	/* Toggle click — mobile only */
	tocHeader.addEventListener( 'click', function () {
		if ( window.innerWidth >= 1280 ) return;
		tocContainer.classList.toggle( 'is-open' );
	} );

	/* Assemble */
	stickyWrap.appendChild( tocHeader );
	stickyWrap.appendChild( tocBody );
	tocContainer.appendChild( stickyWrap );

	/* Always open on desktop */
	if ( window.innerWidth >= 1280 ) {
		tocContainer.classList.add( 'is-open' );
	}

	/* Active item highlight on scroll */
	var items = tocList.querySelectorAll( '.toc-item' );

	window.addEventListener( 'scroll', function () {
		var scrollY = window.pageYOffset + 100;
		var current = '';

		headers.forEach( function ( header ) {
			if ( header.offsetTop <= scrollY ) {
				current = header.id;
			}
		} );

		items.forEach( function ( item ) {
			item.classList.remove( 'active' );
			var link = item.querySelector( 'a' );
			if ( link && link.getAttribute( 'href' ) === '#' + current ) {
				item.classList.add( 'active' );
			}
		} );
	} );
} );
