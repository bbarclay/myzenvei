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
  $('#tabs').tabs();

  /*
   * TODO: Enable Datepicker
   */
  $.datepicker.setDefaults({ 
    changeMonth: true,
    changeYear: true,
  });
  $('#birthday').datepicker({ yearRange: '-100:+0' });
  $('#coapplicant_birthday').datepicker({ yearRange: '-100:+0' });

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
    $('#'+state_id).load('/myzenvei/index.php?option=com_mlm&controller=ajax&task=states&format=raw', { country: $country.val() });
  }
  $('#shipping_country').change(get_states);
  $('#billing_country').change(get_states);

  /*
   * Increment and Decrement Operations for quantity
   */
  $('.quantity_add').click(function (event) {
    $input = $(event.target).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
  $('.quantity_sub').click(function (event) {
    $input = $(event.target).parent().find('input');
    if ($input.val() > 0) {
      $input.val(parseInt($input.val()) - 1);
      $input.change();
    }
    return false;
  });

  /*
   * Make sure quantities are only numeric
   */
  var numeric = function (event) {
    var val = $(event.target).val();
    var original_val = val;
    val = val.replace(/[0-9]*/g, '');
    if (val != '') {
      original_val = parseInt(original_val, 10);
      original_val = original_val >= 0 ? original_val : 0;
      $(this).val(original_val);
      alert('Only positive integer values allowed.');
    }
  };
  $('input[name^=order[products]], input[name^=autoship[products]]').blur(numeric).keyup(numeric);

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
  });

  /*
   *  Form validation
   */
  $('#reg_form').validate({
    debug: true,
    rules: {
      'enrollment_type': "required",
      'user_info[username]': {
        required: true,
        minlength: 3,
        remote: '/myzenvei/index.php?option=com_mlm&controller=ajax&task=fieldcheck&format=raw&field=username', 
      },
      'user_info[replicated_site]': {
        required: true,
        minlength: 3,
        remote: '/myzenvei/index.php?option=com_mlm&controller=ajax&task=fieldcheck&format=raw&field=replicated_site', 
      },
      'user_info[email]': {
        required: true,
        email: true,
        remote: '/myzenvei/index.php?option=com_mlm&controller=ajax&task=fieldcheck&format=raw&field=email', 
      },
      'terms_conditions': "required",
    },
    messages: {
    },
  });


  /*
   * Order Pricing calculations
   */
  
  var order_calc_product_total = function (sku) {
    $quantity = $('#order_quantity_'+sku);
    $price = $('#price_'+sku);
    $total = $('#order_total_'+sku);

    $total.val(($price.val()*$quantity.val()).toFixed(2));
  };

  var order_calc_products_total = function () {
    var products_total = 0;
    $('input[id^=order_total_]').each(function () {
      products_total = parseFloat(products_total) + parseFloat($(this).val());
    });
    $('#order_products_total').val(products_total.toFixed(2));
  };

  var order_calc_tax = function () {
    var tax = $('#order_products_total').val() * $('#state_tax').val();
    $('#order_tax').val(tax.toFixed(2));
  };

  var order_calc_shipping = function () {
  };

  var order_update_total = function () {
    var order_total = parseFloat($('#order_products_total').val()) + parseFloat($('#order_tax').val()) + 
      parseFloat($('#order_shipping').val());
    $('#order_total').val(order_total.toFixed(2));
  };

  /*
   * Autoship Pricing calculations
   */

  var autoship_calc_product_total = function (sku) {
    $quantity = $('#autoship_quantity_'+sku);
    $price = $('#price_'+sku);
    $total = $('#autoship_total_'+sku);

    $total.val(($price.val()*$quantity.val()).toFixed(2));
  };

  var autoship_update_total = function () {
    var products_total = 0;
    $('input[id^=autoship_total_]').each(function () {
      products_total = parseFloat(products_total) + parseFloat($(this).val());
    });
    $('#autoship_total').val(products_total.toFixed(2));
  };


  /*
   * When product quantity is updated for order
   */
  $('input[name^=order[products]]').change(function (event) {
    var sku = $(event.target).attr('id').substr(-3)
    order_calc_product_total(sku);
  
    order_calc_products_total();
    order_calc_tax();
    order_calc_shipping();
    order_update_total();
  });

  /*
   * When product quantity is updated for autoship
   */
  $('input[name^=autoship[products]]').change(function (event) {
    var sku = $(event.target).attr('id').substr(-3)
    autoship_calc_product_total(sku);

    autoship_update_total();
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
    
        order_calc_tax();
        order_update_total();
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
      url: '/myzenvei/index.php?option=com_mlm&controller=ajax&task=productprices&format=json',
      data: ({ group: $this.val() }),
      success: function(data) {
        var prices = $.parseJSON(data);
        $.each(prices, function (i, price) {
          $('.price_'+price.sku).html(price.text_val);
          $('#price_'+price.sku).val(price.value);
          order_calc_product_total(price.sku);
          autoship_calc_product_total(price.sku);
        });
        order_calc_products_total();
        order_calc_tax();
        order_update_total();
        autoship_update_total();
      },
    });
  });
});
