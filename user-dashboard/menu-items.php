<div class="menu-items">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/user-dashboard/logo-2.png" alt="logo"
        class="rounded jahbulonn-logo">
    <?php if (is_page('my-dashboard')): ?>
        <a href="<?php echo home_url(); ?>/my-dashboard" id="jahbulonn-dashboard-link"
            class="jahbulonn-menu-item active">Dashboard</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/my-dashboard" id="jahbulonn-dashboard-link"
            class="jahbulonn-menu-item">Dashboard</a>
    <?php endif; ?>
    <?php if (is_page('01-form-submission')): ?>
        <a href="<?php echo home_url(); ?>/01-form-submission" id="jahbulonn-application-link"
            class="jahbulonn-menu-item active">Submitting a Formulary Exception Form</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/01-form-submission" id="jahbulonn-application-link" class="jahbulonn-menu-item">Submitting a Formulary Exception Form</a>
    <?php endif; ?>
    <?php if (is_page('02-sharefile-settings')): ?>
        <a href="<?php echo home_url(); ?>/02-sharefile-settings" id="jahbulonn-study-materials-link"
            class="jahbulonn-menu-item active">ShareFile Settings (Citrix)</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/02-sharefile-settings" id="jahbulonn-study-materials-link"
            class="jahbulonn-menu-item">ShareFile Settings (Citrix)</a>
    <?php endif; ?>
    <?php if (is_page('03-close-a-program')): ?>
        <a href="<?php echo home_url(); ?>/03-close-a-program" id="jahbulonn-profile-link"
            class="jahbulonn-menu-item active">How to Close a Program Using Task Manager</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/03-close-a-program" id="jahbulonn-profile-link" class="jahbulonn-menu-item">How to Close a Program Using Task Manager</a>
    <?php endif; ?>
        <?php if (is_page('04-review-of-the-detailed-claims')): ?>
        <a href="<?php echo home_url(); ?>/04-review-of-the-detailed-claims" id="jahbulonn-profile-link"
            class="jahbulonn-menu-item active">Review of the detailed claims on MSN</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/04-review-of-the-detailed-claims" id="jahbulonn-profile-link" class="jahbulonn-menu-item">Review of the detailed claims on MSN</a>
    <?php endif; ?>
        <?php if (is_page('05-how-to-run-aca-Individual-quotes')): ?>
        <a href="<?php echo home_url(); ?>/05-how-to-run-aca-Individual-quotes" id="jahbulonn-profile-link"
            class="jahbulonn-menu-item active">How to Run ACA Individual Quotes Through our Website</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/05-how-to-run-aca-Individual-quotes" id="jahbulonn-profile-link" class="jahbulonn-menu-item">How to Run ACA Individual Quotes Through our Website</a>
    <?php endif; ?>
            <?php if (is_page('06-sop-hud-on-ring-central')): ?>
        <a href="<?php echo home_url(); ?>/06-sop-hud-on-ring-central" id="jahbulonn-profile-link"
            class="jahbulonn-menu-item active">SOP: HUD on Ring Central</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/06-sop-hud-on-ring-central" id="jahbulonn-profile-link" class="jahbulonn-menu-item">SOP: HUD on Ring Central</a>
    <?php endif; ?>
    <a href="<?php echo wp_logout_url(); ?>" id="jahbulonn-logout-link" class="jahbulonn-menu-item">Logout</a>
</div>