<div class="advantages container">
	<div class="row align-items-center justify-content-around">
		<? while ( have_rows( 'преимущества', 'option' ) ):
			the_row(); ?>
			<div class="col-md-3 col-sm-4 col-6">
				<div class="advantage">
					<img <? repeater_image( 'иконка' ) ?>>
					<? the_sub_field( 'текст' ) ?>
				</div>
			</div>
		<? endwhile; ?>
		<? get_search_form() ?>
	</div>
</div>