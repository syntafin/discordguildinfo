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

namespace wcf\system\cache\builder;

use Exception;
use http\Exception\RuntimeException;
use wcf\system\discord\type\AbstractDiscordType;
use wcf\system\request\LinkHandler;
use wcf\util\CryptoUtil;
use wcf\util\JSON;
use wcf\system\discord\DiscordApi;
use function wcf\functions\exception\logThrowable;

class SynDiscordGuildInfoBoxCacheBuilder extends AbstractCacheBuilder
{
    /**
     * @inheritDoc
     */
    protected $maxLifetime = 120;

    /**
     * @inheritDoc
     * 
     * @throws GuzzleException
     */
    public function rebuild(array $parameters): array
    {
        try {
            $client = DiscordApi::getApiByID(SYN_DISCORD_GUILD_INFO_BOX_API_ID);
            $data = $client->getGuild(SYN_DISCORD_GUILD_INFO_BOX_SERVER_ID, $withCounts = true);
        } catch (Exception $e) {
            if (ENABLE_DEBUG_MODE || (\defined('ENABLE_ENTERPRISE_MODE') && ENABLE_ENTERPRISE_MODE)) {
                logThrowable($e);
            }

            return $data;
        }

        if(isset($data['error'])) {
            return $data = [];
        }

        $data['proxyLink'] = $data['body']['id'] . '/' . $data['body']['icon'];
        $data['serverIcon'] = $this->getProxyLink('https://cdn.discordapp.com/icons/' . $data['body']['id'] . '/' . $data['body']['icon'] . '.png?size=256');

        return $data;
    }

    /**
     * Returns the link to a given image url via image proxy
     */
    private function getProxyLink(string $link): string
    {
        // Return normal link if proxy is disabled
        if (!MODULE_IMAGE_PROXY) {
            return $link;
        }

        try {
            return LinkHandler::getInstance()->getLink(
                'ImageProxy',
                ['key' => CryptoUtil::createSignedString($link)]
            );
        } catch (Exception $e) {
            return $link;
        }
    }
}
