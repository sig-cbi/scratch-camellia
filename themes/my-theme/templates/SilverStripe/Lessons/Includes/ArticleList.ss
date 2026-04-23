<div id="blog-listing" class="list-style clearfix">
    <div class="row">

        <% if $SelectedRegion %>

            <h3>Region: $SelectedRegion.Title</h3>
        <% else_if $SelectedCategory %>
            <h3>Category: $SelectedCategory.Title</h3>
        <% else_if $StartDate %>
            <h3>Showing $StartDate.Date to $EndDate.Date</h3>

        <% end_if %>

        <% loop $PaginatedArticles %>
            <div class="item col-md-6"><!-- Set width to 4 columns for grid view mode only -->
                <div class="image">
                    <a href="$Link">
                        <span class="btn btn-default">Read More</span>
                    </a>
                    $Photo.Fit(242,156)
                </div>
                <div class="tag"><i class="fa fa-file-text"></i></div>
                <div class="info-blog">
                    <ul class="top-info">
                        <li><i class="fa fa-calendar"></i> $Date.Nice</li>
                        <li><i class="fa fa-comments-o"></i> $Comments.Count</li>
                        <li><i class="fa fa-tags"></i> $CategoriesList</li>
                    </ul>
                    <h3>
                        <a href="$Link">$Title</a>
                    </h3>
                    <% if $Teaser %>
                        <p>$Teaser</p>
                    <% else %>
                        <p>$Content.FirstSentence</p>
                    <% end_if %>
                </div>
            </div>
        <% end_loop %>
    </div>
</div>

<!-- BEGIN PAGINATION -->
<% if $PaginatedArticles.MoreThanOnePage %>
    <div class="pagination">
        <% if $PaginatedArticles.NotFirstPage %>
            <ul id="previous col-xs-6">
                <li><a href="$PaginatedArticles.PrevLink"><i class="fa fa-chevron-left"></i></a></li>
            </ul>
        <% end_if %>
        <ul class="hidden-xs">
            <% loop $PaginatedArticles.PaginationSummary %>
                <% if $Link %>
                    <li class="<% if $CurrentBool %>active<% end_if %>">
                        <a href="$Link">$PageNum</a>
                    </li>
                <% else %>
                    <li>...</li>
                <% end_if %>
            <% end_loop %>
        </ul>

        <% if $PaginatedArticles.NotLastPage %>
            <ul id="next col-xs-6">
                <li><a href="$PaginatedArticles.NextLink"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
        <% end_if %>
    </div>
<% end_if %>
<!-- END PAGINATION -->
