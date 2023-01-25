
<form method="POST" action="">
    <input type="hidden" name="page" id="page" value="{$page|default:1}" />
    <table>
        <tbody class="actions">
        <tr>
            <td>{$i18n->_('Company')}</td>
            <td>{html_options name=id_company id=id_company options=$companies selected=$post['id_company']}</td>
            <td>{$i18n->_('Name')}</td>
            <td><input type="text" name="name" id="name" value="{$post['name']}" class="span3" /></td>
            <td>{$i18n->_('Status')}</td>
            <td>{html_options name=status id=status options=$statuses selected=$post['status']}</td>
    
            <th><input type="submit" class="btn primary" value="{$i18n->_('Filter')}" /></th>
        </tr>
        </tbody>
    </table>
</form>

    <table class="zebra-striped bordered-table">
        <caption><h3>{$i18n->_('Location')}<div style="float: right;">{if "location/new"|isAllowed}<a href="{url action=new}" class="btn">{icon src=page_white_add}{$i18n->_('New')}</a>{/if}</div></h3></caption>
        <thead>
            <tr>
                <th>{$i18n->_('#')}</th>
                <th>{$i18n->_('Name')}</th>
                <th>{$i18n->_('Company')}</th>
                <th>{$i18n->_('Status')}</th>
                <th colspan="3">{$i18n->_('Actions')}</th>
            </tr>
        </thead>
        <tbody>
            {foreach $locations as $location}
                <tr>
                    <td>{$location->getIdLocation()}</td>
                    <td>{$location->getName()}</td>
                    <td>{$companies[$location->getIdCompany()]}</td>
                    <td>{$i18n->_($location->getStatusName())}</td>
                    <td>{if "location/edit"|isAllowed}<a href="{$baseUrl}/location/edit/id/{$location->getIdLocation()}" class="btn">{icon class=tip src=pencil title=$i18n->_('Edit')}</a>{/if}</td>
                    <td>
                    {if $location->isActive()}
                        {if "location/delete"|isAllowed}<a href="{$baseUrl}/location/delete/id/{$location->getIdLocation()}" class="btn deactivate">{icon class=tip src=delete title=$i18n->_('Deactivate')}</a>{/if}
                    {else}
                        {if "location/reactivate"|isAllowed}<a href="{$baseUrl}/location/reactivate/id/{$location->getIdLocation()}" class="btn">{icon class=tip src=tick title=$i18n->_('Reactivate')}</a>{/if}
                    {/if}
                    </td>
                    <td>{if "location/tracking"|isAllowed}<a href="{$baseUrl}/location/tracking/id/{$location->getIdLocation()}" class="btn">{icon class=tip src=book_open title=$i18n->_('Tracking')}</a>{/if}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>


{include file='layout/Pager.tpl' paginator=$paginator}
