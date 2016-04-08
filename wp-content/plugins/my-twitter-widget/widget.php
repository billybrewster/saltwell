<?php
class mtw_twitter_widget extends WP_Widget{
  function mtw_twitter_widget(){
      parent::WP_Widget( $id = 'mtw_twitter_widget', $name = 'My Twitter Widget'/*get_class($this)*/, $options = array( 'description' => 'Grab your tweets from twitter and show in your sidebar' ) );
	}
  function widget( $args, $instance) {
	  extract( $args );
	  $title = apply_filters( 'widget_title', $instance['mtw_twitter_title'] );
    echo $before_widget;
	  if ( $title )
		 echo $before_title . $title . $after_title; 
    
    $mtw = get_option('mtw_settings');
    $mtw_config = $mtw['config'];
		if( count($mtw_config) == 4 ){
			mtw_tweet_markup(' ',$instance['mtw_twitter_number']);
    }
    else{
      echo "<p>Please configure your twitter API settings</p>";
    }
      echo $after_widget;
  }
    
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    $instance['mtw_twitter_title'] = strip_tags($new_instance['mtw_twitter_title']);
    $instance['mtw_twitter_font_size'] = strip_tags($new_instance['mtw_twitter_font_size']);

    $instance['mtw_twitter_number'] = $new_instance['mtw_twitter_number'];
    $instance['mtw_twitter_width'] = $new_instance['mtw_twitter_width'];
    $instance['mtw_twitter_height'] = $new_instance['mtw_twitter_height'];

    $instance['mtw_twitter_container_background'] = $new_instance['mtw_twitter_container_background'];
    $instance['mtw_twitter_container_color'] = $new_instance['mtw_twitter_container_color'];
    $instance['mtw_twitter_tweet_background'] = $new_instance['mtw_twitter_tweet_background'];
    $instance['mtw_twitter_tweet_color'] = $new_instance['mtw_twitter_tweet_color'];
    $instance['mtw_twitter_tweet_link_color'] = $new_instance['mtw_twitter_tweet_link_color'];

