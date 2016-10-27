$(document).ready(function()
{
    $('#galleryEdit').on('click', function()
    {
        $('#edit-modal').modal();
    });


    $("#inputGalleryTags").select2({
        tags: true,
        width: '100%'
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    if (editError !== '')
    {
        $('#edit-modal').modal();

        var options =
        {
            message: editError,
            container: '#editErrorContainer',
            duration: Infinity
        };
        $.meow(options);
    }
});