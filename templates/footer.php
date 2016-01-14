
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
                    <? echo do_shortcode('[contact-form-7 id="689" html_class="form-horizontal form-query"]');?>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="footer-links">
    				<?php // dynamic_sidebar('sidebar-footer'); ?>
                     <ul class="footer-group">
                        <li><a href="#top">Наверх</a></li>
                    </ul>
                    <p>© 2015 <a href="#">М-Ресторатор</a>
                </div>
            </div>
            <? socialButtons(); ?>
        </div>
    </div>
</footer>