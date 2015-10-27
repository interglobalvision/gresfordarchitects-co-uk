<?php get_header(); ?> 
	
	<!-- main content -->

	<section id="main-content" class="single-col">
  
    <section>
      <?php echo category_description( $category_id ); ?> 
      <hr />
    </section>

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <section>

      <article <?php post_class(); ?> id="">

        <h2><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h2>
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

  </section>
  <!-- end main-content -->
  
		
<?php get_footer(); ?> 
