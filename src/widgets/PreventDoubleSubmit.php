<?php

namespace app\widgets;

use Yii;
use yii\bootstrap\Widget;

/**
 * PreventDoubleSubmit
 *
 * Prevents double form submissions on all forms.
 * If you need to double-submit on some forms give them class="allow-double-submit".
 * Uses $(document).on('submit', ... ) so that dynamically loaded forms are selected.
 *
 * @usage
 * ```
 * <?php \app\widgets\PreventDoubleSubmit::widget(); ?>
 * ```
 *
 * @see http://stackoverflow.com/questions/2830542/prevent-double-submission-of-forms-in-jquery
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @copyright 2016 Mr PHP
 * @license BSD-3-Clause
 */
class PreventDoubleSubmit extends Widget
{

    /**
     * @var string The jQuery selector, by default all forms except those with class="allow-double-submit"
     */
    public $formSelector = 'form:not(.allow-double-submit)';

    /**
     * @var string The jQuery selector, by default only links with class="prevent-double-click"
     */
    public $linkSelector = 'a.prevent-double-click';

    /**
     * Register JavaScript to prevent Double Form Submission
     */
    public function run()
    {
        // forms
        $this->getView()->registerJs("$(document).on('submit', '" . $this->formSelector . "', function (e) {
            var form = $(this); 
            if (form.data('submitted') !== true) { 
                form.data('submitted', true); 
                form.find(':submit').attr('disabled', true); 
            } 
            else {
                e.preventDefault(); 
            }
        });");
        // links
        $this->getView()->registerJs("$(document).on('click', '" . $this->linkSelector . "', function (e) {
            var link = $(this);
            if (link.data('clicked') !== true) {
                link.data('clicked', true);
                link.attr('disabled', true);
            }
            else {
                e.preventDefault();
            }
        });");
    }

}
