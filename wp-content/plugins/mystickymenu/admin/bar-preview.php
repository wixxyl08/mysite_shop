<?php
/**
 * MSB BarPreview
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

if (defined('ABSPATH') === false) {
    exit;
}
$button_postion_relative_text = (isset($welcomebar['mysticky_welcomebar_button_postion_relative_text']) ) ? esc_attr($welcomebar['mysticky_welcomebar_button_postion_relative_text']) : '';
$button_text_postion = (isset($welcomebar['mysticky_welcomebar_button_text_postion']) ) ? esc_attr($welcomebar['mysticky_welcomebar_button_text_postion']) : 'center';
$button_text_postion_clss = '';
if ( $button_postion_relative_text == 1 ) {
	$button_text_postion_clss = 'mysticky-welcomebar-position-' . $button_text_postion;
}
?>
<div class="mysticky-welcomebar-preview-wrap">
	<div class="mysticky-welcomebar-setting-right mysticky-welcomebar-preview">
		<div class="mysticky-welcomebar-backword-page">
			<a href="<?php echo esc_url(admin_url("admin.php?page=my-stickymenu-welcomebar"));?>"><span class="dashicons dashicons-arrow-left-alt2 back-dashboard" style="color: unset;font-size: 17px;"></span> <?php esc_html_e('Back to Dashboard', 'mystickymenu'); ?></a>
		</div>
		<div class="mysticky-welcomebar-header-title">
			<h3><?php esc_html_e('Preview', 'mystickymenu'); ?></h3>
		</div>
		<div class="mysticky-welcomebar-preview-screen">
			<div class="mysticky-welcomebar-fixed mysticky-welcomebar-display-desktop <?php echo esc_attr($display_main_class); ?>" >
				<div class="mysticky-welcomebar-fixed-wrap <?php echo esc_attr($button_text_postion_clss);?>">
					<?php 
						$content_width = (isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] === '1') ? '90%'  : '75%';
					?>	
					<div class="mysticky-welcomebar-content" style="width:<?php  echo esc_attr($content_width); ?>">								
						<div class="mysticky-welcomebar-static_text" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] == 'static_text') ? 'block' : 'none'; ?>">
						<?php echo isset($welcomebar['mysticky_welcomebar_bar_text'])? stripslashes($welcomebar['mysticky_welcomebar_bar_text']) :"Get 30% off your first purchase";?>								
						</div>
					</div>

					<div class="mysticky-welcomebar-lead-content gap-2" <?php if((isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] != 1)) :?> style="display:none;" <?php endif; ?>>
						<input type="text" class="preview-lead-name" placeholder="<?php echo esc_attr($welcomebar['lead_name_placeholder']);?>"/>
						<input type="text" class="preview-lead-email" placeholder="<?php echo esc_attr($welcomebar['lead_email_placeholder']);?>" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] == 'email_address') ? 'flex' : 'none';?>"/>
						<input type="text" class="preview-lead-phone" placeholder="<?php echo esc_attr($welcomebar['lead_phone_placeholder']);?>" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] == 'phone') ? 'flex' : 'none';?>"/>
					</div>

					<div class="mysticky-welcomebar-btn">
						<?php 
                        $mysticky_welcomebar_btn_text =  isset($welcomebar['mysticky_welcomebar_btn_text']) ? stripslashes($welcomebar['mysticky_welcomebar_btn_text']) : "Got it!";
                        $allowedTags = [
                            'p' => array(
                                    'style' => array(),
                            ),
                            'br' => array(),
                            'em' => array(),
                            'span' => array(
                                    'style' => array(),
                            ),
                            'u' => array(),
                            'strong' => array(),
                            'underline' => array(),
                        ];
						?>
                        <a class="msb-welcomebar-btn" href="#" >
                            <span class="button-text">
                                <?php echo wp_kses($mysticky_welcomebar_btn_text, $allowedTags);?>
                            </span>
                        </a>
				    </div>
                    <?php
                    $x_color = (isset($welcomebar['mysticky_welcomebar_x_color'])) ? esc_attr($welcomebar['mysticky_welcomebar_x_color']) : '#000000';
                    ?>
                    <span class="mysticky-welcomebar-close" style="color:<?php echo esc_attr($x_color);?>" tabindex="0" role="button" aria-label="close">X</span>
                </div>
			</div>
		</div>
		<div class="timer-message" <?php if(isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] != 1):?> style="display:none;"<?php endif;?>>
			<p><span class="dashicons dashicons-info"></span> The elements will be displayed in 1-line on your actual website. <a class="save_change" href="#"><?php esc_html_e('Save changes', 'mystickymenu'); ?></a> and <a href="<?php echo esc_url(site_url());?>" target="_blank" class="visit_site_link"><span class="dashicons dashicons-migrate" style="color: #2271b1 !important;"></span> visit your website</a> to check how it’d look like</p>
		</div>
		<div class="mysticky-welcomebar-full-screen flex justify-center items-center">
			<button type="button" class="welcomebar-full-screen-btn">
				<?php esc_html_e( 'Show Fullscreen Preview', 'mystickymenu' );?>
				<span class="dashicons dashicons-fullscreen-alt"></span>
			</button>
			
			<button type="button" class="welcomebar-minimise-screen-btn" style="display:none;">
				<?php esc_html_e( 'Minimise Preview', 'mystickymenu' );?>
				<span class="dashicons dashicons-fullscreen-exit-alt"></span>
			</button>
		</div>
	</div>
	<style>
		.morphext > .morphext__animated {
		  display: inline-block;
		}
		.mysticky-welcomebar-fixed {
			background-color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_bgcolor']); ?>;
			font-family: <?php echo esc_attr($welcomebar['mysticky_welcomebar_font']); ?>;
			position: absolute;
			left: 0;
			right: 0;
			opacity: 0;
			z-index: 9;
			-webkit-transition: all 1s ease 0s;
			-moz-transition: all 1s ease 0s;
			transition: all 1s ease 0s;
		}
		.mysticky-welcomebar-fixed-wrap {
			width: 98%;
			min-height: 60px;
			padding: 10px 29px 10px 20px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.mysticky-welcomebar-preview-mobile-screen .mysticky-welcomebar-fixed{
			padding: 0 25px;
		}
		.mysticky-welcomebar-position-top {
			top:0;
		}
		.mysticky-welcomebar-position-bottom {
			bottom:0;
		}
		.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in {
			top: -80px;
		}
		.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in {
			bottom: -80px;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect {
			top:0;
			opacity: 1;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect {
			bottom:0;
			opacity: 1;
		}
		.mysticky-welcomebar-entry-effect-fade {
			opacity: 0;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-fade.entry-effect {
			opacity: 1;
		}
		.mysticky-welcomebar-entry-effect-none {
			display: none;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-none.entry-effect {
			display: block;
			opacity: 1;
		}	.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
			top: 0;			
		}
		.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
			bottom: 0;
		}		
		.mysticky-welcomebar-fixed .mysticky-welcomebar-content p a,
		.mysticky-welcomebar-fixed .mysticky-welcomebar-content p {
			color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_bgtxtcolor']); ?>;
			font-size: <?php echo esc_attr($welcomebar['mysticky_welcomebar_fontsize']); ?>px;
			font-family: inherit;
			margin: 0;
			padding: 0;
			line-height: 1.2;
			font-weight: 400;
		}		
		.mysticky-welcomebar-fixed.mysticky-site-front.mysticky-welcomebar-btn-desktop .mysticky-welcomebar-btn {
			display: block;
			margin-left:5px;
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a {
			background-color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btncolor']); ?>;
			font-family: inherit;
			color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btntxtcolor']); ?>;
			border-radius: 4px;
			text-decoration: none;
			display: inline-block;
			vertical-align: top;
			line-height: 1.2;
			font-size: <?php echo esc_attr($welcomebar['mysticky_welcomebar_fontsize']) ?>px;
			font-weight: 400;
			padding: 5px 15px;
			white-space: nowrap;
			text-align: center;
		}

		@media only screen and (max-width: 1024px) {
			.mysticky-welcomebar-fixed {
				padding: 0 10px 0 10px;
			}
		}
	</style>
</div>