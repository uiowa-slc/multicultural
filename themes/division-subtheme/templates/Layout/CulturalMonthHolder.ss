$Header
<main class="main-content__container" id="main-content__container">

	<!-- Background Image Feature -->
	<% if $BackgroundImage %>
		<% include FeaturedImage %>
	<% end_if %>
	$Breadcrumbs
	
<% if not $BackgroundImage %>
	<div class="column row">
		<div class="main-content__header">
			<h1>$Title</h1>
		</div>
	</div>
<% end_if %>

$BlockArea(BeforeContent)

<div class="row">

	<article role="main" class="main-content main-content--with-padding <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">
		$BlockArea(BeforeContentConstrained)
		<div class="main-content__text">
			$Content
		</div>
		$BlockArea(AfterContentConstrained)
		$Form
		<% if $ShowChildPages %>
			<% if $Children %>
				<section class="childpages" aria-labelledby="ChildPages">
				<h2 class="show-for-sr" id="ChildPages">Related Navigation</h2>
				<% loop $Children %>
					<div class="childpages__page <% if $BackgroundImage || $YoutubeBackgroundEmbed %>childpages--withphoto<% end_if %>">
						<a href="$Link" class="childpages__blocklink">
							<% if $BackgroundImage %>
								<img data-original="$BackgroundImage.CroppedFocusedImage(180,150).URL" width="180" height="150" class="childpages__img dp-lazy" alt="$Title">
							<% else_if $YoutubeBackgroundEmbed %>
								<img src="http://img.youtube.com/vi/$YoutubeBackgroundEmbed/sddefault.jpg" class="childpages__img" alt="$Title">
							<% end_if %>
							<div class="clearfix childpages__content">
								<h3 class="childpages__title">$Title</h3>
								<% if $MetaDescription %>
									<p class="childpages__summary">$MetaDescription.LimitCharacters(200)</p>
								<% else %>
									<p class="childpages__summary">$Content.FirstSentence.LimitCharacters(200)</p>
								<% end_if %>
								<span class="childpages__link">Learn More</span>
							</div>
						</a>
					</div>
				<% end_loop %>
				</section>
			<% end_if %>
		<% end_if %>
	</article>
	<aside class="sidebar dp-sticky">
		<% include SideNav %>
		<% if $SideBarView %>
			$SideBarView
		<% end_if %>
		$BlockArea(Sidebar)
	</aside>
</div>
$BlockArea(AfterContent)

</main>
