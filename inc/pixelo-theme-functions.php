<?php

/**
 * Function to get page content
 */
if( !function_exists( 'pixelo_page_content_markup' ) ) {

  /**
   * Page content markup func
   */
  function pixelo_page_content_markup() {

    $page_sidebar = get_theme_mod( 'pixelo_page_sidebar', true );

    ?>
     <div id="primary" class="content-area primary">
            
        <main id="main" class="site-main" role="main">
  
          <?php while ( have_posts() ) : the_post(); ?>

          <?php if ( has_post_thumbnail() ) { ?>
          <div class="hero-image">
              <?php the_post_thumbnail('large', ['class' => 'objFit'], array('title' => get_the_title() )); ?>
          </div>
          <?php } ?>
          <?php 
              $pixelo_site_title = get_post_meta( get_the_ID(), '_pixelo_title_meta_kay', true );

              if( empty( $pixelo_site_title ) ) {
                  ?>
                      <h1 class="heading"><?php the_title(); ?></h1>
                  <?php
              }
          ?>

          <?php the_content();?>

          <?php endwhile; // end of the loop. ?>
  
        </main><!-- #main -->
              
      </div><!-- #primary -->
    <?php
  }
}
add_action( 'pixelo_page_content', 'pixelo_page_content_markup' );

/**
 * Function to get left sidebar
 */
if( !function_exists( 'pixelo_left_sidebar_markup' ) ) {

    /**
     * Left sidebar markup func
     */
    function pixelo_left_sidebar_markup() {

        $pixelo_sidebar_meta_layout = get_post_meta( get_the_ID(), '_pixelo_sidebar_meta_kay', true );
        $page_sidebar = get_theme_mod( 'pixelo_page_sidebar', true );

        if( $pixelo_sidebar_meta_layout == 'left-sidebar' || $page_sidebar == 'left-sidebar' ) {
            get_sidebar();
        }
    }
}
add_action( 'pixelo_left_sidebar', 'pixelo_left_sidebar_markup' );

/**
 * Function to get right sidebar
 */
if( !function_exists( 'pixelo_right_sidebar_markup' ) ) {

    /**
     * Right sidebar markup func
     */
    function pixelo_right_sidebar_markup() {

        $pixelo_sidebar_meta_layout = get_post_meta( get_the_ID(), '_pixelo_sidebar_meta_kay', true );
        $page_sidebar = get_theme_mod( 'pixelo_page_sidebar', true );

        if( $pixelo_sidebar_meta_layout == 'right-sidebar' || $page_sidebar == 'right-sidebar' ) {
            get_sidebar();
        }
    }
}
add_action( 'pixelo_right_sidebar', 'pixelo_right_sidebar_markup' );

/**
 * Function to get post content
 */
if( !function_exists( 'pixelo_content_markup' ) ) {

    /**
     * Content markup func
     */
    function pixelo_content_markup() {

        ?>
            <?php if (get_theme_mod('pixelo-basic-author-callout-display') == 'Yes') { ?>

            <div class="row row-padding author">

                <div class="col-6 author-image">

                    <img loading="lazy" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod('pixelo-basic-author-callout-image')) ); ?>" alt="<?php echo esc_attr__( "Author Avater", "pixelo" );?>">
                
                </div>

                <div class="col-6 author-content">

                    <?php 

                        $authorText = get_theme_mod('pixelo-basic-author-callout-text');

                        if ($authorText != '') {

                            echo wpautop($authorText);

                        } else {

                            echo __( "Edit this by going to your Dashboard -> Appearance -> Customise -> Author Editor", "pixelo" );
                        
                        }

                    ?>
                    
                </div>

            </div>

            <?php } ?>
        
            <main class="container"> 

                <article id="post-<?php the_ID(); ?>" <?php post_class(['blog_wrap row', 'row-padding']); ?>>

                    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    
                        <div class="blog_wrap-item">

                            <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

                        </div> 

                    <?php endwhile; endif; ?>

                </article>

            </main>
                    
        
            <div class="pixelo-post-pagination">

                <?php pixelo_post_pagination(); ?>

            </div>

        <?php
    }
}
add_action( 'pixelo_post_content', 'pixelo_content_markup' );

/**
 * Function to get post content
 */
