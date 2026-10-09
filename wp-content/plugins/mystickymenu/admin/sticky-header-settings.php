<?php
if (defined('ABSPATH') === false) {
    exit;
}
$mysticky_options = get_option( 'mysticky_option_name');
$is_old = get_option("has_sticky_header_old_version");
$is_old = ($is_old == "yes")?true:false;
$nonce = wp_create_nonce('mysticky_option_backend_update');
$pro_url = "https://go.premio.io/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=";
$upgarde_url 	= admin_url("admin.php?page=my-stickymenu-upgrade");

$mysticky_options['stickymenu_enable'] = isset($mysticky_options['stickymenu_enable']) ? $mysticky_options['stickymenu_enable'] : '';
$mysticky_options['myfixed_disable_scroll_down'] = isset($mysticky_options['myfixed_disable_scroll_down']) ? $mysticky_options['myfixed_disable_scroll_down'] : '';
$mysticky_options['disable_css'] = isset($mysticky_options['disable_css']) ? $mysticky_options['disable_css'] : '';
$mysticky_options['mysticky_disable_at_front_home'] = isset($mysticky_options['mysticky_disable_at_front_home']) ? $mysticky_options['mysticky_disable_at_front_home'] : '';
$mysticky_options['mysticky_disable_at_blog'] = isset($mysticky_options['mysticky_disable_at_blog']) ? $mysticky_options['mysticky_disable_at_blog'] : '';
$mysticky_options['mysticky_disable_at_page'] = isset($mysticky_options['mysticky_disable_at_page']) ? $mysticky_options['mysticky_disable_at_page'] : '';
$mysticky_options['mysticky_disable_at_tag'] = isset($mysticky_options['mysticky_disable_at_tag']) ? $mysticky_options['mysticky_disable_at_tag'] : '';
$mysticky_options['mysticky_disable_at_category'] = isset($mysticky_options['mysticky_disable_at_category']) ? $mysticky_options['mysticky_disable_at_category'] : '';
$mysticky_options['mysticky_disable_at_single'] = isset($mysticky_options['mysticky_disable_at_single']) ? $mysticky_options['mysticky_disable_at_single'] : '';
$mysticky_options['mysticky_disable_at_archive'] = isset($mysticky_options['mysticky_disable_at_archive']) ? $mysticky_options['mysticky_disable_at_archive'] : '';
$mysticky_options['mysticky_disable_at_search'] = isset($mysticky_options['mysticky_disable_at_search']) ? $mysticky_options['mysticky_disable_at_search'] : '';
$mysticky_options['mysticky_disable_at_404'] = isset($mysticky_options['mysticky_disable_at_404']) ? $mysticky_options['mysticky_disable_at_404'] : '';
?>
<div id="mystickymenu" class="wrap mystickymenu msb-wrap">
    <div id="sticky-header-settings" class="sticky-header-content">
        <form class="mysticky-form" id="mystickymenuform" method="post" action="#">
            <div class="mystickymenu-heading">
                <div class="mysticky-stickymenu-header-title mystickymenu-content-section">
                    <h3><?php esc_html_e('Sticky menu', 'mystickymenu'); ?></h3>
                    <label for="mysticky-stickymenu-form-enabled" class="mysticky-welcomebar-switch stickymenu-switch">
                        <input type="checkbox" id="mysticky-stickymenu-form-enabled" name="mysticky_option_name[stickymenu_enable]" value="1" <?php checked( @$mysticky_options['stickymenu_enable'], '1' );?> />
                        <span class="slider"></span>
                    </label>
                    <div class="mysticky-stickymenu-backword-page">
                        <a href="<?php echo esc_url(admin_url("admin.php?page=my-stickymenu-welcomebar"));?>"><span class="dashicons dashicons-arrow-left-alt2 back-dashboard" style="color: unset;font-size: 17px;"></span> <?php esc_html_e('Back to Dashboard', 'mystickymenu'); ?></a>
                    </div>
                </div>
                <div class="myStickymenu-header-title">
                    <h3><?php esc_html_e('How To Make a Sticky Header', 'mystickymenu'); ?></h3>
                </div>
                <p><?php esc_html_e("Add sticky menu / header to any theme. <br />Simply change 'Sticky Class' to HTML element class desired to be sticky (div id can be used as well).", 'mystickymenu'); ?></p>
            </div>
            <div class="mystickymenu-content-section sticky-class-sec p-5">
                <div class="flex flex-col md:flex-row gap-5 w-full md:items-center">
                    <div class="msb-form-field-wrap flex-1/2">
                        <?php
                        $nav_menus  = wp_get_nav_menus();
                        $menu_locations = get_nav_menu_locations();
                        $locations      = get_registered_nav_menus();
                        ?>
                        <div class="msb-form-label">
                            <label class="mysticky_title text-base!"><?php esc_html_e("Sticky Class", 'mystickymenu')?></label>
                        </div>
                        <div class="msb-form-field">
                            <div class="flex sm:items-center gap-2 flex flex-col sm:flex-row">
                                <div class="flex-1/2">
                                    <select name="mysticky_option_name[mysticky_class_id_selector]" id="mystickymenu-select">
                                        <option value=""><?php esc_html_e( 'Select Sticky Menu', 'mystickymenu' ); ?></option>

                                        <?php foreach ( (array) $nav_menus as $_nav_menu ) : ?>
                                            <option value="<?php echo esc_attr( $_nav_menu->slug ); ?>" <?php selected( $_nav_menu->slug, $mysticky_options['mysticky_class_id_selector'] ); ?>>
                                                <?php
                                                echo esc_html( $_nav_menu->name );

                                                if ( ! empty( $menu_locations ) && in_array( $_nav_menu->term_id, $menu_locations ) ) {
                                                    $locations_assigned_to_this_menu = array();
                                                    foreach ( array_keys( $menu_locations, $_nav_menu->term_id ) as $menu_location_key ) {
                                                        if ( isset( $locations[ $menu_location_key ] ) ) {
                                                            $locations_assigned_to_this_menu[] = $locations[ $menu_location_key ];
                                                        }
                                                    }

                                                    /**
                                                     * Filters the number of locations listed per menu in the drop-down select.
                                                     *
                                                     * @since 3.6.0
                                                     *
                                                     * @param int $locations Number of menu locations to list. Default 3.
                                                     */
                                                    $assigned_locations = array_slice( $locations_assigned_to_this_menu, 0, absint( apply_filters( 'wp_nav_locations_listed_per_menu', 3 ) ) );

                                                    // Adds ellipses following the number of locations defined in $assigned_locations.
                                                    if ( ! empty( $assigned_locations ) ) {
                                                        printf(
                                                            ' (%1$s%2$s)',
                                                            implode( ', ', $assigned_locations ),
                                                            count( $locations_assigned_to_this_menu ) > count( $assigned_locations ) ? ' &hellip;' : ''
                                                        );
                                                    }
                                                }
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <option value="custom" <?php selected( 'custom', $mysticky_options['mysticky_class_id_selector'] ); ?>><?php esc_html_e( 'Other Class Or ID', 'mystickymenu' );?></option>
                                    </select>
                                </div>
                                <div class="flex-1/2">
                                    <label for="mysticky_class_selector" class="sr-only"><?php esc_html_e('Enter id or class', 'mystickymenu'); ?></label>
                                    <input type="text" size="18" id="mysticky_class_selector" class="mystickyinput" name="mysticky_option_name[mysticky_class_selector]" value="<?php echo esc_attr($mysticky_options['mysticky_class_selector']);?>"  />
                                </div>
                            </div>
                            <div class="pt-1.5 flex items-center gap-1.5 text-xs">
                                <span class="dashicons dashicons-info"></span>
                                <span class="text-xs">
                                        <?php echo sprintf(__('Need help finding your ID/Class? Install <a href="%s" target="_blank">CSS Peeper</a> to quickly get your navigation menu ID/Class. Here\'s a quick <a href="%s" target="_blank">video <span class="dashicons dashicons-controls-play"></span></a> of how you can do it.', 'mystickymenu'), 'https://chrome.google.com/webstore/detail/css-peeper/mbnbehikldjhnfehhnaidhjhoofhpehk?hl=en', 'https://www.youtube.com/watch?v=uuNqSkBPnLU');?>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="msb-form-field-wrap flex-1/2">
                        <div class="mysticky_device_upgrade">
                            <label class="mysticky_title"><?php esc_html_e("Devices", 'mystickymenu')?></label>
                            <span class="myStickymenu-upgrade">
                                <a class="sticky-header-upgrade bg-[#dcd9ff]!" href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
                                    <?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?>
                                </a>
                            </span>
                            <ul class="mystickymenu-input-multicheckbox pt-3 flex items-center gap-1.5">
                                <li>
                                    <label>
                                        <input id="disable_css" name="mysticky_option_name[device_desktop]" type="checkbox"  checked  disabled />
                                        <?php esc_html_e( 'Desktop', 'mystickymenu' );?>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input id="disable_css" name="mysticky_option_name[device_mobile]" type="checkbox" checked disabled />
                                        <?php esc_html_e( 'Mobile', 'mystickymenu' );?>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mystickymenu-content-section p-5">
                <div class="text-xl pb-4">
                    <?php esc_html_e( 'Settings', 'mystickymenu' );?>
                </div>
                <div class="flex flex-col gap-5 w-full">
                    <div class="flex flex-col md:flex-row gap-5 w-full">
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="myfixed_zindex" class="mysticky_title"><?php esc_html_e("Sticky z-index", 'mystickymenu')?></label>
                            </div>
                            <div class="msb-form-field">
                                <input type="number" min="0" max="2147483647" step="1" class="mysticky-number" id="myfixed_zindex" name="mysticky_option_name[myfixed_zindex]" value="<?php echo esc_attr($mysticky_options['myfixed_zindex']);?>" />
                            </div>
                        </div>
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label class="mysticky_title myssticky-remove-hand"><?php esc_html_e("Fade or slide effect", 'mystickymenu')?></label>
                            </div>
                            <div class="msb-form-field">
                                <label>
                                    <input name="mysticky_option_name[myfixed_fade]" value= "slide" type="radio" <?php checked( @$mysticky_options['myfixed_fade'], 'slide' );?> />
                                    <?php esc_html_e("Slide", 'mystickymenu'); ?>
                                </label>
                                <label>
                                    <input name="mysticky_option_name[myfixed_fade]" value="fade" type="radio"  <?php checked( @$mysticky_options['myfixed_fade'], 'fade' );?> />
                                    <?php esc_html_e("Fade", 'mystickymenu'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-5 w-full">
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="myfixed_disable_small_screen"><?php esc_html_e("Disable at Small Screen Sizes", 'mystickymenu')?></label>
                                <p class="description"><?php esc_html_e('Less than chosen screen width, set 0 to disable','mystickymenu');?></p>
                            </div>
                            <div class="msb-form-field">
                                <div class="px-wrap">
                                    <input type="number" class="" min="0" step="1" id="myfixed_disable_small_screen" name="mysticky_option_name[myfixed_disable_small_screen]" value="<?php echo esc_attr($mysticky_options['myfixed_disable_small_screen']);?>" />
                                    <span class="input-px">PX</span>
                                </div>
                            </div>
                        </div>
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="mysticky_active_on_height"><?php esc_html_e("Make visible on Scroll", 'mystickymenu')?></label>
                                <p class="description"><?php esc_html_e('If set to 0 auto calculate will be used.','mystickymenu');?></p>
                            </div>
                            <div class="msb-form-field">
                                <div class="px-wrap">
                                    <input type="number" class="small-text" min="0" step="1" id="mysticky_active_on_height" name="mysticky_option_name[mysticky_active_on_height]" value="<?php echo esc_attr($mysticky_options['mysticky_active_on_height']);?>" />
                                    <span class="input-px">PX</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-5 w-full">
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="mysticky_active_on_height_home" class="mysticky_title"><?php esc_html_e("Make visible on Scroll at homepage", 'mystickymenu')?></label>
                                <p class="description"><?php esc_html_e( 'If set to 0 it will use initial Make visible on Scroll value.', 'mystickymenu' );?></p>
                            </div>
                            <div class="msb-form-field">
                                <div class="px-wrap">
                                    <input type="number" class="small-text" min="0" step="1" id="mysticky_active_on_height_home" name="mysticky_option_name[mysticky_active_on_height_home]" value="<?php echo esc_attr($mysticky_options['mysticky_active_on_height_home']);?>" />
                                    <span class="input-px">PX</span>
                                </div>
                            </div>
                        </div>
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="myfixed_bgcolor" class="mysticky_title myssticky-remove-hand"><?php esc_html_e("Sticky Background Color", 'mystickymenu')?></label>
                            </div>
                            <div class="msb-form-field">
                                <input type="text" id="myfixed_bgcolor" name="mysticky_option_name[myfixed_bgcolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($mysticky_options['myfixed_bgcolor']);?>" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-5 w-full">
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="myfixed_transition_time" class="mysticky_title"><?php esc_html_e("Sticky Transition Time", 'mystickymenu')?></label>
                            </div>
                            <div class="msb-form-field">
                                <input type="number" class="small-text" min="0" step="0.1" id="myfixed_transition_time" name="mysticky_option_name[myfixed_transition_time]" value="<?php echo esc_attr($mysticky_options['myfixed_transition_time']);?>" />
                            </div>
                        </div>
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="myfixed_textcolor" class="mysticky_title myssticky-remove-hand"><?php esc_html_e("Sticky Text Color", 'mystickymenu')?></label>
                            </div>
                            <div class="msb-form-field">
                                <input type="text" id="myfixed_textcolor" name="mysticky_option_name[myfixed_textcolor]" class="my-color-field" data-alpha="true" value="<?php echo (isset($mysticky_options['myfixed_textcolor'])) ? esc_attr($mysticky_options['myfixed_textcolor']) : '';?>" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-5 w-full">
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">
                            <div class="msb-form-label flex-1 sm:flex-[0_0_250px]">
                                <label for="myfixed_opacity" class="mysticky_title myssticky-remove-hand"><?php esc_html_e("Sticky Opacity", 'mystickymenu')?></label>
                                <p class="description"><?php esc_html_e( 'numbers 1-100.', 'mystickymenu');?></p>
                            </div>
                            <div class="msb-form-field">
                                <input type="hidden" class="small-text mysticky-slider" min="0" step="1" max="100" id="myfixed_opacity" name="mysticky_option_name[myfixed_opacity]"  value="<?php echo esc_attr($mysticky_options['myfixed_opacity']);?>"  />
                                <div id="slider" class="w-full! relative!">
                                    <div class="slider-range bg-[#7761DF] h-0.5 absolute left-0" id="slider-range"></div>
                                    <div id="custom-handle" class="ui-slider-handle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="msb-form-field-wrap inline-field flex flex-col sm:items-center gap-1 sm:gap-2.5 sm:flex-row sm:flex-1/2">

                        </div>
                    </div>
                </div>
            </div>

            <div class="mystickymenu-content-section p-5 <?php echo !$is_old?"mystickymenu-content-upgrade":""?>" >
                <div class="pb-4 flex justify-between">
                    <div class="text-xl">
                        <?php esc_html_e( 'Hide on Scroll Down', 'mystickymenu' );?>
                    </div>
                    <div>
                        <div class="myStickymenu-upgrade">
                            <a class="sticky-header-activate-key" href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
                                <?php esc_html_e( 'Upgrade now', 'mystickymenu' );?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <label class="mysticky_text m-0!" for="myfixed_disable_scroll_down">
                        <input disabled id="myfixed_disable_scroll_down" name="mysticky_option_name[myfixed_disable_scroll_down]" type="checkbox" />
                        <?php esc_html_e("Disable sticky menu at scroll down", 'mystickymenu'); ?>
                    </label>
                </div>
                <div class="text-lg pt-4 pb-0">
                    <?php esc_html_e( 'Page targeting', 'mystickymenu' );?>
                </div>
                <div class="mysticky-page-target-setting mystickymenu-content-option p-0!">
                    <div class="mystickymenu-input-section mystickymenu-page-target-wrap">
                        <div class="mysticky-welcomebar-setting-content-right gap-0!">
                            <div class="mysticky-page-options" id="mysticky-welcomebar-page-options">

                            </div>
                            <a href="#" class="create-rule m-0!" id="mysticky_create-rule"><?php esc_html_e( "Add Rule", "mystickymenu" );?></a>
                        </div>
                        <input type="hidden" id="mysticky_welcomebar_site_url" value="<?php echo esc_url(site_url("/")) ?>" />
                        <div class="mysticky-page-options-html" style="display: none;">
                            <div class="mysticky-page-option mb-0!">
                                <div class="url-content flex gap-4 w-full flex-col sm:flex-row">
                                    <div class="flex gap-4 flex-col sm:flex-row flex-1">
                                        <div class="mysticky-welcomebar-url-select flex-1">
                                            <select name="" id="url_shown_on___count___option">
                                                <option value="show_on"><?php esc_html_e("Show on", "mystickymenu" );?></option>
                                                <option value="not_show_on"><?php esc_html_e("Don't show on", "mystickymenu" );?></option>
                                            </select>
                                        </div>
                                        <div class="mysticky-welcomebar-url-option flex-1">
                                            <select class="mysticky-url-options" name="" id="url_rules___count___option">
                                                <option selected="selected" disabled value=""><?php esc_html_e("Select Rule", "mystickymenu" );?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 flex-col sm:flex-row sm:items-center flex-1">
                                        <div class="mysticky-welcomebar-url-box flex-1">
                                            <span class='mysticky-welcomebar-url'><?php echo esc_url(site_url("/")); ?></span>
                                        </div>
                                        <div class="mysticky-welcomebar-url-values flex-1">
                                            <input type="text" value="" name="mysticky_option_name[mysticky_page_settings][__count__][value]" id="url_rules___count___value" disabled />
                                        </div>
                                    </div>
                                </div>
                                <span class="myStickymenu-upgrade"><a class="sticky-header-upgrade" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-lg pb-0 pt-4">
                    <?php esc_html_e( 'CSS style', 'mystickymenu' );?>
                </div>
                <div class="mystickymenu-content-option p-0!">
                    <span class="mysticky_text m-0! text-[#3C434A]!"><?php esc_html_e( 'Add/edit CSS style. Leave it blank for default style.', 'mystickymenu');?></span>
                    <div class="mystickymenu-input-section">
                        <label for="myfixed_cssstyle" class="sr-only"><?php esc_html_e('Custom CSS', 'mystickymenu'); ?></label>
                        <textarea class="min-h-20" type="text" rows="4" cols="60" id="myfixed_cssstyle" name="mysticky_option_name[myfixed_cssstyle]" disabled></textarea>
                    </div>
                    <p class="p-0 m-0!"><?php esc_html_e( "CSS ID's and Classes to use:", "mystickymenu" );?></p>
                    <p class="p-0 m-0! mt-1!">
                        #mysticky-wrap { }<br/>
                        #mysticky-nav.wrapfixed { }<br/>
                        #mysticky-nav.wrapfixed.up { }<br/>
                        #mysticky-nav.wrapfixed.down { }<br/>
                        #mysticky-nav .navbar { }<br/>
                        #mysticky-nav .navbar.myfixed { }<br/>
                    </p>
                </div>

                <div class="mystickymenu-content-option p-0! pt-4!">
                    <div class="text-lg pb-0">
                        <?php esc_html_e( 'Disable CSS style', 'mystickymenu' );?>
                    </div>
                    <div class="mystickymenu-input-section p-0! m-0!">
                        <label>
                            <input id="disable_css" name="mysticky_option_name[disable_css]" type="checkbox" disabled />
                            <?php esc_html_e( 'Use this option if you plan to include CSS Style manually', 'mystickymenu' );?>
                        </label>
                    </div>
                    <p></p>
                </div>

                <div class="mystickymenu-content-option p-0!">
                    <div class="text-lg pb-0.5">
                        <?php esc_html_e( 'Disable at', 'mystickymenu' );?>
                    </div>
                    <?php if(!$is_old) { ?><span class="myStickymenu-upgrade"><a class="sticky-header-upgrade" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span><?php } ?>
                    <div class="mystickymenu-input-section p-0! m-0!">
                        <ul class="mystickymenu-input-multicheckbox">
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_front_home" name="mysticky_option_name[mysticky_disable_at_front_home]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?>  <?php checked( @$mysticky_options['mysticky_disable_at_front_home'], 'on' );?>/>
                                    <span><?php esc_attr_e('front page', 'mystickymenu' );?></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_blog" name="mysticky_option_name[mysticky_disable_at_blog]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?>  <?php checked( @$mysticky_options['mysticky_disable_at_blog'], 'on' );?>/>
                                    <span><?php esc_attr_e('blog page', 'mystickymenu' );?></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_page" name="mysticky_option_name[mysticky_disable_at_page]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?> <?php checked( @$mysticky_options['mysticky_disable_at_page'], 'on' );?> />
                                    <span><?php esc_attr_e('pages', 'mystickymenu' );?> </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_tag" name="mysticky_option_name[mysticky_disable_at_tag]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?> <?php checked( @$mysticky_options['mysticky_disable_at_tag'], 'on' );?> />
                                    <span><?php esc_attr_e('tags', 'mystickymenu' );?> </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_category" name="mysticky_option_name[mysticky_disable_at_category]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?>  <?php checked( @$mysticky_options['mysticky_disable_at_category'], 'on' );?>/>
                                    <span><?php esc_attr_e('categories', 'mystickymenu' );?></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_single" name="mysticky_option_name[mysticky_disable_at_single]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?> <?php checked( @$mysticky_options['mysticky_disable_at_single'], 'on' );?> />
                                    <span><?php esc_attr_e('posts', 'mystickymenu' );?> </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_archive" name="mysticky_option_name[mysticky_disable_at_archive]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?> <?php checked( @$mysticky_options['mysticky_disable_at_archive'], 'on' );?> />
                                    <span><?php esc_attr_e('archives', 'mystickymenu' );?> </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_search" name="mysticky_option_name[mysticky_disable_at_search]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?> <?php checked( @$mysticky_options['mysticky_disable_at_search'], 'on' );?> />
                                    <span><?php esc_attr_e('search', 'mystickymenu' );?> </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input id="mysticky_disable_at_404" name="mysticky_option_name[mysticky_disable_at_404]" type="checkbox"  <?php echo !$is_old?"disabled":"" ?>  <?php checked( @$mysticky_options['mysticky_disable_at_404'], 'on' );?>/>
                                    <span><?php esc_attr_e('404', 'mystickymenu' );?> </span>
                                </label>
                            </li>
                        </ul>

                        <?php
                        if  (isset ( $mysticky_options['mysticky_disable_at_page'] ) == true )  {
                            echo '<div class="mystickymenu-input-section">';
                            echo '<span class="description"><strong>';
                            esc_html_e('Except for this pages:', 'mystickymenu');
                            echo '</strong></span>';

                            printf(
                                '<input disabled type="text" size="26" class="mystickymenu_normal_text max-w-50! mx-2!" id="mysticky_enable_at_pages" name="mysticky_option_name[mysticky_enable_at_pages]" value="%s"  /> ',
                                isset( $mysticky_options['mysticky_enable_at_pages'] ) ? esc_attr( $mysticky_options['mysticky_enable_at_pages']) : ''
                            );
                            echo '<span class="description">';
                            esc_html_e('Comma separated list of pages to enable. It should be page name, id or slug. Example: about-us, 1134, Contact Us. Leave blank if you realy want to disable sticky menu for all pages.', 'mystickymenu');
                            echo '</span>';
                            echo '</div>';
                        }

                        if  (isset ( $mysticky_options['mysticky_disable_at_single'] ) == true )  {

                            echo '<div class="mystickymenu-input-section pt-4">';
                            echo '<span class="description"><strong>';
                            esc_html_e('Except for this posts:', 'mystickymenu');
                            echo '</strong> </span>';

                            printf(
                                '<input disabled type="text" size="26" class="mystickymenu_normal_text max-w-50! mx-2!" id="mysticky_enable_at_posts" name="mysticky_option_name[mysticky_enable_at_posts]" value="%s" /> ',
                                isset( $mysticky_options['mysticky_enable_at_posts'] ) ? esc_attr( $mysticky_options['mysticky_enable_at_posts']) : ''
                            );

                            echo '<span class="description">';
                            esc_html_e('Comma separated list of posts to enable. It should be post name, id or slug. Example: about-us, 1134, Contact Us. Leave blank if you realy want to disable sticky menu for all posts.', 'mystickymenu');
                            echo '</span>';
                            echo '</div>';

                        }
                        ?>
                        <p></p>
                    </div>
                </div>
            </div>

            <!-- Mysticky Menu: Save & Save Dashbaord Submission Validation Popup -->

            <div class="mystickymenu-action-popup new-center" id="mysticky-sticky-save-confirm" style="display:none;">
                <div class="mystickymenu-action-popup-header">
                    <h3><?php esc_html_e("Turn on Sticky Menu","mystickymenu"); ?></h3>
                    <span class="dashicons dashicons-no-alt close-button" data-from = "stickymenu-confirm"></span>
                </div>
                <div class="mystickymenu-action-popup-body">
                    <p><?php esc_html_e("Sticky Menu is not turned on. Turn on Sticky Menu to activate sticky menu on your website.","mystickymenu"); ?></p>
                </div>
                <div class="mystickymenu-action-popup-footer">
                    <button type="button" class="btn-enable btn-nevermind-status" id="stickymenu_status_dolater" ><?php esc_html_e("Just save & keep it off","mystickymenu"); ?></button>
                    <button type="button" class="btn-disable-cancel" id="stickymenu_status_ok" ><?php esc_html_e("Save & Turn on Sticky Menu","mystickymenu"); ?></button>
                </div>
            </div>
            <div class="mystickymenupopup-overlay" id="stickymenu-option-overlay-popup"></div>

            <!-- End Save & Save Dashbaord Submission Validation Popup -->

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary btn-save-stickymenu" value="<?php esc_attr_e('Save', 'mystickymenu');?>">

                <input type="submit" name="submit_dashboard" id="submit_dashboard" class="button button-primary save_view_dashboard" style="width: auto;" value="<?php esc_html_e('Save & View Dashboard', 'mystickymenu');?>">
            </p>
            <input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>">
            <input type="hidden" id="save_stickymenu" value=""/>
        </form>
        <form class="mysticky-hideformreset" method="post" action="">
            <input name="reset_mysticky_options" class="button button-secondary confirm" type="submit" value="<?php esc_attr_e('Reset', 'mystickymenu');?>" >
            <input type="hidden" name="action" value="reset" />
            <?php $nonce = wp_create_nonce('mysticky_option_backend_reset_nonce'); ?>
            <input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>">
        </form>
        <p class="myStickymenu-review"><a href="https://wordpress.org/support/plugin/mystickymenu/reviews/" target="_blank"><?php esc_attr_e('Leave a review','mystickymenu'); ?></a></p>
    </div>
</div>