<div class="synDiscordGuildBox">
  <div class="synDiscordGuildInner">
    <div class="synDiscordGuildImageOuter">
      <img class="synDiscordGuildImage" src="{$discordData.serverIcon}" alt="">
    </div>
    <div class="synDiscordGuildText">
      <p class="synDiscordGuildName">{$discordData.body.name}</p>
      <p class="synDiscordGuildUserInfo">{$discordData.body.approximate_member_count} {lang}wcf.box.synDiscordGuildInfoBox.members{/lang}</p>
      <p class="synDiscordGuildUserInfo">{$discordData.body.approximate_presence_count} {lang}wcf.box.synDiscordGuildInfoBox.online{/lang}</p>
    </div>
  </div>
  {if SYN_DISCORD_GUILD_INFO_BOX_INVITE_URL != ''}
    <a href="{SYN_DISCORD_GUILD_INFO_BOX_INVITE_URL}" class="synDiscordGuildBoxButton button buttonPrimary" {if SYN_DISCORD_GUILD_INFO_BOX_INVITE_NEW_WINDOW} rel="noopener noreferrer" target="_blank"{/if}>
      {lang}wcf.box.synDiscordGuildInfoBox.join{/lang}
    </a>
  {/if}
</div>
