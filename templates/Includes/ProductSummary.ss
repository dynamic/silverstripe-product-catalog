<div class="product">
    <% if $Image %>
        <a href="$Link" title="Go to the $Title page">
            <img src="$Image.Fill(200,200).URL" class="scale-with-grid">
        </a>
    <% end_if %>
    <h4><a href="$Link" title="Go to the $Title page">$Title</a></h4>
    <% if $SKU %>
        <div class="sku">
            <p><strong>SKU:</strong><br />$SKU</p>
        </div>
    <% end_if %>
    <a href="$Link" class="btn" title="Go to the $Title page">Discover</a>
</div>