<?php

$the_includes = [
  'lib/assets.php',
  'lib/extras.php',
  'lib/setup.php',
  'lib/titles.php',
  'lib/post-types.php',
  'lib/wrapper.php'
];

function getNews(){
    $newsObj = get_category_by_slug('news');
    $newsId = $newsObj->term_id;

    if ( have_posts() ) : query_posts('cat=' . $newsId);
        while (have_posts()) : the_post(); ?>
        <div class="col-md-4">
            <article class="blog-post">
                <figure>
                    <a href="<? echo get_permalink(); ?>" class="single_image">
                        <div class="blog-img-wrap">
                            <div class="overlay">
                                <i class="fa fa-search"></i>
                            </div>
                            <img src="<? $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'Full Size' );
                            echo $large_image_url[0];?>" alt="<?php the_title(); ?>"/>
                        </div>
                    </a>
                    <figcaption>
                    <h2><div href="#" class="blog-category"><? the_title(); ?></a></h2>
                    <p><? the_excerpt(); ?></p>
                    </figcaption>
                </figure>
            </article>
        </div>

    <? endwhile; endif; wp_reset_query();
}
define(‘WPCF7_AUTOP’, false);
function callbackForm(){
?>

<section class="section-padding-bottom section-light sign-up section-form shadow-top">
    <div class="container">
        <div class="row section-header">
            <div class="col-md-12">
                <div class="sign"><i  data-wow-duration="0.6s" data-wow-delay="0.2s" class="wow bounceInUp svg-box svg-ico icon-title"><? includeSVG("line/mail.svg"); ?></i></div>
                <h3>Помогите улучшить наш сервис</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12 leftcol description">
                <h5>Оставьте отзыв</h5>
                <p>Расскажите о вашем вопросе, предложении или возникшей проблеме в форме справа. Оставте контактные данные и мы обязательно свяжемся с вами.</p>
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
<?
}

function favIcons(){
?>
    <link rel="icon" type="image/png" href="<?=getPath()?>images/icons/favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?=getPath()?>images/icons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=getPath()?>images/icons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=getPath()?>images/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=getPath()?>images/icons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=getPath()?>images/icons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=getPath()?>images/icons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=getPath()?>images/icons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=getPath()?>images/icons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=getPath()?>images/icons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?=getPath()?>images/icons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?=getPath()?>images/icons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?=getPath()?>images/icons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?=getPath()?>images/icons/android-chrome-192x192.png" sizes="192x192">
    <meta name="msapplication-square70x70logo" content="<?=getPath()?>smalltile.png" />
    <meta name="msapplication-square150x150logo" content="<?=getPath()?>mediumtile.png" />
    <meta name="msapplication-wide310x150logo" content="<?=getPath()?>widetile.png" />
    <meta name="msapplication-square310x310logo" content="<?=getPath()?>largetile.png" />
    <?
}

function getAboutIcons(){
  ?>
    <div class="about-icons">
      <div class="about-item">
          <i class="icon-clock"></i><span><? the_field('work-time'); ?></span>
          <div class="subscribe"><? the_field('work-days'); ?></div>
      </div>
      <div class="about-item">
          <i class="ln-icon-call-in"></i><span><? the_field('phone-number'); ?></span>
          <div class="subscribe">заказ столов</div>
      </div>
      <div class="about-item">
          <i class="ln-icon-pointer"></i><span><? the_field('where'); ?></span>
          <a class="subscribe" target="_blank" href="https://www.google.ru/maps/place/Оренбург ><? the_field('where'); ?>">посмотреть на карте</a>
      </div>
  </div>
  <?
}
function thePath(){
	echo "/wp-content/themes/m-restorator/";
}
function getPath(){
	return "/wp-content/themes/m-restorator/";
}
function distPath(){
	return "/wp-content/themes/m-restorator/dist/";
}
function includeSVG($svg){
    include get_template_directory()."/svg/".$svg;
}
function getSVG($svg){
  ob_start();
  include get_template_directory()."/svg/".$svg;
  $return = ob_get_contents();
  ob_end_clean();
  return $return;
}

function socialUri($service){
  if($service == "vk") echo "http://www.instagram.com/restoratorm/";
  if($service == "inst") echo "http://vk.com/restoratorm";
  if($service == "facebook") echo "http://ru-ru.facebook.com/mrestorator";
}

function socialButtons(){
?>
  <div class="social-share">
      <div class="text-center">
      <a href="http://www.facebook.com/mrestorator" class="social-button">
      <span class="fa fa-facebook tip" title="" data-original-title="Группа в фейсбуке"></span>
      </a>
      <a href="http://vk.com/restoratorm" class="social-button">
      <span class="fa fa-vk tip" title="" data-original-title="Сообщество вконтакте"></span>
      </a>
      <a href="http://www.instagram.com/restoratorm" class="social-button">
      <span class="fa fa-instagram tip" title="" data-original-title="Инстаграм"></span>
      </a></div>
  </div>
<?
}

function remove_head_scripts() {
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

foreach ($the_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
