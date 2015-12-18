<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
    <div class="about">
        "I the Lord have called thee in righteousness, and will hold thine hand, and will keep thee, and give thee for
        a covenant of the people, for a light of the Gentiles; To open the blind eyes, to bring out the prisoners from
        the prison, and them that sit in darkness out of the prison house" (Isaiah 42:6,7).
    </div>
    <nav class="footer-nav"><?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?></nav>
    <div class="contact" id="contact">
        <?php echo sprintf( '%1$s %2$s %3$s. All Rights Reserved.', '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
        <address>
            SALT Ministries, Wat Preah Yesu<br />
            P.O. Box 93007, Siem Reap, Cambodia
        </address>
        <address>Tel. (855) 12 804017, (855) 12 734102</address>
        <address>E-mail: <a href="mailto:salt@camshin.com.kh">salt@camshin.com.kh</a></address>
    </div>
</footer>
</div> <!-- /wrapper -->
<?php wp_footer(); ?>
</body>
</html>