<?php
global $wpdb;
$is_shown = myStickyMenu_SIGNUP_CLASS::check_modal_status();
if($is_shown) {
    include_once MYSTICKYMENU_PATH . 'admin/email-signup.php';
    return;
}
$where_search = '';
$table_name = $wpdb->prefix . "mystickymenu_contact_lists";
$elements_widgets = get_option( 'mystickymenu-welcomebars' );

$custom_fields = array();
if ( !empty($elements_widgets)) {
    foreach( $elements_widgets as $key=>$value) {
        $widget_no = '-'.$key;
        if ( $key == 0 ) {
            $widget_no = '';
        }
    }
}
if ( isset($_REQUEST['search-contact']) && $_REQUEST['search-contact'] != '' ) {
    $search = '%' . $wpdb->esc_like( sanitize_text_field( $_REQUEST['search-contact'] ) ) . '%';
    $where_search = $wpdb->prepare(
            "WHERE contact_name LIKE %s OR contact_email LIKE %s OR contact_phone LIKE %s OR widget_name LIKE %s ",
    $search, $search, $search, $search);
}

$customPagHTML = "";
$total_query = "SELECT count(*) FROM " . $table_name . " {$where_search} ORDER BY ID DESC";
$total = $wpdb->get_var($total_query);
$items_per_page = 20;
$page = (isset($_GET['cpage'])) ? abs((int)$_GET['cpage']) : 1;
$offset = ($page * $items_per_page) - $items_per_page;
$query = "SELECT * FROM " . $table_name . " {$where_search} ORDER BY ID DESC LIMIT {$offset}, {$items_per_page}";
$result = $wpdb->get_results($query);
$total_page = ceil($total / $items_per_page);
$start_from = $offset + 1;
$to = $offset + min($items_per_page, count($result));

