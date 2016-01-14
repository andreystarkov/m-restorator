<?php
/**
* Template Name: Портал (Главная)
*/
?>
<?
    $homePath = "/home/vkusno/data/www/m-restorator.ru";
    $themeUri = get_template_directory_uri();
    $restId = get_field('the-id');

    function getPicRand($name){
        echo getPath()."/assets/images/photos/".$name."/rooms/".rand(1,3)."-xlarge.jpg";
    }
    function theId(){
        echo get_field('the-id');
    }

    $img = $themeUri."/dist/images/photos/";

    function buildGallery($resName,$typeFolder){
        $all = implode(scandir(get_template_directory()."/images/photos/".$resName."/".$typeFolder,1));
        $count = substr_count($all, 'tiny');
        for($a=1;$a <= $count;$a++){
            ?><a href="<?=$themeUri?>/images/photos/<?=$resName?>/<?=$typeFolder?>/<?=$a?>-full.jpg" class="thumb col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <img src="<?=$themeUri?>/images/photos/<?=$resName?>/<?=$typeFolder?>/<?=$a?>-xsmall.jpg"></a>
            <?
        }
    }

?>

   <section class="cd-hero" id="top-slider">
        <ul class="cd-hero-slider">
            <?php
            $args = array( 'category_name' => $restId, 'post_type' => 'main_slider', 'posts_per_page' => 10 );
            $first = "yes";
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
                if($first == "yes"){
                    $slideClass = " first-slide selected"; $first = "no";
                }
                $theLink = get_field('rest-link');
                if(!empty($theLink)) $dataHref=$theLink;
                ?>
                <li class="cd-bg-video<?=$slideClass?> slide-<?the_field('the-id')?>">
                    <div class="overlay"></div>
                    <div class="slider-content slider-content-full">
                        <a class="rest-link caption caption-left" href="<?=$dataHref?>">
                            <div class="svg-logo logo-<? the_field('the-id'); ?>">
                            <? includeSVG(get_field('svg-logo')); ?>
                            </div>
                            <div class="description">
                                <p><? the_field('the-about'); ?></p>
                            </div>
                            <? if( get_field('the-id') != "mrestorator" ) { ?>
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
                            <div class="btn-go-rest">
                                <a href="<?php trim(the_field('rest-link')); ?>"><i>Меню / Интерьер</i><span class="pulse-go ln-icon-arrow-right"></span></a>
                            </div>
                            <? } else { ?>
                            <div class="about-icons">
                                <div class="about-item">
                                    <i class="ln-icon-call-in"></i><span> 45-55-56</span>
                                    <div class="subscribe">единая справочная</div>
                                </div>
                            </div>
                            <? } ?>
                        </a>
                    </div>

                <?
                $theVideo = get_field('background-video');
                if( !(empty($theVideo)) ) { ?>
                    <div class="cd-bg-video-wrapper" data-video="<?=$themeUri?>/video/<? the_field('background-video'); ?>">
                    </div>
                <? } else {
                    $imgClass = "except-me";
                }
                if(get_field('the_id') == 'mrestorator'){
                    $imgClass = "except-me";
                }
                $thePicture = get_field('background-image');
                if( !(empty($thePicture)) ) {
                    $thePicturePath = $themeUri."/images/photos/".$thePicture;
                    if( $q != 0 ) { ?>
                        <picture>
                          <source srcset="<?=$thePicturePath?>-small.jpg" media="(max-width: 767px)">
                          <source srcset="<?=$thePicturePath?>-medium.jpg" media="(min-width: 768px) and (max-width: 1024px)">
                          <source srcset="<?=$thePicturePath?>-laptop.jpg" media="(min-width: 1280px)">
                          <source srcset="<?=$thePicturePath?>-large.jpg" media="(min-width: 1400px)">
                          <source srcset="<?=$thePicturePath?>-xlarge.jpg" media="(min-width: 1600px)">
                          <source srcset="<?=$thePicturePath?>-full.jpg" media="(max-device-width: 1920px)">
                          <source srcset="<?=$thePicturePath?>-full.jpg" media="(min-width: 1920px)">
                          <img src="<?=$thePicturePath?>-large.jpg" alt="<? the_title(); ?>" class="background-image <?=$imgClass?>" id="slider-img-<? the_field('the-id'); ?>" style="display:none">
                        </picture>
                        <? } else { ?>
                          <img src="<?=$thePicturePath?>-xlarge.jpg" alt="<? the_title(); ?>" class="background-image" id="first-slide">
                        <? } ?>
                    </li>
                <?
                }

                if( $q != 0 ) {
                    $sliderNav .= "<li id='nav-".get_field('the-id')."'><a href='#0'><div class='svg-container' id='icon-"
                    .get_field('the-id')."'>".getSVG(get_field('svg-logo'))."</div></a></li>";
                } else {
                    $sliderNav .= "<li id='nav-".get_field('the-id')."'><a href='#0'><div class='svg-container' id='icon-"
                    .get_field('the-id')."'></div></a></li>";
                }

                $slideClass = "";
                $imgClass = "";
                $q++;
            endwhile;
            ?>
        </ul>
        <div class="cd-slider-nav">
            <nav>
                <span class="cd-marker item-1"></span>
                <ul class="sub-list">
                    <? echo $sliderNav; ?>
                </ul>
            </nav>
        </div>
    </section>
    <? wp_reset_postdata(); ?>
    <section class="intro section-padding section-gray" id="get-started">
        <div class="container">
            <div class="row">
                <div data-wow-duration="0.7s" data-wow-delay="0.4s" class="wow slideInLeft col-md-4 intro-feature">
                    <div class="intro-icon">
                        <span class="svg-box"><? includeSVG(get_field('feature-1-icon')); ?></span>
                    </div>
                    <div class="intro-content">
                        <h5><? the_field('feature-1-header'); ?></h5>
                        <p><? the_field('feature-1'); ?></p>
                    </div>
                </div>
                <div data-wow-duration="0.7s" data-wow-delay="0.4s" class="wow slideInLeft col-md-4 intro-feature">
                    <div class="intro-icon">
                        <span class="svg-box"><? includeSVG(get_field('feature-2-icon')); ?></span>
                    </div>
                    <div class="intro-content">
                        <h5><? the_field('feature-2-header'); ?></h5>
                        <p><? the_field('feature-2'); ?></p>
                    </div>
                </div>
                <div data-wow-duration="0.7s" data-wow-delay="0.4s" class="wow slideInLeft col-md-4 intro-feature">
                    <div class="intro-icon">
                        <span class="svg-box"><? includeSVG(get_field('feature-3-icon')); ?></span>
                    </div>
                    <div class="intro-content">
                        <h5><? the_field('feature-3-header'); ?></h5>
                        <p><? the_field('feature-3'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-background section-padding background-parallax">
        <div class="container">
            <div class="col-md-6 text-center">
                <h2><? the_field('banner-header'); ?></h2>
                <p><? the_field('banner-text'); ?></p>
            </div>
            <div class="col-md-6 text-center">
                <div class="logo-placeholder-big floating-logo logo-background">
                    <? the_field('banner-icon'); ?>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <img src="<? thePath(); ?>images/photos/<? the_field('banner-image'); ?>-xlarge.jpg" class="background-image img-parallax"
         data-parallax='{<? the_field("banner-image-parallax"); ?>}' />
    </section>

    <section id="news-feed" class="blog text-center section-padding section-light">
        <div class="container-fluid container-news" id="news-trigger">
            <div class="row section-header">
                <div class="col-md-12">
                    <div class="sign"><i data-wow-duration="0.6s" data-wow-delay="0.2s" class="wow bounceInUp svg-box svg-ico icon-title"><? includeSVG("line/news.svg"); ?></i></div>
                    <h3>Новости и события компании</h3>
                </div>
            </div>
            <div class="row">
                <? getNews(666); ?>
            </div>

            <div class="row func-buttons-group" style="display:none">
                <div class="col-md-4">
                <button class="btn btn-ghost btn-accent btn-small btn-more disabled"><span class="icon-clock"></span> Архив</button>
                </div>
                <div class="col-md-4 text-center">
                <button id="btn-more-news" class="btn btn-ghost btn-accent btn-small btn-more disabled"><span class="ln-icon-plus"></span> Загрузить ещё</button>
                </div>
                <div class="col-md-4">
                <button class="btn btn-ghost btn-accent btn-small btn-more disabled"><span class="icon-newspaper"></span> Журнал</button>
                </div>
            </div>
       </div>
    </section>

    <section class="section-background section-info-light section-padding section-info" id="instagram-header">
        <div class="container">
            <div class="col-md-6 text-center">
                <h2>Мы в социальных сетях</h2>
                <p>Будте в курсе новостей ресторана в режиме онлайн. Ниже наша инстаграмм-лента, самые свежие события из первых рук.</p>
                <? socialButtons(); ?>
            </div>
            <div class="col-md-6 text-center">
                <div class="logo-placeholder svg-drawing floating-logo logo-background">
                    <? includeSVG("line/camera.svg"); ?>
                 <div class="down-arrow floating-arrow"><a href="#recent"><span class="fa fa-angle-down"></span></a></div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>

    <section class="section-padding instagram-feed section-gray" id="instagram-recent" style="padding-bottom:120px">
        <div class="row" style="text-align:center">
          <div class="col-xs-12">
            <div id="recent" class="well well-sm"></div>
          </div>
        </div>
    </section>

<!--
   <section class="testimonial-slider section-padding text-center" id="slider-partners">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flexslider">
                        <ul class="slides">

                            <li>
                                <div class="avatar"><img src="/wp-content/themes/m-restorator/dist/images/partners/fro.jpg"></div>
                                <h2>Федерация Рестораторов и Отельеров (ФРиО)</h2>
                                <p class="author">Барменская Ассоциация Екатеринбурга (БАЕ) была организована в 2002г. БАЕ является официальным представителем Российской Ассоциации Барменов (БАР) и единственной в
                                городе организацией, объединяющей барменов и официантов, зарегистрированной на международном уровне.</p>
                            </li>
                            <? // endif; ?>
                          <li>
                                <div class="avatar"><img src="/wp-content/themes/m-restorator/dist/images/partners/dae.jpg"></div>
                                <h2>Барменская Ассоциация Екатеринбурга</h2>
                                <p class="author">Шеф-повар гастрономического кафе «Четверг» мог бы легко обыграть любую итальянку в познаниях рецептур</p>
                            </li>
                            <li>
                                <div class="avatar"><img src="/wp-content/themes/m-restorator/dist/images/partners/1.jpg"></div>
                                <h2>Центр коммуникативных технологий Дегтярева</h2>
                                <p class="author">«Центр коммуникативных технологий Дегтярева» основан в 2000 году. Основные тренинги и мастер-классы: Навыки эффективных бизнес-коммуникаций. Искусство убеждения. Технологии эффективных переговоров. Техника профессиональных продаж</p>
                            </li>
                            <li>
                                <div class="avatar"><img src="/wp-content/themes/m-restorator/dist/images/partners/metro.jpg"></div>
                                <h2>МЕТРО Кэш энд Керри</h2>
                                <p class="author">«Центр коммуникативных технологий Дегтярева» основан в 2000 году. Основные тренинги и мастер-классы: Навыки эффективных бизнес-коммуникаций. Искусство убеждения. Технологии эффективных переговоров. Техника профессиональных продаж</p>
                            </li>
                            <li>
                                <div class="avatar"><img src="/wp-content/themes/m-restorator/dist/images/partners/2.jpg"></div>
                                <h2>Группа компаний «Бирюзовый чай»</h2>
                                <p class="author">разработка концепций, решений и полное чайное обеспечение ресторанного бизнеса; организация чаепитий и дегустаций; создание гастрономических композиций на основе чая; создание коллекций чая и чайной посуды; обучение персонала.
                                Интернет-магазин: www.teaexpress.ru</p>
                            </li>
                            <li>
                                <div class="avatar"><img src="/wp-content/themes/m-restorator/dist/images/partners/1.jpg"></div>
                                <h2>«Центр коммуникативных технологий Дегтярева»</h2>
                                <p class="author">«Центр коммуникативных технологий Дегтярева» основан в 2000 году. Основные тренинги и мастер-классы: Навыки эффективных бизнес-коммуникаций. Искусство убеждения. Технологии эффективных переговоров. Техника профессиональных продаж</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
 -->