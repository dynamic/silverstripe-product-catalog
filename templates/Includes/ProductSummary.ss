<div class="col-md-3 product">
    <% if $Image %>
        <a href="$Link" title="Go to the $Title page">
            <img src="$Image.Fill(576,576).URL" class="img-responsive">
        </a>
    <% end_if %>
    <h4><a href="$Link" title="Go to the $Title page">$Title</a></h4>
    <% if $SKU %>
        <div class="sku">
            <p><strong>SKU:</strong><br />$SKU</p>
        </div>
    <% end_if %>
    <a href="$Link" class="btn btn-primary" title="Go to the $Title page">Learn More</a>
</div>