$download_file_url = plugins_url('mystickymenu-contact-leads.php?download_file=mystickybar_contact_leads.csv',__FILE__);
?>
<!-- /**/ */ -->
<div class="sticky-header-content pt-6">
    <div class="wrap mystickymenu-wrap mystickymenu-dashboard">
        <div class="flex items-center justify-between h-full gap-8">
            <div class="heading-title flex flex-col gap-1 text-[#1d2327]">
                <h3><?php esc_html_e( 'Contact Form Leads', 'mystickymenu' ); ?></h3>
                <?php if(count($result) > 0) { ?>
                    <div class="text-sm text-[#1d2327]"><?php esc_html_e('View and export all leads collected through your sticky bars.', 'mystickymenu') ?></div>
                <?php } ?>
            </div>
            <div>
                <?php if(count($result) > 0) { ?>
                    <a href="<?php echo esc_url(wp_nonce_url($download_file_url,'MSB_file_download', 'mystickymenu_nonce') ); ?>" class="msb-primary-button" id="wpappp_export_to_csv" value="Export to CSV" href="#">
                        <?php esc_html_e('Export CSV', 'mystickymenu' );?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php if(count($result) > 0 || !empty($where_search)) { ?>
            <div class="border-1 border-[#F1F1F1] rounded-lg mt-5 msb-shadow msb-form-leads">
                <div class="top p-4 flex flex-col md:flex-row md:justify-between md:items-center">
                    <div>
                        <?php if(count($result) > 0) { ?>
                            <form action="<?php echo admin_url("admin.php?page=my-sticky-menu-leads");?>" method="post">
                                <div class="actions bulkactions">
                                    <input type="hidden" name="action" value="delete_message">
                                    <input type="submit" id="doaction" class="button action delete-button bg-red-100 border-1 border-red-400" value="<?php esc_attr_e('Delete', 'mystickymenu'); ?>">
                                    <?php wp_nonce_field( 'stickyelement-contatc-submit', 'stickyelement-contatc-submit' );  ?>
                                </div>
                            </form>
                        <?php } ?>
                    </div>

                    <form action="<?php echo admin_url("admin.php?page=my-sticky-menu-leads");?>" method='get'>
                        <input type="hidden" name="page" value='my-sticky-menu-leads'/>
                        <div class="search-box relative">
                            <label class="screen-reader-text" for="post-search-input"><?php esc_html_e( 'Search', 'mystickymenu');?></label>
                            <input type="search" id="post-search-input" class="search-input" name="search-contact" value="<?php echo (isset($_GET['search-contact']) && $_GET['search-contact'] != '') ? esc_attr($_GET['search-contact']) : ''; ?>" placeholder="Search by name, email, phone, widget name">
                            <button type="submit" class="msb-search-button">
                                <span class="sr-only"><?php esc_html_e( 'Search', 'mystickymenu' ); ?></span>
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.833 15.834L12.208 12.209M14.1663 7.50065C14.1663 11.1825 11.1816 14.1673 7.49967 14.1673C3.81778 14.1673 0.833008 11.1825 0.833008 7.50065C0.833008 3.81875 3.81778 0.833984 7.49967 0.833984C11.1816 0.833984 14.1663 3.81875 14.1663 7.50065Z" stroke="#717680" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <table border="1" class="responstable msb-table">
                    <tr>
                        <th style="width:1%"><?php esc_html_e( 'Bulk', 'mystickymenu' );?></th>
                        <th><?php esc_html_e( 'ID', 'mystickymenu');?></th>
                        <th><?php esc_html_e( 'Widget Name', 'mystickymenu');?></th>
                        <th><?php esc_html_e( 'Name', 'mystickymenu');?></th>
                        <th><?php esc_html_e( 'Email', 'mystickymenu');?></th>
                        <th><?php esc_html_e( 'Phone', 'mystickymenu');?></th>
                        <th><?php esc_html_e( 'Date', 'mystickymenu');?></th>
                        <th class="w-20 text-center"><?php esc_html_e( 'URL', 'mystickymenu');?></th>
                        <th class="w-30 text-center"><?php esc_html_e( 'Delete', 'mystickymenu');?></th>
                    </tr>
                    <?php
                    $customPagHTML     	= "";
                    $total_page         = ceil($total / $items_per_page);
                    $widgets            = [];
                    if($result){
                        foreach ( $result as $res ) {
                            ?>
                            <tr>
                                <td class="text-center"><input id="cb-select-80" class="cb-select-blk" type="checkbox" name="delete_message[]" value="<?php echo esc_attr($res->ID);?>"></td>
                                <td class="text-sm!"><?php echo esc_html($res->ID);?></td>
                                <td class="text-sm!">
                                    <?php if($res->widget_id !== NULL && !empty($res->widget_id)) {
                                        if(isset($widgets[$res->widget_id])) {
                                            $widget_name = $widgets[$res->widget_id];
                                        } else {
                                            $widget_data = get_option('mysticky_option_welcomebar' . '-' . $res->widget_id);
                                            $widget_name = isset($widget_data['welcomebar-widget']) && !empty($widget_data['welcomebar-widget']) ? $widget_data['welcomebar-widget'] : $res->widget_name;
                                            $widgets[$res->widget_id] = $widget_name;
                                        }
                                        ?>
                                        <a class="text-[#1d2327]!" target="_blank" href="<?php echo admin_url( 'admin.php?page=my-stickymenu-welcomebar&widget=' . $res->widget_id );?>">
                                            <?php echo esc_html($widget_name); ?>
                                        </a>
                                    <?php } else { ?>
                                        <?php echo esc_html($res->widget_name);?>
                                    <?php } ?>
                                </td>
                                <td class="text-sm!"><?php echo esc_html($res->contact_name);?></td>
                                <td class="text-sm!"><?php echo esc_html($res->contact_email);?></td>
                                <td class="text-sm!"><?php echo esc_html($res->contact_phone);?></td>
                                <td class="text-sm!"><?php echo ( isset($res->message_date) ) ? esc_html($res->message_date) : '-' ;?></td>
                                <td class="text-sm! text-center">
                                    <?php if ( $res->page_link) :?>
                                        <a class="external-link" href="<?php echo esc_url($res->page_link);?>" target="_blank"><span class="dashicons dashicons-external"></span></a>
                                    <?php endif;?>
                                </td>

                                <td class="text-sm! text-center">
                                    <button type="button" data-delete="<?php echo esc_html($res->ID);?>" class="mystickymenu-delete-entry text-red-500! cursor-pointer inline-flex items-center gap-1.5 border-1 border-red-500 py-0.5 px-1.5 rounded-sm hover:bg-red-50">
                                        <svg class="w-auto h-4" width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 4.08333H2.41667M2.41667 4.08333H15.75M2.41667 4.08333V15.75C2.41667 16.192 2.59226 16.6159 2.90482 16.9285C3.21738 17.2411 3.64131 17.4167 4.08333 17.4167H12.4167C12.8587 17.4167 13.2826 17.2411 13.5952 16.9285C13.9077 16.6159 14.0833 16.192 14.0833 15.75V4.08333H2.41667ZM4.91667 4.08333V2.41667C4.91667 1.97464 5.09226 1.55072 5.40482 1.23816C5.71738 0.925595 6.14131 0.75 6.58333 0.75H9.91667C10.3587 0.75 10.7826 0.925595 11.0952 1.23816C11.4077 1.55072 11.5833 1.97464 11.5833 2.41667V4.08333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <?php esc_attr_e('Delete', 'mystickymenu');?>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="9" align="center">
                                <p class="mystickymenu-no-contact"> <?php esc_html_e('No Contact Form Leads Found!','mystickymenu');?>
                                </p>
                            </td>
                        </tr>
                    <?php }	?>
                </table>
                <?php if(count($result) > 0) { ?>
                    <div class="flex items-center flex-col md:flex-row justify-between gap-3 p-4">
                        <div class="text-sm">
                            Showing records from <?php echo esc_attr($start_from) ?> to <?php echo esc_attr($to) ?> from <?php echo esc_attr($total) ?> records
                        </div>
                        <?php if($total_page > 1){ ?>
                            <div class="contactleads-pagination">
                                <?php
                                $big = 999999999; // need an unlikely integer
                                echo paginate_links( array(
                                    'base' => add_query_arg( 'cpage', '%#%' ),
                                    'format' => '',
                                    'current' => $page,
                                    'total' =>  $total_page
                                ) );?>
                            </div>
                        <?php }?>
                    </div>
                <?php } ?>
            </div>

            <?php if(count($result) > 0) { ?>
                <div class="bg-red-50 border-1 border-red-400 rounded-lg p-4 mt-8 flex justify-between gap-10 items-center">
                    <div class="flex gap-4 items-center">
                        <div>
                            <div class="h-10 w-10 flex items-center justify-center bg-red-200 rounded-full text-red-600!">
                                <svg class="w-auto h-4" width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 4.08333H2.41667M2.41667 4.08333H15.75M2.41667 4.08333V15.75C2.41667 16.192 2.59226 16.6159 2.90482 16.9285C3.21738 17.2411 3.64131 17.4167 4.08333 17.4167H12.4167C12.8587 17.4167 13.2826 17.2411 13.5952 16.9285C13.9077 16.6159 14.0833 16.192 14.0833 15.75V4.08333H2.41667ZM4.91667 4.08333V2.41667C4.91667 1.97464 5.09226 1.55072 5.40482 1.23816C5.71738 0.925595 6.14131 0.75 6.58333 0.75H9.91667C10.3587 0.75 10.7826 0.925595 11.0952 1.23816C11.4077 1.55072 11.5833 1.97464 11.5833 2.41667V4.08333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col gap-0.5 flex-1">
                            <div class="text-base font-semibold"><?php esc_html_e('Delete all leads permanently','mystickymenu');?> </div>
                            <div><?php esc_html_e('This will permanently delete all leads from the database.','mystickymenu');?> </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="wpappp_buton delete-all-leads-button" id="mystickymenu_delete_all_leads" >
                            <svg class="w-auto h-4" width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.75 4.08333H2.41667M2.41667 4.08333H15.75M2.41667 4.08333V15.75C2.41667 16.192 2.59226 16.6159 2.90482 16.9285C3.21738 17.2411 3.64131 17.4167 4.08333 17.4167H12.4167C12.8587 17.4167 13.2826 17.2411 13.5952 16.9285C13.9077 16.6159 14.0833 16.192 14.0833 15.75V4.08333H2.41667ZM4.91667 4.08333V2.41667C4.91667 1.97464 5.09226 1.55072 5.40482 1.23816C5.71738 0.925595 6.14131 0.75 6.58333 0.75H9.91667C10.3587 0.75 10.7826 0.925595 11.0952 1.23816C11.4077 1.55072 11.5833 1.97464 11.5833 2.41667V4.08333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <?php esc_attr_e('Delete All Leads', 'mystickymenu' );?>
                        </button>
                        <input type="hidden" id="delete_nonce" name="delete_nonce" value="<?php echo esc_attr(wp_create_nonce('mysticky_menu_delete_nonce')) ?>" />
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="border-1 border-[#F1F1F1] rounded-lg mt-5 py-10 text-base msb-shadow msb-form-leads text-center">
                <?php esc_html_e('No Contact Form Leads Yet', 'mystickymenu');?>
            </div>
        <?php } ?>
    </div>
</div>