    $instance['mtw_twitter_scroll'] = $new_instance['mtw_twitter_scroll'];
    $instance['mtw_twitter_live'] = $new_instance['mtw_twitter_live'];
    $instance['mtw_twitter_show_logo'] = $new_instance['mtw_twitter_show_logo'];
    $instance['mtw_twitter_show_username'] = $new_instance['mtw_twitter_show_username'];
    $instance['mtw_twitter_show_credit'] = $new_instance['mtw_twitter_show_credit'];
  	return $instance;
	}
        
  function form ($instance){ 
    global $logo;
    $mtw = get_option('mtw_settings');
    $mtw_config = $mtw['config'];
    if( count($mtw_config) < 4 ){
      echo 'Please configure your twitter API setting first from <a href="'.site_url().'/wp-admin/admin.php?page=my_twitter_widget">here</a>';
      return;
    }
    
    $instance['mtw_twitter_number']= ($instance['mtw_twitter_number'] ?  $instance['mtw_twitter_number'] : 7 );
    $instance['mtw_twitter_width']= ($instance['mtw_twitter_width'] ?  $instance['mtw_twitter_width'] : '198' );
    $instance['mtw_twitter_height']= ($instance['mtw_twitter_height'] ?  $instance['mtw_twitter_height'] : '300' );
    $instance['mtw_twitter_container_background']= ($instance['mtw_twitter_container_background'] ?  $instance['mtw_twitter_container_background'] : '#c4deeb' );
    $instance['mtw_twitter_container_color']= ($instance['mtw_twitter_container_color'] ?  $instance['mtw_twitter_container_color'] : '#3d2c3d' );
    $instance['mtw_twitter_tweet_background']= ($instance['mtw_twitter_tweet_background'] ?  $instance['mtw_twitter_tweet_background'] : '#eaf6fd' );
    $instance['mtw_twitter_font_size']= ($instance['mtw_twitter_number'] ?  $instance['mtw_twitter_font_size'] : '' );
    
    $instance['mtw_twitter_tweet_color']= ($instance['mtw_twitter_tweet_color'] ?  $instance['mtw_twitter_tweet_color'] : '#816666' );
    $instance['mtw_twitter_tweet_link_color']= ($instance['mtw_twitter_tweet_link_color'] ?  $instance['mtw_twitter_tweet_link_color'] : '#497da8' );
    $scroll_select= ($instance['mtw_twitter_scroll']=='false' ? " selected " : '');
    $live_select= ($instance['mtw_twitter_live']=='false' ? " selected " : '');
    $logo_select= ($instance['mtw_twitter_show_logo']=='false' ? " selected " : '');
    $username_select= ($instance['mtw_twitter_show_username']=='false' ? " selected " : '');
    $credit_select = ($instance['mtw_twitter_show_credit']=='false' ? " selected " : '');
    
    ?>    	<p>You will first need to configure your API settings <a href="/wp-admin/admin.php?page=my_twitter_widget">here</a> before your widget will work.</p>
    <label for="<?php echo $this->get_field_id('mtw_twitter_title'); ?>"><?php _e('Title:'); ?></label>			
    <input class="widefat" id="<?php echo $this->get_field_id('mtw_twitter_title'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_title'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_title']); ?>" />
    <br>
    <label for="<?php echo $this->get_field_id('mtw_twitter_number'); ?>"><?php _e('number of tweets:'); ?></label>			
    <input class="widefat" id="<?php echo $this->get_field_id('mtw_twitter_number'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_number'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_number']); ?>" />
    <br>
    
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_width'); ?>"><?php _e('Width:'); ?></label>			
    <input class="widefat" size="3" id="<?php echo $this->get_field_id('mtw_twitter_width'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_width'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_width']); ?>" />
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_height'); ?>"><?php _e('Height:'); ?></label>			
    <input class="widefat" size="3" id="<?php echo $this->get_field_id('mtw_twitter_height'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_height'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_height']); ?>" />
    <br>

    <label for="<?php echo $this->get_field_id('mtw_twitter_container_background'); ?>"><?php _e('Container Background:'); ?></label>			
    <input class="widefat colorpick"  id="<?php echo $this->get_field_id('mtw_twitter_container_background'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_container_background'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_container_background']); ?>" />
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_container_color'); ?>"><?php _e('Container Text Color:'); ?></label>			
    <input class="widefat colorpick"  id="<?php echo $this->get_field_id('mtw_twitter_container_color'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_container_color'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_container_color']); ?>" />
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_tweet_background'); ?>"><?php _e('Tweets Background:'); ?></label>			
    <input class="widefat colorpick"  id="<?php echo $this->get_field_id('mtw_twitter_tweet_background'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_tweet_background'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_tweet_background']); ?>" />
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_font_size'); ?>"><?php _e('Font size (in px):'); ?></label>			
    <input class="widefat" id="<?php echo $this->get_field_id('mtw_twitter_font_size'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_font_size'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_font_size']); ?>" />
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_tweet_color'); ?>"><?php _e('Tweet Text Color:'); ?></label>			
    <input class="widefat colorpick"  id="<?php echo $this->get_field_id('mtw_twitter_tweet_color'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_tweet_color'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_tweet_color']); ?>" />
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_tweet_link_color'); ?>"><?php _e('Tweets Link Color:'); ?></label>			
    <input class="widefat colorpick"  id="<?php echo $this->get_field_id('mtw_twitter_tweet_link_color'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_tweet_link_color'); ?>" type="text" value="<?php echo esc_attr($instance['mtw_twitter_tweet_link_color']); ?>" />
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_scroll'); ?>"><?php _e('Scroll:'); ?></label>			
    <select id="<?php echo $this->get_field_id('mtw_twitter_scroll'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_scroll'); ?>" >
    
        <option value="true">True</option>
        <option value="false" <?php echo $scroll_select; ?> >False</option>
        
    </select>
    <br>

    <label for="<?php echo $this->get_field_id('mtw_twitter_live'); ?>"><?php _e('Live:'); ?></label>			
    <select id="<?php echo $this->get_field_id('mtw_twitter_live'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_live'); ?>" >
    
        <option value="true">True</option>
        <option value="false" <?php echo $live_select; ?> >False</option>
        
    </select>
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_show_logo'); ?>"><?php _e('Show Twitter Logo'); ?></label>			
    <select id="<?php echo $this->get_field_id('mtw_twitter_show_logo'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_show_logo'); ?>" >
    
        <option value="true">True</option>
        <option value="false" <?php echo $logo_select; ?> >False</option>
        
    </select>
    
    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_show_username'); ?>"><?php _e('Show Twitter Username'); ?></label>			
    <select id="<?php echo $this->get_field_id('mtw_twitter_show_username'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_show_username'); ?>" >
    
        <option value="true">True</option>
        <option value="false" <?php echo $username_select; ?> >False</option>
        
    </select>

    <br>
    
    <label for="<?php echo $this->get_field_id('mtw_twitter_show_credit'); ?>"><?php _e('Credit link'); ?></label>			
    <select  id="<?php echo $this->get_field_id('mtw_twitter_show_credit'); ?>" name="<?php echo $this->get_field_name('mtw_twitter_show_credit'); ?>" >
    
        <option value="true">True</option>
        <option value="false" <?php echo $credit_select; ?> >False</option>
        
    </select>   
            
    <? 
  }
    
  public function mtw_get_style(){
     $ops = get_option('widget_'.$this->id_base);
     $key = key( array_slice( $ops, -2, 1, TRUE ) );
     $style = '<style type="text/css">';
     
         
         if(isset($ops[$key]['mtw_twitter_show_logo']) && $ops[$key]['mtw_twitter_show_logo'] == 'false'){
            $style .= ".mtw_footer .twitter_widget_footer_logo img{ display: none; }";
          }

         if(isset($ops[$key]['mtw_twitter_show_username']) && $ops[$key]['mtw_twitter_show_username'] == 'false' )
                 $style .= ".mtw_twitter_username h3{ display: none; } ";
         
         if( $ops[$key]['mtw_twitter_show_credit'] != 'false' )
                 add_action('wp_footer','teamwebusa_plugin_donate');
         
         if($ops[$key]['mtw_twitter_font_size'])
                  $style .= ".mtw_tweets li p{ font-size:".$ops[$key]['mtw_twitter_font_size'] ."px !important; }";
          
          if($ops[$key]['mtw_twitter_width'])
                  $style .= ".mtw_container{ width:".$ops[$key]['mtw_twitter_width']."px !important; }";

          if($ops[$key]['mtw_twitter_height'])
                 $style .= ".mtw_tweets{ height:".$ops[$key]['mtw_twitter_height']."px !important; }";

          if($ops[$key]['mtw_twitter_container_background'])
                 $style .= ".mtw_container{ background:".$ops[$key]['mtw_twitter_container_background'] ." !important; }";

          if($ops[$key]['mtw_twitter_container_color'])
                  $style .= ".mtw_twitter_username p a,.mtw_twitter_username h3 a,.mtw_footer .twitter_widget_footer_link a{ color:".$ops[$key]['mtw_twitter_container_color'] ." !important; }";
          
          if($ops[$key]['mtw_twitter_tweet_background'])
                 $style .= ".mtw_tweets{ background:".$ops[$key]['mtw_twitter_tweet_background'] ." !important; }";

          if($ops[$key]['mtw_twitter_tweet_color'])
                  $style .= ".mtw_tweets li p{ color:". $ops[$key]['mtw_twitter_tweet_color'] ." !important; }";
          
          if($ops[$key]['mtw_twitter_tweet_link_color'])
                  $style .= ".mtw_tweets li a,.mtw_tweets li p a{ color:". $ops[$key]['mtw_twitter_tweet_link_color'] ." !important; }";

          if($ops[$key]['mtw_twitter_scroll'] == 'false')
                  $style .= ".mtw_tweets{ overflow-y: hidden !important; }";
          
          

          if($ops[$key]['mtw_twitter_live'] == 'true'){
            $script .= '<script type="text/javascript">';
            $script .= '$(function(){
                        $.post()
            })';
            
            $script .= '</script>';
            
          }

          $style .= "</style>";
     //$live_select= ($instance['mtw_twitter_live']=='false' ? " selected " : '');

     
     return $style;
  }

    
    
 } // mtw_twitter_widget Class Ends

add_action( 'widgets_init', create_function( '', 'register_widget("mtw_twitter_widget");' ) );
