<?php defined('_JEXEC') or die('Restricted access'); ?>

<h1><?php echo JText::_('CLI_FORM_JOIN');?></h1>
<form id="reg_form" action="index.php?option=com_mlm&controller=user&task=register_save" method="POST">
  <?php echo JHTML::_('form.token'); ?>
  <div>
    <input id="referee" name="referee" value="<?php echo $this->referee ? $this->referee->id : 0 ?>" type="hidden" />
    <div>
      <h3>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Referring Associate Name: <?php echo $this->referee ? $this->referee->name : 'Not Applicable' ?></h3>
    </div>
    <div class="labeltop">
      <label class="lbl" for="enrollment_type">  <?php echo JText::_('CLI_FORM_TYPE');?>Enrollment Type:</label>
      <select id="enrollment_type" name="enrollment_type">
        <option value="">Please Select</option>
        <?php foreach ($this->shopper_groups as $group) { ?>
          <option value="<?php echo str_replace(' ', '_', strtolower($group->shopper_group_name)) ?>"><?php echo $group->shopper_group_name ?></option>
        <?php } ?>
      </select>
      <div>
        <p class="etrigger marketing_associate">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>MARKETING ASSOCIATE - $70 or more</p>
        <p class="etrigger business_associate">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>BUSINESS ASSOCIATE - $128 or more</p>
        <p class="etrigger preferred_customer">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Preferred Customer</p>
      </div>

      <div class="m10">&nbsp;</div>

      <!-- TODO -->
      <label class="lbl" for="builder_packs">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Builder Packs:</label>
      <select id="builder_packs" name="builder_pack">
        <option value="">Please Select</option>
      </select>
    </div>
  </div>
  
  <div id="tab-container" class="tabs">
    <ul>
      <li><a href="#todays_order"><span><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Today's Order</span></a></li>
      <li><a href="#monthly_autoship"><span><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Select Monthly AutoShip Program</span></a></li>
      <li><a href="#user_info"><span><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>User Information</span></a></li>
      <li><a href="#terms_conditions"><span><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Terms &amp; Conditions</span></a></li>
    </ul>
    <div id="todays_order">
      <div class="zn_title">
        <label for="shipping_method">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Shipping Method</label>
        <select id="shipping_method" name="order[shipping_method]">
          <option value="">Please Select</option>
          <?php foreach ($this->shipping_carriers as $carrier) { ?>
            <option value="<?php echo $carrier->shipping_carrier_id ?>"><?php echo $carrier->shipping_carrier_name ?></option>
          <?php } ?>
        </select>
      </div>
      <div>
        <?php foreach ($this->products as $product) { ?>
        <div class="zn_sp">
          <div class="zn_1"><?php echo $product->product_name ?></div>
          <div class="zn_2"><?php echo $product->product_s_desc ?></div>
          <div class="zn_3">
            <span class="zn_3a price_<?php echo $product->product_sku ?>"><?php echo $this->getCurrencySymbol($product->product_currency).sprintf('%.2f', $product->product_price); ?></span>
            <input id="order_total_<?php echo $product->product_sku ?>" class="zn_3b" type="hidden" value="0" />
          </div>
          <div class="zn_4">
            <input id="order_quantity_<?php echo $product->product_sku ?>" name="order[products][<?php echo $product->product_sku ?>]" type="text" value="0"/>
            <img class="quantity_add" src="components/com_mlm/views/register/images/ico_plus.png" />
            <img class="quantity_sub" src="components/com_mlm/views/register/images/ico_minus.png" />
          </div>
          <div class="zn_5"><img src="<?php echo $this->getProductImage($product->product_full_image, 'full') ?>" alt="<?php echo $product->product_name?>" /></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div id="monthly_autoship">
      <div class="zn_title">
        <label for="autoship_date">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Autoship Date</label>
        <select id="autoship_date" name="auto_ship[date]">
          <option value="">Please Select</option>
          <option value="10">10</option>
          <option value="20">20</option>
        </select>
      </div>
      <div class="zn_alert">
        <p>Your first order will ship immedialtely and on that date every month thereafter, until you contact Zenvei to cancel.</p>
        <p class="etrigger marketing_associate">To qualify as a Marketing Associate you must choose a combination of products totalying $70 or more. To enjoy the benefits of a Marketing Associate, your monthly qualifying purchase would be a combination of products totallying $70 or more.</p>
        <p class="etrigger business_associate">To qualify as a Business Associate you must choose a combination of products totallying $128 or more. To enjoy the benefits of a Business Associate, your monthly qualifying purchase would be a combination of products totallying $128 or more.</p>
        <p class="etrigger preferred_customer">If you are a signing up as a Preferred Customer then you can skip this if you do not wish to set up an AutoShip.</p>
      </div>
      <div>
        <?php foreach ($this->products as $product) { ?>
        <div class="zn_sp">
          <div class="zn_1"><?php echo $product->product_name ?></div>
          <div class="zn_2"><?php echo $product->product_s_desc ?></div>
          <div class="zn_3">
            <span class="zn_3a price_<?php echo $product->product_sku ?>"><?php echo $this->getCurrencySymbol($product->product_currency).sprintf('%.2f', $product->product_price); ?></span>
            <input id="autoship_total_<?php echo $product->product_sku ?>" class="zn_3b" type="hidden" value="0" />
          </div>
          <div class="zn_4">
            <input id="autoship_quantity_<?php echo $product->product_sku ?>" name="autoship[products][<?php echo $product->product_sku ?>]" type="text" value="0"/>
            <img class="quantity_add" src="components/com_mlm/views/register/images/ico_plus.png" />
            <img class="quantity_sub" src="components/com_mlm/views/register/images/ico_minus.png" />
          </div>
          <div class="zn_5"><img src="<?php echo $this->getProductImage($product->product_full_image, 'full') ?>" alt="<?php echo $product->product_name?>" /></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div id="user_info">
      <div class="zn_user">
        <fieldset>
          <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Step 1: User Information</legend>
          <ul>
            <li>
              <label for="username">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Username<em>*</em></label>
              <input id="username" type="text" name="user[username]"/>
            </li>
            <li class="etrigger marketing_associate business_associate">
              <label for="replicated_site">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Replicated Site ID<em>*</em></label>
              <input id="replicated_site" type="text"  name="user[replicated_site]"/>
            </li>
            <li>
              <label for="password">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Password<em>*</em></label>
              <input id="password" type="password" name="user[password]"/>
            </li>
            <li>
              <label for="verify_password">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Verify Password<em>*</em></label>
              <input id="verify_password" type="password" name="user[password2]"/>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Step 2: Personal Info (Secure)</legend>
          <fieldset>
            <ul>
              <li>
                <label for="business_signup">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Signup as Business</label>
                <input id="business_signup" type="checkbox" name="business_info[signup_as_business]" />
              </li>
              <li>
                <label for="first_name">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>First Name</label>
                <input id="first_name" type="text" name="user[first_name]"/>
              </li>
              <li>
                <label for="last_name">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Last Name</label>
                <input id="last_name" type="text" name="user[last_name]"/>
              </li>
              <li>
                <label for="birthday">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Birthday</label>
                <input id="birthday" type="text" name="user[birthday]" class="hasdatepicker"/>
              </li>
              <li class="business_signup">
                <label for="business_name">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Business Name</label>
                <input id="business_name" type="text" name="business[name]"/>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <ul>
              <li>
                <label for="email">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Email</label>
                <input id="email" type="text" name="user[email]" />
              </li>
              <li>
                <label for="confirm_email">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Confirm Email</label>
                <input id="confirm_email" type="text" name="user[confirm_email]"/>
              </li>
              <li class="business_signup">
                <label for="tax_id">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Tax ID.</label>
                <input id="tax_id" type="text" name="business[tax_id]"/>
              </li>
              <li class="business_signup">
                <label for="confirm_tax_id">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Confirm Tax ID.</label>
                <input id="confirm_tax_id" type="text" name="business[confirm_tax_id]"/>
              </li>
              <li class="user_signup">
                <label id="ssn_label" for="ssn">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>SSN/SIN</label>
                <input id="ssn" type="text" name="user[ssn]"/>
              </li>
              <li class="user_signup">
                <label for="confirm_ssn">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Confirm SSN/SIN</label>
                <input id="confirm_ssn" type="text" name="user[confirm_ssn]"/>
              </li>
              <li>
                <label for="day_phone">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Day Phone</label>
                <input id="day_phone" type="text" name="user[day_phone]"/>
              </li>
              <li>
                <label for="evening_phone">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Evening Phone</label>
                <input id="evening_phone" type="text" name="user[evening_phone]"/>
              </li>
              <li>
                <label for="cell_phone">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Cell Phone</label>
                <input id="cell_phone" type="text" name="user[cell_phone]" />
              </li>
              <li>
                <label for="fax_number">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Fax Number</label>
                <input id="fax_number" type="text" name="user[fax_number]"/>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Co-applicant Information (Optional)</legend>
            <ul>
              <li>
                <label for="coapplicant_first_name">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>First Name</label>
                <input id="coapplicant_first_name" type="text" name="coapplicant[fname]"/>
              </li>
              <li>
                <label for="coapplicant_last_name">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Last Name</label>
                <input id="coapplicant_last_name" type="text" name="coapplicant[lname]"/>
              </li>
              <li>
                <label for="coapplicant_birthday">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Birthday</label>
                <input id="coapplicant_birthday" type="text" name="coapplicant[birthday]" class="hasdatepicker"/>
              </li>
            </ul>
          </fieldset>
        </fieldset>
        <fieldset>
          <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Step 3: Payment Info (Secure)</legend>
          <fieldset>
            <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Shipping Address (No PO Boxes)</legend>
            <ul>
              <li>
                <label for="shipping_country">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Country</label>
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
              <li>
                <label for="shipping_addr_1">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Address 1</label>
                <input id="shipping_addr_1"  type="text" name="shipping[addr_1]"/>
              </li>
              <li>
                <label for="shipping_addr_2">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Address 2</label>
                <input id="shipping_addr_2"  type="text" name="shipping[addr_2]"/>
              </li>
              <li>
                <label for="shipping_city">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>City</label>
                <input id="shipping_city"  type="text" name="shipping[city]"/>
              </li>
              <li>
                <label for="shipping_state">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>State</label>
                <select id="shipping_state" name="shipping[state]">
                  <option value="">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Please Select</option>
                  <?php foreach ($this->states as $state) { ?>
                    <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
                  <?php } ?>
                </select>
              </li>
              <li>
                <label for="shipping_zip">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Zip</label>
                <input id="shipping_zip" name="shipping[zip]" type="text" />
              </li>

            </ul>
          </fieldset>
          <fieldset>
            <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Billing Address</legend>
            <ul>
              <li>
                <label for="copy_shipping">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Same as shipping</label>
                <input id="copy_shipping" name="copy_shipping" type="checkbox" />
              </li>
              <li class="billing_field">
                <label for="billing_addr_1">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Address 1</label>
                <input id="billing_addr_1" name="billing[addr_1]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_addr_2">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Address 2</label>
                <input id="billing_addr_2" name="billing[addr_2]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_city">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>City</label>
                <input id="billing_city" name="billing[city]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_state">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>State</label>
                <select id="billing_state" name="billing[state]">
                  <option value="">Please Select</option>
                  <?php foreach ($this->states as $state) { ?>
                    <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
                  <?php } ?>
                </select>
              </li>
              <li class="billing_field">
                <label for="billing_zip">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Zip</label>
                <input id="billing_zip" name="billing[zip]" type="text" />
              </li>
              <li class="billing_field">
                <label for="billing_country">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Country</label>
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
            <legend>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Credit Card Information:</legend>
            <ul>
              <li>
                <label for="card_type">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Card Type:</label>
                <select id="card_type" name="card[type]">
                  <option value="">Please Select</option>
                  <option value="AMEX">American Express</option>
                  <option value="Visa">Visa</option>
                  <option value="MasterCard">MasterCard</option>
                  <option value="Discover">Discover</option>
                </select>
              </li>
              <li>
                <label for="card_name">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Name on Card</label>
                <input id="card_name" type="text" name="card[name]"/>
              </li>
              <li>
                <label for="card_number">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Card Number</label>
                <input id="card_number" type="text" name="card[number]"/>
              </li>
              <li>
                <label for="card_expire_date">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Expiration Date</label>
                <input id="card_expire_date" type="text" name="card[expire_date]"/>
              </li>
              <li>
                <label for="card_csv">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>CSV (3 or 4 digits)</label>
                <input id="card_csv" type="text" name="card[csv]"/>
              </li>
            </ul>
          </fieldset>
        </fieldset>
      </div>
    </div>
    <div id="terms_conditions">
      <div class="zn_terms">
        <p>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>To become a Zenvei Associate, you must acknowledge that you have read, understand, and agree to the Terms &amp; Conditions. If you have not already done so, click on the links below to read and print these documents then check the boxes to indicate your agreement.</p>
        <p><input id="terms_conditions" type="checkbox" name="terms_conditions">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>I have read, understand and agree to abide by the terms set forth in the <a href="#">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Terms and Conditions</a>.</p>

        <input type="submit" value="Submit Now!">

        <p class="zn_approve">  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Congratulations! This will submit your enrollment and your order will be shipped within 72 hours. You should talk with your Referring Associate immediately for any questions and information you require. Thank you for your interest in Zenvei International!</p>
        <p class="zn_reject">Please note it may take a few moments to process your credit card. To avoid multiple charges, please do not click the continue button more than once.</p>
      </div>
      <div class="etrigger marketing_associate bussiness_associate">
        <h3>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Registration Fee</h3>
        <p>  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>An annual registration fee of $39.00 will be added to your registration order. This fee will be automatically renewed each year unless you cancel your Zenvei membership.</p>
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

<div id="zn_package">
  <table>
    <tbody>
    <tr id="row_signup_fee">
      <th class="border"><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Reg. Fee</td>
      <td class="border">$<span class="reg_fee">0.00</span></td>
    </tr>
    <tr>
      <th><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Bonus Pak Total:</td>
      <td class="border">$<span id="bonus_pak_total">0.00</span></td>
    </tr>
    <tr>
      <th><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Product Order</td>
      <td class="border">$<span class="order_products_total">0.00</span></td>
    </tr>
    <tr>
      <th class="border"><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Shipping</td>
      <td class="border">$<span class="order_shipping">0.00</span></td>
    </tr>
    <tr>
      <th><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Tax</td>
      <td>$<span class="order_tax">0.00</span></td>
    </tr>
    <tr>
      <th class="total"><?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>TOTAL</td>
      <td class="total">$<span class="order_total">0.00</span></td>
    </tr>
    </tbody>
  </table>
  <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>Your AutoShip order will be charged monthly at an amount of $<span class="autoship_total">0.00</span>
</div>

