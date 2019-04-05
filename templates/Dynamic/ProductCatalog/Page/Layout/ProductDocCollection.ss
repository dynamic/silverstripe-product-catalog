<div class="col-md-12">
    <article>
        <h1>$Title</h1>

        <% if $Content %>
            <div class="typography">$Content</div>
        <% end_if %>
    </article>
</div>

<div class="col-md-10 col-md-offset-1">
    <div class="clearfix">
        $CollectionSearchForm
    </div>

    <% if $PaginatedList %>
        <% loop $PaginatedList %>
            <div class="row download-row $FirstLast">
                <div class="col-md-2">
                    <% if $Download %><a href="$Download.Link" title="Download $Title.XML"><% end_if %>
                        <% if $Products.First.Image %>
                            <img src="$Products.First.Image.Fill(100,100).URL" class="img-responsive" alt="$Products.First.Title">
                        <% end_if %>
                    <% if $Download %></a><% end_if %>
                    </div>
                    <div class="col-md-6">
                        <% with $Products.First %>
                            <% if $Download %>
                                <h4><a href="$Download.Link" title="Download $Title.XML"><% if $PreviewTitle %>$PreviewTitle<% else %>$Title<% end_if %> - $SKU</a></h4>
                            <% end_if %>
                        <% end_with %>
                    </div>
                    <div class="col-md-4">
                        <div class="add-top file-collection-links">
                            <% if $Download %><a href="$Download.Link" class="pdf" target="_blank" title="Download $Title"><% end_if %>
                            $Title
                            <% if $Download %> ({$Download.Size})</a><% end_if %>
                        </div>
                    </div>
                </div>
            <% end_loop %>
            <% with $PaginatedList %>
                <% include Pagination %>
            <% end_with %>
        <% end_if %>
    </div>
    <div class="col-md-12">
        $BlockArea(AfterContent)
    </div>