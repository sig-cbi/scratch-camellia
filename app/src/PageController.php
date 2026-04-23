<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\View\Requirements;

    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();

            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/

            Requirements::css('css/bootstrap.min.css');
            Requirements::css('css/style.css');
            Requirements::themedJavascript('javascript/modernizr.js');

            Requirements::themedJavascript('javascript/jquery-1.11.1.min.js');

            Requirements::themedJavascript('javascript/bootstrap.min.js');
            Requirements::themedJavascript('javascript/bootstrap-datepicker.js');
            Requirements::themedJavascript('javascript/chosen.min.js');
            Requirements::themedJavascript('javascript/bootstrap-checkbox.js');
            Requirements::themedJavascript('javascript/nice-scroll.js');
            
            Requirements::themedJavascript('javascript/jquery-browser.js');
            Requirements::themedJavascript('javascript/scripts.js');
        }
    }
}
