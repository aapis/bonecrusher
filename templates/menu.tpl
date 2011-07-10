{*Smarty*}
<ul id="subnav">
		{if is_null($get['level']) and !isset($get['completed'])}
			<li><a href="{$site->url}" class="selected">Pending</a></li>
		{else}
			<li><a href="{$site->url}">Pending</a></li>
		{/if}
		{if $get['level'] == 1}
			<li><a href="{$site->url}level/1/" class="selected">Level 1</a></li>
		{else}
			<li><a href="{$site->url}level/1/">Level 1</a></li>
		{/if}
		{if $get['level'] == 2}
			<li><a href="{$site->url}level/2/" class="selected">Level 2</a></li>
		{else}
			<li><a href="{$site->url}level/2/">Level 2</a></li>
		{/if}
		{if $get['level'] == 3}
			<li><a href="{$site->url}level/3/" class="selected">Level 3</a></li>
		{else}
			<li><a href="{$site->url}level/3/">Level 3</a></li>
		{/if}
		{if isset($get['completed'])}
			<li><a href="{$site->url}completed/" class="selected">All</a></li>
		{else}
			<li><a href="{$site->url}completed/">All</a></li>
		{/if}
		<li class="floatright"><a href="{$site->url}dashboard/">Dashboard</a></li>
		{if !is_null($user) && $user->logged()}
			<li class="floatright"><a href="{$site->url}?do=logout">Logout</a></li>
			<li class="floatright">{$site->GroupList()}</li>
			{*<li class="floatright"><a href="<?= $site->url; ?>dashboard/messages.php?do=new">Messages</a></li>*}
		{else}
			{if !is_null($site->storage) && $site->storage->get("registration")}
				<li class="floatright"><a href="{$site->url}dashboard/index.php?do=register">Register</a></li>
			{/if}
		{/if}
</ul>