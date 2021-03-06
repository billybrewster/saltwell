<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
 
if ( ! isset( $content_width ) )
  $content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 *   and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

  /* Make Twenty Eleven available for translation.
   * Translations can be added to the /languages/ directory.
   * If you're building a theme based on Twenty Eleven, use a find and replace
   * to change 'twentyeleven' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // Load up our theme options page and related code.
  require( get_template_directory() . '/inc/theme-options.php' );

  // Grab Twenty Eleven's Ephemera widget.
  require( get_template_directory() . '/inc/widgets.php' );

  // Add default posts and comments RSS feed links to <head>.
  add_theme_support( 'automatic-feed-links' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

  // Add support for a variety of post formats
  add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

  $theme_options = twentyeleven_get_theme_options();
  if ( 'dark' == $theme_options['color_scheme'] )
    $default_background_color = '1d1d1d';
  else
    $default_background_color = 'e2e2e2';

  // Add support for custom backgrounds.
  add_theme_support( 'custom-background', array(
    // Let WordPress know what our default background color is.
    // This is dependent on our current color scheme.
    'default-color' => $default_background_color,
  ) );

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  add_theme_support( 'post-thumbnails' );

  // Add support for custom headers.
  $custom_header_support = array(
    // The default header text color.
    'default-text-color' => '000',
    // The height and width of our custom header.
    'width' => apply_filters( 'twentyeleven_header_image_width', 1000 ),
    'height' => apply_filters( 'twentyeleven_header_image_height', 288 ),
    // Support flexible heights.
    'flex-height' => true,
    // Random image rotation by default.
    'random-default' => true,
    // Callback for styling the header.
    'wp-head-callback' => 'twentyeleven_header_style',
    // Callback for styling the header preview in the admin.
    'admin-head-callback' => 'twentyeleven_admin_header_style',
    // Callback used to display the header preview in the admin.
    'admin-preview-callback' => 'twentyeleven_admin_header_image',
  );

  add_theme_support( 'custom-header', $custom_header_support );

  if ( ! function_exists( 'get_custom_header' ) ) {
    // This is all for compatibility with versions of WordPress prior to 3.4.
    define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
    define( 'HEADER_IMAGE', '' );
    define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
    define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
    add_custom_image_header( $custom_header_support['wp-head-callback'], $custom_header_support['admin-head-callback'], $custom_header_support['admin-preview-callback'] );
    add_custom_background();
  }

  // We'll be using post thumbnails for custom header images on posts and pages.
  // We want them to be the size of the header image that we just defined
  // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
  set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

  // Add Twenty Eleven's custom image sizes.
  // Used for large feature (header) images.
  add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
  // Used for featured posts if a large-feature doesn't exist.
  add_image_size( 'small-feature', 500, 300 );

  // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
  register_default_headers( array(
    'wheel' => array(
      'url' => '%s/images/headers/wheel.jpg',
      'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Wheel', 'twentyeleven' )
    ),
    'shore' => array(
      'url' => '%s/images/headers/shore.jpg',
      'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Shore', 'twentyeleven' )
    ),
    'trolley' => array(
      'url' => '%s/images/headers/trolley.jpg',
      'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Trolley', 'twentyeleven' )
    ),
    'pine-cone' => array(
      'url' => '%s/images/headers/pine-cone.jpg',
      'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Pine Cone', 'twentyeleven' )
    ),
    'chessboard' => array(
      'url' => '%s/images/headers/chessboard.jpg',
      'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Chessboard', 'twentyeleven' )
    ),
    'lanterns' => array(
      'url' => '%s/images/headers/lanterns.jpg',
      'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Lanterns', 'twentyeleven' )
    ),
    'willow' => array(
      'url' => '%s/images/headers/willow.jpg',
      'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Willow', 'twentyeleven' )
    ),
    'hanoi' => array(
      'url' => '%s/images/headers/hanoi.jpg',
      'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Hanoi Plant', 'twentyeleven' )
    )
  ) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {
  $text_color = get_header_textcolor();

  // If no custom options for text are set, let's bail.
  if ( $text_color == HEADER_TEXTCOLOR )
    return;

  // If we get this far, we have custom styles. Let's do this.
  ?>
  <style type="text/css">
  <?php
    // Has the text been hidden?
    if ( 'blank' == $text_color ) :
  ?>
    #site-title,
    #site-description {
      position: absolute !important;
      clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
      clip: rect(1px, 1px, 1px, 1px);
    }
  <?php
    // If the user has set a custom color for the text use that
    else :
  ?>
    #site-title a,
    #site-description {
      color: #<?php echo $text_color; ?> !important;
    }
  <?php endif; ?>
  </style>
  <?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
  <style type="text/css">
  .appearance_page_custom-header #headimg {
    border: none;
  }
  #headimg h1,
  #desc {
    font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
  }
  #headimg h1 {
    margin: 0;
  }
  #headimg h1 a {
    font-size: 32px;
    line-height: 36px;
    text-decoration: none;
  }
  #desc {
    font-size: 14px;
    line-height: 23px;
    padding: 0 0 3em;
  }
  <?php
    // If the user has set a custom color for the text use that
    if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
  ?>
    #site-title a,
    #site-description {
      color: #<?php echo get_header_textcolor(); ?>;
    }
  <?php endif; ?>
  #headimg img {
    max-width: 1000px;
    height: auto;
    width: 100%;
  }
  </style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
  <div id="headimg">
    <?php
    $color = get_header_textcolor();
    $image = get_header_image();
    if ( $color && $color != 'blank' )
      $style = ' style="color:#' . $color . '"';
    else
      $style = ' style="display:none"';
    ?>
    <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
    <?php if ( $image ) : ?>
      <img src="<?php echo esc_url( $image ); ?>" alt="" />
    <?php endif; ?>
  </div>
<?php }
endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

if ( ! function_exists( 'twentyeleven_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
  return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}
endif; // twentyeleven_continue_reading_link

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
  return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
  if ( has_excerpt() && ! is_attachment() ) {
    $output .= twentyeleven_continue_reading_link();
  }
  return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args( $args ) {
  if ( ! isset( $args['show_home'] ) )
    $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

  register_widget( 'Twenty_Eleven_Ephemera_Widget' );

  register_sidebar( array(
    'name' => __( 'Main Sidebar', 'twentyeleven' ),
    'id' => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
    'id' => 'sidebar-2',
    'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Footer Area One', 'twentyeleven' ),
    'id' => 'sidebar-3',
    'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Footer Area Two', 'twentyeleven' ),
    'id' => 'sidebar-4',
    'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Footer Area Three', 'twentyeleven' ),
    'id' => 'sidebar-5',
    'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $html_id ) {
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo esc_attr( $html_id ); ?>">
      <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
      <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
    </nav><!-- #nav-above -->
  <?php endif;
}
endif; // twentyeleven_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
  if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
    return false;

  return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
  $count = 0;

  if ( is_active_sidebar( 'sidebar-3' ) )
    $count++;

  if ( is_active_sidebar( 'sidebar-4' ) )
    $count++;

  if ( is_active_sidebar( 'sidebar-5' ) )
    $count++;

  $class = '';

  switch ( $count ) {
    case '1':
      $class = 'one';
      break;
    case '2':
      $class = 'two';
      break;
    case '3':
      $class = 'three';
      break;
  }

  if ( $class )
    echo 'class="' . $class . '"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer class="comment-meta">
        <div class="comment-author vcard">
          <?php
            $avatar_size = 68;
            if ( '0' != $comment->comment_parent )
              $avatar_size = 39;

            echo get_avatar( $comment, $avatar_size );

            /* translators: 1: comment author, 2: date and time */
            printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
              sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
              sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                /* translators: 1: date, 2: time */
                sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
              )
            );
          ?>

          <?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .comment-author .vcard -->

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
          <br />
        <?php endif; ?>

      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->

  <?php
      break;
  endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
  printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
    get_the_author()
  );
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ) {

  if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
    $classes[] = 'single-author';

  if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
    $classes[] = 'singular';

  return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );

