<?php 
	$stickymenus_widgets = get_option( 'mysticky_option_welcomebar' );
	if ( !isset( $stickymenus_widgets['mysticky_welcomebar_enable'])) {
		$widget_status = 0;
	}
	if ( isset( $stickymenus_widgets['mysticky_welcomebar_enable']) ) {
		$widget_status = $stickymenus_widgets['mysticky_welcomebar_enable'];
	}
	$mysticky_options = get_option( 'mysticky_option_name' );


	function getRecentContactLead(){
		global $wpdb;
		$table_name = $wpdb->prefix . "mystickymenu_contact_lists";
		$query = "SELECT * FROM {$table_name} ORDER BY ID DESC LIMIT 3";
		$result     = $wpdb->get_results( $query );

		return $result;
	}
?>
<!-- Updated design -->
<div class="wrap mystickymenu-wrap">
	<div class="mystickymenu-dashboard flex flex-col gap-7">
		<?php if(isset($stickymenus_widgets) && !empty($stickymenus_widgets)) :  ?>
		<div class="welcomebars-list-table">
			<div class="header-section">
				<div class="heading-title">
                    <h3>
                        <?php esc_html_e( 'Dashboard', 'mystickymenu');?>
                    </h3>
                </div>
				<div class="mystickymenu-widgets-btn-wrap">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=my-stickymenu-new-welcomebar'))?>" class="add_new_welcombar msb-primary-button">
                        <span class="dashicons dashicons-insert" style="font-size:18px;color:#fff;"></span>
                        <?php echo esc_html_e('Add a New Bar','mystickymenu');?>
                    </a>
                </div>
			</div>
		
			<table class="dashboard-table msb-table">
				<thead>
					<tr>
						<th class="text-center"><?php esc_html_e( 'Status', 'mystickymenu');?></th>
						<th class="text-left"><?php esc_html_e( 'Bars', 'mystickymenu');?></th>
						<th class="text-center"><?php esc_html_e( 'Quick Action', 'mystickymenu');?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($stickymenus_widgets) && !empty($stickymenus_widgets)) : ?>
					<tr id="stickymenu-widget-0">
						<td class="text-center w-20">
							<label class="mysticky-welcomebar-switch welcombar-status-switch">
								<input type="checkbox" data-id="0" class="mystickymenu-widget-enabled" name ="mystickymenu-widget-enabled" data-id = "0" id = "mystickymenu-widget-enabled-0" value="1" <?php checked( $widget_status, 1 ); ?> />
								<span class="slider round"></span>
							</label>
							<div class="mystickymenu-action-popup welcombar-enabled-status" id="widget-status-dialog-0" style="display:none;">
								<div class="mystickymenu-action-popup-header">
									<h3><?php esc_html_e('Are you sure?','mystickymenu');?></h3>
									<span class="dashicons dashicons-no-alt close-button" data-from = "welcome-bar-status"data-id="0"></span>
								</div>
								<div class="mystickymenu-action-popup-body">
									<p><?php esc_html_e("You're about to turn off the bar. Are you sure about that?",'mystickymenu');?></p>
								</div>
								<div class="mystickymenu-action-popup-footer">
									<button type="button" class="btn-enable btn-nevermind-status" data-id="0"><?php esc_html_e('Nevermind','mystickymenu');?></button>
									<button type="button" class="btn-disable-cancel btn-turnoff-status" data-id="0"><?php esc_html_e('Turn off','mystickymenu');?></button>
								</div>
							</div>
							<div class="mystickymenupopup-overlay mystickymenupopup-widget-status-overlay" id="mystickymenu-status-popup-overlay-0" data-id="0" data-from="welcomebar-status" data-fromoverlay="welcombar_status"></div>
						</td>
						<td class="text-left"><?php echo esc_html_e('Bar #0','mystickymenu'); ?></td>
						<td class="text-center w-40 action-col">
							<div class="tooltip">
								<span class="tooltiptext"><?php esc_html_e('Edit','mystickymenu');?></span>
								<a href="<?php echo admin_url("admin.php?page=my-stickymenu-welcomebar&widget=0&isedit=1" );?>" ><img src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/edit-icon.svg" /></a>
							</div>
							<div class="tooltip">
								<span class="tooltiptext"><?php esc_html_e('Duplicate','mystickymenu');?></span>
								<a class="copyicon" href='<?php echo admin_url("admin.php?page=my-stickymenu-new-welcomebar&duplicate_from=1");?>'><img src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/copy-icon.svg" /></a>
							</div>
								
							<div class="tooltip">
								<span class="tooltiptext"><?php esc_html_e('Delete','mystickymenu');?></span>
								<a href="#" class="mystickymenu-delete-widget" id="delete-widget-0" data-widget-id="0"><img src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/delete-icon.svg" /></a>
							</div>
							
							
							<div class="mystickymenu-action-popup" id="widget-delete-dialog-0" style="display:none;">
								<div class="mystickymenu-action-popup-header">
									<h3><?php esc_html_e('Are you sure?','mystickymenu');?></h3>
									<span class="dashicons dashicons-no-alt close-button" data-from = "welcome-bar-delete"data-id="0"></span>
								</div>
								<div class="mystickymenu-action-popup-body">
									<p><?php esc_html_e("Are you sure want to delete the bar? You will lose the bar permanently and will not be able to retrieve it",'mystickymenu');?></p>
								</div>
								<div class="mystickymenu-action-popup-footer">
									<button type="button" class="btn-enable btn-delete-cancel"  data-id="0"><?php esc_html_e('Nevermind','mystickymenu');?></button>
									<button type="button" class="btn-disable-cancel btn-delete" data-id="0"><?php esc_html_e('Delete','mystickymenu');?></button>
								</div>
							</div>
							<div class="mystickymenupopup-overlay" id="mystickymenu-delete-popup-overlay-0" data-id="0" data-fromoverlay="welcombar_delete"></div>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php else:?>
		
		<div class="mystickymenu-dashboard new-welcomebar-section-wrap">
			<div class="mystickymenu-welcome-img">
				<img src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/firstwelcombar.svg" />
			</div>
			<div class="mystickymenu-newwelcomebar-contents">
				<h2><?php esc_html_e("Welcome 🎉","mystickymenu");?></h2>
				<p><?php esc_html_e("You're one step away from creating a bar.","mystickymenu")?> </p> 
				<p><?php esc_html_e("Add top and bottoms bars for various purposes like showing updates, offers, countdown, flash sales, and more. You can also make any WordPress menu sticky easily.","mystickymenu");?></p>
				<a href="<?php echo esc_url(admin_url('admin.php?page=my-stickymenu-new-welcomebar'));?>" class="add_new_welcombar msb-primary-button py-2! px-6! mt-4!">
                    <?php echo esc_html_e('Add a New Bar','mystickymenu');?>
                    <span class="dashicons dashicons-arrow-right-alt text-white text-base"></span>
                </a>
			</div>	
			<div class="mystickymenu-features">
				<div class="mystickymenu-feature-title">
				<img src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/crown.svg" alt="My Happy SVG" />
				<?php esc_html_e("Features","mystickymenu");?></div>
				<div class="mystickymenu-features-list">
					<ul class="documents-wrap-list">
						<li><?php esc_html_e("Create new bars with unique customization","mystickymenu");?></li>
						<li><?php esc_html_e("Make your WordPress navigation menu sticky","mystickymenu");?></li>
						<li><?php esc_html_e("Explore more triggers & targeting options","mystickymenu");?></li>
					</ul>
				</div>
			</div>	
		</div>
		<?php endif; ?>
		<!-- /**/ */ -->
		
		<div class="mystickymenu-tab-boxs-wrap flex flex-col md:flex-row gap-5">

			<!--Main 1st -->

			<div class="mystickymenu-tab-stickymenu msmenu-blockbox flex-1 flex flex-col gap-5">
				<?php $result = getRecentContactLead(); ?>
				
				<!-- 1 -->
				<div class="contact-recent-lead msm-bgbox">
					<div class="stickymenubox-title-section">
						<h3><?php esc_html_e("Recent Leads","mystickymenu");?></h3> 
						<?php if(isset($result) && count($result) > 0) : ?>
							<a class="msb-secondary-button" href="<?php echo esc_url(admin_url('admin.php?page=my-sticky-menu-leads'));?>"><?php echo esc_html_e('View All','mystickymenu');?></a>
						<?php endif; ?>
					</div>
					<?php 	
					if( isset($result) && count($result) > 0 ){?>
						<div class="stickymenu recent-lead-table">
							<table>
								<tr>
									<th><?php esc_html_e('Name','mystickymenu');?></th>
									<th><?php esc_html_e('Email','mystickymenu');?></th>
									<th><?php esc_html_e('Phone','mystickymenu');?></th>
								</tr>
								<?php 
									foreach( $result as $key => $val ){
										echo "<tr>";
										echo "<td>". esc_html($val->contact_name) ." </td>";
										echo "<td>". esc_html($val->contact_email) ." </td>";
										echo "<td>". esc_html($val->contact_phone) ." </td>";
										echo "</tr>";
									}
								?>
							</table>
						</div>
					<?php
					}else{?>
						<div class="stickymenu-no-lead text-center">
							<?php echo '<img src="'. esc_url(MYSTICKYMENU_URL) .'images/empty_lead.png" class="mx-auto" />'; ?>
							<p><?php  esc_html_e("Once you get a new lead, it’ll appear here","mystickymenu");?></p>
						</div>
						<?php	
					}
					?>
					
				</div>
				<!-- 2 -->
				<div class="contactus-tab-option msm-bgbox">
                    <div class="stickymenubox-title-section">
                        <h3><?php esc_html_e('Create Popups That Convert', 'mystickymenu'); ?></h3>
                    </div>
                    <div class="premio-footer-option flex-col sm:flex-row sm:items-center gap-5">
						<h3>
                            <img src="<?php echo esc_url(MYSTICKYMENU_URL . "images/poptin-popups.png"); ?>" />
                        </h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="premio-content-list text-center w-full sm:text-left">
                                <span><?php esc_html_e("Engaging popups and forms for your website. Build in minutes.", "mystickymenu"); ?></span>
                            </div>
                            <?php
                            if( class_exists( 'POPTIN_Plugin_Base' ) ) {
                                $poptin_url = admin_url('admin.php?page=poptin');
                            } else {
                                $poptin_url = admin_url('admin.php?page=install-poptin-plugin');
                            }
                            ?>
                            <div class="text-center">
                                <a class="msb-secondary-button " href="<?php echo esc_url( $poptin_url );?>" target="_blank">
                                    <?php
                                    if(get_option('poptin_id', false) != false){
                                        echo esc_html_e("Manage Poptin Popups","mystickymenu");
                                    }else{
                                        echo esc_html_e("Create Your First Popup","mystickymenu");
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
					</div>
					
				</div>
				<!--  -->

			</div>

			<!--Main 2nd -->
			
			<div class="msmenu-blockbox flex-1 flex-1 flex flex-col gap-5">
			<!-- 1 -->
				<div class="stickymenu-tab-option msm-bgbox">
					<div class="stickymenubox-title-section"><h3><?php esc_html_e("Sticky menu","mystickymenu");?></h3></div>
					<div class="stickymenu-settings">
						<div class="settings-content">
							<?php 
								if(isset($mysticky_options['stickymenu_enable']) && $mysticky_options['stickymenu_enable'] == 1){
									echo '<p>'.esc_html__('Sticky menu is currently turned on.', 'mystickymenu').'</p>';
								}else{
									echo '<p>'.esc_html__('Sticky menu is not currently configured. Configure to enable.', 'mystickymenu').'</p>';
								}
							?>
						</div>
						<div class="stickymenu-box-button settings-buttons">
                            <div class="flex items-center gap-2">
                                <?php if(isset($mysticky_options['stickymenu_enable']) && $mysticky_options['stickymenu_enable'] == 1):
                                ?>
                                    <a href="<?php echo esc_url(admin_url("admin.php?page=my-stickymenu-settings"));?>" id="btn-config-settings" class="msb-primary-button py-2!">
                                        <?php esc_html_e("Settings","mystickymenu"); ?>
                                    </a>
                                    <a href="#" id="btn-config-disable" class="msb-secondary-button text-[#d3465c]! border-[#d3465c]! hover:bg-[#d3465c]/20!">
                                        <?php esc_html_e("Disable","mystickymenu"); ?>
                                    </a>
                                <?php else : ?>
                                    <a class="msb-secondary-button" href="<?php echo esc_url(admin_url("admin.php?page=my-stickymenu-settings"));?>">
                                        <?php esc_html_e("Configure","mystickymenu"); ?>
                                    </a>
                                <?php endif; ?>
						    </div>
						</div>
					</div>
				</div>
				<!-- 2 -->
				<div class="mystickymenu-tab-documentation msm-bgbox">
                    <div class="stickymenubox-title-section">
                        <h3><?php esc_html_e('Documentation', 'mystickymenu'); ?></h3>
                    </div>
                    <div class="stickymenu-box-container flex flex-column gap-x-px">
                        <ul class="documents-wrap-list">
                            <li><a href="https://premio.io/help/mystickymenu/how-to-use-my-sticky-menu/" target="_blank"><?php esc_html_e('How to use My Sticky Bar?','mystickymenu');?></a></li>
                            <li><a href="https://premio.io/help/mystickymenu/how-to-add-your-sticky-menu-on-specific-pages-only/" target="_blank"><?php esc_html_e('How to add your sticky menu on specific pages only','mystickymenu');?></a></li>
                            <li><a href="https://premio.io/help/mystickymenu/how-to-create-a-welcome-bar/" target="_blank"><?php esc_html_e('How to create a Bar','mystickymenu');?></a></li>
                        </ul>

                        <div class="flex! justify-between gap-2 items-center! stickymenu-box-button">
							<div class="inline-flex pr-2">
                                <?php esc_html_e("Need more help? Visit our ","mystickymenu");?>
                            </div>
							<a class="msb-secondary-button" href="https://premio.io/help/mystickymenu/?utm_source=msmhelp" target="_blank">
                                <?php esc_html_e("Help Center","mystickymenu"); ?>
                            </a>
						</div>
                    </div>
				</div>
			</div>
		</div>

        <div class="mystickymenu-tab-boxs-wrap msmenu-flexbox">
            <div class="mystickymenu-tab-stickymenu contactus-tab-option-wrap msmenu-blockbox">
                <div class="contactus-tab-option msm-bgbox">
                    <div class="inline-flex gap-1.5 items-center text-sm">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M12 1L9 9L1 12L9 15L12 23L15 15L23 12L15 9L12 1Z" fill="black"/></svg>
                        <?php esc_html_e('Explore amazing products from the premio team and supercharge your wordpress website!', 'mystickymenu')?>
                        <a class="copyicon1 text-sm whitespace-nowrap" href="https://premio.io/" target="_blank">
                            <?php esc_html_e('Visit website', 'mystickymenu');?>
                            <span class="inline-flex! dashicons dashicons-external"></span>
                        </a>
                    </div>
                    <div class="contactus-tab-option-right">
                        <div class="contactus-contents-buttons whitespace-nowrap">
                            <span class="folous text-sm!"><?php esc_html_e('Follow Us', 'mystickymenu');?> </span>
                            <div class="inline-flex gap-0.5 items-center">
                                <a class="facebook-link copyicon inline-flex w-8 h-8" href="https://www.facebook.com/groups/premioplugins/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50" class="fill-[#4267B2] w-full h-full">
                                        <path d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M37,19h-2c-2.14,0-3,0.5-3,2 v3h5l-1,5h-4v15h-5V29h-4v-5h4v-3c0-4,2-7,6-7c2.9,0,4,1,4,1V19z"></path>
                                    </svg>
                                </a>
                                <a href="https://x.com/premioplugins" class="tweeter-link copyicon inline-flex w-8 h-8" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50" class="w-full h-full">
                                        <path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- 00000 END  -->
	</div>

    <div class="mystickymenu-action-popup new-center" id="stickymenu_status_popupbox" style="display:none;">
        <div class="mystickymenu-action-popup-header">
            <h3><?php esc_html_e("Are you sure?","mystickymenu"); ?></h3>
            <span class="dashicons dashicons-no-alt close-button" data-from = "stickymenu-status"></span>
        </div>
        <div class="mystickymenu-action-popup-body">
            <p><?php esc_html_e("You’re about to turn off the sticky menu feature. Are you sure about that?","mystickymenu"); ?></p>
        </div>
        <div class="mystickymenu-action-popup-footer">
            <button type="button" class="btn-enable btn-nevermind-status" id="stickymenu_status_nevermind" ><?php esc_html_e("Nevermind","mystickymenu"); ?></button>
            <button type="button" class="btn-disable-cancel" id="stickymenu_status_turnoff" ><?php esc_html_e("Turn off","mystickymenu"); ?></button>
        </div>
    </div>
    <div class="mystickymenupopup-overlay" id="stickymenuconfig-overlay-popup"></div>
</div>	