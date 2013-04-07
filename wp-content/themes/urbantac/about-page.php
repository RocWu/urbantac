<?php
/*
Template Name: About Page
*/
?>

<?php get_header(); ?>

  <div id="content-wrap">
    <div id="about-content" class="about wrap clearfix aligncenter content-container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="about-details clearfix">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>

        <div class="about-image clearfix">
          <?php $aboutImage = get_field('image'); ?>
          <img src="<?php echo $aboutImage['url']; ?>" alt="<?php echo $aboutImage['alt']; ?>"/>
        </div>

        <div class="about-panorama clearfix">
          <?php $panorama = get_field('panorama'); ?>
          <img src="<?php echo $panorama['url']; ?>" alt="<?php echo $panorama['alt']; ?>" />
        </div>
      <?php endwhile; endif; ?>
    </div> <!-- end #about-content -->
  </div> <!-- end #about-wrap -->

<?php get_footer(); ?>