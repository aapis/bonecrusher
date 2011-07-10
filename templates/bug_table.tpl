{*Smarty*}
{nocache}
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	{$lastgroup=null}
	{$groupcounter = 1}
	{foreach $items as $anItem}
		{if $anItem@iteration is div by 2}
			{$class="r1"}
		{else}
			{$class="r2"}
		{/if}
			{if $anItem@first OR $lastgroup != $anItem['group_name']}
				<tr>
					{if $anItem['group_id']	== NULL or $anItem['group_id'] == 0}
						<td colspan='4' class='item header'><a href='{$site->url}group/{$anItem['group_id']}'/>Misc.</a></td>
					{else}
						<td colspan='4' class='item header'><a href='{$site->url}group/{$anItem['group_id']}'/>{$anItem['group_name']}</a></td>
					{/if}
				</tr>
				{$groupcounter=1}
			{/if}
			<tr>
				<td class='item {$class}'>#{$groupcounter}.
					<a href='{$site->url}bug/{$anItem['bug_id']}/?template=true'>{$anItem['bug_summary']|truncate:70}</a><span class="bugid">[#{$anItem['bug_id']}]</span>
				</td>
				<td width='180' class='item user {$class}' align='right'>
				{if $anItem['user_name']}
					Assigned to <a href="{$site->url}user/{$anItem['user_id']}/">{$anItem['user_name']}</a>
				{else}
					Unassigned
				{/if}
				</td>
				<td width='100' class='item {$class} {$site->BugStatus($anItem['bug_status'])}' align='center'>{$anItem['bug_status']|capitalize}</td>
			</tr>
		{$lastgroup=$anItem['group_name']}
		{$groupcounter=$groupcounter+1}
	{/foreach}
</table>
{/nocache}