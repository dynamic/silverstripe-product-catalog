<div class="col-sm-12 crumbs">
    $Breadcrumbs
</div>
<div class="col-sm-12">
    <% if $Slides %>
		<section class="add-bottom">
			<div class="slideshow clearfix">
				<% include FlexSlider %>
			</div>
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
</div>
<div class="col-sm-10 col-sm-offset-1">

    <hr />
    <div class="clearfix">
        $CollectionSearchForm
    </div>

    <% if $PaginatedList %>
        <% loop $PaginatedList %>
            <div class="row download-row $FirstLast">
                <div class="col-sm-2">
                    <% if $Download %><a href="$Download.Link" title="Download $Title.XML"><% end_if %>
                        <% if $Products.First.Image %>
                            <img src="$Products.First.Image.Fill(100,100).URL" class="scale-with-grid" alt="$Products.First.Title">
                        <% end_if %>
                    <% if $Download %></a><% end_if %>
                    </div>
                    <div class="col-sm-6">
                        <% with $Products.First %>
                            <% if $Download %>
                                <h4 class="nocaps"><a href="$Download.Link" title="Download $Title.XML"><% if $PreviewTitle %>$PreviewTitle<% else %>$Title<% end_if %> - $SKU</a></h4>
                            <% end_if %>
                        <% end_with %>
                    </div>
                    <div class="col-sm-4">
                        <div class="add-top file-collection-links">
                            <div class="thirty-bottom">
                                <% if $Download %><a href="$Download.Link" class="pdf" target="_blank" title="Download $Title"><% end_if %>
                                $Title
                                <% if $Download %> ({$Download.Size})</a><% end_if %>
                            </div>
                        </div>
                    </div>
                </div>
            <% end_loop %>
            <% with $PaginatedList %>
                <% include Pagination %>
            <% end_with %>
        <% end_if %>
    </div>
    <div class="col-sm-12">
        $BlockArea(AfterContent)
    </div>