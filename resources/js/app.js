import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // -------------------------------------------------------------------------
    // Toast Notification Logic
    // -------------------------------------------------------------------------
    window.showToast = function (message, type = 'success') {
        let container = document.getElementById('toast-container');

        // If container doesn't exist (e.g., on pages where it wasn't added), create it
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container';
            document.body.appendChild(container); // Append to body dynamically
        }

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<span>${message}</span>`;

        container.appendChild(toast);

        // Auto remove
        setTimeout(() => {
            toast.style.animation = 'fadeOut 0.3s forwards';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    };

    // -------------------------------------------------------------------------
    // Button Loader Logic (Forms)
    // -------------------------------------------------------------------------
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            const btn = form.querySelector('[type="submit"]');
            // Only add loader if the form is valid (browser check usually prevents this anyway)
            if (btn && !btn.classList.contains('btn-loading')) {
                btn.classList.add('btn-loading');
                btn.style.width = getComputedStyle(btn).width; // Maintain width
            }
        });
    });

    // -------------------------------------------------------------------------
    // Button Loader Logic (Links with .btn class)
    // -------------------------------------------------------------------------
    // This targets "Action Buttons" that are actually links (e.g. "Get Started")
    const actionLinks = document.querySelectorAll('a.btn');
    actionLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Ignore if opening in new tab or just an anchor link
            if (link.target === '_blank' || link.getAttribute('href').startsWith('#') || link.getAttribute('href') === 'javascript:void(0)') {
                return;
            }

            if (!link.classList.contains('btn-loading')) {
                link.classList.add('btn-loading');
                link.style.width = getComputedStyle(link).width;
            }
        });
    });

    // Fix for Back-Forward Cache (bfcache)
    // If user clicks back, remove loading states
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            document.querySelectorAll('.btn-loading').forEach(el => {
                el.classList.remove('btn-loading');
            });
        }
    });
});
