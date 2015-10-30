<?php get_header(); ?>

	<!-- main content -->

	<section id="main-content" class="two-col">

  <?php
  if( have_posts() ) {
    while( have_posts() ) {
      the_post();
  ?>

    <section id="page" class="main-col">

      <article <?php post_class('font-copy'); ?> id="page-copy">

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

    <section id="" class="small-col">
<?php
    $meta = get_post_meta($post->ID);
    echo wpautop($meta['_cmb_pagetext'][0]);
?>
    </section>

  </section>
  <!-- end main-content -->


<?php get_footer(); ?>
