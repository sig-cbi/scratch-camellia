<?php

namespace SilverStripe\Lessons;

use Page;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\ORM\ArrayList;
use SilverStripe\view\ArrayData;
use SilverStripe\Versioned\Versioned;
use SilverStripe\ORM\Queries\SQLSelect;

class ArticleHolder extends Page
{

    private static $allowed_children = [
        ArticlePage::class
    ];

    private static $has_many = [
        'Categories' => ArticleCategory::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Categories', GridField::create(
            'Categories',
            'Article categories',
            $this->Categories(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

    public function Regions()
    {
        $page = RegionsPage::get()->first();
        if ($page) {
            return $page->Regions();
        }
    }

    public function ArchiveDates()
    {
        $grouped = [];
        $list = ArrayList::create();

        $stage = Versioned::get_stage();
        $baseTable = ArticlePage::getSchema()->tableName(ArticlePage::class);
        $tableName = $stage === Versioned::LIVE ? "{$baseTable}_Live" : $baseTable;

        $query = SQLSelect::create()
            ->setSelect([])
            ->selectField("DATE_FORMAT(`Date`, '%Y_%M_%m')", "DateString")
            ->setFrom($tableName)
            ->setOrderBy("DateString", "DESC")
            ->setDistinct(true);

        ArticlePage::get()->sort("Date DESC")->column("Date");

        $result = $query->execute();

        if ($result) {
            foreach ($result as $record) {
                list($year, $monthName, $monthNumber) = explode('_', $record['DateString']);

                $startDate = "{$year}-{$monthNumber}-01";
                $endDate = date('Y-m-d', strtotime('+1 month', strtotime($startDate)));

                $articleCount = ArticlePage::get()
                    ->filter([
                        'ParentID' => $this->ID,
                        'Date:GreaterThanOrEqual' => $startDate,
                        'Date:LessThan' => $endDate,
                    ])
                    ->count();

                if (!isset($grouped[$year])) {
                    $grouped[$year] = [
                        'Year' => $year,
                        'ArticleCount' => 0,
                        'Months' => [],
                    ];
                }

                $grouped[$year]['ArticleCount'] += $articleCount;

                $grouped[$year]['Months'][] = [
                    'MonthName' => $monthName,
                    'MonthNumber' => $monthNumber,
                    'Link' => $this->Link("date/$year/$monthNumber"),
                    'ArticleCount' => $articleCount,
                ];
            }
        }

        foreach ($grouped as $yearData) {
            krsort($yearData['Months']);
            krsort($grouped);
            $months = ArrayList::create();

            foreach ($yearData['Months'] as $monthData) {
                $months->push(ArrayData::create($monthData));
            }

            $list->push(ArrayData::create([
                'Year' => $yearData['Year'],
                'ArticleCount' => $yearData['ArticleCount'],
                'Months' => $months,
            ]));
        }

        return $list;
    }
}
