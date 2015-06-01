/**
 * Modal Remote Links
 *
 * usage:
 * ```
 * <a href="<?php echo Url::to(['/']); ?>" class="modal">click me</a>
 * ```
 */
$(document).on('click', '.modal', function (e) {
    e.preventDefault();
    var $modalRemote = $('#modal-remote'),
        url = $(this).attr('href');
    $.ajax({
        url: url,
        beforeSend: function (data) {
            if (!$modalRemote.length) $modalRemote = $('<div class="modal fade" id="modal-remote" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true" data-backdrop="static"><div class="modal-dialog modal-lg"><div class="modal-content"></div></div></div>');
            $modalRemote.find('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h3 id="remoteModalLabel">Loading...</h3></div><div class="modal-body"><div class="modal-remote-indicator"></div></div>');
            $modalRemote.modal();
        },
        success: function (data) {
            var $data = $(data);
            $modalRemote.find('.modal-header > h3').html($data.find('.page-header > h1').html());
            $modalRemote.find('.modal-body').html('<div class="row">' + $data.find('.page-content > .row').html() + '</div>').find('input:text:visible:first').focus();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $modalRemote.find('.modal-header > h3').html('Error');
            $modalRemote.find('.modal-body').html(XMLHttpRequest.responseText);
        }
    });
});
