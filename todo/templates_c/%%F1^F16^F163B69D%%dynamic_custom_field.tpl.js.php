<?php /* Smarty version 2.6.18, created on 2010-07-29 16:16:02
         compiled from js/dynamic_custom_field.tpl.js */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'js/dynamic_custom_field.tpl.js', 22, false),array('block', 't', 'js/dynamic_custom_field.tpl.js', 72, false),)), $this); ?>
var dynamic_options = new Array();

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['fields']['iteration']++;
?>
i = dynamic_options.length;
dynamic_options[i] = new Object();
dynamic_options[i].target_field_id = <?php echo $this->_tpl_vars['field']['fld_id']; ?>
;
dynamic_options[i].fld_type = '<?php echo $this->_tpl_vars['field']['fld_type']; ?>
';
dynamic_options[i].controlling_field_id = '<?php echo $this->_tpl_vars['field']['controlling_field_id']; ?>
';
dynamic_options[i].controlling_field_name = '<?php echo $this->_tpl_vars['field']['controlling_field_name']; ?>
';
dynamic_options[i].hide_when_no_options = '<?php echo $this->_tpl_vars['field']['hide_when_no_options']; ?>
';
dynamic_options[i].lookup_method = '<?php echo $this->_tpl_vars['field']['lookup_method']; ?>
';
dynamic_options[i].groups = new Array();
    <?php $_from = $this->_tpl_vars['field']['structured_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['group']):
?>
    j = dynamic_options[i].groups.length;
    dynamic_options[i].groups[j] = new Object();
    dynamic_options[i].groups[j].keys = new Array();
        <?php $_from = $this->_tpl_vars['group']['keys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key']):
?>
        dynamic_options[i].groups[j].keys[dynamic_options[i].groups[j].keys.length] = '<?php echo $this->_tpl_vars['key']; ?>
';
        <?php endforeach; endif; unset($_from); ?>
    dynamic_options[i].groups[j].options = new Array();
        <?php $_from = $this->_tpl_vars['group']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option_value'] => $this->_tpl_vars['option']):
?>
        dynamic_options[i].groups[j].options[dynamic_options[i].groups[j].options.length] = new Option('<?php echo ((is_array($_tmp=$this->_tpl_vars['option'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['option_value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
');
        <?php endforeach; endif; unset($_from); ?>
    <?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php echo '
function custom_field_get_details_by_controller(controller_id)
{
    var details = new Array();
    for (var i = 0; i < dynamic_options.length; i++) {
        if (dynamic_options[i].controlling_field_id == controller_id) {
            details[details.length] = dynamic_options[i];
        }
    }
    return details;
}

function custom_field_get_details_by_target(target_id)
{
    for (i = 0; i < dynamic_options.length; i++) {
        if (dynamic_options[i].target_field_id == target_id) {
            return dynamic_options[i];
        }
    }
}


function custom_field_init_dynamic_options(fld_id)
{
    for (var i = 0; i < dynamic_options.length; i++) {
        if (dynamic_options[i].target_field_id == fld_id) {
            // set alert on target field prompting them to choose controlling field first
            target_field = $(\'#custom_field_\' + dynamic_options[i].target_field_id);
            target_field.bind("focus.choose_controller", dynamic_options[i].target_field_id, prompt_choose_controller_first);

            // set event handler for controlling field
            controlling_field = $(\'#\' + dynamic_options[i].controlling_field_id);
            controlling_field.bind(\'change.change_options\', dynamic_options[i].controlling_field_id, function(e) {
                custom_field_set_new_options($(e.target), false);
            });
            custom_field_set_new_options(controlling_field, true, fld_id);
            break;
        }
    }
}

function prompt_choose_controller_first(e) {
    target_field = e.target;
    target_id = e.data;
    details = custom_field_get_details_by_target(target_id);

    alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> ' + details.controlling_field_name + ' <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>first<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');

    target_field.blur();
    return false;
}


function custom_field_set_new_options(controller, keep_target_value, target_fld_id) {
    // get current value of controller field
    value = controller.val();

    // find the object
    if (target_fld_id != undefined) {
        details = new Array();
        details[0] = custom_field_get_details_by_target(target_fld_id);
    } else {
        details = custom_field_get_details_by_controller(controller.attr(\'id\'), target_fld_id);
    }
    for (var i = 0; i < details.length; i++) {
        // get the target/targets
        var targets = new Array();
        targets[0] = target = $(\'#custom_field_\' + details[i].target_field_id);

        for (var targ_num = 0; targ_num < targets.length; targ_num++) {
            wrapped_target = targets[targ_num];
            target = wrapped_target.get(0);
            // see if this value has a set of options for the child field
            if (keep_target_value) {
                // get the current value
                current_value = wrapped_target.val();
            }
            if (target.type != \'text\' && target.type != \'textarea\' && details[i].fld_type != \'date\') {
                target.options.length = 1;
            }
            var show = false;
            if (details[i].lookup_method == \'local\') {
                for (var j = 0; j < details[i].groups.length; j++) {
                    for (var k = 0; k < details[i].groups[j].keys.length; k++) {
                        if (((typeof value == \'object\') && (value.indexOf(details[i].groups[j].keys[k]) > -1)) || (details[i].groups[j].keys[k] == value)) {
                            show = true;
                            for (var l = 0; l < details[i].groups[j].options.length; l++) {
                                target.options[target.options.length] = details[i].groups[j].options[l];
                            }
                            // unbind "choose a controller" message
                            wrapped_target.unbind("focus.choose_controller");
                            if (keep_target_value) {
                                if (target.type == \'text\' || target.type == \'textarea\') {
                                    target.value = current_value;
                                } else {
                                    selectOption(target.form, target.name, current_value);
                                }
                            } else {
                                if (target.type == \'text\' || target.type == \'textarea\') {
                                    target.value = \'\';
                                } else {
                                    target.selectedIndex = 0;
                                }
                            }
                        }
                    }
                }
            } else if (details[i].lookup_method == \'ajax\') {
                // submit form via ajax trying to get data
                $(\'#report_form\').ajaxSubmit({
                    \'type\':   \'GET\',
                    \'url\':  \'rpc/get_custom_field_dynamic_options.php\',
                    \'dataType\': \'json\',
                    \'data\': {
                        \'fld_id\':   details[i].target_field_id
                    },
                    \'success\': function(options, status) {
                        var wrapped_target = $(target);
                        var target_id_chunks = wrapped_target.attr(\'id\').split(\'_\');
                        var details = custom_field_get_details_by_target(target_id_chunks[2]);
                        if (options != null) {
                            target.options.length = 0;
                            $.each(options, function(key, val) {
                                target.options[target.options.length] = new Option(val, key);
                                return true;
                            });
                            $(target).unbind("focus.choose_controller");
                        } else {
                            target.options.length = 0;
                            target.options[0] = new Option(\'Please choose an option\', "");
                            wrapped_target.bind("focus.choose_controller", details.target_field_id, prompt_choose_controller_first);
                        }
                    }
                })
            }

            if (details[i].hide_when_no_options == 1) {
                if (show == false) {
                    target.parentNode.parentNode.style.display = \'none\';
                } else {
                    target.parentNode.parentNode.style.display = getDisplayStyle();
                }
            }
        }
    }

}
'; ?>
