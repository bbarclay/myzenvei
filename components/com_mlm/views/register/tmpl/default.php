<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php echo('Restricted access'); ?>

<div id="container">
  <form id="ref_form" action="<?php echo JRoute::_('index.php?option=com_mlm&controller=user'); ?>" method="post">

  <input type="hidden" name="task" value="register_save" />

  <input type="hidden" name="referee" value="<?php echo $this->referee['id']; ?>" />

  <h1>Join the ZENVEI Team</h1>

  <div><h3><?php echo JText::_('CLI_STEP4_HEAD');?></h3><?php echo $this->referee['name']; ?>

    <h3>Enrollment Type:</h3>
    <p>
      <span class="bus">BUSINESS</span>
      <span class="mar">MARKETING</span>
      <span class="noauto" style="display:none;">MARKETING</span>
      ASSOCIATE - <?php echo JText::_('CUSTOM');?>$
      <span class="bus">128</span>
      <span class="mar">70</span>
      <span class="noauto" style="display:none;">0</span>
     or more </p>

    <p><?php echo JText::_('CLI_FORM_D1_HEAD');?></p>
      <select name="drop1" id="drop1" onChange="Changedrop2options(this,'drop2');">
      <option value="<?php echo JText::_('CLI_FORM_D1_OPTION0');?>"><?php echo JText::_('CLI_FORM_D1_OPTION0');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D1_OPTION1');?>"><?php echo JText::_('CLI_FORM_D1_OPTION1');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D1_OPTION2');?>"><?php echo JText::_('CLI_FORM_D1_OPTION2');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D1_OPTION3');?>"><?php echo JText::_('CLI_FORM_D1_OPTION3');?></option>
      </select>
    <br>
    <p><?php echo JText::_('CLI_FORM_D2_HEAD');?></p>
      <select name="drop2" id="drop2" onChange="Changedrop1options(this,'drop1');">
      <option value="<?php echo JText::_('CLI_FORM_D1_OPTION0');?>" selected><?php echo JText::_('CLI_FORM_D1_OPTION0');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D2_OPTION1');?>"><?php echo JText::_('CLI_FORM_D2_OPTION1');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D2_OPTION2');?>"><?php echo JText::_('CLI_FORM_D2_OPTION2');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D2_OPTION3');?>"><?php echo JText::_('CLI_FORM_D2_OPTION3');?></option>
      <option value="<?php echo JText::_('CLI_FORM_D2_OPTION4');?>"><?php echo JText::_('CLI_FORM_D2_OPTION4');?></option>
    </select>

  
  <p><?php echo JText::_('CLI_FORM_D3_HEAD');?></p>
    <p> 
      <select name="vm_autoship_date" id="vm_autoship_date">
        <option value="10">10th</option>
        <option value="20">20th</option>     
      </select>
      
    </p>
    <p>&nbsp;</p>
    <p><?php echo JText::_('CLI_FORM_PREF_LINK');?></p>
    <p>&nbsp;</p>

  <table cellspacing="0" width="70">
    <tr>
      <td width="686" colspan="5" class="bold">


