{*Smarty*}
{nocache}
{if $item['bug_status'] == "review" OR $item['bug_status'] == "complete"}
	<li class='item header'>Bug #{$item['bug_id']}
		<span class='status nopad {$site->BugStatus($item['bug_status'])}'>{$item['bug_status']|capitalize}</span>
	</li>
{else}
	{if ($item['bug_assignee'] == $user->id())}
		<li class='item header'>Bug #{$item['bug_id']}
			<span class='status nopad {$site->BugStatus($item['bug_status'])}'><a href='{$site->url}bug.php?b={$item['bug_id']}'>Review</a></span>
			<span class='status nopad {$site->BugStatus($item['bug_status'])}'>{$item['bug_status']}</span></li>
	{else}
		<li class='item header'>Bug #{$item['bug_id']}
			<span class='status nopad {$site->BugStatus($item['bug_status'])}'>{$item['bug_status']}</span>
		</li>				
	{/if}
{/if}
				
<li class='item'>Level: {$item['bug_level']}</li>
<li class='item'>{$site->GetName($item['bug_assignee'])}</li>
				
{if not is_null($item['bug_submitter'])}	
	<li class='item'>Submitted by {$site->GetName($item['bug_submitter'])}</li>
{/if}

<li class='item'>Group: {$site->GroupName($item['bug_group'])}</li>

{if $item['bug_phours'] != 0}
	<li class='item'>Projected Hours: {$item['bug_phours']}</li>
{/if}

{if not is_null($item['bug_ahours'])}
	<li class='item'>Actual Hours: {$item['bug_ahours']}<span class='status'><a href='#'>Add Hours</a></span></li>
{/if}
<li class='item'><strong>{$item['bug_summary']}</strong></li>
{/nocache}