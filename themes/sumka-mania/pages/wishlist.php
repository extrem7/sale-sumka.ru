<? /* Template Name: Список желаний */
get_header(); ?>
    <div class="advantages-background">
		<? get_template_part( 'views/advantages' ) ?>
    </div>
    <div class="container">
		<?= do_shortcode( '[ti_wishlistsview]' ) ?>
    </div>
<? get_footer() ?>