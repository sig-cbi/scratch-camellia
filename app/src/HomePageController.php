<?php

namespace SilverStripe\Lessons;

use PageController;
use SilverStripe\Lessons\ArticlePage;



class HomePageController extends PageController
{

    public function LatestArticles($count = 3)
    {
        return ArticlePage::get()
            ->sort('Date', 'DESC')
            ->limit($count);
    }

    public function FeaturedProperties()
    {
        return Property::get()
            ->filter([
                'FeaturedOnHomepage' => true
            ])
            ->limit(6);
    }
}
