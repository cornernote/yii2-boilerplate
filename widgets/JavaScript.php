<?php

namespace app\widgets;

use yii\bootstrap\Widget;
use yii\web\View;

/**
 * JavaScript
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @copyright 2015 Mr PHP
 * @license BSD-3-Clause
 *
 * @usage
 * ```
 * <?php \app\widgets\JavaScript::begin(); ?>
 * <script>
 * ... your javascript ...
 * </script>
 * <?php \app\widgets\JavaScript::end(); ?>
 * ```
 *
 * @package dressing.widgets
 */
class JavaScript extends Widget
{
    /**
     * @var
     */
    public $position;

    /**
     *
     */
    public function init()
    {
        ob_start();
    }

    /**
     *
     */
    public function run()
    {
        // get position
        if ($this->position === null) {
            $this->position = View::POS_READY;
        }

        // get contents
        $js = ob_get_clean();
        $js = str_replace(array('<script>', '<script type="text/javascript">', '</script>'), '', $js);
        // register the js script
        $this->getView()->registerJs($js . ';', $this->position, $this->id);

    }
}
