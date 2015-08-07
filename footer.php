<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
    <div class="about">
        Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato. Dandelion cucumber earthnut pea peanut soko zucchini.
    </div>
    <nav class="footer-nav"><?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?></nav>
    <div class="contact">
        <?php echo sprintf( '%1$s %2$s %3$s. All Rights Reserved.', '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
        <address>
            SALT Ministries, Wat Preah Yesu<br />
            P.O. Box 93007, Siem Reap, Cambodia
        </address>
        <address>Tel. (855) 12 804017, (855) 12 734102</address>
        <address>E-mail: <a href="mailto:salt@camshin.com.kh">salt@camshin.com.kh</a></address>
    </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>