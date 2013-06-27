<?php
/*
Template Name: Homepage Template
*/
?>

<?php get_header(); ?>

  <div id="content-wrap">
    <div id="homepage-content" class="wrap clearfix aligncenter content-container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if(get_field('homepage_stage_images')): ?>
          <div class="flexslider clearfix">
            <ul class="slides">
              <?php while(has_sub_field('homepage_stage_images')):
                $sliderImage = get_sub_field('image'); ?>
                <li>
                  <?php $slideShowLink = get_sub_field('relationship');
                  if($slideShowLink):
                    $post_object = $slideShowLink[0]; ?>
                    <a href="<?php echo get_permalink($post_object->ID); ?>"><img src="<?php echo $sliderImage['url'] ?>" alt="<?php echo $sliderImage['alt']?>" /></a>
                  <?php else: ?>
                    <img src="<?php echo $sliderImage['url'] ?>" alt="<?php echo $sliderImage['alt']?>" />
                  <?php endif; ?>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="homepage-about">
          <?php the_content(); ?>
        </div>

        <?php if(get_field('featured_shop_images')): ?>
          <div class="homepage-featured-panes clearfix">
            <?php while(has_sub_field('featured_shop_images')):
              $featuredImage = get_sub_field('image');
              $featuredLink = get_sub_field('link');
              if($featuredLink): 
                $post_object = $featuredLink[0]; ?>
                <a href="<?php echo get_permalink($post_object->ID); ?>"><img src="<?php echo $featuredImage['url']; ?>" alt="<?php echo $featuredImage['alt']; ?>" /></a>
              <?php else: ?>
                <img src="<?php echo $featuredImage['url']; ?>" alt="<?php echo $featuredImage['alt']; ?>" />
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      <?php endwhile; endif; ?>
    </div> <!-- end #homepage-content -->
  </div> <!-- end #homepage-wrap -->

<?php get_footer(); ?>