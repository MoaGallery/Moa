$(document).ready(function()
{
    $('#galleryEdit').on('click', function()
    {
        $('#edit-modal').modal();
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