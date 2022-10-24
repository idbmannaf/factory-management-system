// $(document).on('change', '.mandetory_stock_id', function () {
//     var that = $(this);
//     var mandetory_stock_id = $(this).val();
//     var url = that.attr('data-temp-url');
//     var mandetory_quantity = that.closest('.deleteOrShow').find('.mandetory_quantity').val();

//     if ((mandetory_stock_id <= 0) || (mandetory_quantity <= 0)) {
//         that.closest('.deleteOrShow').find('.msg').text('Mandetory or Mandetory Quantity not found');
//         $('.packBtn').attr('disabled', true)
//         return;
//     } else {
//         $('.packBtn').attr('disabled', false)
//         var mandetory_qty_update = that.closest('.deleteOrShow').find("input[name='mandatory_qty[]']")
//             .map(function () {
//                 // $(this).closest('label').find('.mandatory_qty').trigger('input');
//                 return $(this).val(mandetory_quantity);
//             }).get();


//         that.closest('.deleteOrShow').find('.msg').text('');
//         $.ajax({
//             url: url,
//             method: "GET",
//             data: { mandetory_stock_id: mandetory_stock_id, mandetory_quantity: mandetory_quantity },
//             success: function (res) {
//                 if (res.success) {
//                     that.closest('.deleteOrShow').find('.temp_id').val(res.temp_id);
//                     that.closest('.deleteOrShow').find('.mandetory_stock_id').attr('disabled', true);
//                     $('#packShow').append(res.html);
//                     that.closest('.deleteOrShow').find('.removeMandetory').css({ "display": "inline-block", "color": "red" });
//                 }
//             }
//         })
//     }
// })


$(document).on('keyup', '.mandetory_quantity', function () {
    var that = $(this);
    var mandetory_quantity = $(this).val();
    var temp_id = that.closest('.mandetoryContainer').find('.temp_id').val();

    var mandetory_stock_id = that.closest('.mandetoryContainer').find('.mandetory_stock_id').val();
    var url = that.attr('data-temp-url');

    if (mandetory_quantity <= 0) {
        that.closest('.mandetoryContainer').find('.msg').text('Mandetory Quantity missing');
        $('.packBtn').attr('disabled', true)
        return;
    }
    else {
        $('.packBtn').attr('disabled', false)
        var mandetory_qty_update = that.closest('.mandetoryContainer').find("input[name='mandatory_qty[]']")
            .map(function () {
                $(this).val(mandetory_quantity);
                return $(this).closest('label').find('.mandatory_qty').trigger('input');
            }).get();

        that.closest('.mandetoryContainer').find('.msg').text('');
        $.ajax({
            url: url,
            method: "GET",
            data: { temp_id: temp_id, mandetory_quantity: mandetory_quantity },
            success: function (res) {
                if (res.success) {
                }

            }
        })
    }



})






$(document).on('click', '.stock_select', function () {
    var that = $(this);
    var temp_item_id = that.val();
    var quantity = that.closest('label').find('.selectQty').val();

    if (that.is(':checked')) {
        var mandetoryQty = that.closest('.mandetoryContainer').find('.mandetory_quantity').val();
        if (mandetoryQty == 0) {
            that.closest('.mandetoryContainer').find('.msg').text('Mandetory quantity missing');
            $('.packBtn').attr('disabled', true)
            that.prop('checked', false);
            return;
        } else {
            that.closest('.mandetoryContainer').find('.msg').text('');
            $('.packBtn').attr('disabled', false)
        }

        url = that.attr('data-select-id');
    } else {
        url = that.attr('data-unselect-id');
    }
    // Stock Quantity Check Start
    var temp_item_batch_qty = that.closest('label').find('.temp_item_batch_qty').val();
    if (Number(temp_item_batch_qty) < Number(quantity)) {
        that.closest('.mandetoryContainer').find('.msg').text('Not enough quantity');
        $('.packBtn').attr('disabled', true)
        that.closest('.mandetoryContainer').find('.stock_select').prop('checked', false);
        return;
    } else {
        that.closest('.mandetoryContainer').find('.msg').text('');
        $('.packBtn').attr('disabled', false)
    }
    // Stock Quantity Check extends

    if (quantity <= 0) {
        that.closest('.mandetoryContainer').find('.msg').text('first input Quantity');
        $('.packBtn').attr('disabled', true)
        that.prop('checked', false);
        return;
    } else {
        that.closest('.mandetoryContainer').find('.msg').text('');
        $('.packBtn').attr('disabled', false)
    }

    $.ajax({
        url: url,
        data: {
            temp_item_id: temp_item_id,
            quantity: quantity,
            stock_id: that.val()
        },
        method: "GET",
        success: function (res) {
            if (res.success) {

            }
        }
    });
})

