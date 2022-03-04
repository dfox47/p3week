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
defined('_JEXEC') || die('Restricted access');

use Joomla\CMS\{Language\Text, Uri\Uri};
use Sige\Helper;

?>
<div id="sige-main">
    <?php echo Text::_('COM_SIGE_MAIN_GET_PRO'); ?>
    <br/><br/>
    <img src="<?php echo Uri::base(); ?>components/com_sige/assets/images/sige-pro-logo.png"/>
</div>
<div class="sige-plugin-state">
    <?php if (isset($this->pluginState['enabled']) && isset($this->pluginState['urlSettings'])) : ?>
        <?php if ($this->pluginState['enabled'] === true) : ?>
            <span class="text-success">
                <span class="icon-sige-success"></span>
                <?php echo Text::sprintf('COM_SIGE_PLUGIN_ENABLED', $this->pluginState['urlSettings']); ?>
            </span>
        <?php else : ?>
            <span class="text-error">
                <span class="icon-sige-error"></span>
                <?php echo Text::sprintf('COM_SIGE_PLUGIN_DISABLED', $this->pluginState['urlSettings']); ?>
            </span>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php echo Helper::getFooter() ?>
