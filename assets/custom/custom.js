// ==========================================================================
// CRISTALERIA LATINOAMERICANA - GLOBAL JAVASCRIPT EXTENSIONS (custom.js)
// Auto-dismiss Alerts / Toasts, Smooth Notifications, Global UX Enhancements
// ==========================================================================

(function ($) {
    'use strict';

    /**
     * Auto-dismiss alerts with countdown progress bar and hover-pause
     */
    function initAutoDismissAlerts(context) {
        var $alerts = context ? $(context).find('.alert') : $('.alert');

        $alerts.each(function () {
            var $alert = $(this);

            if ($alert.data('auto-dismiss-bound')) {
                return;
            }
            $alert.data('auto-dismiss-bound', true);

            // Add progress bar if missing
            if (!$alert.find('.alert-progress-bar').length) {
                $alert.append('<div class="alert-progress-bar"></div>');
            }

            var timer = null;
            var duration = 4500; // 4.5 seconds

            function startTimer() {
                var $bar = $alert.find('.alert-progress-bar');
                $bar.css({
                    'transition': 'width ' + duration + 'ms linear',
                    'width': '0%'
                });

                timer = setTimeout(function () {
                    $alert.addClass('alert-fade-out');
                    setTimeout(function () {
                        $alert.slideUp(200, function () {
                            $(this).remove();
                        });
                    }, 300);
                }, duration);
            }

            function pauseTimer() {
                clearTimeout(timer);
                var $bar = $alert.find('.alert-progress-bar');
                var currentWidth = $bar.width();
                $bar.stop().css({
                    'transition': 'none',
                    'width': currentWidth + 'px'
                });
            }

            // Start countdown
            setTimeout(function () {
                $alert.find('.alert-progress-bar').css('width', '100%');
                startTimer();
            }, 60);

            // Pause on mouse hover
            $alert.on('mouseenter', function () {
                pauseTimer();
            }).on('mouseleave', function () {
                duration = 2000; // 2 seconds after mouse leaves
                startTimer();
            });

            // Instant dismiss on close button click
            $alert.find('.close, [data-dismiss="alert"]').on('click', function (e) {
                e.preventDefault();
                clearTimeout(timer);
                $alert.addClass('alert-fade-out');
                setTimeout(function () {
                    $alert.slideUp(150, function () {
                        $(this).remove();
                    });
                }, 200);
            });
        });
    }

    $(document).ready(function () {
        // Initialize existing alerts on page load
        initAutoDismissAlerts();

        // Listen for new alerts added dynamically (AJAX, forms)
        if (window.MutationObserver) {
            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.addedNodes && mutation.addedNodes.length > 0) {
                        for (var i = 0; i < mutation.addedNodes.length; i++) {
                            var node = mutation.addedNodes[i];
                            if (node.nodeType === 1) {
                                if ($(node).hasClass('alert')) {
                                    initAutoDismissAlerts(node.parentNode);
                                } else if ($(node).find('.alert').length) {
                                    initAutoDismissAlerts(node);
                                }
                            }
                        }
                    }
                });
            });

            observer.observe(document.body, { childList: true, subtree: true });
        }
    });

})(jQuery);
