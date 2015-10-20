<?php get_header(); ?> 
  
  <!-- main content -->

  <section id="main-content">
  
    <!-- main posts loop -->
    <section id="post">
  
<?php 
if ( have_posts() ) {
  while ( have_posts() ) {
    the_post(); 
?>

      <article <?php post_class(); ?> id="page-<?php the_ID(); ?>">
        
        <nav id="scroll-up"></nav>
        
        <header>
        <!--
<div id="single-header-inner" class="fixed">
          <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
        </div>
-->
        </header>
      
      <div class="drawers">
          
      <div id="page-text">
        <?php
          $meta = get_post_meta($post->ID);
          echo wpautop($meta['_cmb_pagetext'][0]);
          ?>
      </div>
      </div>
      
        <?php the_content(); 
          
                      echo '<div id="page-text-small">'; 
                    echo wpautop($meta['_cmb_pagetextsmall'][0]); 
                    echo '</div>';
                            ?>div
      
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
