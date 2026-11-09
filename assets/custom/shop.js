/**
 * Cristalería Latinoamericana - Custom Shop Scripts
 * Light Mode / Dark Mode Theme Controller & UI Enhancements
 * Version: 2.0
 */

(function ($) {
    'use strict';

    // Remove legacy color swatch key to prevent old color presets from overriding styles
    try {
        if (localStorage.getItem('shop_color')) {
            localStorage.removeItem('shop_color');
        }
    } catch (e) {}

    function getPreferredTheme() {
        try {
            var saved = localStorage.getItem('shop_theme_mode');
            if (saved === 'dark' || saved === 'light') {
                return saved;
            }
        } catch (e) {}
        return 'light';
    }

    function applyThemeMode(mode, persist) {
        var isDark = (mode === 'dark');

        if (isDark) {
            $('html').addClass('theme-dark').removeClass('theme-light').attr('data-theme', 'dark');
            $('body, #wrapper').addClass('theme-dark').removeClass('theme-light');
            $('.btn-mode-toggle[data-theme-val="dark"]').addClass('active');
            $('.btn-mode-toggle[data-theme-val="light"]').removeClass('active');
            $('#topbarThemeToggle').addClass('is-dark').attr('title', 'Cambiar a Modo Luz');
        } else {
            $('html').removeClass('theme-dark').addClass('theme-light').attr('data-theme', 'light');
            $('body, #wrapper').removeClass('theme-dark').addClass('theme-light');
            $('.btn-mode-toggle[data-theme-val="light"]').addClass('active');
            $('.btn-mode-toggle[data-theme-val="dark"]').removeClass('active');
            $('#topbarThemeToggle').removeClass('is-dark').attr('title', 'Cambiar a Modo Dark');
        }

        if (persist) {
            try {
                localStorage.setItem('shop_theme_mode', isDark ? 'dark' : 'light');
            } catch (err) {}
        }
    }

    // Initialize on document ready
    $(document).ready(function () {
        var initialTheme = getPreferredTheme();
        applyThemeMode(initialTheme, false);

        // Footer segmented mode toggle buttons
        $(document).on('click', '.btn-mode-toggle', function (e) {
            e.preventDefault();
            var targetMode = $(this).attr('data-theme-val');
            applyThemeMode(targetMode, true);
        });

        // Topbar quick toggle button
        $(document).on('click', '#topbarThemeToggle, .header-theme-toggle', function (e) {
            e.preventDefault();
            var current = $('html').hasClass('theme-dark') ? 'dark' : 'light';
            var next = (current === 'dark') ? 'light' : 'dark';
            applyThemeMode(next, true);
        });

        // Safeguard against scripts that modify #wrapper class
        setTimeout(function () {
            var current = $('html').hasClass('theme-dark') ? 'dark' : 'light';
            if (current === 'dark' && !$('#wrapper').hasClass('theme-dark')) {
                $('#wrapper').addClass('theme-dark');
            }
        }, 300);
    });

})(jQuery);
