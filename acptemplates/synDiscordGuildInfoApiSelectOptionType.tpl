{if $discordBotList|count}
	<select id="{$option->optionName}" name="values[{$option->optionName}]">
		<option value="">{lang}wcf.acp.option.syn_discord_guild_info_box_noBot{/lang}</option>
		{foreach from=$discordBotList item=discordBot}
			<option value="{@$discordBot->botID}"{if $discordBot->botID == $value} selected{/if}>
				{$discordBot->botName}
			</option>
		{/foreach}
	</select>
{else}
	<p class="info">{lang}wcf.acp.discordBotSelectOptionType.noBot{/lang}</p>
{/if}
