<?php
/**
 * Sticky menu Analytics Pro Feature
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

if (defined('ABSPATH') === false) {
    exit;
}
?>

<div class="container sticky-header-content wrap max-w-4xl!">
    <div class="mystickymenu-widgetanalytic-body">
        <div class="flex-1">
            <div class="mystickymenu-widgetanalytic-heading text-2xl sm:text-3xl md:text-4xl">
                <?php _e("Unlock My Sticky Bar <span>Analytics</span> 🚀", "mystickymenu") ?>
            </div>
			
			<div class="mystickymenu-licenseimage">
				<img class="h-full w-auto" src="<?php echo esc_url(plugins_url('/images/analytics-image.png', __FILE__)); ?>" alt="Stickymenu analytics" />
			</div>
			
			<div class="text-center text-xl sm:text-2xl md:text-3xl text-[#181749]">
                <?php esc_html_e( 'What can you use it for?', 'mystickymenu');?>
            </div>
            <ul class="mt-7 flex flex-col space-y-2 content-center gap-6 flex-col md:flex-row md:gap-5">
                <li class="flex items-center py-6 px-7 bg-[#F9FAFB] rounded-md space-x-6 text-cht-gray-150 text-lg font-primary">
                    <img width="42" height="59" src="<?php echo esc_url(MYSTICKYMENU_URL) ?>/images/channel-discover.svg" alt="Channel Discover">
                    <span class="max-w-[305px] text-sm text-[#181749] text-center pt-2"><?php printf(esc_html__('%1$sDiscover%2$s the most frequently used channels', "mystickymenu"), '<strong>', '</strong>') ?></span>
                </li>
                <li class="flex items-center py-6 px-7 bg-[#F9FAFB] rounded-md space-x-6 text-cht-gray-150 text-lg font-primary">
                    <img width="42" height="59" src="<?php echo esc_url(MYSTICKYMENU_URL) ?>/images/channel-tracking.svg" alt="Channel Tracking">
                    <span class="max-w-[305px] text-sm text-[#181749] text-center pt-2"><?php printf(esc_html__('Keep %1$strack%2$s of how each widget performs', "mystickymenu"), '<strong>', '</strong>') ?></span>
                </li>
                <li class="flex items-center py-6 px-7 bg-[#F9FAFB] rounded-md space-x-6 text-cht-gray-150 text-lg font-primary">
                    <img width="42" height="59" src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/channel-analyze.svg" alt="Channel Analyze">
                    <span class="max-w-[305px] text-sm text-[#181749] text-center pt-2"><?php printf(esc_html__('%1$sAnalyze%2$s the number of unique clicks and the %3$sclick-through rate%4$s', "mystickymenu"), '<strong>', '</strong>', '<strong>', '</strong>') ?></span>
                </li>
            </ul>

            <div class="flex items-center mt-5 space-x-3 content-center">
                <a class="msb-primary-button px-6!" href="<?php echo esc_url(admin_url("admin.php?page=my-stickymenu-upgrade")) ?>" >
                    <?php esc_html_e('Upgrade to Pro 🚀', 'mystickymenu'); ?>
                </a>                
            </div>
        </div>
        
    </div>
</div>

<style>
    #wpcontent {
        padding: 20px !important;
    }
.mystickymenu-widgetanalytic-body {
    display: flex;
	justify-content: space-evenly;	
}
.mystickymenu-widgetanalytic-heading {
	font-style: normal;
	font-weight: 600;
	text-align: center;
	color: #000000;
    display: block;
	margin: 20px auto 30px auto;
    justify-content: center;
    align-items: end;
    line-height: 1;
}

.mystickymenu-widgetanalytic-heading span {
	color: #6558F5;
	font-size: inherit;
	font-weight: 800;
}


.mystickymenu-widgetanalytic-body h3 {
	font-family: 'Lato';
	font-style: normal;
	font-weight: 600;
	font-size: 32px;
	line-height: 29px;
	color: #000000;
	text-align: center;
	margin:20px 0 16px;
}

/*.mystickymenu-widgetanalytic-body .w-auto{
	width:100%;
}*/

.mystickymenu-widgetanalytic-body ul {
    display: flex;
    margin-top: 1.75rem;
}

.mystickymenu-widgetanalytic-body img {
    height: auto;
    max-width: 100%;
    display: block;
    vertical-align: middle;
}

.mystickymenu-widgetanalytic-body li {
	flex-direction:column;
	padding:26px 35px 26px 35px;
	box-sizing: border-box;
	flex: 1;
	background: #FFFFFF;
    box-shadow: 0 2px 8px 0 rgba(99, 99, 99, 0.2);
	border-radius: 16px;
	display:flex;
    font-size: 1.125rem;
    line-height: 1.75rem;
    align-items: center;
    margin: 0;
}

.mystickymenu-widgetanalytic-body .mt-5{
	text-align:center;
	border-radius:8px;
	margin-top:3.25rem;
	margin-bottom:2.25rem;
}

.mystickymenu-widgetanalytic-body ul li img{
	width:auto;
	height:48px;
}

.mystickymenu-widgetanalytic-body img.h-full.w-auto{
	display: flex;
    margin: 0 auto;
    justify-content: center;
    align-items: center;
	width: auto;
	height:100%;
}
	

.mystickymenu-widgetanalytic-body .px-7.py-8.flex-1 h2.mystickymenu-widgetanalytic-heading img{
	float:right;
}
</style>
