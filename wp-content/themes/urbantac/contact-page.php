<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

  <div id="content-wrap">
    <div id="contact-content" class="contact wrap clearfix aligncenter content-container" itemscope itemtype="http://schema.org/LocalBusiness">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="contact-details clearfix">
          <h1><?php the_title(); ?></h1>

          <div class="employees">
            <?php if(get_field('employees')): ?>
              <?php while(has_sub_field('employees')): ?>
                <div class="employee">
                  <p class="name"><?php the_sub_field('name'); ?></p>
                  <p class="title"><?php the_sub_field('title'); ?></p>
                  <p class="email"><a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></p>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="facebook-inset">
            <a href="http://www.facebook.com/pages/Urban-Tactical-Supplies-LLC/149152391833258" target="_blank"><span>Like us on Facebook! <i class="icon-facebook-sign"></i></span></a>
          </div>
        </div>

        <div class="contact-map-container clearfix">
          <p class="phone"><span itemprop="telephone">774.302.0130</span></p>
          <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="address"><span itemprop="streetAddress">260 Main Street</span>, <span itemprop="addressLocality">Buzzards Bay</span>, <span itemprop="addressRegion">Massachusetts</span> <span itemprop="postalCode">02532</span></p>
          <p class="hours">Tuesday - Friday 9:00am-5:00pm <span class="separator">/</span> Saturday 9:00am-1:00pm</p>
          <meta itemprop="openingHours" content="Tu-Fr 09:00-17:00">
          <meta itemprop="openingHours" content="Sa 11:00-13:00">
          <div class="contact-map-wrap">
            <div id="contact-map"></div>
          </div>
          <div class="contact-directions">
            <section>
              <p>
                <strong>From the Cape:</strong><br />
                Take the Bourne or Sagamore Bridge to the Bourne rotary<br />
                Take the exit after Ocean State Job Lot on the Bourne rotary<br />
                We are a quarter mile down Main Street on the left
              </p>
            </section>
            <section>
              <p>
                <strong>From the North:</strong><br />
                Take I-495 South to MA-25 East<br />
                Take Exit 3 to the Bourne rotary and exit after Ocean State Job Lot<br />
                We are a quarter mile down Main Street on the left
              </p>
            </section>
          </div>
        </div>

        
      <?php endwhile; endif; ?>
    </div> <!-- end #about-content -->
  </div> <!-- end #about-wrap -->


  <!-- google maps code -->
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-1f76iJ12lb8G_KNP9oiT5dKtV-WzoQs&sensor=false"></script>
  <script>
    function initialize()
    {
      //41.750386,-70.60014
      var latitude = 41.750386;
      var longitude = -70.60014;

      var mapProp = {
        mapTypeId: google.maps.MapTypeId.HYBRID
        };
      var map=new google.maps.Map(document.getElementById("contact-map")
        ,mapProp);

      map.setCenter(new google.maps.LatLng(latitude,longitude));
      map.setZoom(18);

      // Add Marker
      var marker1 = new google.maps.Marker({
          position: new google.maps.LatLng(latitude,longitude),
          map: map
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
<?php get_footer(); ?>