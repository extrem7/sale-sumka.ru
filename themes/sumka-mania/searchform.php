<div class="search-form col-md-3" method="post" action="<?= home_url( '/' ); ?>">
   <!-- <input type="search" name="s" placeholder="поиск по категориям">
    <button type="submit"><i class="fa fa-search"></i></button>
    <input type="hidden" name="post_type" value="product">-->
	<?php if (function_exists('aws_get_search_form')) {
		aws_get_search_form();
	}?>
</div>