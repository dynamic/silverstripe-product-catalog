<div class="col-md-12 crumbs">
	$Breadcrumbs
</div>
<div class="col-sm-12">
	<% if $HeaderImage %>
		<section class="add-bottom">
			<img src="$HeaderImage.FocusFill(1176,320).URL" class="scale-with-grid">
		</section>
	<% end_if %>
</div>
<div class="col-sm-10 col-sm-offset-1">
	<h2 class="title"><% if $SubTitle %>$SubTitle<% else %>$Title<% end_if %></h2>
	<% if $Content %>
		<div class="typography">
			$Content
		</div>
	<% end_if %>

	<hr />

	$CollectionSearchForm
  <div class="clearfix"></div>

	<% if $ProductList %>
		<div class="product-list row">
			<% loop $ProductList %>
				<% include ProductSummary %>
				<% if MultipleOf(5,1) %><div class="clearfix"></div><% end_if %>
			<% end_loop %>
		</div>
		<% with $ProductList %>
			<% include Pagination %>
		<% end_with %>
	<% else %>
		<p>Sorry, there are currently no products. Please refine your search or check back soon.</p>
	<% end_if %>

	$Form
</div>
<div class="col-sm-12">
		$BlockArea(AfterContent)
</div>