<div id="mainbody">
  <div id="flip-tabs">
    <ul id="flip-navigation">
      <li class="selected"><a href="#" id="tab-0">Todays Order</a></li>
      <li><a href="#" id="tab-1" >Future Autoship</a></li>
      <li><a href="#" id="tab-2" >User Information</a></li>
      <li><a href="#" id="tab-3">Terms</a></li>
    </ul>
    <div id="flip-container" >
    <div>
        <ul class="blue">
          <table cellspacing="0" width="70">
          <tr>
                      <td>*Shipping Method</td>
                      <td><select name="ship_method" id="ship_method">
                        <option value="">Select Shipping Method</option>
                        <option value="US Mail">US Mail</option>
             <option value="Will-Call">Will-Call</option>
                        </select>
                      </td>
           </tr>
           <tr>
            <td>&nbsp;</td>
           </tr>
                    <tr>
                      <td width="98" class="bold">ZENVEI RED</td>
                      <td width="215">Improves and maintains cardiovascular function. </td>
                      <td width="30" align="left" class="b">$<span id="rprice">32</span>
                       </td>
                      <td width="118">
            <input type="text" class="inputboxquantity" size="4" id="red_qty" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('red_qty');" />
            <input type="button" class="down_arrow" onclick="_down('red_qty');" />
                      </td>
                      <td width="225"><img src="../images/red_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI BLUE</td>
                      <td>Immunity, brain function and cell therapy</td>
                      <td align="left" class="b">$<span id="bprice">35</span></td>
                      <td>
            <input type="text" class="inputboxquantity" size="4" id="blue_qty" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('blue_qty')" />
            <input type="button" class="down_arrow" onclick="_down('blue_qty')" />
            </td>
                      <td><img src="../images/blue_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI GREEN </td>
                      <td>Cellular detoxification</td>
                      <td align="left" class="b">$<span id="gprice">32</span></td>
                      <td>
            <input type="text" class="inputboxquantity" size="4" id="green_qty" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('green_qty')" />
            <input type="button" class="down_arrow" onclick="_down('green_qty')" />
            </td>
                      <td><img src="../images/green_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI SILVER</td>
                      <td>True Colloidal Silver</td>
                      <td align="left" class="b">$<span id="sprice">32</span></td>
                      <td>
            <input type="text" class="inputboxquantity" size="4" id="silver_qty" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"  onclick="_up('silver_qty')" />
            <input type="button" class="down_arrow" onclick="_down('silver_qty')" />
            </td>
                      <td><img src="../images/silver_bottle.png" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
      </ul>
      </div>
    <div>
        <ul class="green">
           <h3>Select Monthly AutoShip Program.</h3>
    <p>Your first order will ship immedialtely and on that date every month thereafter, until you contact Zenvei<br /> to cancel. </p>
    <p>To qualify as a <span class="bus">Business</span><span class="mar">MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  Associate you must choose a combination of products totallying $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span></p>
    <p> or more. 
      To enjoy the benefits of a <span class="bus">Business</span><span class="mar">MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  Associate, your monthly qualifying purchase</p>
    <p> would be a combination 
      of products totallying $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span> or more.</p>
    <p>&nbsp;</p>
 
  <p>===============================================================================</p>
        <table cellspacing="0" width="70">
          <tr>
                      <td>*Shipping Method</td>
                      <td><select name="ship_method2" id="ship_method2">
                        <option value="">Select Shipping Method</option>
                        <option value="US Mail">US Mail</option>
             <option value="Will-Call">Will-Call</option>
                        </select>
                      </td>
           </tr>
           <tr>
            <td>This field is required</td>
           </tr>
                    <tr>
                      <td width="98" class="bold">ZENVEI RED</td>
                      <td width="215">Improves and maintains cardiovascular function. </td>
                      <td width="30" align="left" class="b">$<span id="rprice2">32</span>
                          <!--<span class="bus">32</span><span class="mar">35</span> --></td>
                      <td width="118">
            <input type="text" class="inputboxquantity" size="4" id="red_qty2" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('red_qty2');" />
            <input type="button" class="down_arrow" onclick="_down('red_qty2');" />
                      </td>
                      <td width="225"><img src="../images/red_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI BLUE</td>
                      <td>Immunity, brain function and cell therapy</td>
                      <td align="left" class="b">$<span id="bprice2">35</span></td>
                      <td>
            <input type="text" class="inputboxquantity" size="4" id="blue_qty2" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('blue_qty2');" />
            <input type="button" class="down_arrow" onclick="_down('blue_qty2');" />
            </td>
                      <td><img src="../images/blue_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI GREEN </td>
                      <td>Cellular detoxification</td>
                      <td align="left" class="b">$<span id="gprice2">32</span></td>
                      <td>
              <input type="text" class="inputboxquantity" size="4" id="green_qty2" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('green_qty2');" />
            <input type="button" class="down_arrow" onclick="_down('green_qty2');" />
            </td>
                      <td><img src="../images/green_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI SILVER</td>
                      <td>True Colloidal Silver</td>
                      <td align="left" class="b">$<span id="sprice2">32</span></td>
                      <td>
            <input type="text" class="inputboxquantity" size="4" id="silver_qty2" name="quantity[]" value="0" />
            <input type="button" class="up_arrow"   onclick="_up('silver_qty2');" />
            <input type="button" class="down_arrow" onclick="_down('silver_qty2');" />
            </td>
                      <td><img src="../images/silver_bottle.png" alt="" width="225" height="236" /></td>
                    </tr>
          <tr>
                      </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
        </ul>
      </div>
      
      <div>
        <ul class="user">
         <div>
          <table cellspacing="0" width="100%">        
          <tr>
            <td colspan="2"><h3>Step 1: User Information </h3></td>
            <td colspan="2" class="bold">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div id="status">  &nbsp;</div></td>
            <td colspan="2"><div id="replicated_status">  &nbsp;</div></td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DF_USERNAME');?></td>
            <td>
              <input id="username"  type="text" name="username[]" onKeyUp="checkUsername(this.value)" />     </td>
            <td><?php echo JText::_('CLI_DF_SITEID');?></td>
            <td><input id="replicated_siteid"  type="text" name="replicated_siteid[]" onKeyUp="checkRep(this.value)" /></td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DF_PASSWORD');?></td>
            <td><input name="password[]" type="password" id="password" /></td>
            <td><?php echo JText::_('CLI_DF_VERIFYPASSWORD');?> </td>
          <td class="bold"><input name="vpassword[]" type="password" id="vpassword" /></td>
          </tr>
          <tr>
            <td colspan="2"><h3><?php echo JText::_('CLI_DF_STEP2_HEAD');?></h3></td>
            <td colspan="2" class="bold">Signup as Business
            <input name="as_buss[]" type="checkbox" class="check" id="as_buss" value="1" /></td>
          </tr>
          <tr>
            <td width="15%" height="30"><?php echo JText::_('CLI_DF_FIRSTNAME');?></td>
            <td width="33%">
            <input name="fname[]" type="text" id="fname" />          </td>
            <td width="17%"><?php echo JText::_('CLI_DF_LASTNAME');?> </td>
            <td width="35%"><input name="lname[]" type="text" id="lname" /></td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DF_BIRTH');?> </td>
            <td><input name="b_day2[]" type="text"  id="b_day2" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr id="buss_name_field">
            <td><?php echo JText::_('CLI_DF_BUSINESS_NAME');?></td>
            <td colspan="3"><input name="buss_name[]" type="text" class="large" id="buss_name" /></td>
          </tr>   
          <tr>
            <td colspan="2"><div id="email_status"></div></td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DF_EMAIL');?></td>
            <td><input name="email[]" type="text" id="email" onBlur="checkEmail(this.value)" /><br /><span id="email_err"></span></td>
            <td><?php echo JText::_('CLI_DF_CONFIRM_EMAIL');?></td>
            <td><input name="c_email[]" type="text" id="c_email" /></td>
          </tr>
          <tr>
            <td><span class="ssn_text"><?php echo JText::_('CLI_DF_SSN');?></span> </td>
            <td><input name="ssn[]" type="text" id="ssn" /></td>
            <td>Confirm <span class="ssn_text"><?php echo JText::_('CLI_DF_SSN');?></span> </td>
            <td><input name="c_ssn[]" type="text" id="c_ssn" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="bold"><?php echo JText::_('CLI_WHY_SSN');?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DAYTIME_PHONE');?> </td>
            <td><input name="day_phone[]" type="text" id="day_phone" /></td>
            <td><?php echo JText::_('CLI_EVE_PHONE');?> </td>
            <td><input name="even_phone[]" type="text" id="even_phone" /></td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_CELL_PHONE');?> </td>
            <td><input name="cell[]" type="text" id="cell" /></td>
            <td><?php echo JText::_('CLI_FAX_NUMBER');?> </td>
            <td><input name="fax[]" type="text" id="fax" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="bold"><?php echo JText::_('CLI_COAPP_INFO');?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DF_FIRSTNAME');?> </td>
            <td><input name="fname_co[]" type="text" id="fname_co" /></td>
            <td><?php echo JText::_('CLI_DF_LASTNAME');?></td>
            <td><input name="lname_co[]" type="text" id="lname_co" /></td>
          </tr>
          <tr>
            <td><?php echo JText::_('CLI_DF_BIRTH');?> </td>
            <td><input name="b_day_co[]" type="text" id="b_day_co" /></td>
           </tr>
           <tr>
            <td><?php echo JText::_('CLI_FORM_D1_OPTION2');?>/<?php echo JText::_('CLI_DF_LASTNAME');?></td>
           </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </div>
