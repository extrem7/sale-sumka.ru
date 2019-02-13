<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= wp_get_document_title() ?></title>
	<? wp_head() ?>
</head>
<body <? body_class() ?>>
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="row flex-column flex-md-row align-items-center justify-content-between">
                <a href="<? bloginfo('url') ?>"
                   class="logo d-flex align-items-center mb-2 mb-sm-0"><img <? the_image( 'лого', 'option' ) ?>>
                    <p><? the_field( 'лого_текст', 'option' ) ?></p></a>
                <div class="right d-flex justify-content-around align-items-center">
                    <div class="social d-flex mb-2 mb-sm-0">
						<? while ( have_rows( 'соц_сети', 'option' ) ):the_row() ?>
                            <a href="<? the_sub_field( 'ссылка' ) ?>" target="_blank"><i
                                        class="fab fa-<? the_sub_field( 'класс' ) ?>"></i></a>
						<? endwhile; ?>
                    </div>
	                <? woocommerce_mini_cart() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row flex-column flex-md-row align-items-center justify-content-between flex-md-nowrap">
                <nav class="navbar navbar-expand-sm">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
					<?php
					wp_nav_menu( [
						'menu'            => 'Хедер',
						'theme_location'  => 'header',
						'container'       => 'div',
						'container_id'    => 'bs4navbar',
						'container_class' => 'collapse navbar-collapse',
						'menu_id'         => false,
						'menu_class'      => 'navbar-nav align-items-center flex-column flex-sm-row',
						'depth'           => 2,
						'fallback_cb'     => 'bs4navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker()
					] );
					?>
                </nav>
                <div class="phones">
					<? while ( have_rows( 'телефоны', 'option' ) ):
						the_row();
						$phone = get_sub_field( 'телефон' );
						?>
                        <a href="<?= phoneLink( $phone ) ?>"><?= $phone ?></a>
					<? endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</header>