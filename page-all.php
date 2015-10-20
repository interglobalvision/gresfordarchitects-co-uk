<?php 
/* 
Template Name: Index Page
*/
get_header(); ?> 
  
  <!-- main content -->

  <section id="main-content">
  
    <!-- main posts loop -->
    <section id="posts">
  
    <?php 
      query_posts( 'posts_per_page=-1' );
    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
      $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'mason');
    ?>

      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" style="width: <?php echo $img[1]; ?>px;height:<?php echo $img[2]; ?>px">
        <a href="<?php the_permalink() ?>">
          <img src="<?php echo $img[0]; ?>">
          <div class="holder">
            <div class="title">
              <?php the_title(); ?>
            </div>
          </div>
        </a>
      </article>

    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria :{'); ?></p>
    <?php endif; ?>
    
    <!-- end posts -->
    </section>
  
  <!-- end main-content -->
  
  </section>
    
<?php get_footer(); ?>
