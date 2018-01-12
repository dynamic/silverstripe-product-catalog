<% if MoreThanOnePage %>
    <nav aria-label="$Title pagination">
        <ul class="pagination justify-content-center">
            <% if NotFirstPage %>
                <li class="page-item"><a href="$PrevLink" class="page-link" aria-label="Previous" title="Go to the previous page"><span aria-hidden="true">&laquo;</span></a></li>
            <% end_if %>

            <% loop PaginationSummary(4) %>
                <% if CurrentBool %>
                    <li class="page-item active"><span class="page-link">$PageNum <span class="sr-only">(current)</span></span></li>
                <% else %>
                    <% if Link %>
                        <li class="page-item"><a href="$Link" class="page-link" title="Go to page $PageNum">$PageNum</a></li>
                    <% else %>
                        <em>...</em>
                    <% end_if %>
                <% end_if %>
            <% end_loop %>
            <% if NotLastPage %>
                <li class="page-item"><a href="$NextLink" class="page-link" aria-label="Next" title="Go to the next page"><span aria-hidden="true">&raquo;</span></a></li>
            <% end_if %>
        </ul>
    </nav>
<% end_if %>
