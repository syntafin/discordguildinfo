<?php

/*
* Copyright Syntafin.dev
*
* License: 
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
* IN THE SOFTWARE.
*
* The above copyright notice and this disclaimer notice shall be included in all
* copies or substantial portions of the Software.
* 
*/

namespace wcf\system\box;

use wcf\system\cache\builder\SynDiscordGuildInfoBoxCacheBuilder;
use wcf\system\exception\SystemException;
use wcf\system\WCF;
use wcf\util\StringUtil;
use wcf\system\discord\DiscordApi;

class SynDiscordGuildInfoBoxController extends AbstractBoxController
{
    /**
     * @inheritDoc
     */
    protected static $supportedPositions = [
        'sidebarLeft',
        'sidebarRight',
    ];

    /**
     * Discord Data
     */
    public $discordData = [];

    /**
     * @inheritDoc
     * 
     * @throws SystemException
     */
    public function hasContent(): bool
    {
        if (!SYN_DISCORD_GUILD_INFO_BOX_SERVER_ID) {
            return false;
        }

        $this->discordData = SynDiscordGuildInfoBoxCacheBuilder::getInstance()->getData();

        if (empty($this->discordData)) {
            return false;
        }

        return parent::hasContent();
    }

    /**
     * @inheritDoc
     */
    function loadContent()
    {
        $this->content = WCF::getTPL()->fetch('boxSynDiscordGuildInfoBox', 'wcf', [
            'discordData' => $this->discordData,
        ], true);
    }
}
