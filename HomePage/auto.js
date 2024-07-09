// <!-- Custom JavaScript for Autocomplete -->

$(document).ready(function() {
    $(".input-field").keyup(function() {
        var query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: '', // The same PHP file will handle the AJAX request
                type: 'GET',
                data: {
                    term: query
                },
                success: function(data) {
                    let items = JSON.parse(data);
                    $('.autobox').empty();
                    $.each(items, function(i, item) {
                        $('.autobox').append($('<li>').text(item));
                    });
                    $('.autobox').show();
                }
            });
        } else {
            $('.autobox').hide();
        }
    });

    $(document).on("click", ".autobox li", function() {
        $(".input-field").val($(this).text());
        $('.autobox').hide();
    });
});
