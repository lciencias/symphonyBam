{$i18n->_('Yes')}: <input type="radio" name="value" value="1" {if $option->getValue()}checked="checked"{/if} />
{$i18n->_('No')}: <input type="radio" name="value" value="0" {if !$option->getValue()}checked="checked"{/if} />