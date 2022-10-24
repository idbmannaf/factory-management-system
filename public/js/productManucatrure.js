
$(document).on('change', '#sample', function (e) {
    var sample = $(this).val();
    if (!sample) {
        $('.submitBtn').attr('disabled', true);
        return;
    } else {
        $('.submitBtn').attr('disabled', false);
    }
    var url = $(this).attr('data-url');
    fullUrl = url + "?id=" + sample;
    $.ajax({
        url: fullUrl,
        method: "GET",
        success: function (response) {
            $('#insertSampleItems').html(response);
            $('#insertSampleitemsWithPrice').hide();
            $('#qtyMultiply').val(0);
        }
    });
})

$(document).on('change keyup', '#qtyMultiply', function (e) {
    $('#insertSampleitemsWithPrice').show();
    var that = $(this);
    var multiply = that.val();
    var sample = $('#sample').val();
    var url = that.attr('data-url')
    var sample_unti = $('#sample_unit').val();
    if (sample_unti == '') {
        $('.submitBtn').attr('disabled', true);
        return;
    }
    if (multiply <= 0 || !sample) {
        $('.submitBtn').attr('disabled', true);
        return;
    }
    user_type = that.attr('data-user-type');
    if (user_type) {
        user_type = $(this).attr('data-user-type');
    }else{
        user_type = 'admin';
    }

    var fullUrl = url + "?sample=" + sample + "&multiply=" + multiply + "&sample_unit=" + sample_unti + "&user_type="+user_type;
    $.ajax({
        url: fullUrl,
        method: "GET",
        success: function (response) {
            $('#insertSampleitemsWithPrice').html(response);
            $('#qtyMultiply').show();
            $('.submitBtn').attr('disabled', false);
        }
    });
});

$(document).on('change', '#sample_unit', function (e) {
    if ($(this).val() == '') {
        $('.submitBtn').attr('disabled', true);
        return;
    } else {
        $('.submitBtn').attr('disabled', false);
    }

    if ($('#qtyMultiply').val() <= 0) {
        $('.submitBtn').attr('disabled', true);
        return;
    } else {
        $('.submitBtn').attr('disabled', false);
    }
});
// Sample Unit Check
$(document).on('change', '.sample', function () {
    var that = $(this);
    var sample_id = that.val();
    var url = that.attr('data-unit-check-url');
    var finalUrl = url + "?sample_id=" + sample_id;

    $.ajax({
        url: finalUrl,
        method: "GET",
        success: function (res) {
            if (res.unit === 'kg' || res.unit === 'gm') {
                $('.show_sample_unit').html(
                    `
                    <select name="sample_unit" id="sample_unit" class='form-control' required>
                    <option value="">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="gm">gm</option>
                </select>`
                )
            }
            else if (res.unit === 'ltr' || res.unit === 'ml') {

                $('.show_sample_unit').html(
                    `
                    <select name="sample_unit" id="sample_unit" class='form-control' required>
                    <option value="">Select Unit</option>
                    <option value="ltr">Litter</option>
                    <option value="ml">ml</option>
                </select>`
                )
            }
            else {
                $('.show_sample_unit').html('')
            }
        }
    })
})
