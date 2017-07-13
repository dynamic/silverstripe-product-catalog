<% if SlideShow %>
<div class="flexslider detail">
    <ul class="slides">
    	<% loop SlideShow %>
        <li class="remove-bottom">
        	<% if PageLink %><a href="$PageLink.Link" title="$PageLink.MenuTitle.XML"><% end_if %>
    				<% if Image %>
    					<img src="$Image.Fill(767,450).URL" alt="$Name">
            <% end_if %>
          <% if PageLink %></a><% end_if %>
        </li>
        <% end_loop %>
    </ul>
</div>
<% end_if %>
