<div class="mystickymenu-popup" id="mystickymenu-intro-popup">
    <div class="mystickymenu-popup-box">
        <div class="mystickymenu-popup-header">
            <?php esc_html_e('Welcome to myStickymenu 🎉', 'mystickymenu'); ?>
            <button class="close-mystickymenu-popup"><span class="dashicons dashicons-no-alt"></span></button>
            <div class="clear"></div>
        </div>
        <div class="mystickymenu-popup-content">
            <?php printf(esc_html__('With myStickymenu you can make your website\'s menu sticky. You can also use it to create a welcome notification bar. Need help? Visit our %1$sHelp Center%2$s', 'mystickymenu'), '<a target="_blank" href="https://premio.io/help/mystickymenu/?utm_source=pluginonboarding">', '</a>') ?>
            <iframe class="w-full" width="420" height="240" src="https://www.youtube.com/embed/5sebFgUMpDA"></iframe>
        </div>
        <div class="mystickymenu-popup-footer">
            <button type="button"><?php esc_html_e('Go to myStickymenu', 'mystickymenu'); ?></button>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on("click", ".mystickymenu-popup-box button, #mystickymenu-intro-popup", function(e){
            e.stopPropagation();
            var nonceVal = "<?php echo esc_attr(wp_create_nonce("mystickymenu_update_popup_status")) ?>";
            jQuery("#mystickymenu-intro-popup").remove();
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'mystickymenu_update_popup_status',
                    nonce: nonceVal
                },
                beforeSend: function (xhr) {

                },
                success: function (res) {

                },
                error: function (xhr, status, error) {

                }
            });
        });

        jQuery(document).on("click", ".mystickymenu-popup-box", function(e){
            e.stopPropagation();
        });
    });
</script>