function my_sort($a, $b)
{
    if ($a-date > $b->date) {
        return -1;
    } else if ($a->date < $b->date) {
        return 1;
    } else {
        return 0; 
    }
}

function get_fb_events() {
  
  $limit = 50;
  $userId =$_SESSION["userId"];
  
  $group_id = '517414261687949';
  
  //$accessToken = $_SESSION["accessToken"];
  $accessToken = 'CAALYh5lx46sBACxN0yx4b2JAvOv2IXa3WIYgsTCBdAykvfJ7p0M2Vv7UZA6MkkceqZCqH54r2R5pNKmZCHPEmeTBAILLZAdgKZBSKouol8avgPWvLNZB9cT9wH1BFTUlNtdchGSTu21de9gBZAwpw9P7GTES9ZBR21ZB3zonutZCP4kgO1VV86VuIE';
 
  $url = "https://graph.facebook.com/{$group_id}/events/?access_token=$accessToken";
  $data = json_decode(file_get_contents($url, true));
  
  $data2 = $data->result;
  echo ($url);
  print_r($data);
  
  //rsort($data2, 'my_sort');
  
  
  

  $counter = 0;
  
   foreach($data->data as $d) {
   if($counter==$limit)
   break;
    
    //print_r($d);
     $fb_event_id= $d->id;
     $fb_event_name = $d->name;
     //$fb_event_start_time = $d->start_time;
     //$fb_message = $d->message;
     //$fb_description = $d->description;
      $fb_event_start_time = date('F j, Y H:i',strtotime($d->start_time));
     
    //echo "$fb_event_id  <br>";
    echo "$fb_event_name <br>";
    echo "$fb_event_start_time <br>";
    
    $url2 = "https://graph.facebook.com/{$fb_event_id}/feed/?access_token=$accessToken";
    $data2 = json_decode(file_get_contents($url2, true));
    
     foreach($data2->data as $d2) {
       $fb_message = $d2->message;
       //echo "$fb_message <br>";
     }
     echo "<br>";
    $counter++;
      
     /*
     echo <<<EOL
       <div id="facebook_container">
      <div>
       <a href="http://facebook.com/profile.php?id=$fb_id">
         <img border="0" alt="$fn_name" src="https://graph.facebook.com/$fb_id/picture"/>
       </a>
       </div>
       <div id="facebook_item">
       <div id="facebook_from"><a href="http://facebook.com/profile.php?id=$fb_id">$fb_name</a></div>
       
      EOL;
    */
   }
 


}