<!--end step2 -->
<!--step3 starts -->
<div id="step3">
     <h3><?php echo JText::_('CLI_STEP3_HEADER');?> </h3>
    <table cellspacing="0" width="96%">
        <tr>
          <td colspan="2" class="bold">Shipping Address: (No PO Boxes)</td>
          <td width="156"></td>
          <td width="252"></td>
        </tr>
        <tr>
          <td width="147"><?php echo JText::_('CLI_SHIP_ADDRESS1');?> </td>
          <td colspan="3"><input name="add1_ship[]" type="text" class="large" id="add1_ship" /></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_SHIP_ADDRESS2');?>  </td>
          <td colspan="3"><input name="add2_ship[]" type="text" class="large" id="add2_ship" /></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CITY');?> </td>
          <td width="275"><input name="city_ship[]" type="text" id="city_ship" /></td>
          <td><?php echo JText::_('CLI_STATE');?></td>
          <td><select name="state_ship[]" id="state_ship">
            <option value="">Select a state</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="DC">Washington D.C.</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select></td>
        </tr>
        <tr>
          <td height="63">Zip:</td>
          <td><input name="zip_ship[]" type="text" id="zip_ship" /></td>
          <td>Country: </td>
          <td><input name="country_ship[]" type="text" id="country_ship"  value="USA"/></td>
        </tr>
        <tr>
          <td height="63"></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td height="63" class="bold">Billing Address:</td>
          <td valign="top">Same as shipping          
          <input name="same_as_ship[]" type="checkbox" class="check" id="same_as_ship" value="1" /></td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td>Address 1: </td>
          <td colspan="3"><input name="add1_bill[]" type="text" class="large" id="add1_bill" /></td>
        </tr>
        <tr>
          <td>Address 2: </td>
          <td colspan="3"><input name="add2_bill[]" type="text" class="large" id="add2_bill" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city_bill[]" type="text" id="city_bill" /></td>
          <td>State:</td>
          <td><select name="state_bill[]" id="state_bill">
              <option value="">Select a state</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="DC">Washington D.C.</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
          </select></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_ZIPCODE');?></td>
          <td><input name="zip_bill[]" type="text" id="zip_bill" /></td>
          <td><?php echo JText::_('CLI_COUNTRY');?> </td>
          <td><input name="country_bill[]" type="text" id="country_bill" value="USA" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" class="bold">&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" class="bold"><?php echo JText::_('CLI_CC_INFO');?></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CC_TYPE');?> </td>
          <td>
            <select name="card_type[]" id="card_type">
              <option value="AMEX">American Express</option>
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Discover">Discover</option>
            </select>
          </td>
          <td><?php echo JText::_('CLI_NAME_ON_CARD');?> </td>
          <td><input name="name_card[]" type="text" id="name_card" /></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CC_NUMBER');?> </td>
          <td><input name="card_no[]" type="text" id="card_no" maxlength="18" /></td>
          <td><?php echo JText::_('CLI_EXP_DATE');?></td>
          <td>
      <select id="expire_date[]" name="expire_date">
      <option value=''><?php echo JText::_('CLI_FORM_D1_OPTION0');?></option>
    <option value='01'>January</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
    </select>
