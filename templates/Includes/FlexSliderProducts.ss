<% if $SlideShow %>
    <div class="flexslider detail">
        <ul class="slides" role="flexslider">
            <% loop $SlideShow %>
            <% if $Image %>
            <li role="slide">
                <img src="$Image.URL" alt="<% if $Headline %>$Headline<% end_if %>">
            </li>
            <% end_if %>
            <% end_loop %>
        </ul>
    </div>
<% end_if %>
