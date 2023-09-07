{if $discordBotList|count}
	<select id="{$option->optionName}" name="values[{$option->optionName}]">
		<option value="">{lang}wcf.acp.option.syn_discord_guild_info_box_noGuild{/lang}</option>
		{foreach from=$discordBotList item=discordBot}
			<option value="{@$discordBot->guildID}"{if $discordBot->guildID == $value} selected{/if}>
				{$discordBot->guildName}
			</option>
		{/foreach}
	</select>
{else}
	<p class="info">{lang}wcf.acp.discordBotSelectOptionType.noBot{/lang}</p>
{/if}
