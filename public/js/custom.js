// public/js/custom.js

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('.toggle');
    const menu = document.getElementById('menu');

    if (toggleButton && menu) {
        toggleButton.addEventListener('click', function (e) {
            e.preventDefault();
            menu.classList.toggle('active');

            // Update ARIA attribute
            const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
            toggleButton.setAttribute('aria-expanded', !isExpanded);
        });
    }

    // Form Validation (if applicable)
    const contactForm = document.querySelector('footer#footer form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            const name = contactForm.querySelector('#name').value.trim();
            const email = contactForm.querySelector('#email').value.trim();
            const message = contactForm.querySelector('#message').value.trim();
            let errors = [];

            if (name === '') {
                errors.push('Le nom est requis.');
            }

            if (email === '') {
                errors.push('L\'email est requis.');
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    errors.push('L\'email est invalide.');
                }
            }

            if (message === '') {
                errors.push('Le message est requis.');
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
            }
        });
    }
});
