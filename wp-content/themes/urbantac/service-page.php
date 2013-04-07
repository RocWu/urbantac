<?php
/*
Template Name: Services Page
*/
?>

<?php get_header(); ?>

  <div id="content-wrap">
    <div id="services-content" class="services wrap clearfix aligncenter content-container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php if(get_field('services')): ?>
          <?php while(has_sub_field('services')): ?>
            <div class="services-pane clearfix">
                <h2><?php the_sub_field('service_title'); ?></h2>
                <?php
                  the_sub_field('service_bullet_list');
                  $serviceImage = get_sub_field('service_image');
                ?>
                <img src="<?php echo $serviceImage['url']; ?>" alt="<?php echo $serviceImage['alt']; ?>"/>
            </div> <!-- end .homepage-affiliates -->
          <?php endwhile; ?>
        <?php endif; ?>
      <?php endwhile; endif; ?>
    </div> <!-- end #about-content -->
  </div> <!-- end #about-wrap -->
<?php get_footer(); ?>