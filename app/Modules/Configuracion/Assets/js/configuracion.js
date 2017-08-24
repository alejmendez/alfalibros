var aplicacion;

$(function() {

    $('#formulario').submit(function() {
        $(this).ajaxSubmit({
            'url': $url + 'guardar',
            'data': {
                '_method': 'post'
            },
            'type': 'POST',
            'success': function(r) {
                aviso(r);
            }
        });
        return false;
    });

    $('.btn:not(#guardar)', '#botonera').remove();

    $('#guardar').on('click', function() {
        $('#formulario').submit();
    });

    $("#forma").datepicker({
        dateFormat: 'yy-mm-dd',
        defaultDate: "+1w",
        changeMonth: true,

        onClose: function(selectedDate) {
            $("#formato_fecha").datepicker("option", "minDate", selectedDate);
        }
    });
});