if( !function_exists( 'pixelo_single_post_content_markup' ) ) {

    /**
     * Single post content markup func
     */
    function pixelo_single_post_content_markup() {

        $pixelo_sidebar_layout = get_theme_mod('pixelo_single_post_sidebar');

        if( $pixelo_sidebar_layout == 'left-sidebar' ) { 

            get_sidebar(); 

        }

        get_template_part( 'template-parts/single-post' );

        if( $pixelo_sidebar_layout == 'right-sidebar' ) {

            get_sidebar(); 

        } 
        
    }
}
add_action( 'pixelo_single_post_content', 'pixelo_single_post_content_markup' );

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'pixelo_body_classes' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @since 1.0.0
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function pixelo_body_classes( $classes ) {
        $pixelo_sidebar_meta_layout = get_post_meta( get_the_ID(), '_pixelo_sidebar_meta_kay', true );
        $pixelo_page_sidebar = get_theme_mod( 'pixelo_page_sidebar', true );
        $pixelo_single_post_sidebar = get_theme_mod('pixelo_single_post_sidebar');
        $pixelo_woocommerce_sidebar = get_theme_mod('pixelo_wc_sidebar_layout_options');
        $pixelo_single_product_sidebar = get_theme_mod('pixelo_single_product_sidebar');

        /**
         * Adds custom page sidebar classes to the array of body classes.
         *
         * @since 1.0.0
         * @param array $classes Classes for the body element.
         * @return array
         */
        if ( is_page() ) {

            if ( $pixelo_page_sidebar || $pixelo_sidebar_meta_layout ) {

                $classes[] = 'pixelo-'.$pixelo_page_sidebar. ' pixelo-'.$pixelo_sidebar_meta_layout;

            }
        }

        /**
         * Adds custom product page sidebar classes to the array of body classes.
         *
         * @since 1.0.0
         * @param array $classes Classes for the body element.
         * @return array
         */
        if ( did_action( 'woocommerce_loaded' ) ) {
            
            if ( is_shop() || is_product_category() || is_product_tag() ) {

                if ( $pixelo_woocommerce_sidebar ) {
    
                    $classes[] = 'pixelo-'.$pixelo_woocommerce_sidebar;
        
                }
    
            }
        }


        /**
         * Adds custom single product page sidebar classes to the array of body classes.
         *
         * @since 1.0.0
         * @param array $classes Classes for the body element.
         * @return array
         */
        if ( did_action( 'woocommerce_loaded' ) ) {
            
            if ( is_product() ) {

                if ( $pixelo_single_product_sidebar ) {
    
                    $classes[] = 'pixelo-'.$pixelo_single_product_sidebar;
    
                }
    
                unset( $classes[ array_search( "single", $classes ) ] );
    
            }
        }

        /**
         * Adds custom single post sidebar classes to the array of body classes.
         *
         * @since 1.0.0
         * @param array $classes Classes for the body element.
         * @return array
         */
        if ( is_single() ) {

            if ( $pixelo_single_post_sidebar ) {

                $classes[] = 'pixelo-'.$pixelo_single_post_sidebar;

            }

        }

        return $classes;
	}
}

add_filter( 'body_class', 'pixelo_body_classes' );

/**
 * Function to get woocommerce sidebar
 */
if ( ! function_exists( 'pixelo_wc_product_sidebar' ) ) {

	/**
	 * woocommerce sidebar markup
	 *
	 */
	function pixelo_wc_product_sidebar() {
        ?>
            <div id="secondary" class="widget-area" role="complementary">
            <?php if ( ! dynamic_sidebar( 'pixelo_wc_sidebar' ) ) : ?>

                <aside id="search" class="widget widget_search">
                        <?php get_search_form(); ?>
                </aside>
                <aside id="archives" class="widget">
                        <h3 class="widget-title"><?php _e( 'Archives', 'pixelo' ); ?></h3>
                        <ul>
                                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                </aside>
                
            <?php endif; ?>
            </div><!-- #secondary -->
        <?php
       
	}
}
add_action( 'pixelo_woocommerce_product_sidebar', 'pixelo_wc_product_sidebar' );

/**
 * Function to get woocommerce sidebar
 */
if ( ! function_exists( 'pixelo_wc_single_product_sidebar' ) ) {

	/**
	 * woocommerce sidebar markup
	 *
	 */
	function pixelo_wc_single_product_sidebar() {
        ?>
            <div id="secondary" class="widget-area" role="complementary">
            <?php if ( ! dynamic_sidebar( 'single_product_sidebar' ) ) : ?>

                <aside id="search" class="widget widget_search">
                        <?php get_search_form(); ?>
                </aside>
                <aside id="archives" class="widget">
                        <h3 class="widget-title"><?php _e( 'Archives', 'pixelo' ); ?></h3>
                        <ul>
                                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                </aside>
                
            <?php endif; ?>
            </div><!-- #secondary -->
        <?php
       
	}
}
add_action( 'pixelo_woocommerce_single_product_sidebar', 'pixelo_wc_single_product_sidebar' );