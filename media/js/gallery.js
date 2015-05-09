$(document).ready(function()
{
    $('#galleryEdit').on('click', function()
    {
        $('#edit-modal').modal();
    });

    var newTags = [];
    $("#inputGalleryTags").select2({
        tags: true,
        width: '100%'
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