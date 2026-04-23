<% include Banner %>

<!-- BEGIN CONTENT WRAPPER -->
<div class="content">
	<div class="container">
		<div class="row">

			<!-- BEGIN MAIN CONTENT -->
			<div class="main col-sm-8">
				<% include SilverStripe/Lessons/ArticleList %>
				<!-- END MAIN CONTENT -->
			</div>
			<!-- END MAIN CONTENT -->

			<!-- BEGIN SIDEBAR -->
			<div class="sidebar gray col-sm-4">

				<h2 class="section-title">Regions</h2>
				<ul class="categories">
					<% loop $Regions %>
						<li><a href="$ArticlesLink">$Title <span>($Articles.count)</span></a></li>
					<% end_loop %>
					<li><a href="$Top.Link">All <span>($Top.Children.Count)</span></a></li>
				</ul>

				<h2 class="section-title">Categories</h2>
				<ul class="tags col-sm-12">
					<% loop $Categories %>
						<li><a href="$Link">$Title <span>($Articles.count)</span></a></li>
					<% end_loop %>
					<li><a href="$Top.Link">All <span>($Top.Children.Count)</span></a></li>
				</ul>

				<!-- BEGIN ARCHIVES ACCORDION -->
				<h2 class="section-title">Archives</h2>
				<div id="accordion" class="panel-group blog-accordion">
					<% loop $ArchiveDates %>
						<div class="panel">

							<div class="panel-heading">
								<div class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse$Pos" class="">
										<i class="fa fa-chevron-right"></i> $Year ($ArticleCount)
									</a>
								</div>
							</div>
							<div id="collapse$Pos" class="panel-collapse collapse in">
								<div class="panel-body">
									<ul>
										<% loop $Months %>
										<li><a href="$Link">$MonthName ($ArticleCount) </a></li>
										<% end_loop %>
									</ul>
								</div>
							</div>

						</div>
					<% end_loop %>

				</div>
				<!-- END  ARCHIVES ACCORDION -->

				<!-- BEGIN LATEST NEWS -->
				<h2 class="section-title">Latest News</h2>
				<ul class="latest-news">
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>

						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 30, 2014</li>
						</ul>

						<h3><a href="blog-detail.html">How to get your dream property for the best price?</a></h3>
					</li>
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>

						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 24, 2014</li>
						</ul>

						<h3><a href="blog-detail.html">7 tips to get the best mortgage.</a></h3>
					</li>
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>

						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 05, 2014</li>
						</ul>

						<h3><a href="blog-detail.html">House, location or price: What's the most important factor?</a></h3>
					</li>
				</ul>
				<!-- END LATEST NEWS -->

			</div>
			<!-- END SIDEBAR -->

		</div>
	</div>
</div>
