{*Smarty*}
{nocache}
<div id="bug-list">
	{$lastgroup=null}
	{$groupcounter = 1}
	{foreach $items as $anItem}
		{if $anItem@iteration is div by 2}
			{$class="r1"}
		{else}
			{$class="r2"}
		{/if}
			{if $anItem@first OR $lastgroup != $anItem['group_name']}
				{if not $anItem@first}
					</ul>
				{/if}
				<div class="project-header-row" id="headergroup_{$anItem['group_id']|default:'empty'}">
					{if $anItem['group_id']	== NULL or $anItem['group_id'] == 0}
						<div class='item header'><a href='{$site->url}group/{$anItem['group_id']}/'>Misc.</a></div>
					{else}
						<div class='item header'><a href='{$site->url}group/{$anItem['group_id']}/'>{$anItem['group_name']}</a></div>
					{/if}
				</div>
				<ul id="ulgroup_{$anItem['group_id']|default:'empty'}">
				{$groupcounter=1}
			{/if}
			<li class="project-task" bk-data-id="{$anItem['bug_id']}" bk-data-pinged="{$anItem['bug_pinged']}" bk-data-ping-by="{$anItem['bug_pinged_by']}" bk-data-ping-time="{$anItem['bug_pinged_timestamp']}">
				<div class='task-summary item {$class}'>
					<span class="internal-content">
						#{$groupcounter}.
						<a href='{$site->url}bug/{$anItem['bug_id']}/?template=true'>{$anItem['bug_summary']|truncate:70}</a>
						<!--<span class="bugid">[#{$anItem['bug_id']}]</span>-->
					</span>
				</div>
				<div class="assignment-cell {$class}">
					<span class="internal-content">
						{if $anItem['user_name']}
							Assigned to <a href="{$site->url}user/{$anItem['user_id']}/">{$anItem['user_name']}</a>
						{else}
							Unassigned
						{/if}
					</span>
				</div>
				<div class='task-status-cell item {$class} {$site->BugStatus($anItem['bug_status'])}'>
					<span class="internal-content">
						{$anItem['bug_status']|capitalize}
					</span>
				</div>
			</li>
		{$lastgroup=$anItem['group_name']}
		{$groupcounter=$groupcounter+1}
		{*If item is last in group close off unordered list*}
		{if $anItem@last}
				</ul>
		{/if}
	{/foreach}
</div>
<script>
	$(document).ready(function() {
	   $(".project-header-row").click(function(){
	   		var nameparts = $(this).attr("id").split("_");
	   		var groupid = nameparts[nameparts.length-1];
	   		var ulselector = "#ulgroup_"+groupid;
	   		$(ulselector).slideToggle(400);
	   });
	 });
</script>
{/nocache}