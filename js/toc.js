document.addEventListener('DOMContentLoaded', function () {
    const content = document.querySelector('.entry-content');
    const tocContainer = document.getElementById('toc-container');

    if (!content || !tocContainer) return;

    const headers = content.querySelectorAll('h2, h3');
    if (headers.length === 0) return;

    const tocList = document.createElement('ul');
    tocList.className = 'toc-list';

    headers.forEach((header, index) => {
        const id = 'toc-' + index;
        header.id = id;

        const li = document.createElement('li');
        li.className = 'toc-item toc-' + header.tagName.toLowerCase();

        const a = document.createElement('a');
        a.href = '#' + id;
        a.textContent = header.textContent;

        // Smooth scroll
        a.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#' + id).scrollIntoView({
                behavior: 'smooth'
            });
        });

        li.appendChild(a);
        tocList.appendChild(li);
    });

    // Mobile Toggle
    const toggleBtn = document.createElement('button');
    toggleBtn.className = 'toc-toggle-btn';
    toggleBtn.textContent = 'Table of Contents';
    toggleBtn.onclick = () => {
        tocList.classList.toggle('active');
        toggleBtn.classList.toggle('active');
    };

    tocContainer.appendChild(toggleBtn);
    tocContainer.appendChild(tocList);
});