$(document).on('input', '.mandatory_qty', function () {
    var that = $(this);
    var temp_item_id = that.closest('label').find('.stock_select').val();
    var quantity = that.val();
    var url = that.attr('data-url');
    // Stock Quantity Check Start
    var temp_item_batch_qty = that.closest('label').find('.temp_item_batch_qty').val();

    if (Number(temp_item_batch_qty) < Number(quantity)) {
        that.closest('.mandetoryContainer').find('.msg').text('Not enough quantity');
        $('.packBtn').attr('disabled', true)
        that.closest('.mandetoryContainer').find('.stock_select').prop('checked', false);
        return;
    } else {
        that.closest('.mandetoryContainer').find('.msg').text('');
        $('.packBtn').attr('disabled', false)
    }
    // Stock Quantity Check end

    var mandetoryQty = that.closest('.mandetoryContainer').find('.mandetory_quantity').val();
    if (mandetoryQty <= 0) {
        that.closest('.mandetoryContainer').find('.msg').text('Mandetory Quantity Missing');
        $('.packBtn').attr('disabled', true)
        that.prop('checked', false);
        return;
    } else {
        that.closest('.mandetoryContainer').find('.msg').text('');
        $('.packBtn').attr('disabled', false)
    }
    $.ajax({
        url: url,
        method: "GET",
        data: {
            'temp_item_id': temp_item_id,
            'quantity': quantity
        },
        success: function (res) {
            if (res.success) {

            }
        }
    });
})
$(document).on('input', '.optional_qty', function () {
    var that = $(this);
    var quantity = that.val();
    var temp_item_id = that.closest('label').find('.stock_select').val();
    var url = that.attr('data-url');

    // Stock Quantity Check Start
    var temp_item_batch_qty = that.closest('label').find('.temp_item_batch_qty').val();
    if (Number(temp_item_batch_qty) < Number(quantity)) {

        that.closest('.mandetoryContainer').find('.msg').text('Not enough quantity');
        $('.packBtn').attr('disabled', true)
        that.closest('.mandetoryContainer').find('.stock_select').prop('checked', false);
        return;
    } else {
        that.closest('.mandetoryContainer').find('.msg').text('');
        $('.packBtn').attr('disabled', false)
    }
    // Stock Quantity Check end

    var mandetoryQty = that.closest('.mandetoryContainer').find('.mandetory_quantity').val();
    if (mandetoryQty <= 0) {
        that.closest('.mandetoryContainer').find('.msg').text('Mandetory Quantity Missing');
        $('.packBtn').attr('disabled', true)
        that.prop('checked', false);
        return;
    } else {
        that.closest('.mandetoryContainer').find('.msg').text('');
        $('.packBtn').attr('disabled', false)
    }
    $.ajax({
        url: url,
        method: "GET",
        data: {
            'temp_item_id': temp_item_id,
            'quantity': quantity
        },
        success: function (res) {
            if (res.success) {

            } else {

            }
        }
    });

})
$(document).on('click', '.removeMandetoryPack', function (e) {
    e.preventDefault();

    var that = $(this);
    var url = that.attr('href');
    var temp_id = that.closest('.mandetoryContainer').find('.temp_id').val();
    $.ajax({
        url: url,
        method: "GET",
        data: {
            'temp_id': temp_id,
        },
        success: function (res) {
            if (res.success) {
                that.closest('.mandetoryContainer').remove();
            }
        }
    });

})



// $(document).on('change', '.stock_id', function () {
//     var that = $(this);
//     if (that.val() > 0) {
//         var v = that.closest('.form-group').find('.qty').attr('required', true);
//         url = that.attr('data-url');
//         finalUrl = url + "?stock=" + that.val();
//         $.ajax({
//             url: finalUrl,
//             method: "GET",
//             success: function (response) {
//                 Number(that.closest('.form-group').find('#unitValue').val(response.unit_value));
//                 Number(that.closest('.form-group').find('#unit').val(response.unit));

