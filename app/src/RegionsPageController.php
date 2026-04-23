<?php

namespace SilverStripe\Lessons;

use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Lessons\Region;
use SilverStripe\ORM\PaginatedList;

class RegionsPageController extends PageController
{

    private static $allowed_actions = [
        'show'
    ];

    public function show(HTTPRequest $request)
    {
        $region = Region::get()->byID($request->param('ID'));

        if (!$region) {
            return $this->httpError(404);
        }

        return [
            'Region' => $region,
            'Title' => $region->Title
        ];
    }

    public function index(HTTPRequest $request)
    {
        $regions = Region::get();

        $paginatedRegions = PaginatedList::create($regions, $request)
            ->setPageLength(2)
            ->setPaginationGetVar('s');

        $data = [
            'Regions' => $paginatedRegions,
        ];

        $isAjaxRequest = $request->isAjax() || $request->getVar('ajax') === '1';

        if ($isAjaxRequest) {
            return $this->customise($data)
                ->renderWith('SilverStripe/Lessons/Includes/RegionsList');
        }

        return $data;
    }
}
