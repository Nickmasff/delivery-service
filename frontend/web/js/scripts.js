
$( document ).ready(function() {

    var targetSelect =  $('#deliveryform-target');

    $(document).on('change', '#deliveryform-city', function () {
        var cityCode = this.value;

        targetSelect.attr('disabled', 'disabled');

        $.ajax({
            url: '/getPoints',
            data: {cityCode:cityCode},
            success: function (data) {
                targetSelect.empty();
                $.each(data, function (key, val) {
                    if(key){
                        var opt = '<option value="'+key+'">'+val+'</option>';
                        targetSelect.append(opt);
                    }
                });
                targetSelect.removeAttr('disabled');
            }
        })
    });

    $('#delivery-form').on('beforeSubmit', function () {
        var form = $(this);
        var responseContainer = $('.delivery_response');

        if (form.find('.has-error').length) {
            return false;
        }

        responseContainer.empty();

        $.ajax({
            url    : 'getPrice',
            type   : 'post',
            data   : form.serialize(),
            success: function (response) {
                responseContainer.text(response);
            },
            error  : function () {
                console.log('internal server error');
            }
        });
        return false;
    });
});