
$(document).ready(function () {
    $('input[name="status[]"]').change(function () {
        var parent = $(this).closest('td');
        var label_id = $('label',parent);
        if ($(this).prop('checked')) {
            $(label_id).text('حاضر');
        } else {
            $(label_id).text('غایب');
        }
    });
});