function getAccessToken() {
    require_once 'facebook.php';
   //require_once 'autoload.php';

  //$app_id='801026859983787';
  //$app_secret ='5d6e67a221adcc527fc95c202f044563';

  $app_id='887419204666910 ';
  $app_secret ='57beb149a5eb588bf40a2745c9ec290b';

  $facebook = new Facebook(array(
   'appId'  => $app_id, // your application id
   'secret' => $app_secret, // your application secret
  'cookie' => true,
  ));

  $loginUrl   = $facebook->getLoginUrl(
        array(
            'scope' =>  'public_profile,email,user_managed_groups,user_events,user_about_me',
       'redirect_uri' => 'http://www.saltwellharriers.org.uk/saltwell_wordpress/test_facebook/'
        )
  );

  echo $loginUrl;
  //echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
  echo "<script type='text/javascript'>top.location.href = 'http://www.saltwellharriers.org.uk/test_facebook';</script>";
}


function get_facebook() {

$userId =$_SESSION["userId"];
//programmatic_login($userId);
$user_id = get_current_user_id();

global $wpdb;

$fbuserid = $wpdb->get_var("select count(*) from wp_usermeta where user_id=$user_id and meta_key='facebookall_user_id'");
$fbuserid =0;

//echo "use id is " .$user_id . " count is " .  $fbuserid ;

if ($fbuserid==0) {
}
else {

echo ('
  
  <section>
          <a href="https://www.facebook.com/groups/517414261687949/"><div class="heading">Facebook</div></a>
          
          <div class="facebook_content"> 
          <!--
          <!--
          <ul class="list">
            <li><a href="#">Post1</a></li>
            <li><a href="#">Post2</a></li>
            <li><a href="#">Post3</a></li>
            <li><a href="#">Post4</a></li>
            <li><a href="#">Post5</a></li>
          </ul>
          -->
          <!--
          <iframe src="http://www.facebook.com/plugins/likebox.php?id=214595641941425&amp;width=320&amp;connections=5&amp;stream=true&amp;header=true&amp;height=400" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:280px; height:400px;" allowTransparency="true"></iframe>
          -->
          ');
          
          
          
          $limit = 5;
 
$group_id = '517414261687949';
$url1 = 'https://graph.facebook.com/'.$group_id;
//$des = json_decode(file_get_contents($url1));
 
 
echo '<pre>';
//print_r($des);
echo '</pre>';
 /*
  require_once 'facebook.php';
 //require_once 'autoload.php';

//$app_id='801026859983787';
//$app_secret ='5d6e67a221adcc527fc95c202f044563';

$app_id='887419204666910 ';
$app_secret ='57beb149a5eb588bf40a2745c9ec290b';

$facebook = new Facebook(array(
 'appId'  => $app_id, // your application id
 'secret' => $app_secret, // your application secret
'cookie' => true,
));
*/
/*
 $loginUrl   = $facebook->getLoginUrl(
        array(
            'scope' =>  'public_profile,email,user_groups,user_events',
       'redirect_uri' => 'http://localhost:8080/saltwell_wordpress/test_facebook/'
        )
);
*/
 /* $loginUrl   = $facebook->getLoginUrl(
        array(
            'scope' =>  'public_profile,email,user_groups,user_events',
       'redirect_uri' => 'http://localhost:8080/saltwell_wordpress/test_facebook/'
        )
);
*/

 $accessToken = $_SESSION["accessToken"];
 echo "********ACCESS TOKEN $accessToken  ************ <br> " ;

 
 if (is_null($accessToken)) {
  
  echo "********TOKEN IS NULL";
  getAccessToken();
  
  //echo $loginUrl;
  //echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
  //echo "<script type='text/javascript'>top.location.href = 'http://localhost:8080/saltwell_wordpress/test_facebook';</script>";
}
else {
  //echo "********ACCESS TOKEN $accessToken";
}
 
 /*
 echo "XXXXXXXXXXXXXXXXXX";


//$facebook2 = new Facebook();
//$user = $facebook->facebook->getUser();
$user = $facebook->getUser();
echo "USER IS $user";

try{
             $me = $facebook->api('/me');
            //If id_facebook exist, then set logged in session to user id
            if($me){
    echo "ME IS $me";
                $stmt = $GLOBALS['link']->prepare('SELECT * FROM users WHERE id_facebook=:id_facebook');
                $stmt->execute(array('id_facebook' => $me['id']));
                if($row = $stmt->fetch()){
                    $_SESSION['uid'] = $row['id'];
                }
            }
      else {
    echo "NOT ME IS $me";
    }
        } catch (FacebookApiException $e) {
  echo "EXCEPTION $e";
            $user = null;
            //User is not logged in
        }
  
  
*/



/*
if ($user) {
//try {
echo "FB USER LOGGEN IN";
// Proceed knowing you have a logged in user who's authenticated.
//$permissions = $facebook->api('/me/permissions');   
//   } catch (FacebookApiException $e) {
//    echo $e;
//    $user = null;
//  }
 }  

 if (!$user) {
 echo "NO USER   $loginUrl" ;
    //echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
    
  } 
  
  
*/

 
 //$accessToken = 'CAALYh5lx46sBAGiQmBJ9f6EcG6IO9pfiCWEPJTTMdn8NlF8OXLRWtRT9kKJmZACHsGuXJhYmOUGFNBC4Uf8RstDXl5PDRFtRtUxIjEOM2uCsC4bAHrmr01QNqyZCrxzhf8VpSA1col8nY0RhFEtARzC4qWKSTwgGnaEHZC5Pbv0R2ZB1QO48Yi1YE8WOKpqvShlGusIpzmDcjnYNUjva';
 
 try {
    $url2 = "https://graph.facebook.com/{$group_id}/feed/?access_token=$accessToken";
    echo $url2;
    $data = json_decode(file_get_contents($url2, true));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    
    $_SESSION["accessToken"]= NULL;
    getAccessToken();
    
}

//echo "DATA ID " . $data;
if ($data == NULL) {
  echo "data is null";
  //getAccessToken();
  $data = json_decode(file_get_contents($url2, true));
}  


/*
$requestUrl = 'https://graph.facebook.com/motyar';
$response  = file_get_contents($requestUrl);
$jsonobj  = json_decode($response);
$resultArray = object2array($jsonobj);
print_r($resultArray);

*/

//var_dump($data);
//print_r($data);


echo ('

<div>
 <div>
 
');
 
 
 $counter = 0;
  
 foreach($data->data as $d) {
 if($counter==$limit)
 break;
 
 $fb_id= $d->from->id;
 $fb_name = $d->from->name;
 $fb_picture = $d->picture;
 $fb_message = $d->message;
 $fb_description = $d->description;
 $fb_time = date('F j, Y H:i',strtotime($d->created_time));
 
 //print_r($d);
 
 $fb_comments = $d->comments;

//print_r($fb_comments);
 
echo <<<EOL
 <div id="facebook_container">
<div>
 <a href="http://facebook.com/profile.php?id=$fb_id">
   <img border="0" alt="$fn_name" src="https://graph.facebook.com/$fb_id/picture"/>
 </a>
 </div>
 <div id="facebook_item">
 <div id="facebook_from"><a href="http://facebook.com/profile.php?id=$fb_id">$fb_name</a></div>
 
EOL;

if ($fb_picture != NULL) {
 echo <<<EOL
 <div id="facebook_pic"><img src=$fb_picture></div>
EOL;
}
 
echo <<<EOL
 <div id="facebook_post">$fb_description</div>
 <div id="facebook_post">$fb_message</div>
 <div id="facebook_time">on $fb_time</div> 
 </div>

 
EOL;




if ($fb_comments != NULL) {
  echo <<<EOL
    <input type="checkbox" class="button-settings name="ShowFacebook$counter" id="ShowFacebook$counter" onclick="showFacebookSelect($counter)" onChange="showFacebookSelect($counter)""/>
    <label for="ShowFacebook$counter">Show Comments</label>
    <div id="fbComments$counter" style="display:none;background:#FAE6E6">
EOL;

  foreach($fb_comments->data as $c) {
    $name = $c->from->name;
    $id = $c->from->id;
    echo <<<EOL
    

    <!-- <input type="checkbox" name="ShowFacebook$counter" id="ShowFacebook$counter" onclick="showFacebookSelect($counter)" onChange="showFacebookSelect($counter)" /> -->
    <!-- <div id="fbComments$counter"> -->
    <a href="http://facebook.com/profile.php?id=$fb_id">
      <img border="0" alt="$name" src="https://graph.facebook.com/$id/picture"/>
    </a>
 
    <div id="facebook_from"><a href="http://facebook.com/profile.php?id=$id">$name</a></div>
    <div id="facebook_post">$c->message </div>
    
    <div id="facebook_time">on $c->created_time </div>
    
EOL;
  } 
  echo "</div>";
}
echo "</div>";
//echo $fb_comments;
  
  /*
  <a href='http://facebook.com/profile.php?id=<?php echo $d->from->id?>'>
   <img border=\"0\" alt=\"<?=$d->from->name?>\" src=\"https://graph.facebook.com/<?php echo $d->from->id?>/picture\"/>
   
 <div id=\"facebook_item\">
 <div id=\"facebook_from\"><a href=\"http://facebook.com/profile.php?id=<?php echo $d->from->id?>\">
<?php echo $d->from->name?></a></div>
 
 <div id=\"facebook_post\"><?php echo $d->message?></div>
  
 <div id=\"facebook_time\">on <?php echo date(\"F j, Y H:i\",strtotime($d->created_time))?></div> 
 
 

 </div>
 */

 
  
 
 $counter++;
 }

 echo ('
</div>



          </div> 
        </section>');
}
        
}


function get_saltwell_sidebar() {
  
   
$user_id = get_current_user_id();
if ($user_id == 0) {
//echo 'You are not logged in ';
$_SESSION["accessToken"] = NULL;
//the_widget( 'FacebookAllLoginWidget', $instance, $args );
//echo "<a href='http://www.saltwellharriers.org.uk/saltwell_wordpress/wp-login.php'>Login</a>";

} else {
    // echo 'You are logged in as user '.$user_id;
    $logout_url = wp_logout_url(home_url());
    echo "<a href=" . $logout_url . ">Logout</a>";
    get_facebook();
    
    
} 
  //get_facebook();
  
   echo ('
        <section>
    <iframe height="454" width="280" frameborder="5" allowtransparency="true" scrolling="no" src="http://www.strava.com/clubs/swharriers/latest-rides/4a5feb78b126a402ae9576b6b92a8289163a143b?show_rides=true"></iframe>

    
  </section>
  
        <section>
        <div class="heading">Forthcoming Races</div>
        <div class="content">
  
');  
          set_time_limit ( 235 );
           $rss = new DOMDocument();
            $rss->load('http://www.northeastraces.com/next.rss');
            $feed = array();
            
            
foreach ($rss->getElementsByTagName('item') as $node) {
  $item = array ( 
    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
    'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
    'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
    'timestamp' => strtotime(substr(($node->getElementsByTagName('title')->item(0)->nodeValue),0,10)),
    'racedate' => date('l F d, Y', strtotime(substr(($node->getElementsByTagName('title')->item(0)->nodeValue),0,10))),
    'racename' => substr(($node->getElementsByTagName('title')->item(0)->nodeValue), 11, ($node->getElementsByTagName('title')->item(0)->nodeValue)),
    );
  array_push($feed, $item);
}

$newarray = array();

foreach ($feed as $key => $row)
{
    $newarray[$key] = $row['timestamp'];
}

array_multisort($newarray, SORT_ASC, $feed);

$limit = 10;
for($x=0;$x<$limit;$x++) {
  $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
  $link = $feed[$x]['link'];
  $description = $feed[$x]['desc'];
  $pubdate = date('l F d, Y', strtotime($feed[$x]['date']));
  //$racedate = substr($title,0,10);
  //$newDate = date("d-m-Y", strtotime($originalDate));
  //$race2date = date('l F d, Y', strtotime(substr($title,0,10)));
  $racedate = $feed[$x]['racedate'];
  //$racename = substr($title,11,strlen($title));
  $racename = $feed[$x]['racename'];
  $timestamp = $feed[$x]['timestamp'];
  
  echo '<div class="race_title"><a href="'.$link.'" title="'.$title.'">'.$racename.'</a></div>';
  echo '<div class="race_name">'.$racedate.'</div>';
  //echo '<p>'.$racename.'</p>';
  //echo '<p>'.$timestamp.'</p>';
  // echo '<small><em>Posted on '.$date.'</em></small></p>';
  // echo '<p>'.$description.'</p>';
}

$baseurl=get_site_url();


echo <<<EOL
          
          </div>
        </section>
        <section>
          <!-- <div class="heading">Training Tools</div> -->
          <div class="content">
            <section>
            
          <a class="fell_running" href="$baseurl/fell-running">
            <div class="image">
              <img src="$baseurl/wp-content/themes/saltwell/images/fell.jpg" /><br>
              <span class="img_text"><span class="fell">Fell Running</span></span>
            </div>
          </a>
          <a class="fell_running" href="http://www.harrierleague.com/">
            <div class="image">
              <img src="$baseurl/wp-content/themes/saltwell/images/xc.jpg" /><br>
              <span class="img_text"><span class="xc">Cross Country</span></span>
            </div>
          </a>
          
          
          <a class="fell_running" href="http://www.runnersworld.com/training/marathon-training-plans">
            <div class="image">
              <img src="$baseurl/wp-content/themes/saltwell/images/marathon.jpg" />
              <span class="img_text"><span class="marathon">Marathon Training</span></span>
            </div>
          </a>
        
              
            </section>
          </div>
        </section>
      </div>
      
  
EOL;
}



function new_excerpt_more( $more ) {
  return ' <p class="more"><a class="button" href="'. get_permalink( get_the_ID() ) . '">Read More >></a></p>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function custom_excerpt_length( $length ) {
  return 55;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*
//Function returns array by a SimpleXmlObject
function object2array($object){
    $return = NULL;
      
    if(is_array($object))
    {
        foreach($object as $key => $value)
            $return[$key] = object2array($value);
    }
    else
    {
        $var = get_object_vars($object);
          
        if($var)
        {
            foreach($var as $key => $value)
                $return[$key] = ($key && !$value) ? NULL : object2array($value);
        }
        else return $object;
    }

    return $return;
}
*/



function improved_trim_excerpt($text = '') {
  $raw_excerpt = $text;
  if ( '' == $text ) {
    $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
    //$text = str_replace('[...]', 'RRRR', $text);
                $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
    
                $text = strip_tags($text, '<p>,<a>,<td>,<tr>,<col>,<tbody>,<colgroup>');
    //$text = strip_tags($text, '<p>,<a>,<table>,<td>,<tr>,<col>,<tbody>,<colgroup>');
    //$text = strip_tags($text, '<a href>');
    //$text = strip_tags($text, '<table>');
    //$text = strip_tags($text, '<br>');
    //$text = strip_tags($text, '<ul>');
    //$text = strip_tags($text, '<li>');
    //$text = strip_tags($text, '&nbsp;');
                $excerpt_length = 55;
                $words = explode(' ', $text, $excerpt_length + 1);
    $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
                if (count($words)> $excerpt_length) {
                        array_pop($words);
      array_push($words, $excerpt_more);
                        //array_push($words, '[...]');
                        $text = implode(' ', $words);
                }
    //$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
    //$text = improved_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  /**
   * Filter the trimmed excerpt string.
   *
   * @since 2.8.0
   *
   * @param string $text        The trimmed text.
   * @param string $raw_excerpt The text prior to trimming.
   */
  return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}


remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');


class SaltwellCustomPosts {

    function createCustomPosts() {
        register_post_type("race", array("labels" => array(
                                                                      "name" => "Races",
                                                                      "singular_name" => "Race",
                                                                      "add_new_item" => "Add New Race",
                                                                      "edit_item" => "Edit Race",
                                                                      "new_item" => "New Race",
                                                                      "view_item" => "View Race",
                                                                      "search_items" => "Search Races",
                                                                      "not_found" => "No races found",
                                                                      "not_found_in_trash" => "No races found in trash"
                                                                     ),
                                              "public" => true,
                                              "publicly_queryable" => true,
                                              "show_ui" => true, 
                                              "show_in_menu" => true, 
                                              "query_var" => true,
                                              "rewrite" => true,
                                              "capability_type" => "post",
                                              "has_archive" => true, 
                                              "hierarchical" => false,
                                              "menu_position" => null,
                                              "supports" => array("title", "editor", "thumbnail")));
    }
    
    function createTaxonomies() {
        register_taxonomy("races", "post", array(
                                                "labels" => array(
                                                                  "name" => "Races",
                                                                  "singular_name" => "Race",
                                                                  "search_items" => "Search Races",
                                                                  "popular_items" => "Popular Races",
                                                                  "all_items" => "All Races",
                                                                  "edit_item" => "Edit Race",
                                                                  "update_item" => "Update Country",
                                                                  "add_new_item" => "Add New Race",
                                                                  "new_item_name" => "New Race Name",
                                                                  "separate_items_with_commas" => "Separate races with commas",
                                                                  "add_or_remove_items" => "Add or remove races",
                                                                  "choose_from_most_used" => "Choose from the most used races"
                                                                 ),
                                                "hierarchical" => false,
                                                "show_ui" => true,
                                                "query_var" => true,
                                                "rewrite" => false
                                               ));
    }
    
}



add_action("init", array("SaltwellCustomPosts", "createCustomPosts"));
add_action("init", array("SaltwellCustomPosts", "createTaxonomies"));


/**
* Programmatically logs a user in
*
* @param string $username
* @return bool True if the login was successful; false if it wasn't
*/
function programmatic_login( $username ) {
if ( is_user_logged_in() ) {
//wp_logout();
}
add_filter( 'authenticate', 'allow_programmatic_login', 10, 3 ); // hook in earlier than other callbacks to short-circuit them
$user = wp_signon( array( 'user_login' => $username ) );
remove_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );
if ( is_a( $user, 'WP_User' ) ) {
wp_set_current_user( $user->ID, $user->user_login );
if ( is_user_logged_in() ) {
return true;
}
}
 
return false;
}
 
/**
* An 'authenticate' filter callback that authenticates the user using only the username.
*
* To avoid potential security vulnerabilities, this should only be used in the context of a programmatic login,
* and unhooked immediately after it fires.
*
* @param WP_User $user
* @param string $username
* @param string $password
* @return bool|WP_User a WP_User object if the username matched an existing user, or false if it didn't
*/
function allow_programmatic_login( $user, $username, $password ) {
return get_user_by( 'login', $username );
} 

// custom admin login logo
function custom_login_logo() {
  echo '<style type="text/css">
  h1 a { background-image: url('.get_bloginfo('template_directory').'/images/custom-login-logo.png) !important; }
  </style>';

}
add_action('login_head', 'custom_login_logo');

