<?php
/**
* Template Name: Ресторан
*/
?>
<?
$restId = get_field('the-id');
$gallery = get_field('rest-gallery');
$intBg = get_field('int-background-image');
$themeUri = get_template_directory_uri();

function getPicRand($name){
    echo getPath()."/images/photos/".$name."/rooms/".rand(1,3)."-full.jpg";
}

function theId(){
    echo get_field('the-id');
}

function buildGallery($resName,$typeFolder){
    $all = implode(scandir(get_template_directory()."/images/photos/".$resName."/".$typeFolder,1));
    $count = substr_count($all, 'tiny');
    for($a=1;$a <= $count;$a++){
        ?><a href="<?=get_template_directory_uri()?>/images/photos/<?=$resName?>/<?=$typeFolder?>/<?=$a?>-full.jpg" class="thumb col-xs-6 col-sm-4 col-md-3 col-lg-3">
        <img src="<?=get_template_directory_uri()?>/images/photos/<?=$resName?>/<?=$typeFolder?>/<?=$a?>-xsmall.jpg"></a>
        <?
    }
}

function galleryBuild($resName, $items){
    $galleryItems = explode(" ", $items);
    foreach ($galleryItems as &$value) {
        ?><a href="<?=get_template_directory_uri()?>/images/photos/<?=$resName?>/<?=$value?>-full.jpg" class="thumb col-xs-6 col-sm-4 col-md-3 col-lg-3">
        <img src="<?=get_template_directory_uri()?>/images/photos/<?=$resName?>/<?=$value?>-xsmall.jpg"></a><?
    }
}

?>
<section class="cd-hero rest-header" id="page-slider">
    <ul class="cd-hero-slider">
        <li class="cd-bg-video autoplay first-slide selected">
            <div class="overlay"></div>
            <div class="slider-content slider-content-full">
                <div class="caption caption-left">
                    <div class="svg-logo logo-<?theId();?>">
                        <? includeSVG(get_field('the-id').".svg"); ?>
                    </div>
                            <div class="about-icons">
                                <div class="about-item">
                                    <i class="icon-clock"></i><span><? the_field('work-time'); ?></span>
                                    <div class="subscribe"><? the_field('work-days'); ?></div>
                                </div>
                                <div class="about-item">
                                    <i class="ln-icon-call-in"></i><span><? the_field('phone-number'); ?></span>
                                    <div class="subscribe">заказ столов</div>
                                </div>
                                <div class="about-item about-item-where">
                                    <i class="ln-icon-pointer"></i><span><? the_field('where'); ?></span>
                                    <a class="subscribe" target="_blank" href="https://www.google.ru/maps/place/Оренбург ><? the_field('where'); ?>">посмотреть на карте</a>
                                </div>
                            </div>
                    <div class="btn-go" style="margin:70px auto">
                        <a href="#section-content"><span class="down-arrow floating-arrow fa fa-angle-down"></span></a>
                    </div>
                </div>
            </div>

            <div class="overlay"></div>
            <?
            $theVideo = get_field('background-video');
            if( !(empty($theVideo)) ) { ?>
                <div class="cd-bg-video-wrapper" data-video="<?=$themeUri?>/video/<? the_field('background-video'); ?>">
                </div>
            <? }

            $thePicture = get_field('background-image');
            if( !(empty($thePicture)) ) {
                $thePicturePath = $themeUri."/images/photos/".$restId."/".$thePicture; ?>
                    <picture>
                      <source srcset="<?=$thePicturePath?>-small.jpg" media="(max-width: 767px)">
                      <source srcset="<?=$thePicturePath?>-medium.jpg" media="(min-width: 768px) and (max-width: 1024px)">
                      <source srcset="<?=$thePicturePath?>-laptop.jpg" media="(min-width: 1280px)">
                      <source srcset="<?=$thePicturePath?>-large.jpg" media="(min-width: 1400px)">
                      <source srcset="<?=$thePicturePath?>-xlarge.jpg" media="(min-width: 1600px)">
                      <source srcset="<?=$thePicturePath?>-full.jpg" media="(max-device-width: 1920px)">
                      <source srcset="<?=$thePicturePath?>-full.jpg" media="(min-width: 1920px)">
                      <img src="<?=$thePicturePath?>-large.jpg" alt="<? the_title(); ?>" class="background-image">
                    </picture>
            <?
            }
            ?>
            </div>
        </li>
    </ul>
</section>

<section class="section-padding page-intro section-gray section-content" style="padding: 100px 0" id="section-content">
    <div class="container">
        <h2><? the_title(); ?></h2>
        <p><? the_field('the-about'); ?></p>
    </div>
</section>

