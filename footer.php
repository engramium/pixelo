<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pixelo
 */

?>

        </div><!-- #side content -->
        <?php if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
            <div class="footer__widget-section">
                <div class="wrapper"> 
                    <div class="footer-widget">
                        <div class="single-widget">
                            <?php 
                                
                                if ( is_active_sidebar( 'footer-1' ) ) {
                                    dynamic_sidebar( 'footer-1' );
                                }

                            ?>
                        </div>
                        <div class="single-widget">
                            <?php 
                                
                                if ( is_active_sidebar( 'footer-2' ) ) {
                                    dynamic_sidebar( 'footer-2' );
                                }

                            ?>
                        </div>
                        <div class="single-widget">
                            <?php
                                
                                if ( is_active_sidebar( 'footer-3' ) ) {
                                    dynamic_sidebar( 'footer-3' );
                                }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <footer class="site-footer">
            <div class="coyyright-section">
                <p>
                    <?php

                        echo date_i18n(
                            _x( '©Y', 'copyright date format', 'pixelo' )
                        );

                    ?>
                    <span>
                        <?php echo bloginfo('name'); ?>
                        <?php printf( __( '/ Pixelo WordPress Theme by', 'pixelo' ) ); ?>
                    </span> 
                    <a href="<?php echo esc_url( __( 'https://www.engramium.com/', 'pixelo' ) ); ?>" target='_blank'><?php printf( __( 'Engramium', 'pixelo' ) ); ?></a>
                </p>
            </div>
        </footer>

        <?php wp_footer(); ?>

    </body>
</html>
