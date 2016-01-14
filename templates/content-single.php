<section class="single-page-header cd-hero" id="page-slider">
    <ul class="cd-hero-slider">
        <li class="cd-bg-video autoplay first-slide selected" >
            <div class="overlay"></div>
            <div class="slider-content slider-content-full">
                <div class="caption caption-left">
                    <div class="svg-logo logo-mrestorator" style>
                        <? includeSVG("logo.svg"); ?>
                    </div>

                    <div class="btn-go" style="margin:70px auto">
                        <a href="#intro-content"><span class="down-arrow floating-arrow fa fa-angle-down"></span></a>
                    </div>
                </div>
            </div>

            <div class="cd-bg-video-wrapper" data-video="/wp-content/themes/m-restorator/video/<? the_field('bg-video'); ?>">
            <video loop="" muted=""><source src="/wp-content/themes/m-restorator/video/trefol.mp4" type="video/mp4"><source src="/wp-content/themes/m-restorator/dist/video/trefol.webm" type="video/webm"></video></div>
    </li>
    </ul>
</section>


<?php while (have_posts()) : the_post(); ?>
<section class="section-light section-content section-padding">
<div class="container">
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
</div>

<?php endwhile; ?>
