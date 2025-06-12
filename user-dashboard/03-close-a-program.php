<?php
/** Template Name: How to Close a Program Using Task Manager */
if (!is_user_logged_in()) {
    wp_redirect(esc_url(home_url()));
    exit;
}
include "header-user-dashboard.php";
?>

<main class="jahbulonn-main" id="jahbulonn-dashboard">

    <?php require "dashboard-mobile-navbar.php"; ?>
    <!-- Sidebar for desktop -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar">
                <?php include "menu-items.php"; ?>
            </div>

            <div class="col-md-9 col-lg-10 col-12 p-4">
             

                <!-- Instructions -->
                <div style="background: #e3f2fd; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #2196f3; max-width: 900px; margin: auto;">
                    <p style="margin: 0; color: #1565c0; font-size: 14px; line-height: 1.5;">
                        <strong>🖥️ Tip:</strong> Use the Task Manager to close frozen or unresponsive applications. The steps are shown in the image below.
                    </p>
                </div>

                <!-- Zoom Controls -->
                <div style="text-align: center; margin-bottom: 15px; max-width: 900px; margin-left: auto; margin-right: auto;">
                    <button id="zoom-in" style="background: #2196f3; color: white; border: none; padding: 8px 15px; margin: 0 5px; border-radius: 4px; cursor: pointer; font-size: 14px;">🔍 Zoom In</button>
                    <button id="zoom-out" style="background: #f44336; color: white; border: none; padding: 8px 15px; margin: 0 5px; border-radius: 4px; cursor: pointer; font-size: 14px;">🔍 Zoom Out</button>
                    <button id="reset-zoom" style="background: #4caf50; color: white; border: none; padding: 8px 15px; margin: 0 5px; border-radius: 4px; cursor: pointer; font-size: 14px;">↻ Reset</button>
                    <span id="zoom-level" style="margin-left: 15px; font-weight: bold; color: #666;">Zoom: 100%</span>
                </div>

                <!-- Zoomable Image Viewer -->
                <div id="zoom-container" style="overflow: hidden; width: 100%; max-width: 900px; height: auto; margin: auto; border: 2px solid #ddd; border-radius: 8px; background: #f9f9f9; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                    <img id="form-image" 
                         src="<?php echo get_template_directory_uri(); ?>/assets/Last.jpeg" 
                         alt="Task Manager Instructions"
                         style="max-width: 100%; height: auto; display: block; margin: auto; user-select: none; -webkit-user-drag: none;">
                </div>

                <!-- Custom Instructions -->
                <div style="text-align: center; margin-top: 15px; max-width: 900px; margin-left: auto; margin-right: auto;">
                    <p style="color: #666; font-size: 13px; margin: 0;">
                        💡 <strong>Instructions:</strong> Use zoom buttons or mouse wheel to zoom. Click and drag to pan around the image.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>

<!-- Viewer Styles -->
<style>
#zoom-container.grabbing {
    cursor: grabbing !important;
}
#zoom-container.grabbing #form-image {
    pointer-events: none;
}
button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}
button:active {
    transform: translateY(0);
}
@media (max-width: 768px) {
    #zoom-container {
        height: auto !important;
    }
}
</style>

<!-- Viewer Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('zoom-container');
    const image = document.getElementById('form-image');
    const zoomInBtn = document.getElementById('zoom-in');
    const zoomOutBtn = document.getElementById('zoom-out');
    const resetBtn = document.getElementById('reset-zoom');
    const zoomLevel = document.getElementById('zoom-level');

    let scale = 1;
    let translateX = 0;
    let translateY = 0;
    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let initialTranslateX = 0;
    let initialTranslateY = 0;

    const minScale = 0.5;
    const maxScale = 3;
    const scaleStep = 0.2;

    function updateTransform() {
        image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
        zoomLevel.textContent = `Zoom: ${Math.round(scale * 100)}%`;
    }

    function constrainPosition() {
        const containerRect = container.getBoundingClientRect();
        const imageRect = image.getBoundingClientRect();

        const maxTranslateX = Math.max(0, (imageRect.width - containerRect.width) / 2);
        const maxTranslateY = Math.max(0, (imageRect.height - containerRect.height) / 2);

        translateX = Math.max(-maxTranslateX, Math.min(maxTranslateX, translateX));
        translateY = Math.max(-maxTranslateY, Math.min(maxTranslateY, translateY));
    }

    function zoomIn() {
        if (scale < maxScale) {
            scale = Math.min(maxScale, scale + scaleStep);
            updateTransform();
        }
    }

    function zoomOut() {
        if (scale > minScale) {
            scale = Math.max(minScale, scale - scaleStep);
            constrainPosition();
            updateTransform();
        }
    }

    function resetZoom() {
        scale = 1;
        translateX = 0;
        translateY = 0;
        updateTransform();
    }

    zoomInBtn.addEventListener('click', zoomIn);
    zoomOutBtn.addEventListener('click', zoomOut);
    resetBtn.addEventListener('click', resetZoom);

    container.addEventListener('wheel', function(e) {
        e.preventDefault();
        const rect = container.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const oldScale = scale;

        scale = e.deltaY < 0 ? Math.min(maxScale, scale + scaleStep) : Math.max(minScale, scale - scaleStep);
        if (scale !== oldScale) {
            const scaleChange = scale / oldScale;
            translateX = x - (x - translateX) * scaleChange;
            translateY = y - (y - translateY) * scaleChange;
            constrainPosition();
            updateTransform();
        }
    });

    container.addEventListener('mousedown', function(e) {
        if (e.button === 0) {
            isDragging = true;
            container.classList.add('grabbing');
            startX = e.clientX;
            startY = e.clientY;
            initialTranslateX = translateX;
            initialTranslateY = translateY;
            e.preventDefault();
        }
    });

    document.addEventListener('mousemove', function(e) {
        if (isDragging) {
            translateX = initialTranslateX + (e.clientX - startX);
            translateY = initialTranslateY + (e.clientY - startY);
            constrainPosition();
            updateTransform();
        }
    });

    document.addEventListener('mouseup', function() {
        isDragging = false;
        container.classList.remove('grabbing');
    });

    container.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            initialTranslateX = translateX;
            initialTranslateY = translateY;
            e.preventDefault();
        }
    });

    container.addEventListener('touchmove', function(e) {
        if (e.touches.length === 1) {
            translateX = initialTranslateX + (e.touches[0].clientX - startX);
            translateY = initialTranslateY + (e.touches[0].clientY - startY);
            constrainPosition();
            updateTransform();
            e.preventDefault();
        }
    });

    image.onload = function() {
        resetZoom();
    };
    if (image.complete) {
        resetZoom();
    }
});
</script>
