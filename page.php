<?php get_header(); ?>

  <!-- main content -->

  <section id="main-content">

    <!-- main posts loop -->
    <section id="page">

<?php
if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
?>

      <article <?php post_class(); ?> id="page-<?php the_ID(); ?>">

        <header>
        <!--
<div id="single-header-inner" class="fixed">
          <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
        </div>
-->
        </header>

        <?php
          the_content();
          echo '<div id="page-text-small">';
          echo wpautop($meta['_cmb_pagetextsmall'][0]);
          echo '</div>';
        ?>

      </article>

<?php }
} else { ?>
    <p><?php _e('Sorry, no posts matched your criteria'); ?></p>
<?php } ?>

    <!-- end posts -->
    </section>

  <!-- end main-content -->

  </section>

<?php get_footer(); ?>
