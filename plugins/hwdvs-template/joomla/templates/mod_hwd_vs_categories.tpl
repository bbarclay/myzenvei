{if $hwdvids_params.mod_style eq 2}<ol>{elseif $hwdvids_params.mod_style eq 3}<ul>{/if}

  {foreach name=outer item=data from=$list}

    {if $hwdvids_params.mod_style eq 2}<li>{elseif $hwdvids_params.mod_style eq 3}<li>{/if}
    {$data->link}{if $smarty.foreach.outer.last}{else}{if $hwdvids_params.mod_style eq 0},&nbsp{elseif $hwdvids_params.mod_style eq 1}&nbsp;|&nbsp;{/if}{/if}
    {if $hwdvids_params.mod_style eq 2}</li>{elseif $hwdvids_params.mod_style eq 3}</li>{/if}

  {/foreach}

{if $hwdvids_params.mod_style eq 2}</ol>{elseif $hwdvids_params.mod_style eq 3}</ul>{/if}
