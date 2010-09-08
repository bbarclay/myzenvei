<?php defined('_JEXEC') or die('Restricted access'); ?>

<h1>Join the Zenvei Team</h1>
<form id="reg_form" action="index.php?option=com_mlm&controller=user&task=register_save" method="POST">
  <?php echo JHTML::_( 'form.token' ); ?>
  <div>
    <input id="referee" name="referee" value="<?php echo $this->referee['id'] ?>" type="hidden" />
    <div>
      <h3>Referring Associate Name: <?php echo $this->referee['name'] ?></h3>
    </div>
    <div>
      <label for="enrollment_type">Enrollment Type:</label>
      <select id="enrollment_type" name="enrollment_type">
        <option value="">Please Select</option>
        <?php foreach ($this->shopper_groups as $group) { ?>
          <option value="<?php echo str_replace(' ', '_', strtolower($group->shopper_group_name)) ?>"><?php echo $group->shopper_group_name ?></option>
        <?php } ?>
      </select>
      <div>
        <p class="etrigger marketing_associate">MARKETING ASSOCIATE - $70 or more</p>
        <p class="etrigger business_associate">BUSINESS ASSOCIATE - $128 or more</p>
        <p class="etrigger preferred_customer">Preferred Customer</p>
      </div>

      <!-- TODO -->
      <label for="builder_packs">Builder Packs</label>
      <select id="builder_packs" name="builder_pack">
        <option value="">Please Select</option>
      </select>
    </div>
  </div>

  <div id="tabs">
    <ul>
      <li><a href="#todays_order"><span>Today's Order</span></a></li>
      <li><a href="#monthly_autoship"><span>Select Monthly AutoShip Program</span></a></li>
      <li><a href="#user_info"><span>User Information</span></a></li>
      <li><a href="#terms_conditions"><span>Terms &amp; Conditions</span></a></li>
    </ul>
    <div id="todays_order">
      <div>
        <label for="shipping_method">Shipping Method</label>
        <select id="shipping_method" name="order[shipping_method]">
          <option value="">Please Select</option>
          <?php foreach ($this->shipping_carriers as $carrier) { ?>
            <option value="<?php echo $carrier->shipping_carrier_id ?>"><?php echo $carrier->shipping_carrier_name ?></option>
          <?php } ?>
        </select>
      </div>
      <div>
        <?php foreach ($this->products as $product) { ?>
        <div>
          <div><?php echo $product->product_name ?></div>
          <div><?php echo $product->product_s_desc ?></div>
          <div>
            <span class="price_<?php echo $product->product_sku ?>"><?php echo $this->getCurrencySymbol($product->product_currency).sprintf('%.2f', $product->product_price); ?></span>
            <input id="order_total_<?php echo $product->product_sku ?>" type="hidden" value="0" />
          </div>
          <div><input id="order_quantity_<?php echo $product->product_sku ?>" name="order[products][<?php echo $product->product_sku ?>]" type="text" value="0"/> <a class="quantity_add" href="#">+</a> <a class="quantity_sub" href="#">-</a></div>
          <div><img src="<?php echo $this->getProductImage($product->product_full_image, 'full') ?>" alt="<?php echo $product->product_name?>" /></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div id="monthly_autoship">
      <div>
        <label for="autoship_date">Autoship Date</label>
        <select id="autoship_date" name="auto_ship[date]">
          <option value="">Please Select</option>
          <option value="10">10</option>
          <option value="20">20</option>
        </select>
      </div>
      <div>
        <p>Your first order will ship immedialtely and on that date every month thereafter, until you contact Zenvei to cancel.</p>
        <p class="etrigger marketing_associate">To qualify as a Marketing Associate you must choose a combination of products totalying $70 or more. To enjoy the benefits of a Marketing Associate, your monthly qualifying purchase would be a combination of products totallying $70 or more.</p>
        <p class="etrigger business_associate">To qualify as a Business Associate you must choose a combination of products totallying $128 or more. To enjoy the benefits of a Business Associate, your monthly qualifying purchase would be a combination of products totallying $128 or more.</p>
        <p class="etrigger preferred_customer">If you are a signing up as a Preferred Customer then you can skip this if you do not wish to set up an AutoShip.</p>
      </div>
      <div>
        <?php foreach ($this->products as $product) { ?>
        <div>
          <div><?php echo $product->product_name ?></div>
          <div><?php echo $product->product_s_desc ?></div>
          <div>
            <span class="price_<?php echo $product->product_sku ?>"><?php echo $this->getCurrencySymbol($product->product_currency).sprintf('%.2f', $product->product_price); ?></span>
            <input id="autoship_total_<?php echo $product->product_sku ?>" type="hidden" value="0" />
          </div>
          <div><input id="autoship_quantity_<?php echo $product->product_sku ?>" name="autoship[products][<?php echo $product->product_sku ?>]" type="text" value="0"/> <a class="quantity_add" href="#">+</a> <a class="quantity_sub" href="#">-</a></div>
          <div><img src="<?php echo $this->getProductImage($product->product_full_image, 'full') ?>" alt="<?php echo $product->product_name?>" /></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div id="user_info">
      <div>
        <fieldset>
          <legend>Step 1: User Information</legend>
          <ul>
            <li>
              <label for="username">Username<em>*</em></label>
              <input id="username" type="text" name="user_info[username]"/>
              <span id="username_status"></span>
            </li>
            <li class="etrigger marketing_associate business_associate">
              <label for="replicated_site">Replicated Site ID<em>*</em></label>
              <input id="replicated_site" type="text"  name="user_info[replicated_site]"/>
              <span id="replicated_site_status"></span>
            </li>
            <li>
              <label for="password">Password<em>*</em></label>
              <input id="password" type="password" name="user_info[password]"/>
            </li>
            <li>
              <label for="verify_password">Verify Password<em>*</em></label>
              <input id="verify_password" type="password" name="user_info[password2]"/>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <legend>Step 2: Personal Info (Secure)</legend>
          <fieldset>
            <ul>
              <li>
                <label for="business_signup">Signup as Business</label>
                <input id="business_signup" type="checkbox" name="business_info[signup_as_business]" />
              </li>
              <li>
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" name="business_info[first_name]"/>
              </li>
              <li>
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" name="business_info[last_name]"/>
              </li>
              <li>
                <label for="birthday">Birthday</label>
                <input id="birthday" type="text" name="business_info[birthday]"/>
              </li>
              <li class="business_signup">
                <label for="business_name">Business Name</label>
                <input id="business_name" type="text" name="business_info[business_name]"/>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <ul>
              <li>
                <label for="email">Email</label>
                <input id="email" type="text" name="user_info[email]" />
                <span id="email_status"></span>
              </li>
              <li>
                <label for="confirm_email">Confirm Email</label>
                <input id="confirm_email" type="text" name="user_info[confirm_email]"/>
              </li>
              <li class="business_signup">
                <label for="tax_id">Tax ID.</label>
                <input id="tax_id" type="text" name="business_info[tax_id]"/>
              </li>
              <li class="business_signup">
                <label for="confirm_tax_id">Confirm Tax ID.</label>
                <input id="confirm_tax_id" type="text" name="business_info[confirm_tax_id]"/>
              </li>
              <li class="user_signup">
                <label id="ssn_label" for="ssn">SSN/SIN</label>
                <input id="ssn" type="text" name="business_info[ssn]"/>
              </li>
              <li class="user_signup">
                <label for="confirm_ssn">Confirm SSN/SIN</label>
                <input id="confirm_ssn" type="text" name="business_info[confirm_ssn]"/>
              </li>
              <li>
                <label for="day_phone">Day Phone</label>
                <input id="day_phone" type="text" name="business_info[day_phone]"/>
              </li>
              <li>
                <label for="evening_phone">Evening Phone</label>
                <input id="evening_phone" type="text" name="business_info[evening_phone]"/>
              </li>
              <li>
                <label for="cell_phone">Cell Phone</label>
                <input id="cell_phone" type="text" name="business_info[cell_phone]" />
              </li>
              <li>
                <label for="fax_number">Fax Number</label>
                <input id="fax_number" type="text" name="business_info[fax_number]"/>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <legend>Co-applicant Information (Optional)</legend>
            <ul>
              <li>
                <label for="coapplicant_first_name">First Name</label>
                <input id="coapplicant_first_name" type="text" name="coapplicant[fname]"/>
              </li>
              <li>
                <label for="coapplicant_last_name">Last Name</label>
                <input id="coapplicant_last_name" type="text" name="coapplicant[lname]"/>
              </li>
              <li>
                <label for="coapplicant_birthday">Birthday</label>
                <input id="coapplicant_birthday" type="text" name="coapplicant[birthday]"/>
              </li>
            </ul>
          </fieldset>
        </fieldset>
        <fieldset>
          <legend>Step 3: Payment Info (Secure)</legend>
          <fieldset>
            <legend>Shipping Address (No PO Boxes)</legend>
            <ul>
              <li>
                <label for="shipping_addr_1">Address 1</label>
                <input id="shipping_addr_1"  type="text" name="shipping[addr_1]"/>
              </li>
              <li>
                <label for="shipping_addr_2">Address 2</label>
                <input id="shipping_addr_2"  type="text" name="shipping[addr_2]"/>
              </li>
              <li>
                <label for="shipping_city">City</label>
                <input id="shipping_city"  type="text" name="shipping[city]"/>
              </li>
              <li>
                <label for="shipping_state">State</label>
                <select id="shipping_state" name="shipping[state]">
                  <option value="">Please Select</option>
                  <?php foreach ($this->states as $state) { ?>
                    <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
                  <?php } ?>
                </select>
              </li>
              <li>
                <label for="shipping_zip">Zip</label>
                <input id="shipping_zip" name="shipping[zip]" type="text" />
              </li>
              <li>
                <label for="shipping_country">Country</label>
                <select id="shipping_country" name="shipping[country]">
                  <option value="">Please Select</option>
                  <?php foreach ($this->countries as $country) { ?>
                    <?php if ($country->country_3_code == $this->default_country) { ?>
                      <option value="<?php echo $country->country_3_code ?>" selected="selected"><?php echo $country->country_name ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $country->country_3_code ?>"><?php echo $country->country_name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <legend>Billing Address</legend>
            <ul>
              <li>
                <label for="copy_shipping">Same as shipping</label>
                <input id="copy_shipping" name="copy_shipping" type="checkbox" />
              </li>
              <li class="billing_field">
                <label for="billing_addr_1">Address 1</label>
                <input id="billing_addr_1" name="billing[addr_1]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_addr_2">Address 2</label>
                <input id="billing_addr_2" name="billing[addr_2]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_city">City</label>
                <input id="billing_city" name="billing[city]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_state">State</label>
                <select id="billing_state" name="billing[state]">
                  <option value="">Please Select</option>
                  <?php foreach ($this->states as $state) { ?>
                    <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
                  <?php } ?>
                </select>
              </li>
              <li class="billing_field">
                <label for="billing_zip">Zip</label>
                <input id="billing_zip" name="billing[zip]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_country">Country</label>
                <select id="billing_country" name="billing[country]">
                  <option value="">Please Select</option>
                  <?php foreach ($this->countries as $country) { ?>
                    <?php if ($country->country_3_code == $this->default_country) { ?>
                      <option value="<?php echo $country->country_3_code ?>" selected="selected"><?php echo $country->country_name ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $country->country_3_code ?>"><?php echo $country->country_name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <legend>Credit Card Information:</legend>
            <ul>
              <li>
                <label for="card_type">Card Type:</label>
                <select id="card_type" name="card[type]">
                  <option value="">Please Select</option>
                  <option value="AMEX">American Express</option>
                  <option value="Visa">Visa</option>
                  <option value="MasterCard">MasterCard</option>
                  <option value="Discover">Discover</option>
                </select>
              </li>
              <li>
                <label for="card_name">Name on Card</label>
                <input id="card_name" type="text" name="card[name]"/>
              </li>
              <li>
                <label for="card_number">Card Number</label>
                <input id="card_number" type="text" name="card[number]"/>
              </li>
              <li>
                <label for="card_expire_date">Expiration Date</label>
                <input id="card_expire_date" type="text" name="card[expire_date]"/>
              </li>
              <li>
                <label for="card_csv">CSV (3 or 4 digits)</label>
                <input id="card_csv" type="text" name="card[csv]"/>
              </li>
            </ul>
          </fieldset>
        </fieldset>
      </div>
    </div>
    <div id="terms_conditions">
      <div>
        <p>To become a Zenvei Associate, you must acknowledge that you have read, understand, and agree to the Terms &amp; Conditions. If you have not already done so, click on the links below to read and print these documents then check the boxes to indicate your agreement.</p>
        <p><input id="terms_conditions" type="checkbox" name="terms_conditions"/>I have read, understand and agree to abide by the terms set forth in the <a href="#">Terms and Conditions</a>.</p>

        <input type="submit" value="Submit Now!" />

        <p>Congratulations! This will submit your enrollment and your order will be shipped within 72 hours. You should talk with your Referring Associate immediately for any questions and information you require. Thank you for your interest in Zenvei International!</p>
        <p class="red">Please note it may take a few moments to process your credit card. To avoid multiple charges, please do not click the continue button more than once.</p>
      </div>
      <div class="etrigger marketing_associate bussiness_associate">
        <h3>Registration Fee</h3>
        <p>An annual registration fee of $39.00 will be added to your registration order. This fee will be automatically renewed each year unless you cancel your Zenvei membership.</p>
      </div>
    </div>
  </div>

  <!-- BEGIN: Used for calculations -->
  <input id="state_tax" value="0" type="hidden" />
  
  <?php foreach ($this->products as $product) { ?>
  <input id="price_<?php echo $product->product_sku ?>" value="<?php echo sprintf('%.2f', $product->product_price) ?>" type="hidden" />
  <?php } ?>
  
  <input id="order_products_total" type="hidden" value="0" />
  <input id="order_tax" type="hidden" value="0" />
  <input id="order_shipping" type="hidden" value="0" />
  <input id="order_total" type="hidden" value="0" />

  <input id="autoship_total" type="hidden" value="0" />
  <!-- END: Used for calculations -->

</form>
