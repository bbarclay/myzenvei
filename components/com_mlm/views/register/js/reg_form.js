jQuery(document).ready(function ($) {

  /*
   * Add rounding method to the number class
   */
  Number.prototype.toFixed = function (precision) {
    var precision = precision || 0,
    neg = this < 0,
    power = Math.pow(10, precision),
    value = Math.round(this * power),
    integral = String((neg ? Math.ceil : Math.floor)(value / power)),
    fraction = String((neg ? -value : value) % power),
    padding = new Array(Math.max(precision - fraction.length, 0) + 1).join('0');

    return precision ? integral + '.' +  padding + fraction : integral;
  }

  /*
   * TODO: Enable tabs
   */

  /*
   * TODO: Enable Datepicker
   */

  /*
   * Signup as business functionality
   */
  $('.business_signup').hide();
  $('#business_signup').click(function() {
    if ($(this).attr('checked')) {
      $('.business_signup').show();
      $('.user_signup').hide();
    } else {
      $('.business_signup').hide();
      $('.user_signup').show();
    }
  });

  /*
   * Same shipping and billing address.
   */
  $('#copy_shipping').click(function () {
    if ($(this).attr('checked')) {
      $('.billing_field').hide();
    } else {
      $('.billing_field').show();
    }
  }); 

  /*
   * Update state list by country
   */
  var get_states = function(event) {
    $country = $(event.target);
    var state_id = $country.attr('id').replace(/country/, 'state');
    alert(state_id);
    $('#'+state_id).load('/myzenvei/index.php?option=com_mlm&controller=ajax&task=states&format=raw', { country: $country.val() });
  }
  $('#shipping_country').change(get_states);
  $('#billing_country').change(get_states);

  /*
   * Functionality to check availability of:
   *   - Username
   *   - Replicated Site ID
   *   - Email
   */
  var field_check = function(event) {
    $field = $(event.target);
    if ($field.val()) {
      var status_field = $field.attr('id')+'_status';
      $status = $('#'+status_field);
      $status.load('/myzenvei/index.php?option=com_mlm&controller=ajax&task=fieldcheck&format=raw', { 
        field: $field.attr('id'),
        value: $field.val(),
      });
    }
  }
  $('#username').change(field_check);
  $('#replicated_site').change(field_check);
  $('#email').change(field_check);

  /*
   *  On form submit
   */
  $('#reg_form').submit(function () {
    // Copy shipping address values to billing address
    if ($('#copy_shipping').attr('checked')) {
      $('#billing_state').html($('shipping_state').html());
      $('[name^=shipping_]').each(function() {
        var billing_name = $(this).attr('name').replace(/^shipping\_/, 'billing_');
        $('[name=' + billing_name + ']').val($(this).val());
      });
    }

    return false;
  });

  /*
   *  Form validation
   */
  $('#reg_form').validate({
    debug: true,
    rules: {
    },
    messages: {
    },

  });


  /*
   * Pricing calculations
   */
  
  var pricing_calc_product_total = function (sku) {
    $quantity = $('#order_quantity_'+sku);
    $price = $('#price_'+sku);
    $total = $('#order_total_'+sku);

    $total.val(($price.val()*$quantity.val()).toFixed(2));
  };

  var pricing_calc_order_cost = function () {
    var products_total = 0;
    $('input[id^=order_total_]').each(function () {
      products_total = parseFloat(products_total) + parseFloat($(this).val());
    });
    $('#order_products_total').val(products_total.toFixed(2));
  };

  var pricing_calc_tax = function () {
    var tax = $('#order_products_total').val() * $('#state_tax').val();
    $('#order_tax').val(tax.toFixed(2));
  };

  var pricing_calc_shipping = function () {
  };

  var pricing_update_total = function () {
    var order_total = parseFloat($('#order_products_total').val()) + parseFloat($('#order_tax').val()) + 
      parseFloat($('#order_shipping').val());
    $('#order_total').val(order_total.toFixed(2));
  };


  /*
   * When product quantity is updated
   */
  $('input[name^=order[products]]').change(function (event) {
    var sku = $(event.target).attr('id').substr(-3)
    pricing_calc_product_total(sku);
  
    pricing_calc_order_cost();
    pricing_calc_tax();
    pricing_calc_shipping();
    pricing_update_total();
  });

  /*
   * Update tax rate according to selected state
   */
  $('#shipping_state').change(function(event) {
    $this = $(event.target);

    $.ajax({
      url: '/myzenvei/index.php?option=com_mlm&controller=ajax&task=statetax&format=json',
      data: ({ state: $this.val(), country: $('#shipping_country').val() }),
      success: function(data) {
        var tax = $.parseJSON(data);
        $('#state_tax').val(tax);
    
        pricing_calc_tax();
        pricing_update_total();
      },
    });
  });

  /*
   * TODO: Update shipping when shipping method selected
   */
  $('#shipping_method').change(function(event) {
    $this = $(event.target);

    alert($this.val());
  });

  /*
   * On Enrollment Type Change
   */
  $('.etrigger').hide();
  $('#enrollment_type').change(function(event) {
    $this = $(event.target);

    // Hide & Show fields according to the enrollment type
    var selected = $this.val();
    $('.etrigger').hide();
    if ($this.val()) {
      $('.'+selected).show();
    }

    // Update prices for products and calculations
    $.ajax({
      url: '/myzenvei/index.php?option=com_mlm&controller=user&task=productprices&format=json',
      data: ({ group: $this.val() }),
      success: function(data) {
        var prices = $.parseJSON(data);
        $.each(prices, function (i, price) {
          $('.price_'+price.sku).html(price.text_val);
          $('#price_'+price.sku).val(price.value);
          pricing_calc_product_total(price.sku);
        });
        pricing_calc_order_cost();
        pricing_calc_tax();
        pricing_update_total();
      },
    });
  });

});