/
    <select id="expire_year[]" name="expire_year">
    <option value='2010'>2010</option>
    <option value='2011'>2011</option>
    <option value='2012'>2012</option>
    <option value='2013'>2013</option>
    <option value='2014'>2014</option>
    <option value='2015'>2015</option>

    </select>


</td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CSV');?></td>
          <td><input name="csv[]" type="text" id="csv" maxlength="18" /></td>
          <td></td>
          <td></td>
        </tr>
    </table>
</div>  
        </ul>
      </div>
      <div>
      <ul class="terms">
        <h2><?php echo JText::_('CLI_STEP4_TERMS');?> 
        <p>&nbsp;</p>

        <p><input name="terms_condition[]" type="checkbox" class="check" id="terms_condition" /> &nbsp;<?php echo JText::_('CLI_STEP4_AFTERCHECK');?><p class="ecxecxMsoNormal"> </p>
        <p class="ecxecxMsoNormal"><a rel="lightbox" href="https://www.zenvei.com/index.php?option=com_content&amp;view=article&amp;id=44" class="jcepopup"><?php echo JText::_('CLI_STEP4_TERMS_CLICK');?></a></p>
        <p class="ecxecxMsoNormal"> </p></p>
        <p>&nbsp;</p>
        <input type="submit" value="<?php echo JText::_('CLI_SUBMITNOW');?>" name="Submit" />
        <p>&nbsp;</p> 

        <?php echo JText::_('CLI_CONGRATS');?>
      <div> <?php include('../jumi_include.php') ;?> </div>
      <p>&nbsp;</p>
      <p>==============================================================================</p>
       <h3><?php echo JText::_('CLI_REGFEE_HEAD');?> </h3>
      <?php echo JText::_('CLI_REGFEE_BODY');?>
      <p>&nbsp;</p>
    
    
      </ul>
      </div>
  </div>
  </div>
  </div>
  </form> 
      </td>
    </tr>
  </table> 
  