<? if ( !empty($gallery) ){ ?>

    <section class="section-background section-padding background-parallax" id="menu-list-header">
        <div class="container">
            <div class="col-md-6 text-center">
                <h2><? the_field('int-title'); ?></h2>
                <p><? the_field('int-description'); ?>
                </div>
                <div class="col-md-6 text-center">
                    <div class="logo-placeholder svg-drawing floating-logo logo-background">
                        <? includeSVG("line/camera.svg"); ?>
                        <div class="down-arrow floating-arrow"><a href="#recent"><span class="fa fa-angle-down"></span></a></div>
                    </div>
                </div>
            </div>
        <? if ( !empty($intBg) ) { ?>
        <div class="overlay"></div>
        <img src="<? thePath(); ?>images/photos/<?=$restId?>/<?=$intBg?>-xlarge.jpg" class="background-image img-parallax"
        data-parallax='{ "y" : -200, "smoothness":40 }' data-parallax2='{ "scale": 1.1, from-scroll": 150, "x":150 }'  />
        <? } ?>
    </section>

    <section class="section-pictures">
        <div class="row" id="gallery">
            <? galleryBuild($restId, $gallery); ?>
        </div>
    </section>

<? } // gallery end ?>

<? // menu section start
    $args = array( 'category_name' => $restId, 'post_type' => 'menu_db', 'posts_per_page' => 999 );
    $loop = new WP_Query( $args );
    $i = 0;
    if( !empty($loop) ) {
?>
<section id="menu-list" class="blog section-menu text-center section-light">
    <div class="container container-menu target-box">
        <div class="row section-header">
            <div class="col-md-12">
                <div class="sign"><i class="svg-box svg-ico icon-title"><? includeSVG("line/menu.svg"); ?></i></div>
                <h3><? the_field('menu-title'); ?></h3>
                <p><? the_field('menu-description'); ?></p>
            </div>
        </div>
        <?php
        while ( $loop->have_posts() ) : $loop->the_post();

        if ( $i == 3 ) { $i = 0; echo "</div>"; }
        if ( $i == 0 ) echo "<div class='row'>";

        $menuImage = get_field('menu-image');
        $menuPrice = get_field('menu-price');
        $menuWeight = get_field('menu-weight');

        if ( !empty( $menuImage ) ){
            $menuClass = "with-image";
        } else $menuClass = "without-image";

        ?>
        <div class="col-md-4 col-sm-6">
            <article class="menu-post">
                <figure>
                    <figcaption>
                    <div class="menu-link <?=$menuClass?>">
                        <div class="img-wrap">
                            <img src="<?=$menuImage?>" />
                        </div>
                        <div class="caption">
                            <? if( !empty($menuPrice) ) { ?>
                            <span class="price"><?=$menuPrice?> р.</span>
                            <? } ?>
                            <? if( !empty($menuWeight) ) { ?>
                            <span class="weight"><?=$menuWeight?> г.</span>
                            <? } ?>
                            <b class="name"><? the_title(); ?></b>
                            <?
                                if( trim(get_field('menu-description')) != "" ){
                            ?>
                            <i class="about"><? the_field('menu-description'); ?></i>
                            <? } ?>
                        </div>
                    </div>
                    </figcaption>
                </figure>
            </article>
        </div>
        <?
        $i++;
        endwhile;
        ?>
    </div>
<!--
    <div class="container-footer container text-center">
        <button id="btn-more-menu" class="btn btn-ghost btn-accent btn-small btn-more"><span class="ln-icon-refresh"></span> Загрузить ещё</button>
    </div> -->
</section>

<?  } wp_reset_query(); // menu section end ?>

<section class="section-background section-padding section-about background-parallax" id="box-about">
    <div class="container">
        <div class="col-md-6 text-center">
            <h2>Как нас найти?</h2>
            <div class="about-icons">
                <div class="about-item">
                    <i class="icon-clock"></i><span><? the_field('work-time'); ?></span>
                    <div class="subscribe"><? the_field('work-days'); ?></div>
                </div>
                <div class="about-item">
                    <i class="ln-icon-call-in"></i><span><? the_field('phone-number'); ?></span>
                    <div class="subscribe">заказ столов</div>
                </div>
                <div class="about-item about-item-where">
                    <i class="ln-icon-pointer"></i><span><? the_field('where'); ?></span>
                    <a class="subscribe" target="_blank" href="https://www.google.ru/maps/place/Оренбург ><? the_field('where'); ?>">посмотреть на карте</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="logo-placeholder-big floating-logo logo-background">
                <svg id="icon-fishwine" class="icon-fish" viewBox="0 0 400 400">
                    <use xlink:href="#svg-fishwine" />
                </svg>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <img src="<? thePath(); ?>/images/photos/<?=$restId?>/outside/1-full.jpg" class="background-image img-parallax" data-parallax='{ "y" : -300,  "smoothness": 30 }' />
 </section>

<!-- <section class="section-padding section-map background-map">
    <div class="about-map">
        <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=zEbUx5lnALmDbwCGjJv9n68_L6q3c9X3&width=100%&height=100%&lang=ru_RU&sourceType=constructor"></script>
    </div>
</section>
 -->
