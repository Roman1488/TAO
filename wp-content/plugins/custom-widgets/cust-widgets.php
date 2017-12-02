<?php
	
/**
 * Plugin Name: Custom Widgets
 * Description: A collection of custom  widgets for use in any widgetized area or in SiteOrigin page builder. SiteOrigin Widgets Bundle is required.
 * Author: MakeIT
 */

function my_widgets($folders){
    $folders[] = plugin_dir_path(__FILE__).'/admin/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'my_widgets');
 ?>