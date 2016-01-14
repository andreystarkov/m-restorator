<?php
/**
* Template Name: Новости
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
<section class="section-padding-bottom section-gray sign-up section-form shadow-top">
    <div class="container">
        <div class="row section-header">
            <div class="col-md-12">
                <div class="sign"><i  data-wow-duration="0.6s" data-wow-delay="0.2s" class="wow bounceInUp svg-box svg-ico icon-title"><? includeSVG("line/mail.svg"); ?></i></div>
                <h3>Помогите улучшить наш сервис</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12 leftcol description">
                <h5>Что вы хотели бы изменить?</h5>
                <p>У каждого из посетителей нашей сети есть свои любимые блюда и свои причины, по которым они ходят к нам, поэтому важно, чтобы в каждом из ресторанов и кафе сети, подаваемые блюда были одинакового, отличного качества.</p>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12 rightcol">
                <form class="form-horizontal form-query">
                    <div class="form-group">
                        <label for="inputName" class="col-lg-2 control-label"><span class="icon-user"></span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Как к вам обращаться?">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label"><span class="icon-envelope-letter"></span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Как связаться с вами?">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label"><span class="icon-speech"></span></label>
                        <div class="col-lg-10">
                            <textarea required placeholder="Ваше сообщение" class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Очистить</button>
                            <input type="submit" class="btn btn-primary" value="Отправить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>