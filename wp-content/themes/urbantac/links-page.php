<?php
/*
Template Name: Links Page
*/
?>

<?php get_header(); ?>

  <div id="content-wrap">
    <div id="links-content" class="links wrap clearfix aligncenter content-container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php if(get_field('links')): 
          while(has_sub_field('links')): ?>
          <div class="link clearfix">
            <div class="link-image">
              <?php $linkImage = get_sub_field('link_image'); ?>
              <a href="<?php the_sub_field('link_url'); ?>">
                <img src="<?php echo $linkImage['url']; ?>" alt="<?php echo $linkImage['alt']; ?>" />
              </a>
            </div>
            <a href="<?php the_sub_field('link_url'); ?>"><h2><?php the_sub_field('link_title'); ?></h2></a>
            <div class="link-description">
              <?php the_sub_field('link_description'); ?>
            </div>
          </div>
          <?php endwhile; ?>


        <?php endif; ?>
      <?php endwhile; endif; ?>
    </div> <!-- end #about-content -->
  </div> <!-- end #about-wrap -->

<?php get_footer(); ?>