<aside class="sidebar col-lg-3 col-md-4">
    <p class="sidebar-title">Категории</p>

    <ul class="categories">
		<? wp_list_categories( [
			'taxonomy' => 'product_cat',
			'title_li' => '',
			'walker'   => new Walker_Catalog()
		] ) ?>
    </ul>
</aside>