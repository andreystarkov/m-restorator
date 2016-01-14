<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-title" content="M-Restorator">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <? favIcons(); ?>
    <? wp_head();?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/wp-content/themes/m-restorator/fonts/robotodraft/robotodraft.css" />
    <style>

    /* ❤ sorry for this */

    .form-query * {
        transition: 0.6s ease all;
    }

    .success-query h5 {
            font-family: RobotoDraft;
            font-weight: 200;
            font-size: 1.8em;
            text-transform: none;
            margin-bottom: 1.3em;
    }
    .wrong-form {
        transition: display 0.1s ease 0s, transform 0.7s cubic-bezier(.43,1.11,1,.01) 0.1s, opacity 0.5s linear 0.2s, height 0.3s ease 0.1s;
        transform:scale(0);
        height:0;
        display:none;
        opacity:0;
    }

    .form-query div.wpcf7-response-output {
        visibility:hidden;
        height:0!important;
    }

    #top {
        overflow:hidden;
    }
    .rest-link {
        overflow:visible !important;
    }
    @media screen and (max-width:1024px){
        .cd-hero-slider li .caption .description {
            margin-top: 18px !important;
        }
    }
    @media screen and (max-width: 1920px) {
        .rest-link .svg-logo svg {
            max-height: 220px;
        }
        .svg-pelmeni {
            max-height: 300px;
        }
    }
    .btn-go-rest a i {
        color: #e8e2db;

    }
    .slide-mrestorator .about-icons .about-item {
        min-width:210px;
        font-size:1.6em;
    }
    </style>
</head>