</div>
<div id="footer" class="footer"><input type="button" class="previous" onClick="_previous();" name="Previous" value="Previous">&nbsp;&nbsp;&nbsp;<input type="button" class="next" onClick="_next();" name="Next" value="Next"></div><br>
<!--ends step 1 -->
</div>
<!--container div ends -->
    

<!--footer div start -->

<!--end footer -->

<div id="package">
    <table width="180" cellpadding="0" cellspacing="0">
        <tr id="row_signup_fee">
            <td valign="bottom" style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                <?php echo JText::_('CLI_FLOAT_REG');?>

            </td>
            <td valign="bottom" align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="fee_amount" style="font-weight: bold;">$39.00</span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>
            </td>
            <td align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="order_amount" style="font-weight: bold;">$<span id="products_total">0.00</span></span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
               <?php echo JText::_('CLI_FLOAT_SHIPPING');?>
            </td>
            <td align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="shipping_amount" style="font-weight: bold;">0.00</span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
               <?php echo JText::_('CLI_FLOAT_TAX');?>
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="tax_amount" style="font-weight: bold;">0.00</span>
            </td>
        </tr>
        <tr>
            <td align="right" style="color: #64184c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; font-weight: bold; font-size: 14px;">
                <img src="../images/arrow.png" width="8" height="9" alt="" style="margin-right: 4px;" /><?php echo JText::_('CLI_FLOAT_TOTAL');?>
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="total_amount" style="font-weight: bold; font-size: 14px;">39.00</span>
            </td>
        </tr>
    </table>
        <?php echo JText::_('CLI_FLOAT_FUTURE_AUTO_VALUE');?> <span id="autoship_amount">
            0.00</span>
</div>

