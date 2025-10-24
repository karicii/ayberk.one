// Theme Toggle
(function() {
    const themeToggle = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('theme-icon-sun');
    const moonIcon = document.getElementById('theme-icon-moon');
    const htmlElement = document.documentElement;
    
    // Load saved theme or default to dark
    const savedTheme = localStorage.getItem('theme') || 'dark';
    htmlElement.setAttribute('data-theme', savedTheme);
    updateIcons(savedTheme);
    
    function updateIcons(theme) {
        if (theme === 'light') {
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
        } else {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
        }
    }
    
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcons(newTheme);
        });
    }
})();

// Mobile Menu Toggle
(function() {
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            mainNav.classList.toggle('active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = mainNav.contains(event.target) || menuToggle.contains(event.target);
            
            if (!isClickInside && mainNav.classList.contains('active')) {
                menuToggle.classList.remove('active');
                mainNav.classList.remove('active');
            }
        });
        
        // Close menu when clicking on a link
        const navLinks = mainNav.querySelectorAll('a');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                mainNav.classList.remove('active');
            });
        });
    }
})();

// Mobile Search Overlay
(function() {
    const searchToggle = document.getElementById('mobile-search-toggle');
    const searchOverlay = document.getElementById('mobile-search-overlay');
    const searchClose = document.getElementById('mobile-search-close');
    
    if (searchToggle && searchOverlay) {
        // Open overlay
        searchToggle.addEventListener('click', function() {
            searchOverlay.classList.add('active');
            // Focus on input after overlay is visible
            setTimeout(function() {
                const input = searchOverlay.querySelector('input');
                if (input) input.focus();
            }, 100);
        });
        
        // Close with close button
        if (searchClose) {
            searchClose.addEventListener('click', function() {
                searchOverlay.classList.remove('active');
            });
        }
        
        // Close overlay when clicking outside the form
        searchOverlay.addEventListener('click', function(event) {
            if (event.target === searchOverlay) {
                searchOverlay.classList.remove('active');
            }
        });
        
        // Close on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && searchOverlay.classList.contains('active')) {
                searchOverlay.classList.remove('active');
            }
        });
    }
})();

// Language Switcher Dropdown
(function() {
    const langToggle = document.getElementById('lang-toggle');
    const langSwitcher = document.querySelector('.lang-switcher');
    const langOptions = document.querySelectorAll('.lang-option');
    const langCurrent = document.querySelector('.lang-current');
    
    const langMap = {
        'tr': 'TR',
        'en': 'EN',
        'fr': 'FR'
    };
    
    // Get current language from cookie or localStorage
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }
    
    const savedLang = getCookie('lang') || localStorage.getItem('language') || 'tr';
    langCurrent.textContent = langMap[savedLang];
    
    // Set active option
    langOptions.forEach(function(option) {
        if (option.dataset.lang === savedLang) {
            option.classList.add('active');
        } else {
            option.classList.remove('active');
        }
    });
    
    // Toggle dropdown
    if (langToggle) {
        langToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            langSwitcher.classList.toggle('active');
            langToggle.classList.toggle('active');
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!langSwitcher.contains(event.target)) {
            langSwitcher.classList.remove('active');
            langToggle.classList.remove('active');
        }
    });
    
    // Handle language selection
    langOptions.forEach(function(option) {
        option.addEventListener('click', function(e) {
            e.stopPropagation();
            const selectedLang = this.dataset.lang;
            
            // Send to backend
            fetch('/api/set-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ lang: selectedLang })
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    // Update localStorage
                    localStorage.setItem('language', selectedLang);
                    
                    // Reload page to apply translations
                    window.location.reload();
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    });
})();
