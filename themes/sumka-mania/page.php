<? get_header(); ?>
    <div class="advantages-background">
		<? get_template_part( 'views/advantages' ) ?>
    </div>
    <div class="container">
        <div class="row align-items-start flex-column-reverse flex-md-row">
			<? get_sidebar() ?>
            <div class="col-lg-9 col-md-8 <?= ! get_page_template_slug() ? 'typography' : '' ?>">
                <div class="row d-block"><? wc_print_notices() ?></div>
				<?= apply_filters( 'the_content', wpautop( get_post_field( 'post_content', $id ), true ) ); ?>
            </div>
        </div>
    </div>
<? get_footer(); ?>