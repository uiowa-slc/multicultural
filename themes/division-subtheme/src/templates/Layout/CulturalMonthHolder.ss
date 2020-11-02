$Header
<main class="main-content__container" id="main-content__container">

	<!-- Background Image Feature -->
	<% if $BackgroundImage %>
		<% include FeaturedImage %>
	<% end_if %>


	<% if not $BackgroundImage %>
    <div class="column row">
        <div class="main-content__header">
            $Breadcrumbs
            <h1>$Title</h1>
        </div>
    </div>
	<% end_if %>

	$BeforeContent
	<div class="row">
		<article role="main" class="main-content main-content--with-padding <% if $SiteConfig.ShowExitButton %>main-content--with-exit-button-padding<% end_if %> <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">
			$BeforeContentConstrained
			<div class="main-content__text">
				$Content
			</div>
			$AfterContentConstrained
			$Form
		</article>
	</div>
	<div class="month-grid expanded row small-up-1 medium-up-2 large-up-3 ">
		<% loop $SortedChildren %>
			<a class="column month-grid__link" href="$Link">
				<img class="month-grid__img" src="{$BackgroundImage.Pad(1280,720).URL}" alt="" role="presentation" />
				<div class="month-grid__content">
					<h2 class="month-grid__header">$Title</h2>
                    <% if $MetaDescription %>
                        <p class="month-grid__summary">$MetaDescription.LimitCharacters(150)</p>
                    <% else %>
                        <p class="month-grid__summary">$Content.LimitCharacters(150)</p>
                    <% end_if %>

                    <span target="_blank" class="button warning">View $Title events<svg class="svg-inline--fa fa-arrow-right fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg><!-- <i class="fas fa-arrow-right"></i> --></span>
				</div>
			</a>
		<% end_loop %>
	</div>

	$AfterContent

</main>
