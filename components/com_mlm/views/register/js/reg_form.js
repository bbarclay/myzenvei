jQuery(document).ready(function ($) {
  /*
   * Enable tabs
   */

  /*
   * Enable Datepicker
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

  // On form submit
  $('ref_form').submit(function () {
    /*
     * Copy shipping address values to billing address
     */
    if ($('#copy_shipping').attr('checked')) {
      $('#billing_state').html($('shipping_state').html());
      $('[name^=shipping_]').each( function() {
        var billingName = $(this).attr('name').replace(/^shipping\_/, 'billing_');
        $('[name=' + billingName + ']').val($(this).val());
      });
    }

    /*
     * Check inputs
     */
    return false;
  });

  /*
   * Pricing functionality:
   *   - Shipping Method
   *   - Tax
   *   - Group Prices
   */

  /*
   * On Enrollment Type Change
   */
  $('.etrigger').hide();
  $('#enrollment_type').change(function() {
    // Hide & Show fields according to the enrollment type
    var selected = $(this).val();
    $('.etrigger').hide();
    $('.'+selected).show();

    // Update prices for products
  });

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
      $status.load($status.attr('href'), { value: $field.val() } )
    }
  }

  $('#username').change(field_check);
  $('#replicated_site').change(field_check);
  $('#email').change(field_check);

});
