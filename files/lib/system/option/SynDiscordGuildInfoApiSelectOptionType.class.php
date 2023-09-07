<?php

namespace wcf\system\option;

use wcf\data\option\Option;
use wcf\data\discord\bot\DiscordBotList;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;
use wcf\util\ArrayUtil;
use wcf\util\StringUtil;

/**
 * @author Syntafin <hello@syntafin.dev>
 * @copyright 2022 Syntafin
 * @license MIT
 */
class SynDiscordGuildInfoApiSelectOptionType extends AbstractOptionType
{
    /**
     * @inheritDoc
     */
    public function getFormElement(Option $option, $value)
    {
        $discordBotList = new DiscordBotList();
        $discordBotList->sqlOrderBy = 'clientID ASC, guildName ASC';
        $discordBotList->readObjects();

        $botList = [];

        foreach ($discordBotList as $discordBot) {
            $botList[$discordBot->clientID] = $discordBot;
        }

        WCF::getTPL()->assign([
            'discordBotList' => $botList,
            'option' => $option,
            'value' => $value,
        ]);
        
        return WCF::getTPL()->fetch('synDiscordGuildInfoApiSelectOptionType');
    }

    /**
     * @inheritDoc
     */
    public function validate(Option $option, $newValue)
    {
        if (!is_array($newValue)) {
            $newValue = [];
        }
        $newValue = ArrayUtil::toIntegerArray($newValue);
    }
}
