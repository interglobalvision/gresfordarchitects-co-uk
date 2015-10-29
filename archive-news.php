<?php get_header(); ?>

	<!-- main content -->

	<section id="main-content" class="two-col">

    <section class="main-col posts">

  <?php
  if( have_posts() ) {
    while( have_posts() ) {
      the_post();
  ?>

      <article <?php post_class(); ?>>

        <header class="news-header">
          <h2 class="news-title"><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h2>
          <span class="news-date"><?php the_date('M d'); ?></span>
        </header>

        <?php the_post_thumbnail('single'); ?>

        <?php the_content(); ?>

        <hr class="news-hr"/>

      </article>

  <?php
    }
  } else {
  ?>
      <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
  <?php
  } ?>

    </section>

    <section class="small-col">
      <?php get_template_part('partials/twitter-feed'); ?>
    </section>

  </section>
  <!-- end main-content -->

<?php get_footer(); ?>