//                 var unitValue = Number(that.closest('.form-group').find('.mandotoryQty').val());
//                 if (unitValue < 0) {
//                     $('.packBtn').attr('disabled', true);
//                 } else {
//                     $('.packBtn').attr('disabled', false);
//                 }
//             }
//         })

//     } else {
//         var v = that.closest('.form-group').find('.qty').attr('required', false);
//         Number(that.closest('.form-group').find('#unitValue').val(0));
//         $('.packBtn').attr('disabled', true);
//     }
// })



// $(document).on('click', '.mPlus', function (e) {
//     e.preventDefault();
//     var that = $(this);
//     var url = that.attr('data-url');
//     var mId = that.closest('.deleteOrShow').find('.stock_id').val();
//     if (mId == 0) {
//         alert('select Mandotory');
//         return;
//     }

//     $.ajax({
//         url: url,
//         data: { 'mandetory_stock_id': mId },
//         method: "GET",
//         success: function (res) {
//             if (res.success) {
//                 $('.mPlus').hide();
//                 that.closest('.deleteOrShow').find('.stock_id').attr('disabled', true);
//                 $('#packShow').append(res.html);
//                 that.closest('.deleteOrShow').find('#temp_id').val(res.temp_id);
//             }
//         }
//     });
// })

// $(document).on('input', '.qty', function () {
//     var that = $(this);
//     var firstMandetoryQty = that.val();
//     var stock_id = that.closest('.deleteOrShow').find('.stock_id').val();
//     if (stock_id == 0) {
//         that.closest('.deleteOrShow').find('.error').text('select Mandotory Packaging');
//         var mandetory_qty = that.closest('.deleteOrShow').find("input[name='mandatory_qty[]']")
//             .map(function () {
//                 return $(this).val(firstMandetoryQty);
//             }).get();
//         return;
//     }

//     var mendotory_stock_unit = $('#unitValue').val();
//     var mendotory_stock_unit_price = Number($("#unit").val());
//     var mendotoryQty = Number(firstMandetoryQty);
//     var product_unit = $('#productUnit').val();
//     var product_unit_value = Number($('#productUnitValue').val());



//     // if (mendotoryQty * mendotory_stock_unit_price > product_unit_value) {
//     //     alert('Mandetory Qty must br less then or equal product unit value');
//     //     return;
//     // }

//     var mandetory_qty = that.closest('.deleteOrShow').find("input[name='mandatory_qty[]']")
//         .map(function () {
//             $(this).closest('label').find('.mandatory_qty').trigger('input');
//             return $(this).val(firstMandetoryQty);
//         }).get();

//     that.closest('.deleteOrShow').find('.error').text('');
//     $('.stock_id').trigger('change');


// })



// $(document).on('change', '.stock_id', function () {
//     var that = $(this);
//     var temp_id = that.closest('.deleteOrShow').find('.temp_id').val();
//     var url = that.attr('data-temp-url');
//     var quantity = that.closest('.deleteOrShow').find('.firstMandetory').val();

//     if (that.val() <= 0) {
//         that.closest('.deleteOrShow').find('.error').text('Must Select Mandetory');
//         that.closest('.deleteOrShow').find('.mPlus').hide();
//         return;
//     } else {
//         that.closest('.deleteOrShow').find('.error').text('');
//         that.closest('.deleteOrShow').find('.mPlus').show();
//     }
//     if (quantity <= 0) {
//         that.closest('.deleteOrShow').find('.firstMandetory').addClass('border border-danger');
//         that.closest('.deleteOrShow').find('.mPlus').hide();
//         return;

//     } else {
//         var unit = that.closest('.deleteOrShow').find('#unit').val();
//         var unitValue = that.closest('.deleteOrShow').find('#unitValue').val();
//         // alert(checkUnitValue(quantity, unit, unitValue));

//         that.closest('.deleteOrShow').find('.firstMandetory').removeClass('border border-danger');
//         that.closest('.deleteOrShow').find('.mPlus').show();
//     }

