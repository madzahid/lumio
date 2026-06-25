(function() {
    var btn = document.getElementById('search-toggle');
    var bar = document.getElementById('search-bar');
    if (!btn || !bar) return;

    var focusableSelectors = 'a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])';

    function getFocusables() {
        return Array.prototype.slice.call(bar.querySelectorAll(focusableSelectors));
    }

    function openSearch() {
        bar.removeAttribute('hidden');
        btn.setAttribute('aria-expanded', 'true');
        var field = bar.querySelector('.search-field');
        if (field) field.focus();
    }

    function closeSearch() {
        bar.setAttribute('hidden', '');
        btn.setAttribute('aria-expanded', 'false');
        btn.focus();
    }

    btn.addEventListener('click', function() {
        if (bar.hasAttribute('hidden')) {
            openSearch();
        } else {
            closeSearch();
        }
    });

    // Focus trap inside search modal
    bar.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSearch();
            return;
        }
        if (e.key !== 'Tab') return;

        var focusables = getFocusables();
        if (!focusables.length) return;

        var first = focusables[0];
        var last  = focusables[focusables.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === first) {
                e.preventDefault();
                last.focus();
            }
        } else {
            if (document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });

    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!bar.hasAttribute('hidden') && !bar.contains(e.target) && e.target !== btn) {
            closeSearch();
        }
    });
})();
