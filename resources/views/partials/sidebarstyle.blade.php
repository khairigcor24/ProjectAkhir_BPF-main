
<style>
    /* ============================================
       SIDEBAR NAVIGATION STYLING
       ============================================ */

    :root {
        --primary-green: #28a745; /* Emphasize green for social assistance theme */
        --primary-blue: #4a90e2;
        --primary-warm: #f5a623;
        --accent-light: rgba(40, 167, 69, 0.08);
        --accent-lighter: rgba(40, 167, 69, 0.12);
        --accent-hover: rgba(40, 167, 69, 0.2);
        --accent-green: rgba(40, 167, 69, 0.1);
        --accent-warm: rgba(245, 166, 35, 0.1);
        --border-light: #e8e8e8;
        --text-muted: #777;
        --text-dark: #333;
        --shadow-light: rgba(0, 0, 0, 0.1);
        --shadow-medium: rgba(0, 0, 0, 0.15);
        --sidebar-bg: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .nav {
        position: relative;
        padding: 10px 0;
        margin: 0;
        background: var(--sidebar-bg);
        border-radius: 8px;
        box-shadow: 0 2px 10px var(--shadow-light);
        min-height: 100vh; /* Ensure full vertical height */
    }

    /* ============================================
       DASHBOARD ITEM
       ============================================ */
    .nav-dashboard {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .nav-dashboard a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 15px !important; /* Narrower padding for side alignment */
        margin: 0 5px !important;
        background: transparent !important;
        color: var(--text-dark) !important;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        border-radius: 6px;
    }

    .nav-dashboard a i {
        font-size: 16px;
        color: var(--primary-blue);
        transition: all 0.3s ease;
    }

    .nav-dashboard a p {
        margin: 0;
        font-size: 14px;
    }

    .nav-dashboard:hover a {
        background-color: var(--accent-light) !important;
        /* Removed padding-left increase to keep straight */
    }

    .nav-dashboard:hover a i {
        transform: scale(1.1);
        color: var(--primary-teal);
    }

    .nav-dashboard.active a {
        background: linear-gradient(135deg, var(--accent-lighter), var(--accent-green)) !important;
        border-left: 4px solid var(--primary-green);
        color: var(--primary-green) !important;
        font-weight: 600;
        /* Removed padding-left to keep straight */
        box-shadow: 0 2px 8px var(--shadow-light);
    }

    .nav-dashboard.active a i {
        color: var(--primary-blue);
        text-shadow: 0 1px 2px var(--shadow-light);
    }

    /* ============================================
       CATEGORY HEADER (SECTION TITLE)
       ============================================ */
    .nav-category {
        list-style: none !important;
        padding: 0 !important;
        margin: 20px 0 10px 0 !important;
    }

    .nav-category-title {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px; /* Narrower for side alignment */
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 5px;
        background: linear-gradient(90deg, var(--accent-light), var(--accent-green));
        border-radius: 6px;
        box-shadow: 0 1px 3px var(--shadow-light);
        border-left: 3px solid var(--primary-green);
    }

    .nav-category-title i {
        font-size: 12px;
        color: var(--primary-green);
    }

    /* ============================================
       NAV LINKS (MENU ITEMS)
       ============================================ */
    .nav > li:not(.nav-dashboard):not(.nav-category) {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .nav-link {
        display: flex !important;
        align-items: center;
        gap: 12px;
        padding: 12px 20px !important;
        margin: 0 8px !important;
        background-color: transparent !important;
        color: var(--text-dark) !important;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-decoration: none !important;
        border-radius: 6px;
    }

    .nav-link i {
        font-size: 14px;
        color: var(--primary-teal);
        transition: all 0.25s ease;
        flex-shrink: 0;
    }

    .nav-link p {
        margin: 0;
        flex-grow: 1;
        font-size: 13px;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--primary-blue), var(--primary-green));
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-blue), var(--primary-green));
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ============================================
       HOVER STATE
       ============================================ */
    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link {
        background: linear-gradient(135deg, var(--accent-light), var(--accent-green)) !important;
        color: var(--primary-green) !important;
        /* Removed translateX and padding-left to keep vertical straight */
        transform: scale(1.02);
        box-shadow: 0 4px 12px var(--shadow-medium);
    }

    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link::before {
        transform: scaleY(1);
    }

    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link::after {
        width: 20px;
    }

    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link i {
        transform: scale(1.2) rotate(5deg);
        color: var(--primary-blue);
    }

    /* ============================================
       ACTIVE STATE
       ============================================ */
    .nav > li.active .nav-link {
        background: linear-gradient(135deg, var(--accent-lighter), var(--accent-green)) !important;
        color: var(--primary-green) !important;
        font-weight: 600;
        /* Removed padding-left to keep straight */
        box-shadow: 0 2px 8px var(--shadow-medium);
        border: 1px solid rgba(40, 167, 69, 0.2);
    }

    .nav > li.active .nav-link::before {
        transform: scaleY(1);
    }

    .nav > li.active .nav-link::after {
        width: 15px;
    }

    .nav > li.active .nav-link i {
        color: var(--primary-blue);
        font-weight: 700;
        text-shadow: 0 1px 2px var(--shadow-light);
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */
    @media (max-width: 991px) {
        .nav-link {
            font-size: 12px;
            padding: 10px 12px !important; /* Narrower */
            margin: 0 4px !important;
        }

        .nav-link i {
            font-size: 13px;
        }

        .nav-dashboard a {
            padding: 12px 12px !important;
        }

        .nav-category-title {
            font-size: 10px;
            padding: 8px 12px;
            margin: 0 4px;
        }
    }

    @media (max-width: 768px) {
        .nav-link {
            font-size: 11px;
            padding: 8px 12px !important;
            margin: 0 4px !important;
        }

        .nav-dashboard a {
            padding: 10px 12px !important;
        }

        .nav-link p {
            font-size: 11px;
        }

        .nav-category-title {
            font-size: 9px;
            padding: 6px 12px;
        }
    }
</style>

<script>
$(document).ready(function(){
    var currentRoute = '{{ request()->route()->getName() }}';

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'right',
        delay: { show: 300, hide: 100 },
        trigger: 'hover focus'
    });

    // Highlight active menu
    $('.nav > li:not(.nav-dashboard):not(.nav-category)').each(function() {
        var $link = $(this).find('.nav-link');
        var href = $link.attr('href');

        if(currentRoute && href && href.includes(currentRoute.split('.')[0])) {
            $(this).addClass('active');
        }
    });

    if(currentRoute === 'dashboard') {
        $('.nav-dashboard').addClass('active');
    }

    // Enhanced smooth animations with stagger effect
    $('.nav > li:not(.nav-dashboard):not(.nav-category)').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(-20px) scale(0.95)'
        }).delay(index * 50).animate({
            'opacity': '1'
        }, 400, function() {
            $(this).css({
                'transform': 'translateX(0) scale(1)',
                'transition': 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)'
            });
        });
    });

    // Add ripple effect on click
    $('.nav-link').on('click', function(e) {
        var $this = $(this);
        var $ripple = $('<span class="ripple-effect"></span>');

        var x = e.pageX - $this.offset().left;
        var y = e.pageY - $this.offset().top;

        $ripple.css({
            left: x,
            top: y
        });

        $this.append($ripple);

        setTimeout(function() {
            $ripple.remove();
        }, 600);
    });

    // Add hover sound effect (visual feedback)
    $('.nav > li:not(.nav-dashboard):not(.nav-category)').hover(
        function() {
            $(this).find('.nav-link').addClass('pulse');
        },
        function() {
            $(this).find('.nav-link').removeClass('pulse');
        }
    );

    console.log('✓ Enhanced Sidebar initialized with tooltips and animations');
});
</script>

<style>
    /* Ripple effect */
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(74, 144, 226, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Pulse animation */
    .pulse {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
</style>