//     $.ajax({
//         url: url,
//         data: {
//             'temp_id': temp_id,
//             'quantity': quantity,
//             'mandetory_stock_id': that.val()
//         },
//         method: "GET",
//         success: function (res) {
//             if (res.success) {
//                 // that.closest('.deleteOrShow').find('.mPlus').trigger('click');
//                 // that.closest('.deleteOrShow').find('.deleteClass').removeClass('.mPlus');
//                 that.closest('.deleteOrShow').find('.temp_id').val(res.temp_id);
//                 that.closest('.deleteOrShow').find('.firstMandetory').val(res.quanitity);
//             }
//         }
//     });
// })

////////////////////////////

// $(document).on('click', '.stock_select', function () {
//     var that = $(this);
//     var temp_id = that.closest('.deleteOrShow').find('.temp_id').val();
//     var quantity = that.closest('label').find('.selectQty').val();

//     if (that.is(':checked')) {
//         var mandetoryQty = that.closest('.deleteOrShow').find('.firstMandetory').val();
//         var madetory_stock = that.closest('.deleteOrShow').find('.stock_id').val();
//         if (mandetoryQty == 0 && madetory_stock == 0) {
//             alert('first select mandetory quantity and stock');
//             that.prop('checked', false);
//             return;
//         }

//         url = that.attr('data-select-id');
//     } else {
//         url = that.attr('data-unselect-id');
//     }
//     if (quantity <= 0) {
//         alert('first input Quantity');
//         that.prop('checked', false);
//         return;
//     }

//     $.ajax({
//         url: url,
//         data: {
//             'temp_id': temp_id,
//             'quantity': quantity,
//             'stock_id': that.val()
//         },
//         method: "GET",
//         success: function (res) {
//             if (res.success) {
//                 that.attr('data-item_id', res.item_id);
//                 // that.closest('.deleteOrShow').find('.firstMandetory').val(res.quanitity);
//                 // alert(res.success);
//             }
//         }
//     });
// })
// $(document).on('input', '.mandatory_qty', function () {
//     var that = $(this);
//     var item_id = that.closest('label').find('.stock_select').attr('data-item_id');
//     var stock_id = that.closest('label').find('.stock_select').val();
//     var quantity = that.val();
//     var url = that.attr('data-url');
//     $.ajax({
//         url: url,
//         data: {
//             'item_id': item_id,
//             'stock_id': stock_id,
//             'quantity': quantity
//         },
//         method: "GET",
//         success: function (res) {

//         }
//     });
// })
// $(document).on('input', '.optional_qty', function () {
//     var that = $(this);
//     var item_id = that.closest('label').find('.stock_select').attr('data-item_id');
//     var stock_id = that.closest('label').find('.stock_select').val();
//     var quantity = that.val();
//     var url = that.attr('data-url');

//     var mandetoryQty = that.closest('.deleteOrShow').find('.firstMandetory').val();
//     var madetory_stock = that.closest('.deleteOrShow').find('.stock_id').val();

//     if (mandetoryQty == 0 && madetory_stock == 0) {
//         alert('first select mandetory quantity and stock');

//     }
//     $.ajax({
//         url: url,
//         data: {
//             'item_id': item_id,
//             'stock_id': stock_id,
//             'quantity': quantity
//         },
//         method: "GET",
//         success: function (res) {
//             if (res.success) {
//                 alert('pk');
//             }
//         }
//     });

// })


// function gTk(value) {
//     return value / 1000;
// }
// /**
//  * Kg To Gram
//  */
// function kTg(value) {
//     return value * 1000;
// }

// /**
//  * Litter To Milliter
//  */
// function lTm(value) {
//     return value / 1000;
// }
// /**
//  * Milliter To Litter
//  */
// function mTl(value) {
//     return value * 1000;
// }
// function checkUnitValue(qty, unit, unitValue) {
//     var product_unit = $('#productUnit').val();
//     var productUnitValue = Number($('#productUnitValue').val());
//     var unit_value = 0;
//     if (unit != product_unit) {
//         if (unt == 'ltr') {
//             unit_value = lTm(productUnitValue);
//         } else if (unit == 'ml') {
//             unit_value = mTl(productUnitValue);
//         } else if (unit == 'gm') {
//             unit_value = kTg(productUnitValue);
//         } else if (unit == 'kg') {
//             unit_value = gTk(productUnitValue);
//         }
//     } else {
//         unit_value = unitValue;
//     }
//     var final_unit_value = unitValue * Number(qty);
//     if (productUnitValue < final_unit_value) {
//         return false;
//     } else {
//         return true;
//     }

// }
