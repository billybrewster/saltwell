<?php
/**
 * Plugin Name: My Twitter Widget
 
 * Plugin URI: http://www.pooks.com/
 
 * Description: The absolute best <strong>twitter feed sidebar widget</strong> for Wordpress yet. Easy to use, install, set-up and comes with several options to control how it looks on your wordpress website. Download and install this <strong>twitter widget</strong> and see just how great it is and how easy it is to use. Full support and even help installing it are available upon request. 
 
 * Author: Jack Higgins
 
 * Version: 1.6.1
 
 * Author URI: http://pooks.com
 
 * License: GPLv2 or later 
 
 */
 
/*  Copyright 2010  Jack HIggins (info@pooks.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    **********************************************************************
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details
    **********************************************************************
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('MTW_VERSION','1.2.3');

define('MTW_ROOT',dirname(__FILE__).'/');

define('MTW_INC',BNCF_ROOT.'include/');

define('MTW_LIB',BNCF_ROOT.'lib/');

define('MTW_SKIN',BNCF_ROOT.'skins/');

define('MTW_DIR',basename(dirname(__FILE__)));

define('MTW_CSS_URL',  trailingslashit(plugins_url('/css/', __FILE__) ));

define('MTW_IMG_URL',  trailingslashit(plugins_url('/images/', __FILE__) ));

//////////////////////////////////////////////////////////////////////////////
register_activation_hook( __FILE__,'mtw_activate');
register_deactivation_hook( __FILE__,'mtw_deactivate');
/////////////////////////////////////////////////////////////////////////////////////////
function mtw_activate(){
    update_option('mtw_admin_notice','TRUE');
}
/////////////////////////////////////////////////////////////////////////////////////////
function mtw_deactivate(){ }
//////////////////////////////////////////////////////////////////////////////
function mtw_activation_notice(){
    echo    '<div class="updated" style="background-color: #53be2a; border-color:#199b57">            <p>Thank you for installing <strong>My Twitter Widget</strong>.You will need to configure your twitter plugin from the twitter API console. You will need to login here <a href="https://dev.twitter.com/apps" target="_blank">here</a> using your login information for your regular twitter account. Once you have logged in fill in the form fields, name your API and generate the Keys needed. This is required for all twitter Feeds now. Twitter no longer allows unauthorized access to live feeds and all widgets require registration. Once you have generated the Key Codes for your plugin you will need to go here <a href="'.site_url().'/wp-admin/widgets.php">Widget page</a> to configure twitter widget.</p>
</div>';
}
//////////////////////////////////////////////////////////////////////////////
function mtw_register_admin_menu_page(){
    add_menu_page( 'My Twitter Widget', 'My Twitter Widget', 'manage_options', 'my_twitter_widget', 'mtw_admin_menu_page' ); 
}
add_action( 'admin_menu', 'mtw_register_admin_menu_page' );
//////////////////////////////////////////////////////////////////////////////
function mtw_admin_menu_page(){
    $mtw = get_option('mtw_settings',true);
    $mtw_config = $mtw['config'];
    $consumer_key = $mtw_config['consumer_key'];
    $consumer_secret = $mtw_config['consumer_secret'];
    $access_token = $mtw_config['access_token'];
    $access_token_secret = $mtw_config['access_token_secret'];

    if($_POST['mtw_save_settings']){
        $consumer_key = trim($_POST['mtw_consumer_key']);
        $consumer_secret = trim($_POST['mtw_consumer_secret']);
        $access_token = trim($_POST['mtw_access_token']);
        $access_token_secret = trim($_POST['mtw_access_token_secret']);

        $mtw = array();
        $mtw['config'] = array(
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
            'access_token' => $access_token,
            'access_token_secret' => $access_token_secret
        );
        update_option('mtw_settings',$mtw);
    }
?>
<div class="mtw_twitter_widget_option_container">
    <h3>Twitter API settings</h3>    	
	<p>Having problems with configuration? Instructions can be found here <a href="http://wordpress.org/plugins/wp-twitter-feeder-widget-10/"  target="_blank">My Twitter Widget Download</a> page.<br /> See how to get api information from 	<a target="_blank" href="http://www.dallasprowebdesigners.com/installations-instuctions.html"  target="_blank">Instructions</a> page or if you are updating your plugin for an older version<br /> you may also get the instructions from here <a href="http://wordpress.org/plugins/wp-twitter-feeder-widget-10/" target="_blank">My Twitter Widget Download</a> page.</p>
    <form id="mtw_twitter_account_config" method="post" action="">
        <div class="mtw_single_field">
            <p>Consumer Key<p>
            <input type='text' name="mtw_consumer_key" id="mtw_consumer_key" value="<?php echo $consumer_key ?>"/>
        </div>
        <div class="mtw_single_field">
            <p>Consumer Secret<p>
            <input type='text' name="mtw_consumer_secret" id="mtw_consumer_secret" value="<?php echo $consumer_secret ?>"/>
        </div>
        <div class="mtw_single_field">
            <p>Access Token<p>
            <input type='text'name="mtw_access_token" id="mtw_access_token" value="<?php echo $access_token ?>"/>
        </div>
        <div class="mtw_single_field">
            <p>Access Token Secret<p>
            <input  type='text' name="mtw_access_token_secret" id="mtw_access_token_secret" value="<?php echo $access_token_secret ?>"/>
        </div>
        <div class="mtw_single_field">
            <input type='submit' name="mtw_save_settings" id="mtw_save_settings" value="save" class="update button"/>
        </div>
    </form>   
</div>
<?php
}
//////////////////////////////////////////////////////////////////////////////
function mtw_featch_tweets(){
$mtw = get_option('mtw_settings');
$mtw_config = $mtw['config'];
$consumer_key = $mtw_config['consumer_key'];
$consumer_secret = $mtw_config['consumer_secret'];
$access_token = $mtw_config['access_token'];
$access_token_secret = $mtw_config['access_token_secret'];
$oauth_hash = '';
$oauth_hash .= 'oauth_consumer_key='.$consumer_key;
$oauth_hash .= '&oauth_nonce=' . time();
$oauth_hash .= '&oauth_signature_method=HMAC-SHA1';
$oauth_hash .= '&oauth_timestamp=' . time();
$oauth_hash .= '&oauth_token='.$access_token;
$oauth_hash .= '&oauth_version=1.0';
$base = '';
$base .= 'GET';
$base .= '&';
$base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
$base .= '&';
$base .= rawurlencode($oauth_hash);
$key = '';
$key .= rawurlencode($consumer_secret);
$key .= '&';
$key .= rawurlencode($access_token_secret);
$signature = base64_encode(hash_hmac('sha1', $base, $key, true));
$signature = rawurlencode($signature);
$oauth_header = '';
$oauth_header .= 'oauth_consumer_key="'.$consumer_key.'", ';
$oauth_header .= 'oauth_nonce="' . time() . '", ';
$oauth_header .= 'oauth_signature="' . $signature . '", ';
$oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
$oauth_header .= 'oauth_timestamp="' . time() . '", ';
$oauth_header .= 'oauth_token="'.$access_token.'", ';
$oauth_header .= 'oauth_version="1.0", ';
$curl_header = array("Authorization: Oauth {$oauth_header}", 'Expect:');
$curl_request = curl_init();
curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
curl_setopt($curl_request, CURLOPT_HEADER, false);
curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json');
curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
$json = curl_exec($curl_request);
curl_close($curl_request);
//print_r(json_decode($json));
return json_decode($json);
}
//add_action('wp_head', 'mtw_featch_tweets');
/////////////////////////////////////////////////////////////////////////////////////////
function mtw_make_links($tweet = ''){
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";                
    if( preg_match( $reg_exUrl, $tweet, $url ) ) 
    $tweet = preg_replace( $reg_exUrl, "<a target=\"_blank\" href=".$url[0].">{$url[0]}</a> ", $tweet);
    return $tweet;
}
/////////////////////////////////////////////////////////////////////////////////////////
function mtw_make_mentions($tweet = ''){
    $regex = "/@[a-zA-Z0-9\_]*/";                
    if( preg_match_all( $regex, $tweet, $matches ) ){ 
        foreach( (array) $matches[0] as $match ){
            $url = 'https://twitter.com/'.str_replace('@', '', $match);
            $tweet = str_replace( $match, "<a target=\"_blank\" href=".$url.">{$match}</a> ", $tweet);
        }
    }
    return $tweet;
}
/////////////////////////////////////////////////////////////////////////////////////////
function mtw_make_hashes($tweet = ''){
    $regex = "/#[a-zA-Z0-9\_\-]*/";                
    if( preg_match_all( $regex, $tweet, $matches ) ){ 
        foreach( (array) $matches[0] as $match ){
            $url = 'https://twitter.com/search?q=%23'.str_replace('#', '', $match).'&src=hash';
            $tweet = str_replace( $match, "<a target=\"_blank\" href=".$url.">{$match}</a> ", $tweet);
        }
    }
    return $tweet;
}
/////////////////////////////////////////////////////////////////////////////////////////
function mtw_tweet_markup($skin,$max_tweet){
    $tweets = mtw_featch_tweets();
    $avatar = $tweets[0]->user->profile_image_url;
    $name = $tweets[0]->user->name;
    $uname = $tweets[0]->user->screen_name;
    $url = $tweets[0]->user->url;
?>
    <div class="mtw_skin <?php echo $skin ?>">
        <div class="mtw_container">
            <div class="mtw_head">
                <div class="mtw_avatar">
                    <a target="_blank" href="<?php echo $url ?>"><img src="<?php echo $avatar ?>" /></a>
                </div>
                <div class="mtw_twitter_username">
                    <p><a target="_blank" href="<?php echo $url ?>"><?php echo $name ?></a></p>
                    <h3 class=""><a target="_blank" href="<?php echo $url ?>"> <?php echo $uname ?></a></h3>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="mtw_tweets">
                <ul>
                <?php for($i=0; $i<$max_tweet; $i++){
                    $tweet = $tweets[$i]->text;
                    $tweet = mtw_make_links($tweet);
                    $tweet = mtw_make_mentions($tweet);
                    $tweet = mtw_make_hashes($tweet);

                    $tweet_id = $tweets[$i]->id_str;
                    $time = $tweets[$i]->created_at;
                    $tweet_url = 'https://twitter.com/'.$uname.'/status/'.$tweet_id;
                    ?>                 
                        <li class="tweet">
                            <p><a href="<?php echo $url ?>"><?php echo $uname ?></a> <?php echo $tweet ?></p>
                            <p class="tweet_meta">
                                <span><a target="_blank" href="<?php echo $tweet_url ?>"><?php echo human_time_diff( strtotime($time), time() ) ?></a></span>
                                <span><a target="_blank" href="<?php echo $tweet_url ?>"> . reply</a></span>
                                <span><a target="_blank" href="<?php echo $tweet_url ?>"> . retweet</a></span>
                                <span><a target="_blank" href="<?php echo $tweet_url ?>"> . favorite</a></span>
                            <p>
                        </li>
                <?php } ?>
                </ul>
            </div>
            <div class="mtw_footer">
                <div class="twitter_widget_footer_logo">
                    <a href="htts://twitter.com/"><img src="<?php echo MTW_IMG_URL.'twitter-widget-logo.png' ?>" /></a>
                </div>
                <div class="twitter_widget_footer_link">
                    <a href="<?php echo  $url ?>">join the conversation</a>
                </div>
                <div style="clear:both"></div>										
				<div class="designedby">By: <a href="http://www.clinicaljobresources.com/">Medical Jobs</a></div>
            </div>
        </div>
    </div>
<?php
}
//////////////////////////////////////////////////////////////////////////////
function mtw_load_style_scripts(){
    wp_register_style( 'mtw-admin-style', MTW_CSS_URL.'mtw-admin.css' );
    wp_enqueue_style( 'mtw-admin-style' );
}
add_action('admin_enqueue_scripts','mtw_load_style_scripts');
//////////////////////////////////////////////////////////////////////////////
function mtw_load_style(){
    wp_register_style( 'mtw-style',MTW_CSS_URL.'mtw-style.css' );
    wp_enqueue_style( 'mtw-style' );
}
add_action('wp_enqueue_scripts','mtw_load_style');
/////////////////////////////////////////////////////////////////////////////////////////
$twitter_options=get_option('mtw_admin_notice');  
if($twitter_options=='TRUE' && is_admin())
add_action('admin_notices','mtw_activation_notice');
update_option('mtw_admin_notice','FALSE');
//////////////////////////////////////////////////////////////////////////////
function mtw_custom_style(){ 
     $obj = new mtw_twitter_widget();
     echo  $obj->mtw_get_style();
 }   
add_action('wp_head','mtw_custom_style');
function teamwebusa_plugin_donate()
{
    if(!strpos($_SERVER['REQUEST_URI'],'widgets.php'))
            return;
    ?>
        
<?php
}
function teamweb_credit_link()  {
    echo '<div style="width:280px; margin-left: auto; margin-right:auto" >
        by <a rel="dofollow" href="http://www.dallasprowebdesigners.com">Team Web USA</a></div>';
}
require_once(MTW_ROOT.'widget.php');
?>