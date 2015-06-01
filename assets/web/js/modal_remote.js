/**
 * Modal Remote
 *
 * usage:
 * ```
 * <a href="<?php echo Url::to(['/']); ?>" data-toggle="modal-remote">click me</a>
 * ```
 */
$(document).on('click', '[data-toggle="modal-remote"]', function (e) {
    e.preventDefault();
    var $modalRemote = $('#modal-remote'),
        url = $(this).attr('href');
    $.ajax({
        url: url,
        beforeSend: function (data) {
            if (!$modalRemote.length) $modalRemote = $('<div class="modal fade" id="modal-remote" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"></div></div></div>');
            $modalRemote.find('.modal-content').html('<div class="modal-header"><h3 id="remoteModalLabel">Loading...</h3></div><div class="modal-body"><div class="modal-remote-indicator"></div></div>');
            $modalRemote.modal();
        },
        success: function (data) {
            var $data = $(data);
            $modalRemote.find('.modal-body').html('<div class="row">' + $data.find('.page-content > .row').html() + '</div>').find('input:text:visible:first').focus();
            $modalRemote.find('.modal-header > h3').html($data.find('.page-header > h1').html());
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $modalRemote.children('.modal-header').html('<button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button><h3>Error</h3>');
            $modalRemote.children('.modal-body').html(XMLHttpRequest.responseText);
        }
    });
});
