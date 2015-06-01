<?php

namespace app\widgets;

use app\widgets\JavaScript;
use yii\bootstrap\Widget;
use yii\web\View;

/**
 * ModalRemote
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @copyright 2015 Mr PHP
 * @license BSD-3-Clause
 *
 * @usage
 *
 * installation:
 * ```
 * <?php app\widgets\ModalRemote::widget(); ?>
 * ```
 *
 * usage:
 * ```
 * <a href="<?php echo Url::to(['/']); ?>" data-toggle="modal-remote">click me</a>
 * ```
 *
 * @package dressing.widgets
 */
class ModalRemote extends Widget
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
        JavaScript::begin();
        ?>
        <script>
            $(document).on('click', '[data-toggle="modal-remote"]', function (e) {
                e.preventDefault();
                var $modalRemote = $('#modal-remote'),
                    url = $(this).attr('href');

                $.ajax({
                    url: url,
                    beforeSend: function (data) {
                        if (!$modalRemote.length) $modalRemote = $('<div class="modal fade" id="modal-remote" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"></div></div></div>');
                        $modalRemote.find('.modal-content').html('<div class="modal-header"><h3 id="remoteModalLabel"><?php echo \Yii::t('app', 'Loading...'); ?></h3></div><div class="modal-body"><div class="modal-remote-indicator"></div></div>');
                        $modalRemote.modal();
                    },
                    success: function (data) {
                        var $data = $(data);
                        $modalRemote.find('.modal-body').html('<div class="row">' + $data.find('.page-content > .row').html() + '</div>').find('input:text:visible:first').focus();
                        $modalRemote.find('.modal-header > h3').html($data.find('.page-header > h1').html());
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $modalRemote.children('.modal-header').html('<button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button><h3><?php echo \Yii::t('app', 'Error!'); ?></h3>');
                        $modalRemote.children('.modal-body').html(XMLHttpRequest.responseText);
                    }
                });
            });
        </script>
        <?php
        JavaScript::end();
    }
}
