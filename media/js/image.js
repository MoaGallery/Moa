$(document).ready(function()
{
    $('#imageEdit').on('click', function()
    {
        $('#edit-modal').modal();
    });


    $("#inputImageTags").select2({
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