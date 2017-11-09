<% with $Product %>
    <div class="product clearfix">
        <div class="col-sm-12 text-center product-header">
            <h1>$Title</h1>
            <% if $Content %>
                <div class="typography">$Content</div>
            <% end_if %>
        </div>

        <div class="clearfix fifty-bottom">
            <% if $SlideShow %>
                <div class="product-slider slideshow clearfix">
                    <% include FlexSliderProducts %>
                </div>
                <div class="clearfix"></div>
            <% end_if %>
            <div class="col-sm-7">
                <div class="clearfix thirty-bottom">
                    <h3>Product Features</h3>

                    <% if $SKU %>
                        <p class="remove-bottom"><strong>SKU:</strong> $SKU</p>
                    <% end_if %>
                    <% if $Dimensions %>
                        <p class="remove-bottom"><strong>Dimensions:</strong> $Dimensions</p>
                    <% end_if %>
                </div>

                $Form
                $PageComments
            </div>

            <div class="col-sm-5 sidebar productsidebar">
                <aside>
                    <% if $QuickFeatures %>
                        <div class="clearfix typography quick-features fifty-bottom">
                            <h3>Key Features</h3>
                            <div class="typography">
                                $QuickFeatures
                            </div>
                        </div>
                    <% end_if %>

                    <% if $Top.ProductInquiryForm %>
                        <div class="clearfix fifty-bottom">
                            <h3>Request Information</h3>
                            $Top.ProductInquiryForm
                        </div>
                    <% end_if %>


                    <% if $SpecSheets || $CareCleaningDocs || $OperationManuals || $Warranties %>
                        <div class="clearfix product-docs">
                            <h3>Product Information</h3>
                            <% if $SpecSheets %>
                                <% loop $SpecSheets %>
                                    <ul>
                                        <li class="$FirstLast">
                                            <a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
                                        </li>
                                    </ul>
                                <% end_loop %>
                            <% end_if %>
                            <% if $CareCleaningDocs %>
                                <% loop $CareCleaningDocs %>
                                    <ul>
                                        <li class="$FirstLast">
                                            <a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
                                        </li>
                                    </ul>
                                <% end_loop %>
                            <% end_if %>
                            <% if $OperationManuals %>
                                <% loop $OperationManuals %>
                                    <ul>
                                        <li class="$FirstLast">
                                            <a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
                                        </li>
                                    </ul>
                                <% end_loop %>
                            <% end_if %>
                            <% if $Warranties %>
                                <% loop $Warranties %>
                                    <ul>
                                        <li class="$FirstLast">
                                            <a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
                                        </li>
                                    </ul>
                                <% end_loop %>
                            <% end_if %>
                        </div>
                    <% end_if %>
                </aside>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>

<% end_with %>
