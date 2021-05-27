<footer>
    <?php if (get_theme_mod('pixelo-basic-footer-callout-display') == 'Yes') { ?>
    <p>
        <?php 
            $pixeloBasicFooter = get_theme_mod('pixelo-basic-footer-callout-copyright');
            $pixeloBasicPrivacyPolicy = get_theme_mod('pixelo-basic-footer-callout-privacy-policy');
            $pixeloBasicCookiePolicy = get_theme_mod('pixelo-basic-footer-callout-cookie-policy');

            if ($pixeloBasicPrivacyPolicy == "" || $pixeloBasicPrivacyPolicy == null) {
                echo "<a href='/privacy'>".__( 'Privacy Policy', 'pixelo' )."</a> /";
            }
            else {
                echo "<a href='". $pixeloBasicPrivacyPolicy ."'>".__( 'Privacy Policy', 'pixelo' )."</a> / ";
            }
            if ($pixeloBasicCookiePolicy == "" || $pixeloBasicCookiePolicy == null) {
                echo "<a href='/policy'>".__( 'Cookie Policy', 'pixelo' )."</a>";
            }
            else {
                echo "<a href='". $pixeloBasicCookiePolicy ."'>".__( 'Cookie Policy', 'pixelo' )."</a>";
            }

        ?>
    </p>
    <?php } ?>

    <p>
        <?php
            $thisYear = date("Y");
            $blog_title = get_bloginfo();
            $pixeloBasicFooter = get_theme_mod('pixelo-basic-footer-callout-copyright');

            if ($pixeloBasicFooter == "" || $pixeloBasicFooter == null) {
                $pixeloBasicFooter = __( "&copy; ", 'pixelo' ) . $thisYear . " " . $blog_title . " / ".__( 'Designed & Built by', 'pixelo' )." <a href='https://www.pixelo.com/' target='_blank'>".__( 'Pixelo', 'pixelo' )."</a>";
            }
            echo $pixeloBasicFooter;

        ?>
    </p>
</footer>
</div> 

<?php wp_footer() ?>
