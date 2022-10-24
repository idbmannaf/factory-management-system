$(document).on('click','.addBtn',function(e){
    e.preventDefault();
    var that = $(this);
    var url = that.attr('data-url');
  var raw_id= that.closest('.sampleValue').find('.raw').val();
  var unit_value= that.closest('.sampleValue').find('.unitItemValue').val();



  if (!raw_id) {
    that.closest('.sampleValue').find('.rawError').show();
        return;
  }if (!unit_value) {
    that.closest('.sampleValue').find('.unitValueError').show();
    return;
  }
  if (!raw_id && !unit_value) {
    that.closest('.sampleValue').find('.rawError').show();
    that.closest('.sampleValue').find('.unitValueError').show();
    return;
  }

    $.ajax({
        url:url,
        method:'GET',
        success:function (response){
            console.log(response)
            $('.sampleValue').append(response);
        }
    });
})
 $(document).on('click','.deleteBtn',function(e){
    e.preventDefault();
    var that = $(this);
    that.closest('.closeDiv').remove();
})
$(document).on('change','.raw',function(){
    var that = $(this);
    var raw = that.val();
    // alert(raw)
    var url =that.attr('data-url');
    var fullUrl= url+"?raw="+raw;
    $.ajax({
        url:fullUrl,
        method:"GET",
        success:function(response){
            console.log(response)
            that.closest('.sampleValue').find('.batchValue').html(response);
        }
    });
});
$('.step2-select').select2({
    theme: 'bootstrap4',
    // minimumInputLength: 1,
    ajax: {
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            // alert(data[0].s);
            var data = $.map(data, function(obj) {
                obj.id = obj.id || obj.id;
                return obj;
            });
            var data = $.map(data, function(obj) {
                var name =JSON.parse(obj.name);
                obj.text = name.en+"("+obj.unit+")";
                // obj.text = name.en+"("+obj.cat_title+")" +"("+obj.unit+")";
                return obj;
            });
            return {
                results: data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        }
    },
});


// Raw Change get  unit
$(document).on('change','.raw',function(){
    var that = $(this);
    var raw_id = that.val();
    var url = that.attr('data-unit-check-url');
    var finalUrl = url+"?raw="+raw_id;

    $.ajax({
        url:finalUrl,
        method:"GET",
        success:function(res){
            if(res.unit == 'kg' || res.unit == 'gm'){
                that.closest('.closeDiv').find('.showUnit').html(
                    `<select name="unit[]" id="unit" class='form-control' required>
                    <option value="">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="gm">gm</option>
                </select>`
                )
            }
            if (res.unit == 'ltr' || res.unit == 'ml') {
                that.closest('.closeDiv').find('.showUnit').html(
                    `<select name="unit[]" id="unit" class='form-control' required>
                    <option value="">Select Unit</option>
                    <option value="ltr">Litter</option>
                    <option value="ml">ml</option>
                </select>`
                )
            }
        }
    })
})
// Prduct name Change get  unit
$(document).on('change','.dhpl_product_id',function(){
    var that = $(this);
    var dhpl_product_id = that.val();
    var url = that.attr('data-unit-check-url');
    var finalUrl = url+"?product_id="+dhpl_product_id;

    $.ajax({
        url:finalUrl,
        method:"GET",
        success:function(res){
            if(res.unit == 'kg' || res.unit == 'gm'){
                $('.show_sample_unit').html(
                    `
                    <label for="sample_unit">Unit</label>
                    <select name="sample_unit" id="sample_unit" class='form-control' required>
                    <option value="">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="gm">gm</option>
                </select>`
                )
            }
            if (res.unit == 'ltr' || res.unit == 'ml') {
                $('.show_sample_unit').html(
                    `
                    <label for="sample_unit">Unit</label>
                    <select name="sample_unit" id="sample_unit" class='form-control' required>
                    <option value="">Select Unit</option>
                    <option value="ltr">Litter</option>
                    <option value="ml">ml</option>
                </select>`
                )
            }
        }
    })
})
