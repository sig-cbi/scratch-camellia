<?php

namespace SilverStripe\Lessons;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;

use SilverStripe\Versioned\Versioned;


class Region extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'Text',
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'RegionsPage' => RegionsPage::class,
    ];

    private static $has_many = [
        'Articles' => ArticlePage::class,
    ];

    private static $owns = [
        'Photo',
    ];

    private static $extensions = [
        Versioned::class,
    ];

    private static $summary_fields = [
        'GridThumbnail' => '',
        'Title' => 'Title',
        'Description' => 'Description',
    ];

    private static $versioned_gridfield_extensions = true;


    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title'),
            TextAreaField::create('Description'),
            $uploader = UploadField::create('Photo')
        );

        $uploader->setFolderName('region-photos');
        $uploader->getValidator()->setAllowedExtensions(['png', 'gif', 'jpeg', 'jpg']);

        return $fields;
    }

    public function getGridThumbnail()
    {
        if ($this->Photo()->exists()) {
            return $this->Photo()->ScaleWidth(100);
        }

        return '(no image)';
    }

    public function Link()
    {
        return $this->RegionsPage()->Link('show/' . $this->ID);
    }

    public function ArticlesLink()
    {
        $page = ArticleHolder::get()->first();

        if ($page) {
            return $page->Link('region/' . $this->ID);
        }
    }
}
