<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
    <nav class="footer-nav"><?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?></nav>
    <span class="contact">
        <?php echo sprintf( '%1$s %2$s %3$s. All Rights Reserved.', '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?> •
        SALT Ministries, Wat Preah Yesu • P.O. Box 93007, Siem Reap, Cambodia • Tel. (855) 12 804017, (855) 12 734102 • E-mail: <a href="mailto:salt@camshin.com.kh">salt@camshin.com.kh</a>
    </span>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>