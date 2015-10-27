<?php get_header(); ?> 
	
	<!-- main content -->

	<section id="main-content" class="two-col">

  <?php
  if( have_posts() ) {
    while( have_posts() ) {
      the_post();
  ?>

    <section class="main-col posts">

      <article <?php post_class(); ?>>

        <header>
          <h2><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h2>
          <span class="date"><?php the_date('M d'); ?></span>
        </header>
        <?php the_post_thumbnail('single'); ?>
        <?php the_content(); ?>

      </article>

    </section>

  <?php
    }
  } else {
  ?>
      <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
  <?php
  } ?>

    <section class="small-col">
<?php get_template_part('partials/twitter-feed'); ?> 
    
    </section>

  </section>
  <!-- end main-content -->
  
		
<?php get_footer(); ?> 
