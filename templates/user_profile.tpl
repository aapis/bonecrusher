{*Smarty*}
{nocache}
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<form method='post' action=''>
		<tr>
			<td class='item header'>Edit User Information</td>
			<td class='item header'></td>
		</tr>
		<tr>
			<td class='item' colspan='2'>
				<label for='user_email'>Email: </label>
				<input type='text' id='user_email' name='user_email' value='{$user['user_email']}' /></td>
		</tr>
					
		{if $user['user_group'] == 1}
			<tr>
				<td class='item' colspan='2'><label for='user_colour'>Colour (comments): </label>
				<input type='text' name='user_colour' id='user_colour' value='{$user['user_colour']}' /></td>
			</tr>
		{/if}
			<tr>
			<td class='item'><label for='user_theme'>Theme: </label>
				<select name='user_theme' id='user_theme'>
														
							<option>Select...</option>
							
							{foreach $themes as $theme}
								
								{if $user->theme == $theme['theme_id']}
									<option value='{$theme['theme_id']}' selected='selected'>{$theme['theme_name']|capitalize}</option>
									
								{else}
									<option value='{$theme['theme_id']}'>{$theme['theme_name'])|capitalize}</option>
								
								{/if}
							
							{/foreach}
							
				</select>
			</td>
			<td class='item'></td>
			</tr>
			<tr>
				<td class='item'><input type='submit' name='grinfucked' value='Update Information' class='btn' /></td>
				<td class='item' align='right'><a href='content.php' class='btn'>Cancel</a></td>
			</tr>			
	</form>
</table>
<p>Comment preview:</p>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr>
	{if $user['user_group'] < 3}
		<td class='item header nocaps nobg' style='background-color: #{$user['user_colour']}'><img src='{$site->url}images/Security.png' class='adminpostimg' title='Site Administrator' /><span class='admintxtwrap'>{$user['user_name']}</span></td>
		<td align='right' class='header item nobg' style='background-color: #{$user['user_colour']}'>date("m/j/y g:iA", time()) #1</td>
	{else}
					
		<td class='item header nocaps'>{$user['user_name']}</td>
		<td align='right' class='header item'> date("m/j/y g:iA", time())  #1</td>
					
	{/if}
					
	</tr>
	<tr>
		<td class='item' colspan='3'>I am a demo comment.</td>
	</tr>
</table>
{/nocache}