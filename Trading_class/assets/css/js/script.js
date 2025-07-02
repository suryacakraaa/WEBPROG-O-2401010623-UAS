// jQuery Document Ready
$(document).ready(function() {
    // Smooth scrolling for anchor links
    $('a[href*="#"]').on('click', function(e) {
        e.preventDefault();
        
        $('html, body').animate(
            {
                scrollTop: $($(this).attr('href')).offset().top,
            },
            500,
            'linear'
        );
    });

    // Form validation feedback
    $('form').on('submit', function() {
        $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Processing...');
    });

    // Tooltips
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        placement: 'top'
    });

    // Alert auto dismiss
    setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove(); 
        });
    }, 5000);
});

