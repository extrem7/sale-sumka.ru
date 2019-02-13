<div class="d-none"><? dynamic_sidebar('right-sidebar') ?></div>
<footer class="footer">
    <div class="delivery">
        <div class="container">
            <p><i class="fa fa-info"></i> <? the_field( 'доставка', 'option' ) ?>
            </p>
            <div class="scroll-up"><i class="fal fa-chevron-up"></i></div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex flex-wrap justify-content-around">
            <div class="footer-block info-block">
                <p class="title">Контактная информация</p>
                <p class="title">Адрес:</p>
                <p><? the_field( 'адрес', 'option' ) ?></p><br>
                <p class="title">Телефон службы поддержки:</p>
                <p><?
					$i = 0;
					while ( have_rows( 'телефоны', 'option' ) ):
						the_row();
						$phone = get_sub_field( 'телефон' );
						if ( $i > 0 ) {
							echo ',';
						}
						?>
                        <a href="<?= phoneLink( $phone ) ?>"><?= $phone ?></a>
						<? $i ++; endwhile; ?></p>
                <div class="social d-flex">
					<? while ( have_rows( 'соц_сети', 'option' ) ):the_row() ?>
                        <a href="<? the_sub_field( 'ссылка' ) ?>" target="_blank"><i
                                    class="fab fa-<? the_sub_field( 'класс' ) ?>"></i></a>
					<? endwhile; ?>
                </div>
            </div>
            <div class="footer-block">
                <p class="title">Бренды</p>
				<? wp_nav_menu( [
					'menu'       => 'Бренды',
					'container'  => null,
					'items_wrap' => '<ul>%3$s</ul>',
				] ); ?>
            </div>
            <div class="footer-block">
                <p class="title">Категории</p>
				<? wp_nav_menu( [
					'menu'       => 'Категории',
					'container'  => null,
					'items_wrap' => '<ul class="categories">%3$s</ul>',
				] ); ?>
            </div>
            <div class="footer-block">
                <p class="title">Оплата</p>
				<? wp_nav_menu( [
					'menu'       => 'Оплата',
					'container'  => null,
					'items_wrap' => '<ul class="payment">%3$s</ul>',
				] ); ?>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container d-flex flex-column flex-sm-row align-items-center">
            <p class="name"><? the_field( 'копирайт', 'option' ) ?></p>
			<?
			global $wpdb;
			$date  = date( "Y-m-d" );
			$day   = $wpdb->get_var( "SELECT COUNT(`views`) FROM `" . XT_VC_TABLE_NAME . "` WHERE `date` = '$date'" );
			$total = $wpdb->get_var( "SELECT COUNT(`views`) FROM `" . XT_VC_TABLE_NAME . "`" );
			?>
            <p class="views">Посещения сегодня <b><?= $day ?></b><br class="d-sm-none"> Всего посетителей
                <b><?= $total ?></b></p>
        </div>
    </div>
</footer>
<? wp_footer() ?>
</body>
</html>