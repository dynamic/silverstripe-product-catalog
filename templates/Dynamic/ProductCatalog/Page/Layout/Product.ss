<% require css('resources/dynamic/flexslider/thirdparty/flexslider/flexslider.css') %>
<% require css('resources/dynamic/flexslider/css/silverstripe-flexslider.css') %>
<div class="col-md-12 crumbs">
	$Breadcrumbs
</div>
<% with $Product %>
<div class="col-sm-12" style="margin-bottom: 10px;">
	<h1><% if $SubTitle %>$SubTitle<% else %>$Title<% end_if %></h1>
</div>
<div class="clearfix fifty-bottom">
	<div class="col-sm-8">
		<% if SlideShow %>
			<div class="product-slider slideshow clearfix">
				<% include FlexSliderProducts %>
			</div>
		<% end_if %>

		<div class="clearfix thirty-bottom">
			<% if $Content %>
				<h3>About this product</h3>
				<div class="typography">
					$Content
				</div>
			<% end_if %>
		</div>
		<div class="clearfix product-feature-holder fifty-bottom">
			<% if $Features %>
				<% loop $Features.Sort('SortOrder') %>
					<div class="row typography product-feature<% if $Pos > 2 %> hiddenfeature<% end_if %>">
						<% if $Image %>
							<div class="col-sm-6<% if $Even %> col-sm-push-6<% end_if %>">
									<img src="$Image.URL" alt="$Title" class="scale-with-grid">
							</div>
						<% end_if %>
						<% if $Image %>
							<div class="col-sm-6<% if $Even %> col-sm-pull-6<% end_if %>">
						<% else %>
							<div class="col-sm-12">
						<% end_if %>
							<% if $Title %><h3>$Title</h3><% end_if %>
							<% if $Content %>$Content<% end_if %>
						</div>
					</div>
				<% end_loop %>
			<% end_if %>
			<% if $Features.Count > 2 %><div class="see-more-features-holder"><a href="#" class="see-more-features"><span>See More Features</span></a></div><% end_if %>
		</div>

		<div class="clearfix">
			<% if $VideoList %>
				<h2>Videos</h2>
				<div class="row detailpage-videos">
					<div class="currentvideo">
						<% loop $VideoList.Sort('SortOrder') %>
							<div class="clearfix<% if not $First %> hide-video<% end_if %> video-holder" data-src="$Pos">
								<div class="col-sm-7">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe width="560" height="315" src="https://www.youtube.com/embed/{$VideoID}" frameborder="0" allowfullscreen></iframe>
									</div>
								</div>
								<div class="col-sm-5">
									<% if $Title %><h4>$Title</h4><% end_if %>
									<% if $Content %><div class="typography">$Content</div><% end_if %>
								</div>
							</div>
						<% end_loop %>
					</div>
					<div class="othervideos">
						<% loop $VideoList.Sort('SortOrder') %>
							<div class="col-sm-3<% if $First %> hide-video<% end_if %>">
								<a href="#" class="video-trigger" data-src="$Pos"><img src="$Image.Fill(420,234).URL" class="scale-with-grid" alt="Watch the<% if $Title %> $Title<% end_if %> video"></a>
								<% if $Title %><h5 class="half-top"><a href="#" class="video-trigger" data-src="$Pos">$Title</a></h5><% end_if %>
							</div>
						<% end_loop %>
					</div>
				</div>
			<% end_if %>
		</div>

		$Form
		$PageComments
	</div>

	<div class="col-sm-4">
		<aside>
			<div class="clearfix typography quick-features fifty-bottom">
				<% if $QuickFeatures %>
					<h3>Quick Features</h3>
					<div class="typography">
						$QuickFeatures
					</div>
				<% end_if %>
			</div>

			<% if $Top.ContactForm %>
				<div class="clearfix fifty-bottom">
					<h3>Request Information</h3>
					$Top.ContactForm
				</div>
			<% end_if %>

			<div class="clearfix text-uppercase fifty-bottom product-detail-link-loop">
				<% if $SpecSheets %>
                    <h3>Spec Sheets</h3>
					<% loop $SpecSheets %>
						<ul>
							<li class="$FirstLast">
								<a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title - spec sheet</a>
							</li>
						</ul>
					<% end_loop %>
				<% end_if %>
				<% if $CareCleaningDocs %>
                    <h3>Care &amp Cleaning</h3>
					<% loop $CareCleaningDocs %>
						<ul>
							<li class="$FirstLast">
								<a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
							</li>
						</ul>
					<% end_loop %>
				<% end_if %>
				<% if $OperationManuals %>
                    <h3>Operation Manuals</h3>
					<% loop $OperationManuals %>
						<ul>
							<li class="$FirstLast">
								<a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
							</li>
						</ul>
					<% end_loop %>
				<% end_if %>
				<% if $Warranties %>
                    <h3>Warranties</h3>
					<% loop $Warranties %>
						<ul>
							<li class="$FirstLast">
								<a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title</a>
							</li>
						</ul>
					<% end_loop %>
				<% end_if %>
			</div>

		</aside>
	</div>
</div>
<% end_with %>
<% require javascript('resources/silverstripe/admin/thirdparty/jquery/jquery.min.js') %>
<% require javascript('resources/dynamic/flexslider/thirdparty/flexslider/jquery.flexslider-min.js') %>