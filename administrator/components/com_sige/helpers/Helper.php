<?php

/**
 * @copyright
 * @package     Simple Image Gallery Extended - SIGE for Joomla! 3.x
 * @author      Viktor Vogel <admin@kubik-rubik.de>
 * @version     3.4.2-FREE - 2020-12-14
 * @link        https://kubik-rubik.de/sige-simple-image-gallery-extended
 *
 * @license     GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Sige;

defined('_JEXEC') || die('Restricted access');

use Exception;
use Joomla\CMS\{Factory, Uri\Uri, Language\Text};

/**
 * Class Helper
 *
 * @package Sige
 *
 * @since   3.4.0-FREE
 * @version 3.4.2-FREE
 */
class Helper
{
    /**
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    public const SIGE_VERSION = '3.4.2-FREE';

    /**
     * Adds the pro button in the main view
     *
     * @throws Exception
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    public static function addProButton()
    {
        $proLink = 'https://kubik-rubik.de/pro';

        if (Factory::getApplication()->getLanguage()->getTag() === 'de-DE') {
            $proLink = 'https://kubik-rubik.de/de/pro';
        }

        $proLink .= '?extension=sige';

        $proButton = '<div class="btn-wrapper" id="toolbar-pro"><a href="' . $proLink . '" title="Kubik-Rubik Joomla! Pro Extensions" target="_blank"><button class="btn btn-small btn-inverse"><span class="icon-cube icon-white" aria-hidden="true"></span> PRO</button></a></div>';

        $scriptDeclaration = 'jQuery(function($){$("#toolbar").append(\'' . $proButton . '\');});';
        Factory::getDocument()->addScriptDeclaration($scriptDeclaration);
    }

    /**
     * Gets the status of the SIGE content plugin
     *
     * @return array
     * @since 3.4.0-FREE
     */
    public static function getPluginState(): array
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__extensions');
        $query->where('folder = ' . $db->quote('content') . ' AND element = ' . $db->quote('sige'));
        $db->setQuery($query);
        $result = $db->loadObject();

        if (!empty($result)) {
            return ['enabled' => (boolean)$result->enabled, 'urlSettings' => Uri::base() . 'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $result->extension_id];
        }

        return [];
    }

    /**
     * Gets the default footer for the views
     *
     * @return string
     * @since 3.4.0-FREE
     */
    public static function getFooter(): string
    {
        return '<div class="sige-version">' . Text::sprintf('COM_SIGE_VERSION', self::SIGE_VERSION) . '</div>';
    }
}
