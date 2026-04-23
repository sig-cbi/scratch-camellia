<!-- BEGIN BLOG LISTING -->
<div class="grid-style1 clearfix">
    <% loop $Regions %>
        <div class="item col-md-12"><!-- Set width to 4 columns for grid view mode only -->
            <div class="image image-large">
                <a href="$Link">
                    <span class="btn btn-default"><i class="fa fa-file-o"></i> Read More</span>
                </a>
                $Photo.Fit(720,255)
            </div>
            <div class="info-blog">
                <h3>
                    <a href="$Link">$Title</a>
                </h3>
                <p>$Description</p>
            </div>
        </div>
    <% end_loop %>
</div>
<!-- END BLOG LISTING -->

<!-- BEGIN PAGINATION -->
<% if $Regions.MoreThanOnePage %>
    <div class="pagination">
        <% if $Regions.NotFirstPage %>
            <ul id="previous col-xs-6">
                <li><a href="$Regions.PrevLink"><i class="fa fa-chevron-left"></i></a></li>
            </ul>
        <% end_if %>
        <ul class="hidden-xs">
            <% loop $Regions.PaginationSummary %>
                <% if $Link %>
                    <li class="<% if $CurrentBool %>active<% end_if %>">
                        <a href="$Link">$PageNum</a>
                    </li>
                <% else %>
                    <li>...</li>
                <% end_if %>
            <% end_loop %>
        </ul>

        <% if $Regions.NotLastPage %>
            <ul id="next col-xs-6">
                <li><a href="$Regions.NextLink"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
        <% end_if %>
    </div>
<% end_if %>
<!-- END PAGINATION -->
