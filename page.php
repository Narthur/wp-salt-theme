<?php get_header(); ?>
	<section id="content" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="header">
					<?php
					$parents = array_reverse(get_post_ancestors($post->ID));
					$first_parent = get_post($parents[0]);
					$title = get_the_title();
					$firstParentChildren = get_children(array(
						'post_parent' => $first_parent->ID,
						'post_type' => 'page'
					));
					echo "<h1 class='entry-title'>$first_parent->post_title</h1>";
					if (!empty($firstParentChildren)) {
						$isAtTop = $first_parent->ID == get_the_ID();
						$extraAtts = ($isAtTop) ? ' class="current_page_item"' : '';
						$topLink = "<li $extraAtts><a href='$first_parent->guid'>About</a></li>";
						$childLinks = wp_list_pages(array(
							'child_of' => $first_parent->ID,
							'title_li' => '',
							'echo'     => false
						));
						echo "<ul>$topLink $childLinks</ul>";
					}
					?>
				</header>
				<section class="entry-content">
					<?php
					the_content();
					edit_post_link();
					?>
					<div class="entry-links"><?php wp_link_pages(); ?></div>
				</section>
			</article>
			<?php if ( ! post_password_required() ) {
				comments_template( '', true );
			} ?>
		<?php endwhile; endif; ?>
	</section>
<?php get_footer(); ?>