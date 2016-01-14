<?php
/**
* Template Name: Галлерея
*/
?>
<?
$themeUri = get_template_directory_uri();

function theGallery(){
    if ($handle = opendir(get_template_directory()."/images/photos/the-gallery/")) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $nums = explode('-',$entry);
                $num = $nums[0];

                if( $prev !== $num){
                   ?><a href="<?=get_template_directory_uri()?>/images/photos/the-gallery/<?=$num?>-full.jpg" class="thumb col-xs-6 col-sm-4 col-md-3 col-lg-3">
                    <img src="<?=get_template_directory_uri()?>/images/photos/the-gallery/<?=$num?>-xsmall.jpg"></a><?

                }
                $prev = $num;
                $nums = "";
                $num = "";
            }
        }

        closedir($handle);
    }

}
?>

<section class="single-page-header cd-hero gallery-top" id="page-slider">
    <ul class="cd-hero-slider">
        <li class="cd-bg-video autoplay first-slide selected">
            <div class="overlay"></div>
            <div class="slider-content slider-content-full">
                <div class="caption caption-left">
                    <div class="svg-logo logo-mrestorator">
                        <? includeSVG("logo.svg"); ?>
                    </div>

                    <div class="btn-go" style="margin:70px auto">
                        <a href="#intro-content"><span class="down-arrow floating-arrow fa fa-angle-down"></span></a>
                    </div>
                </div>
            </div>

            <div class="cd-bg-video-wrapper" data-video="/wp-content/themes/m-restorator/video/trefol">
            </div>
    </li>
    </ul>
</section>

<section id="the-best" class="blog section-menu text-center section-light">
    <div class="container container-menu target-box">
        <div class="row section-header">
            <div class="col-md-12">
                <div class="sign"><i class="svg-box svg-ico icon-title"><? includeSVG("line/camera.svg"); ?></i></div>
                <h3>Только лучшее</h3>
                <p>избранные фото</p>
            </div>
        </div>
    </div>

    <section class="section-pictures">
        <div class="row" id="gallery">
            <? theGallery(); ?>
        </div>
    </section>

</section>
