<?php defined('_JEXEC') or die('Restricted access'); ?>

<form id="reg_form">
  <div>
    <div>
      <!-- TODO: referee -->
      <h3>Referring Associate Name: <?php echo $this->referee ?></h3>
    </div>
    <div>
      <label for="enrollment_type">Enrollment Type:</label>
      <select id="enrollment_type">
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

      <label for="builder_packs">Builder Packs</label>
      <select id="builder_packs">
        <option value="">Please Select</option>
        <option value="Marketing Associate">Marketing Associate</option>
        <option value="Business Associate">Business Associate</option>
        <option value="Master Builder Pak">Master Builder Pak</option>
        <option value="Mega Master Builder Pak">Mega Master Builder Pak</option>
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
        <select id="shipping_method">
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
          <div><?php echo $this->getCurrencySymbol($product->product_currency).sprintf('%.2f', $product->product_price); ?></div>
          <div><input type="text" name="products[<?php echo $product->product_sku ?>][quantity]" value="0"/></div>
          <div><img src="<?php echo $this->getProductImage($product->product_full_image, 'full') ?>" alt="<?php echo $product->product_name?>" /></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div id="monthly_order">
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
          <div><?php echo $this->getCurrencySymbol($product->product_currency).sprintf('%.2f', $product->product_price); ?></div>
          <div><input type="text" name="products[<?php echo $product->product_sku ?>][quantity]" value="0"/></div>
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
              <input id="username" type="text" />
              <span id="username_status" href="<?php echo '/myzenvei/index.php?option=com_mlm&controller=user&task=fieldcheck&format=raw' ?>"></span>
            </li>
            <li class="etrigger marketing_associate business_associate">
              <label for="replicated_site">Replicated Site ID<em>*</em></label>
              <input id="replicated_site" type="text" />
              <span id="replicated_site_status"<?php echo '/myzenvei/index.php?option=com_mlm&controller=user&task=fieldcheck&format=raw' ?>></span>
            </li>
            <li>
              <label for="password">Password<em>*</em></label>
              <input id="password" type="password" />
            </li>
            <li>
              <label for="verify_password">Verify Password<em>*</em></label>
              <input id="verify_password" type="password" />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <legend>Step 2: Personal Info (Secure)</legend>
          <fieldset>
            <ul>
              <li>
                <label for="business_signup">Signup as Business</label>
                <input id="business_signup" type="checkbox" />
              </li>
              <li>
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" />
              </li>
              <li>
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" />
              </li>
              <li>
                <label for="birthday">Birthday</label>
                <input id="birthday" type="text" />
              </li>
              <li class="business_signup">
                <label for="business_name">Business Name</label>
                <input id="business_name" type="text" />
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <ul>
              <li>
                <label for="email">Email</label>
                <input id="email" type="text" />
                <span id="email_status"<?php echo '/myzenvei/index.php?option=com_mlm&controller=user&task=fieldcheck&format=raw' ?>></span>
              </li>
              <li>
                <label for="confirm_email">Confirm Email</label>
                <input id="confirm_email" type="text" />
              </li>
              <li class="business_signup">
                <label for="tax_id">Tax ID.</label>
                <input id="tax_id" type="text" />
              </li>
              <li class="business_signup">
                <label for="confirm_tax_id">Confirm Tax ID.</label>
                <input id="confirm_tax_id" type="text" />
              </li>
              <li class="user_signup">
                <label id="ssn_label" for="ssn">SSN/SIN</label>
                <input id="ssn" type="text" />
              </li>
              <li class="user_signup">
                <label for="confirm_ssn">Confirm SSN/SIN</label>
                <input id="confirm_ssn" type="text" />
              </li>
              <li>
                <label for="day_phone">Day Phone</label>
                <input id="day_phone" type="text" />
              </li>
              <li>
                <label for="evening_phone">Evening Phone</label>
                <input id="evening_phone" type="text" />
              </li>
              <li>
                <label for="cell_phone">Cell Phone</label>
                <input id="cell_phone" type="text" />
              </li>
              <li>
                <label for="fax_number">Fax Number</label>
                <input id="fax_number" type="text" />
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <legend>Co-applicant Information (Optional)</legend>
            <ul>
              <li>
                <label for="coapplicant_first_name">First Name</label>
                <input id="coapplicant_first_name" type="text" />
              </li>
              <li>
                <label for="coapplicant_last_name">Last Name</label>
                <input id="coapplicant_last_name" type="text" />
              </li>
              <li>
                <label for="coapplicant_birthday">Birthday</label>
                <input id="coapplicant_birthday" type="text" />
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
                <input id="shipping_addr_1" name="shipping_addr_1" type="text" />
              </li>
              <li>
                <label for="shipping_addr_2">Address 2</label>
                <input id="shipping_addr_2" name="shipping_addr_2" type="text" />
              </li>
              <li>
                <label for="shipping_city">City</label>
                <input id="shipping_city" name="shipping_city" type="text" />
              </li>
              <li>
                <label for="shipping_state">State</label>
                <select id="shipping_state" name="shipping_state">
                  <option value="">Select a state</option>
                  <?php foreach ($this->states as $state) { ?>
                    <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
                  <?php } ?>
                </select>
              </li>
              <li>
                <label for="shipping_zip">Zip</label>
                <input id="shipping_zip" name="shipping_zip" type="text" />
              </li>
              <li>
                <label for="shipping_country">Country</label>
                <select id="shipping_country" name="shipping_country">
                  <option value="">Select a country</option>
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
                <input id="billing_addr_1" name="billing_addr_1" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_addr_2">Address 2</label>
                <input id="billing_addr_2" name="billing_addr_2" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_city">City</label>
                <input id="billing_city" name="billing_city" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_state">State</label>
                <select id="billing_state" name="billing_state">
                  <option value="">Select a state</option>
                  <?php foreach ($this->states as $state) { ?>
                    <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
                  <?php } ?>
                </select>
              </li>
              <li class="billing_field">
                <label for="billing_zip">Zip</label>
                <input id="billing_zip" name="billing_zip" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_country">Country</label>
                <select id="billing_country" name="billing_country">
                  <option value="">Select a country</option>
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
                <select id="card_type">
                  <option value="AMEX">American Express</option>
                  <option value="Visa">Visa</option>
                  <option value="MasterCard">MasterCard</option>
                  <option value="Discover">Discover</option>
                </select>
              </li>
              <li>
                <label for="card_name">Name on Card</label>
                <input id="card_name" type="text" />
              </li>
              <li>
                <label for="card_number">Card Number</label>
                <input id="card_number" type="text" />
              </li>
              <li>
                <label for="card_expire_date">Expiration Date</label>
                <input id="card_expire_date" type="text" />
              </li>
              <li>
                <label for="card_csv">CSV (3 or 4 digits)</label>
                <input id="card_csv" type="text" />
              </li>
            </ul>
          </fieldset>
        </fieldset>
      </div>
    </div>
    <div id="terms_conditions">
      <div>
        <p>To become a Zenvei Associate, you must acknowledge that you have read, understand, and agree to the Terms &amp; Conditions. If you have not already done so, click on the links below to read and print these documents then check the boxes to indicate your agreement.</p>
        <p><input id="terms_condition" type="checkbox" />I have read, understand and agree to abide by the terms set forth in the <a href="#">Terms and Conditions</a>.</p>

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
</form>
