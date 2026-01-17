/* ================================================
   Sistem Bansos - Enhanced Layout Scripts
   ================================================ */

$(document).ready(function() {
    // =============================================
    // 1. SMOOTH PAGE TRANSITIONS
    // =============================================
    
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // =============================================
    // 2. ENHANCED SIDEBAR FUNCTIONALITY
    // =============================================
    
    // Active menu item highlighting
    const currentUrl = window.location.pathname;
    $('.sidebar .nav a').each(function() {
        const href = $(this).attr('href');
        if (href && (currentUrl === href || currentUrl.includes(href.replace('/index', '')))) {
            $(this).closest('li').addClass('active');
            // Highlight parent section header
            $(this).closest('.admin-section, .staff-section, .user-section')
                .find('.nav-section-header').addClass('active-section');
        }
    });

    // Enhanced tooltip functionality
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        delay: { show: 300, hide: 100 },
        animation: true,
        placement: 'right'
    });

    // =============================================
    // 3. AUTO-HIDE ALERTS
    // =============================================
    
    const hideAlerts = () => {
        const alerts = $('.alert:not(.alert-permanent):not(.alert-dismissible)');
        if (alerts.length) {
            setTimeout(() => {
                alerts.fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
        }
    };
    
    hideAlerts();

    // =============================================
    // 4. FORM SUBMISSION HANDLING
    // =============================================
    
    $('form').on('submit', function(e) {
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        // Disable and show loading state
        submitBtn.prop('disabled', true)
                .html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
        
        // Re-enable button on error
        $(this).on('invalid', function() {
            submitBtn.prop('disabled', false).html(originalText);
        });
    });

    // =============================================
    // 5. RESPONSIVE SIDEBAR
    // =============================================
    
    const handleResponsiveSidebar = () => {
        const windowWidth = $(window).width();
        const sidebar = $('.sidebar');
        
        if (windowWidth <= 991) {
            sidebar.addClass('sidebar-mobile');
        } else {
            sidebar.removeClass('sidebar-mobile');
        }
    };
    
    handleResponsiveSidebar();
    $(window).resize(handleResponsiveSidebar);

    // =============================================
    // 6. SMOOTH SCROLL FOR ANCHORS
    // =============================================
    
    $('a[href^="#"]').on('click', function(e) {
        const href = $(this).attr('href');
        if (href === '#') return;
        
        e.preventDefault();
        const target = $(href);
        
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800, 'easeInOutQuad');
        }
    });

    // =============================================
    // 7. TABLE ENHANCEMENTS
    // =============================================
    
    // Add hover effects to table rows
    $('table tbody tr').hover(
        function() {
            $(this).addClass('table-row-hover');
        },
        function() {
            $(this).removeClass('table-row-hover');
        }
    );

    // =============================================
    // 8. BUTTON LOADING STATES
    // =============================================
    
    $(document).on('click', '.btn-delete, .btn-confirm', function(e) {
        const btn = $(this);
        
        if (!btn.hasClass('confirmed')) {
            e.preventDefault();
            btn.addClass('confirmed')
               .css('background-color', '#dc3545')
               .text('Yakin? Klik lagi untuk konfirmasi');
            
            setTimeout(() => {
                btn.removeClass('confirmed')
                   .css('background-color', '')
                   .text(btn.data('original-text') || 'Hapus');
            }, 3000);
        }
    });

    // =============================================
    // 9. NOTIFICATION HANDLER
    // =============================================
    
    window.showNotification = function(message, type = 'info', duration = 3000) {
        const alertClass = `alert alert-${type}`;
        const alertHTML = `
            <div class="${alertClass} alert-dismissible fade show" role="alert">
                <strong>${type.toUpperCase()}:</strong> ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        `;
        
        const alertContainer = $('.content').prepend(alertHTML);
        
        if (duration > 0) {
            setTimeout(() => {
                alertContainer.find('.alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, duration);
        }
    };

    // =============================================
    // 10. PAGE LOAD ANIMATION
    // =============================================
    
    $('.content-wrapper').fadeIn(300);
    $('.card').each(function(index) {
        const delay = index * 50;
        $(this).css({
            'animation-delay': delay + 'ms'
        });
    });

    // =============================================
    // 11. SEARCH & FILTER FUNCTIONALITY
    // =============================================
    
    if ($('[data-search]').length) {
        $('[data-search]').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            const targetSelector = $(this).data('search');
            
            $(targetSelector).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
        });
    }

    // =============================================
    // 12. SECTION HEADER ANIMATIONS
    // =============================================
    
    $('.nav-section-header').each(function(index) {
        $(this).css({
            'animation': 'slideInLeft 0.4s ease-out',
            'animation-delay': (index * 0.1) + 's',
            'animation-fill-mode': 'both'
        });
    });

    // =============================================
    // 13. RESPONSIVE TABLE WRAPPER
    // =============================================
    
    if ($('table').length) {
        const tables = $('table');
        tables.each(function() {
            if (!$(this).parent().hasClass('table-responsive')) {
                $(this).wrap('<div class="table-responsive-wrapper"></div>');
            }
        });
    }

    // =============================================
    // 14. ENHANCED FORM VALIDATION
    // =============================================
    
    if ($.fn.validate) {
        $('form').validate({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    }

    // =============================================
    // 15. KEYBOARD SHORTCUTS
    // =============================================
    
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + S untuk save
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
            e.preventDefault();
            $('form').first().submit();
        }
        
        // Esc untuk close modals
        if (e.keyCode === 27) {
            $('.modal.show').modal('hide');
        }
    });

    // =============================================
    // 16. SESSION TIMEOUT WARNING
    // =============================================
    
    let inactivityTimer;
    const sessionTimeout = 30 * 60 * 1000; // 30 menit
    
    function resetInactivityTimer() {
        clearTimeout(inactivityTimer);
        inactivityTimer = setTimeout(() => {
            showNotification('Sesi Anda akan segera berakhir. Silakan refresh halaman.', 'warning', 0);
        }, sessionTimeout - 5 * 60 * 1000); // Warning 5 menit sebelum timeout
    }
    
    $(document).on('mousemove keydown click', resetInactivityTimer);
    resetInactivityTimer();

    // =============================================
    // 17. CUSTOM SCROLLBAR TRACK
    // =============================================
    
    if ($(window).scrollTop() > 100) {
        $('.navbar').addClass('scrolled');
    }
    
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.navbar').addClass('scrolled');
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });

    console.log('✅ Sistem Bansos - Enhanced Layout Scripts Loaded Successfully');
});

// =============================================
// CSS ANIMATIONS
// =============================================

const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .table-row-hover {
        background-color: rgba(81, 203, 206, 0.08) !important;
        transition: all 0.2s ease;
    }

    .navbar.scrolled {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .table-responsive-wrapper {
        overflow-x: auto;
        border-radius: 8px;
    }

    .form-group.has-error .form-control {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .content-wrapper {
        animation: fadeIn 0.3s ease-out;
    }

    .card {
        animation: slideInUp 0.4s ease-out;
    }
`;

document.head.appendChild(styleSheet);
