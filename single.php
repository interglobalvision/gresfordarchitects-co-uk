<?php get_header(); ?>

	<!-- main content -->

	<section id="main-content">

		<!-- main posts loop -->
		<section id="post" <?php
			$cats = get_the_category($post->ID);
if ($cats[0]->slug == 'featured') {
				echo 'data-cat="' . $cats[1]->term_id . '"';
			} else {
				echo 'data-cat="' . $cats[0]->term_id . '"';
			}
		?>>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			$cat = get_the_category();
		?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" data-cat-id="<?php echo $cat[0]->cat_ID; ?>">

				<nav id="scroll-up"></nav>

				<header class="post-header">
				<div id="single-header-inner" class="fixed">
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

					<div class="right">
						<ul id="gallery-indicators">
						</ul>

						<ul id="nav-right">
							<li id="toggle-project-text"><a>
						<div id="view-project-text"><span class="entypo"><i class="icon-info-circled"></i>	</span></div>
						<div id="close-project-text"><span class="entypo"><i class="icon-cancel-circled"></i></span></div>
							</a></li>
							<li id="mail-toggle"><a><div class="button"><span class="entypo"><i class="icon-export"></i></span></div></a></li>
							<li><div class="pinterest"><a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="<?php bloginfo('stylesheet_directory'); ?>/img/pin.png"></a></div></li>
						</ul>
					</div>
				</div>
				</header>

			<div class="drawers">
			<div id="mail" data-state="false">

			<div id="mailtitle">You can use this form to email a link to this project...<br><br></div>
 	  			<form method="post" action="<?php bloginfo('stylesheet_directory'); ?>/lib/swift/sendmail.php">
        <div class="cf">
            <div>
                <label for="name-to">Their name:</label> <input name="name-to" type="text" id="name-to" placeholder="Receipient name (optional)" autofocus="">
            </div>

            <div>
                <label for="email-to">Their email:</label> <input name="email-to" type="email" id="q" placeholder="Receipient email address" required="" autofocus="">
            </div>

            <div>
                <label for="name-from">Your name:</label> <input name="name-from" type="text" id="name-from" placeholder="Your name (optional)" autofocus="">
            </div>

            <div>
                <label for="email-from">Your email:</label> <input name="email-from" type="email" placeholder="Your email address" required="">
            </div>
            <div>
                <label for="message">Your message:</label> <input name="message" type="text" placeholder="(optional message)">
            </div>

            <input type="hidden" name="url" value="<?php the_permalink(); ?>">

            <div>
                <input name="send" type="submit" value="Share">
            </div>
        </div>
        		</form>
 	  		</div>

			<div id="project-text" data-state="false">
				<?php
					$meta = get_post_meta($post->ID);
					echo wpautop($meta['_cmb_projdesc'][0]); ?>
			</div>
			</div>

 	  		<?php the_content(); ?>

			</article>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria'); ?></p>
		<?php endif; ?>

		<!-- end posts -->
		</section>

	<!-- end main-content -->

	</section>

<?php get_footer(); ?>
