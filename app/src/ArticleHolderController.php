<?php

namespace SilverStripe\Lessons;

use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\ORM\FieldType\DBField;

class ArticleHolderController extends PageController
{
    private static $allowed_actions = [
        'category',
        'region',
        'date'
    ];

    protected $articleList;

    protected function init()
    {
        parent::init();

        $this->articleList = ArticlePage::get()->filter([
            'ParentID' => $this->ID
        ])->sort('Date DESC');
    }

    public function PaginatedArticles($num = 3)
    {
        return PaginatedList::create(
            $this->articleList,
            $this->getRequest()
        )->setPageLength($num)->setPaginationGetVar('s');
    }

    public function index(HTTPRequest $request)
    {
        $data = [];

        if ($request->isAjax() || $request->getVar('ajax') === '1') {
            return $this->customise($data)
                ->renderWith('SilverStripe/Lessons/Includes/ArticleList');
        }

        return $data;
    }

    public function category(HTTPRequest $r)
    {
        $category = ArticleCategory::get()->byID($r->param('ID'));

        if (!$category) {
            return $this->httpError(404, 'That category was not found');
        }

        $this->articleList = $this->articleList->filter([
            'Categories.ID' => $category->ID
        ]);

        $data = [
            'SelectedCategory' => $category
        ];

        if ($r->isAjax() || $r->getVar('ajax') === '1') {
            return $this->customise($data)
                ->renderWith('SilverStripe/Lessons/Includes/ArticleList');
        }

        return $data;
    }

    public function region(HTTPRequest $r)
    {
        $region = Region::get()->byID($r->param('ID'));

        if (!$region) {
            return $this->httpError(404, 'That region was not found');
        }

        $this->articleList = $this->articleList->filter([
            'RegionID' => $region->ID
        ]);

        $data = [
            'SelectedRegion' => $region
        ];

        if ($r->isAjax() || $r->getVar('ajax') === '1') {
            return $this->customise($data)
                ->renderWith('SilverStripe/Lessons/Includes/ArticleList');
        }

        return $data;
    }

    public function date(HTTPRequest $r)
    {
        $year = $r->param('ID');
        $month = $r->param('OtherID');

        if (!$year) return $this->httpError(404);

        $startDate = $month ? "{$year}-{$month}-01" : "{$year}-01-01";

        if (strtotime($startDate) === false) {
            return $this->httpError(404, 'Invalid date');
        }

        $adder = $month ? '+1 month' : '+1 year';
        $endDate = date('Y-m-d', strtotime(
            $adder,
                strtotime($startDate)
        ));

        $this->articleList = $this->articleList->filter([
            'Date:GreaterThanOrEqual' => $startDate,
            'Date:LessThan' => $endDate
        ]);

        return [
            'StartDate' => DBField::create_field('Datetime', $startDate),
            'EndDate' => DBField::create_field('Datetime', $endDate)
        ];

    }
}
