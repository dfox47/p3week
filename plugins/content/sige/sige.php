<?php

/**
 * @copyright
 * @package     Simple Image Gallery Extended - SIGE for Joomla! 3.x
 * @author      Viktor Vogel <admin@kubik-rubik.de>
 * @version     3.4.2-FREE - 2020-12-14
 * @link        https://kubik-rubik.de/sige-simple-image-gallery-extended
 *
 * @license     GNU/GPL
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') || die('Restricted access');

use Joomla\CMS\{Plugin\CMSPlugin, Factory, Uri\Uri, Document\HtmlDocument, HTML\HTMLHelper, Language\Text, Filesystem\File, Filesystem\Folder};
use Joomla\Registry\Registry;

class PlgContentSige extends CMSPlugin
{
    /**
     * @var string $absolutePath
     * @since 3.4.0-FREE
     */
    protected $absolutePath;

    /**
     * @var array $allowedExtensions
     * @since 3.4.0-FREE
     */
    protected $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * @var string $articleTitle
     * @since 3.4.0-FREE
     */
    protected $articleTitle = '';

    /**
     * @var bool $autoloadLanguage
     * @since 3.4.0-FREE
     */
    protected $autoloadLanguage = true;

    /**
     * @var string $image
     * @since 3.4.0-FREE
     */
    protected $image;

    /**
     * @var array $imageInfo
     * @since 3.4.0-FREE
     */
    protected $imageInfo = [];

    /**
     * @var string $imagesDir
     * @since   3.4.0-FREE
     * @version 3.4.1-FREE
     */
    protected $imagesDir = '';

    /**
     * @var string $liveSite
     * @since 3.4.0-FREE
     */
    protected $liveSite;

    /**
     * @var array $photoswipeJs
     * @since 3.4.0-FREE
     */
    protected $photoswipeJs = [];

    /**
     * @var array $pluginParameters
     * @since 3.4.0-FREE
     */
    protected $pluginParameters = [];

    /**
     * @var string $rootFolder
     * @since 3.4.0-FREE
     */
    protected $rootFolder = '/images/';

    /**
     * @var object $session
     * @since 3.4.0-FREE
     */
    protected $session;

    /**
     * @var int $sigCount
     * @since 3.4.0-FREE
     */
    protected $sigCount;

    /**
     * @var int $sigCountArticles
     * @since 3.4.0-FREE
     */
    protected $sigCountArticles;

    /**
     * @var array $syntaxParameters
     * @since 3.4.0-FREE
     */
    protected $syntaxParameters = [];

    /**
     * @var int $thumbnailMaxHeight
     * @since 3.4.0-FREE
     */
    protected $thumbnailMaxHeight;

    /**
     * @var int $thumbnailMaxWidth
     * @since 3.4.0-FREE
     */
    protected $thumbnailMaxWidth;

    /**
     * @var bool $turboCssReadIn
     * @since 3.4.0-FREE
     */
    protected $turboCssReadIn;

    /**
     * @var bool $turboHtmlReadIn
     * @since 3.4.0-FREE
     */
    protected $turboHtmlReadIn;

    /**
     * PlgContentSige constructor.
     *
     * @param object $subject
     * @param array  $config
     *
     * @throws Exception
     * @since 3.4.0-FREE
     */
    public function __construct(object $subject, array $config)
    {
        parent::__construct($subject, $config);

        $this->session = Factory::getSession();
        $this->session->clear('sigcount', 'sige');
        $this->session->clear('sigcountarticles', 'sige');

        $this->absolutePath = JPATH_SITE;
        $this->liveSite = Uri::base();

        if (substr($this->liveSite, -1) === '/') {
            $this->liveSite = substr($this->liveSite, 0, -1);
        }

        require_once JPATH_ADMINISTRATOR . '/components/com_sige/helpers/Helper.php';
    }

    /**
     * Entry point of the plugin in core content trigger onContentPrepare
     *
     * @param string   $context
     * @param object   $article
     * @param Registry $params
     * @param null|int $limitstart
     *
     * @throws Exception
     * @since   3.4.0-FREE
     * @version 3.4.1-FREE
     */
    public function onContentPrepare($context, &$article, &$params, $limitstart)
    {
        if (Factory::getApplication()->isClient('administrator')) {
            return;
        }

        if (stripos($article->text, '{gallery}') === false) {
            return;
        }

        $this->sigCountArticles = $this->session->get('sigcountarticles', -1, 'sige');

        if (preg_match_all('@{gallery}(.*){/gallery}@Us', $article->text, $sigeSyntaxMatches, PREG_PATTERN_ORDER) > 0) {
            $this->sigCountArticles++;
            $this->session->set('sigcountarticles', $this->sigCountArticles, 'sige');
            $this->sigCount = $this->session->get('sigcount', -1, 'sige');
            $this->pluginParameters['lang'] = Factory::getLanguage()->getTag();

            foreach ($sigeSyntaxMatches[1] as $sigeSyntaxMatch) {
                $this->prepareSyntaxParameters($sigeSyntaxMatch, $article);
                $html = $this->createHtmlOutput();
                $article->text = preg_replace('@(<p>)?{gallery}' . $sigeSyntaxMatch . '{/gallery}(</p>)?@s', $html, $article->text);
            }

            $this->addDataToBottom($article->text);
            $this->loadHeadData();
        }
    }

    /**
     * Prepares the syntax parameters
     *
     * @param string $sigeSyntaxMatch
     * @param object $article
     *
     * @throws Exception
     * @since 3.4.1-FREE
     */
    private function prepareSyntaxParameters(string $sigeSyntaxMatch, object $article)
    {
        $this->sigCount++;
        $this->session->set('sigcount', $this->sigCount, 'sige');
        $sigeSyntaxArray = explode(',', $sigeSyntaxMatch);

        $this->setImagesFolder($sigeSyntaxArray);
        $this->getSyntaxParameters($sigeSyntaxArray);
        $this->setParams($article);
        $this->setTurboParameters();
    }

    /**
     * Gets the images folder
     *
     * @param array $sigeSyntaxArray
     *
     * @since   3.4.0-FREE
     * @version 3.4.1-FREE
     */
    private function setImagesFolder(array $sigeSyntaxArray)
    {
        if (!empty($sigeSyntaxArray[0])) {
            $this->imagesDir = $sigeSyntaxArray[0];
        }
    }

    /**
     * Extracts all parameters from the entered syntax
     *
     * @param array $sigeSyntaxArray
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function getSyntaxParameters(array $sigeSyntaxArray)
    {
        // Reset syntax parameters if syntax is used more than once per page
        $this->syntaxParameters = [];
        $sigeSyntaxArrayCount = count($sigeSyntaxArray);

        if ($sigeSyntaxArrayCount >= 2) {
            for ($i = 1; $i < $sigeSyntaxArrayCount; $i++) {
                $parameterTemp = explode('=', $sigeSyntaxArray[$i], 2);

                if (count($parameterTemp) === 2) {
                    $this->syntaxParameters[strtolower(trim($parameterTemp[0]))] = trim($parameterTemp[1]);
                }
            }
        }
    }

    /**
     * Sets all parameters for the correct execution
     *
     * @param object $article
     *
     * @throws Exception
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function setParams(object $article)
    {
        $params = $this->getParamsList();

        foreach ($params as $value) {
            $this->pluginParameters[$value] = $this->getParams($value);
        }

        $count = $this->getParams('count', true);

        if (!empty($count)) {
            $this->sigCount = $count;
        }

        if ($this->pluginParameters['root']) {
            $this->rootFolder = '/';
        }

        if (!empty($this->pluginParameters['displaymessage'])) {
            if (isset($article->title) && Factory::getApplication()->input->getWord('view') !== 'featured') {
                $this->articleTitle = preg_replace("@\"@", "'", $article->title);
            }
        }

        $this->thumbnailMaxHeight = $this->pluginParameters['height'];
        $this->thumbnailMaxWidth = $this->pluginParameters['width'];
    }

    /**
     * Returns the complete params list as an array
     *
     * @return array
     * @since 3.4.0-FREE
     */
    private function getParamsList(): array
    {
        return [
            'calcmaxthumbsize',
            'caption',
            'column_quantity',
            'connect',
            'crop',
            'crop_factor',
            'css_image',
            'css_image_half',
            'displaymessage',
            'displaynavtip',
            'download',
            'encrypt',
            'fileinfo',
            'gap_h',
            'gap_v',
            'height',
            'height_image',
            'image_info',
            'image_link',
            'image_link_new',
            'image_link_local',
            'images_new',
            'iptc',
            'iptcutf8',
            'js',
            'limit',
            'limit_quantity',
            'list',
            'message',
            'modaltitle',
            'navtip',
            'nodebug',
            'noslim',
            'print',
            'quality',
            'quality_png',
            'ratio',
            'ratio_image',
            'resize_images',
            'root',
            'salign',
            'scaption',
            'single',
            'single_gallery',
            'sort',
            'thumbdetail',
            'thumbs',
            'thumbs_new',
            'turbo',
            'view',
            'watermark',
            'watermark_new',
            'watermarkimage',
            'watermarkposition',
            'width',
            'width_image',
            'word',
        ];
    }

    /**
     * Gets a specific parameter - syntax or plugins settings
     *
     * @param string $param
     * @param bool   $syntaxOnly
     * @param string $default
     *
     * @return mixed|string
     * @since 3.4.0-FREE
     */
    private function getParams(string $param, bool $syntaxOnly = false, string $default = '')
    {
        if (array_key_exists($param, $this->syntaxParameters) && $this->syntaxParameters[$param] !== '') {
            return $this->syntaxParameters[$param];
        }

        if (empty($syntaxOnly)) {
            return $this->params->get($param);
        }

        return $default;
    }

    /**
     * Sets the turbo mode parameters
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function setTurboParameters()
    {
        $this->turboHtmlReadIn = false;
        $this->turboCssReadIn = false;

        if ($this->pluginParameters['turbo']) {
            if ($this->pluginParameters['turbo'] === 'new') {
                $this->turboHtmlReadIn = true;
                $this->turboCssReadIn = true;

                return;
            }

            if (!File::exists($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_html-' . $this->pluginParameters['lang'] . '.txt')) {
                $this->turboHtmlReadIn = true;
            }

            if (!File::exists($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_css-' . $this->pluginParameters['lang'] . '.txt')) {
                $this->turboCssReadIn = true;
            }
        }
    }

    /**
     * Creates the HTML output of the gallery
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function createHtmlOutput(): string
    {
        if (!$this->pluginParameters['turbo'] || ($this->pluginParameters['turbo'] && $this->turboHtmlReadIn)) {
            $images = [];
            $imagesLoaded = 0;
            $this->loadImagesFromDir($images, $imagesLoaded);

            // Set default message
            $html = '';

            if (empty($this->pluginParameters['nodebug'])) {
                $html .= '<p class="sige_noimages">' . Text::_('PLG_CONTENT_SIGE_NOIMAGES') . '<br /><br />' . Text::_('PLG_CONTENT_SIGE_NOIMAGESDEBUG') . ' ' . $this->liveSite . $this->rootFolder . $this->imagesDir . '</p>';
            }

            if (!empty($imagesLoaded)) {
                if (!File::exists($this->absolutePath . $this->rootFolder . $this->imagesDir . '/index.html')) {
                    File::write($this->absolutePath . $this->rootFolder . $this->imagesDir . '/index.html', '');
                }

                $this->sortImagesArray($images);

                $imagesLoadedRest = 0;
                $singleYes = false;

                if ($this->pluginParameters['single']) {
                    $this->singleImageHandling($images, $imagesLoaded, $imagesLoadedRest, $singleYes);
                }

                $fileInfo = $this->getFileInfo($images, $imagesLoaded, $singleYes);

                if ($this->pluginParameters['calcmaxthumbsize']) {
                    $this->calculateMaxThumbnailSize($images);
                }

                $sigeCss = $this->createMainCssInstruction();
                $this->loadHeadData($sigeCss);

                if ($this->pluginParameters['resize_images']) {
                    $this->resizeImages($images);
                }

                if ($this->pluginParameters['watermark']) {
                    $this->createWatermark($images, $singleYes);
                }

                $this->limitImageList($imagesLoaded, $imagesLoadedRest);

                if ($this->pluginParameters['thumbs']) {
                    $this->createThumbnails($images, $imagesLoaded);
                }

                if ($this->pluginParameters['word']) {
                    $imagesLoadedRest = $imagesLoaded;
                    $this->pluginParameters['limit_quantity'] = 1;
                    $imagesLoaded = 1;
                }

                $html = '<!-- Simple Image Gallery Extended - Plugin for Joomla! 3.x - Kubik-Rubik Joomla! Extensions -->';

                if (empty($this->pluginParameters['word'])) {
                    $html .= '<ul id="sige_' . $this->sigCount . '" class="';

                    if ($this->pluginParameters['single'] && !empty($singleYes)) {
                        $html .= 'sige_single';
                    } elseif ($this->pluginParameters['list']) {
                        $html .= 'sige_list';
                    } else {
                        $html .= 'sige';
                    }

                    // PhotoSwipe - Add specific class for the PhotoSwipe library
                    if ($this->pluginParameters['view'] == 7) {
                        $swipeClassId = $this->getSwipeClassId();

                        $html .= ' sige_swipe_' . $swipeClassId;
                    }

                    $html .= '">';
                } else {
                    if ($this->pluginParameters['view'] == 7) {
                        $swipeClassId = $this->getSwipeClassId();

                        $html .= '<span class="sige_swipe_' . $swipeClassId . '">';
                    }
                }

                for ($a = 0; $a < $imagesLoaded; $a++) {
                    $this->htmlImage($images[$a]['filename'], $html, 0, $fileInfo, $a);
                }

                if (!empty($imagesLoadedRest) && !$this->pluginParameters['image_link']) {
                    for ($a = $this->pluginParameters['limit_quantity']; $a < $imagesLoadedRest; $a++) {
                        $this->htmlImage($images[$a]['filename'], $html, 1, $fileInfo, $a);
                    }
                }

                if (empty($this->pluginParameters['word'])) {
                    if ($this->pluginParameters['list']) {
                        $html .= '</ul>';
                    } else {
                        $html .= '</ul><span class="sige_clr"></span>';
                    }
                } else {
                    if ($this->pluginParameters['view'] == 7) {
                        $html .= '</span>';
                    }
                }

                // PhotoSwipe
                if ($this->pluginParameters['view'] == 7) {
                    // Add Photoswipe JavaScript code but only once for the same class ID
                    static $photoswipeId = false;

                    if ($photoswipeId !== $swipeClassId) {
                        $photoswipeJs = 'jQuery(document).ready(photoSwipeSige(".sige_swipe_' . $swipeClassId . '", ".sige_swipe_single_' . $swipeClassId . '", ' . ((int)$swipeClassId + 1) . '));';

                        $this->photoswipeJs[] = $photoswipeJs;

                        if ($this->turboHtmlReadIn) {
                            File::write($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_js-' . $this->pluginParameters['lang'] . '.txt', $photoswipeJs);
                        }

                        $photoswipeId = $swipeClassId;
                    }
                }
            }

            if ($this->turboHtmlReadIn) {
                File::write($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_html-' . $this->pluginParameters['lang'] . '.txt', $html);
            }

            return $html;
        }

        $this->loadHeadData(1);
        $this->loadPhotoSwipeJs();
        $html = file_get_contents($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_html-' . $this->pluginParameters['lang'] . '.txt');

        return $html;
    }

    /**
     * Loads all images with the allowed extensions from the specified directory
     *
     * @param array $images
     * @param int   $imagesLoaded
     *
     * @since 3.4.0-FREE
     */
    private function loadImagesFromDir(array &$images, int &$imagesLoaded)
    {
        $directory = $this->absolutePath . $this->rootFolder . $this->imagesDir;

        if (is_dir($directory)) {
            if ($handle = opendir($directory)) {
                while (($file = readdir($handle)) !== false) {
                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $this->allowedExtensions)) {
                        $images[] = ['filename' => $file];
                        $imagesLoaded++;
                    }
                }

                closedir($handle);
            }
        }
    }

    /**
     * Sorts the images array
     *
     * @param array $images
     *
     * @since 3.4.0-FREE
     */
    private function sortImagesArray(array &$images)
    {
        $sort = (int)$this->pluginParameters['sort'];

        if ($sort === 1) {
            shuffle($images);
        } elseif ($sort === 2) {
            sort($images);
        } elseif ($sort === 3) {
            rsort($images);
        } elseif ($sort === 4 || $sort === 5) {
            foreach ($images as $imageKey => $imageValue) {
                $images[$imageKey]['timestamp'] = filemtime($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $imageValue['filename']);
            }

            if ($sort === 4) {
                usort($images, [$this, 'timeasc']);
            } elseif ($sort === 5) {
                usort($images, [$this, 'timedesc']);
            }
        }
    }

    /**
     * Handles the single image output properly
     *
     * @param array $images
     * @param int   $imagesLoaded
     * @param int   $imagesLoadedRest
     * @param bool  $singleYes
     *
     * @since 3.4.0-FREE
     */
    private function singleImageHandling(array &$images, int &$imagesLoaded, int &$imagesLoadedRest, bool &$singleYes)
    {
        if ($images[0]['filename'] === $this->pluginParameters['single']) {
            if ($this->pluginParameters['single_gallery']) {
                $imagesLoadedRest = $imagesLoaded;
                $this->pluginParameters['limit_quantity'] = 1;
            }

            $imagesLoaded = 1;
            $singleYes = true;

            return;
        }

        for ($a = 1; $a < $imagesLoaded; $a++) {
            if ($images[$a]['filename'] === $this->pluginParameters['single']) {
                if ($this->pluginParameters['single_gallery']) {
                    $imagesLoadedRest = $imagesLoaded;
                    $this->pluginParameters['limit_quantity'] = 1;
                }

                $imageSingle = $images[$a];
                unset($images[$a]);
                array_unshift($images, $imageSingle);

                $imagesLoaded = 1;
                $singleYes = true;

                break;
            }
        }
    }

    /**
     * Loads all information from the info text file
     *
     * @param array $images
     * @param int   $imagesLoaded
     * @param bool  $singleYes
     *
     * @return array
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function getFileInfo(array &$images, int &$imagesLoaded, bool $singleYes): array
    {
        $fileInfo = [];

        if ($this->pluginParameters['fileinfo']) {
            $captionsLang = $this->absolutePath . $this->rootFolder . $this->imagesDir . '/captions-' . $this->pluginParameters['lang'] . '.txt';
            $captionsTextFile = $this->absolutePath . $this->rootFolder . $this->imagesDir . '/captions.txt';

            if (File::exists($captionsLang)) {
                $captionsFile = array_map('trim', file($captionsLang));

                foreach ($captionsFile as $value) {
                    if (!empty($value)) {
                        $captionsLine = explode('|', $value);
                        $fileInfo[] = $captionsLine;
                    }
                }
            } elseif (File::exists($captionsTextFile) && !File::exists($captionsLang)) {
                $captionsFile = array_map('trim', file($captionsTextFile));

                foreach ($captionsFile as $value) {
                    if (!empty($value)) {
                        $captionsLine = explode('|', $value);
                        $fileInfo[] = $captionsLine;
                    }
                }
            }

            // Use the sorting from the captions.text to sort the images
            if (!empty($fileInfo) && (int)$this->pluginParameters['sort'] === 6 && empty($singleYes)) {
                $imagesFileInfo = [];

                foreach ($fileInfo as $fileInfoImage) {
                    foreach ($images as $key => $image) {
                        if ($fileInfoImage[0] === $image['filename']) {
                            $imagesFileInfo[]['filename'] = $fileInfoImage[0];
                            unset($images[$key]);
                            break;
                        }
                    }
                }

                if (!empty($imagesFileInfo)) {
                    $images = $imagesFileInfo;
                    $imagesLoaded = count($images);
                }
            }
        }

        return $fileInfo;
    }

    /**
     * Calculates the maximum thumbnails size (resolution) of all loaded images
     *
     * @param array $images
     *
     * @since 3.4.0-FREE
     */
    private function calculateMaxThumbnailSize(array $images)
    {
        $maxHeight = [];
        $maxWidth = [];

        foreach ($images as $image) {
            [$maxHeightSingle, $maxWidthSingle] = $this->calculateSize($image['filename'], 1);
            $maxHeight[] = $maxHeightSingle;
            $maxWidth[] = $maxWidthSingle;
        }

        rsort($maxHeight);
        rsort($maxWidth);

        $this->thumbnailMaxHeight = $maxHeight[0];
        $this->thumbnailMaxWidth = $maxWidth[0];
    }

    /**
     * Gets the correct resolution dependent of selected parameters
     *
     * @param string $image
     * @param bool   $thumbnail
     *
     * @return array
     * @since 3.4.0-FREE
     */
    private function calculateSize(string $image, bool $thumbnail): array
    {
        if ($this->pluginParameters['resize_images'] && empty($thumbnail)) {
            [$heightNew, $widthNew] = $this->calculateSizeProcess($image, (int)$this->pluginParameters['height_image'], (int)$this->pluginParameters['width_image'], (bool)$this->pluginParameters['ratio_image']);

            return [$heightNew, $widthNew];
        }

        [$heightNew, $widthNew] = $this->calculateSizeProcess($image, (int)$this->pluginParameters['height'], (int)$this->pluginParameters['width'], (bool)$this->pluginParameters['ratio']);

        return [$heightNew, $widthNew];
    }

    /**
     * Calculates the proper resolution of a specific image and returns the height and width in an array with integer
     * type casting
     *
     * @param string $image
     * @param int    $height
     * @param int    $width
     * @param bool   $ratio
     *
     * @return array
     * @since 3.4.0-FREE
     */
    private function calculateSizeProcess(string $image, int $height, int $width, bool $ratio): array
    {
        $heightNew = $height;
        $widthNew = $width;

        if ($ratio) {
            $imageData = getimagesize($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $image);
            $heightNew = $imageData[1] * ($width / $imageData[0]);

            if ($heightNew > $height) {
                $heightNew = $height;
                $widthNew = $imageData[0] * ($height / $imageData[1]);
            }
        }

        return [$heightNew, $widthNew];
    }

    /**
     * Creates the main CSS instructions for the gallery output
     *
     * @return string
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function createMainCssInstruction(): string
    {
        $sigeCss = '';

        if ($this->pluginParameters['css_image']) {
            $cssImageWidth = 600;

            if ($this->pluginParameters['css_image_half']) {
                $cssImageWidth /= 2;
            }

            $sigeCss .= '.sige_cont_' . $this->sigCount . ' .sige_css_image:hover span{width: ' . $cssImageWidth . 'px;}' . "\n";
        }

        $captionHeight = 0;

        if ($this->pluginParameters['caption']) {
            $captionHeight = 20;
        }

        if ($this->pluginParameters['salign']) {
            if ($this->pluginParameters['salign'] === 'left') {
                $sigeCss .= '.sige_cont_' . $this->sigCount . ' {width:' . ($this->thumbnailMaxWidth + $this->pluginParameters['gap_h']) . 'px;height:' . ($this->thumbnailMaxHeight + $this->pluginParameters['gap_v'] + $captionHeight) . 'px;float:left;display:inline-block;}' . "\n";
            } elseif ($this->pluginParameters['salign'] === 'right') {
                $sigeCss .= '.sige_cont_' . $this->sigCount . ' {width:' . ($this->thumbnailMaxWidth + $this->pluginParameters['gap_h']) . 'px;height:' . ($this->thumbnailMaxHeight + $this->pluginParameters['gap_v'] + $captionHeight) . 'px;float:right;display:inline-block;}' . "\n";
            } elseif ($this->pluginParameters['salign'] === 'center') {
                $sigeCss .= '.sige_cont_' . $this->sigCount . ' {width:' . ($this->thumbnailMaxWidth + $this->pluginParameters['gap_h']) . 'px;height:' . ($this->thumbnailMaxHeight + $this->pluginParameters['gap_v'] + $captionHeight) . 'px;display:inline-block;}' . "\n";
            }

            return $sigeCss;
        }

        $sigeCss .= '.sige_cont_' . $this->sigCount . ' {width:' . ($this->thumbnailMaxWidth + $this->pluginParameters['gap_h']) . 'px;height:' . ($this->thumbnailMaxHeight + $this->pluginParameters['gap_v'] + $captionHeight) . 'px;float:left;display:inline-block;}' . "\n";

        return $sigeCss;
    }

    /**
     * Loads the CSS and JS instructions to the head section of the HTML page
     *
     * @param int|string $sigeCss
     *
     * @since 3.4.0-FREE
     */
    private function loadHeadData($sigeCss = 0)
    {
        $document = Factory::getDocument();

        if ($document instanceof HtmlDocument) {
            $head = $this->getHeadData($sigeCss);

            // Combine dynamic CSS instructions - Check whether a custom style tag was already set and combine them to
            // avoid problems in some browsers due to too many CSS instructions
            if (!empty($sigeCss) && !empty($document->_custom)) {
                $customTags = [];

                foreach ($document->_custom as $key => $customTag) {
                    if (preg_match('@<style type="text/css">(.*)</style>@Us', $customTag, $match)) {
                        $customTags[] = $match[1];
                        unset($document->_custom[$key]);
                    }
                }

                // If content is loaded from the turbo file, then the CSS instructions need to be prepared for the output
                if ($sigeCss === 1) {
                    if (preg_match('@<style type="text/css">(.*)</style>@Us', $head, $match)) {
                        $sigeCss = $match[1];
                    }
                }

                if (!empty($customTags)) {
                    $head = '<style type="text/css">' . implode('', $customTags) . $sigeCss . '</style>';
                }
            }

            if (!empty($head)) {
                $document->addCustomTag($head);
            }
        }
    }

    /**
     * Creates the correct CSS and JS instructions for the loaded gallery
     *
     * @param string $sigeCss
     *
     * @return array|string
     * @since 3.4.0-FREE
     *
     */
    private function getHeadData(string $sigeCss)
    {
        if (!empty($sigeCss)) {
            if (!$this->pluginParameters['turbo'] || ($this->pluginParameters['turbo'] && $this->turboCssReadIn)) {
                $head = '<style type="text/css">' . $sigeCss . '</style>';

                if ($this->turboCssReadIn) {
                    File::write($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_css-' . $this->pluginParameters['lang'] . '.txt', $head);
                }

                return $head;
            }

            $head = file_get_contents($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_css-' . $this->pluginParameters['lang'] . '.txt');

            return $head;
        }

        if ($this->sigCountArticles === 0) {
            $head = [];
            $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/sige.css" type="text/css" media="screen" />';

            if ((int)$this->pluginParameters['js'] === 1) {
                HTMLHelper::_('behavior.framework');

                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/slimbox.js"></script>';
                $head[] = '<script type="text/javascript">
                                Slimbox.scanPage = function() {
                                    $$("a[rel^=lightbox]").slimbox({counterText: "' . Text::_('PLG_CONTENT_SIGE_SLIMBOX_IMAGES') . '"}, null, function(el) {
                                        return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
                                    });
                                };
                                if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
                                    window.addEvent("domready", Slimbox.scanPage);
                                }
                                </script>';
                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/slimbox.css" type="text/css" media="screen" />';
            } elseif ((int)$this->pluginParameters['js'] === 2) {
                if ($this->pluginParameters['lang'] === 'de-DE') {
                    $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/lytebox.js"></script>';
                } else {
                    $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/lytebox_en.js"></script>';
                }

                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/lytebox.css" type="text/css" media="screen" />';
            } elseif ((int)$this->pluginParameters['js'] === 3) {
                if ($this->pluginParameters['lang'] === 'de-DE') {
                    $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/shadowbox.js"></script>';
                } else {
                    $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/shadowbox_en.js"></script>';
                }

                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/shadowbox.css" type="text/css" media="screen" />';
                $head[] = '<script type="text/javascript">Shadowbox.init();</script>';
            } elseif ((int)$this->pluginParameters['js'] === 4) {
                HTMLHelper::_('behavior.framework');

                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/milkbox.js"></script>';
                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/milkbox.css" type="text/css" media="screen" />';
            } elseif ((int)$this->pluginParameters['js'] === 5) {
                HTMLHelper::_('jquery.framework');

                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/slimbox2.js"></script>';
                $head[] = '<script type="text/javascript">
                                if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
                                    jQuery(function($) {
                                        $("a[rel^=\'lightbox\']").slimbox({counterText: "' . Text::_('PLG_CONTENT_SIGE_SLIMBOX_IMAGES') . '"}, null, function(el) {
                                            return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
                                        });
                                    });
                                }
                                </script>';
                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/slimbox2.css" type="text/css" media="screen" />';
            } elseif ((int)$this->pluginParameters['js'] === 6) {
                HTMLHelper::_('jquery.framework');

                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/venobox/venobox.min.js"></script>';

                $venoboxIni = '<script type="text/javascript">jQuery(document).ready(function(){jQuery(\'.venobox\').venobox(';

                if (!empty($this->pluginParameters['modaltitle'])) {
                    $venoboxIni .= '{titleattr: \'' . $this->pluginParameters['modaltitle'] . '\'}';
                }

                $venoboxIni .= ');});</script>';

                $head[] = $venoboxIni;
                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/venobox/venobox.min.css" type="text/css" media="screen" />';
            } elseif ((int)$this->pluginParameters['js'] === 7) {
                HTMLHelper::_('jquery.framework');

                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/photoswipe/photoswipe.min.js"></script>';
                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/photoswipe/photoswipe-ui-default.min.js"></script>';
                $head[] = '<script type="text/javascript" src="' . $this->liveSite . '/plugins/content/sige/assets/photoswipe/photoswipe.sige.min.js"></script>';
                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/photoswipe/photoswipe.css" type="text/css" />';
                $head[] = '<link rel="stylesheet" href="' . $this->liveSite . '/plugins/content/sige/assets/photoswipe/default-skin/default-skin.css" type="text/css" />';
            }

            return "\n" . implode("\n", $head) . "\n";
        }

        return '';
    }

    /**
     * Resizes all loaded images to the specified resolution
     *
     * @param array $images
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function resizeImages(array $images)
    {
        $this->createEmptyDirectory($this->absolutePath . $this->rootFolder . $this->imagesDir . '/resizedimages');

        foreach ($images as $image) {
            $this->resizeImage($image['filename']);
        }
    }

    /**
     * Creates an empty directory and index.html file in the transferred path
     *
     * @param string $path
     *
     * @since 3.4.0-FREE
     */
    private function createEmptyDirectory(string $path)
    {
        if (!is_dir($path)) {
            Folder::create($path, 0755);
            File::write($path . '/index.html', '');
        }
    }

    /**
     * Resizes a specific image properly
     *
     * @param string $image
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function resizeImage(string $image)
    {
        if (!empty($image)) {
            $fileNameThumb = $this->absolutePath . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $image;

            if (!empty($this->pluginParameters['images_new'] || !File::exists($fileNameThumb))) {
                $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

                if ($imageType === 'jpg' || $imageType === 'jpeg') {
                    $imageSource = imagecreatefromjpeg($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $image);
                    $imageThumb = $this->resizeImageThumbnail($image, $imageSource);
                    imagejpeg($imageThumb, $this->absolutePath . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $image, $this->pluginParameters['quality']);
                } elseif ($imageType === 'png') {
                    $imageSource = imagecreatefrompng($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $image);
                    $imageThumb = $this->resizeImageThumbnail($image, $imageSource);
                    imagepng($imageThumb, $this->absolutePath . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $image, $this->pluginParameters['quality_png']);
                } elseif ($imageType === 'gif') {
                    $imageSource = imagecreatefromgif($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $image);
                    $imageThumb = $this->resizeImageThumbnail($image, $imageSource);
                    imagegif($imageThumb, $this->absolutePath . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $image);
                }

                if (isset($imageSource) && is_resource($imageSource)) {
                    imagedestroy($imageSource);
                }

                if (isset($imageThumb) && is_resource($imageThumb)) {
                    imagedestroy($imageThumb);
                }

                return;
            }
        }
    }

    /**
     * Creates the copy of the resized image
     *
     * @param string   $image
     * @param resource $imageSource
     *
     * @return resource
     *
     * @since 3.4.0-FREE
     */
    private function resizeImageThumbnail(string $image, $imageSource)
    {
        $widthOriginal = imagesx($imageSource);
        $heightOriginal = imagesy($imageSource);
        [$heightNew, $widthNew] = $this->calculateSize($image, 0);
        $imageThumb = imagecreatetruecolor($widthNew, $heightNew);
        imagecopyresampled($imageThumb, $imageSource, 0, 0, 0, 0, $widthNew, $heightNew, $widthOriginal, $heightOriginal);

        return $imageThumb;
    }

    /**
     * Creates the watermark on the images
     *
     * @param array $images
     * @param bool  $singleYes
     *
     * @since 3.4.0-FREE
     */
    private function createWatermark(array $images, bool $singleYes)
    {
        $this->createEmptyDirectory($this->absolutePath . $this->rootFolder . $this->imagesDir . '/wm');
        $num = count($images);

        if (empty($this->pluginParameters['single_gallery']) && $singleYes) {
            $num = 1;
        }

        for ($a = 0; $a < $num; $a++) {
            $this->createWatermarkImage($images[$a]['filename']);
        }
    }

    /**
     * Creates the watermark on a specific image
     *
     * @param string $image
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function createWatermarkImage(string $image)
    {
        if (!empty($image)) {
            $imageHash = $this->encryptImageName($image);
            $fileNameWatermark = $this->absolutePath . $this->rootFolder . $this->imagesDir . '/wm/' . $imageHash;

            if (!empty($this->pluginParameters['watermark_new']) || !File::exists($fileNameWatermark)) {
                $imageWatermark = imagecreatefrompng($this->absolutePath . '/plugins/content/sige/assets/watermark.png');

                if ($this->pluginParameters['watermarkimage']) {
                    $imageWatermark = imagecreatefrompng($this->absolutePath . '/plugins/content/sige/assets/' . $this->pluginParameters['watermarkimage']);
                }

                $watermarkWidth = (int)imagesx($imageWatermark);
                $watermarkHeight = (int)imagesy($imageWatermark);
                $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

                if ($imageType === 'jpg' || $imageType === 'jpeg') {
                    $imageSource = imagecreatefromjpeg($this->createWatermarkImageThumbnailSourcePath($image));
                    $imageSourceWatermark = $this->createWatermarkImageCopy($imageSource, $imageWatermark, $watermarkHeight, $watermarkWidth);
                    imagejpeg($imageSourceWatermark, $this->absolutePath . $this->rootFolder . $this->imagesDir . '/wm/' . $imageHash, $this->pluginParameters['quality']);
                } elseif ($imageType === 'png') {
                    $imageSource = imagecreatefrompng($this->createWatermarkImageThumbnailSourcePath($image));
                    $imageSourceWatermark = $this->createWatermarkImageCopy($imageSource, $imageWatermark, $watermarkHeight, $watermarkWidth);
                    imagepng($imageSourceWatermark, $this->absolutePath . $this->rootFolder . $this->imagesDir . '/wm/' . $imageHash, $this->pluginParameters['quality_png']);
                } elseif ($imageType === 'gif') {
                    $imageSource = imagecreatefromgif($this->createWatermarkImageThumbnailSourcePath($image));
                    $imageSourceTemp = imagecreatetruecolor(imagesx($imageSource), imagesy($imageSource));
                    imagecopy($imageSourceTemp, $imageSource, 0, 0, 0, 0, imagesx($imageSource), imagesy($imageSource));
                    $imageSource = $imageSourceTemp;

                    $imageSourceWatermark = $this->createWatermarkImageCopy($imageSource, $imageWatermark, $watermarkHeight, $watermarkWidth);
                    imagegif($imageSourceWatermark, $this->absolutePath . $this->rootFolder . $this->imagesDir . '/wm/' . $imageHash);
                }

                if (isset($imageSource) && is_resource($imageSource)) {
                    imagedestroy($imageSource);
                }

                if (isset($imageWatermark) && is_resource($imageWatermark)) {
                    imagedestroy($imageWatermark);
                }
            }
        }
    }

    /**
     * Creates an image name hash to hide the original image name
     *
     * @param string $image
     *
     * @return string
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function encryptImageName(string $image): string
    {
        $watermarkEncryption = (int)$this->pluginParameters['encrypt'];

        if ($watermarkEncryption === -1) {
            return $image;
        }

        $imageName = pathinfo($image, PATHINFO_FILENAME);
        $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $imageHash = md5($imageName);

        if ($watermarkEncryption === 0) {
            $imageHash = str_rot13($imageName);
        }

        if ($watermarkEncryption === 2) {
            $imageHash = sha1($imageName);
        }

        return $imageHash . '.' . $imageType;
    }

    /**
     * Creates the watermark image thumbnail source path
     *
     * @param string $image
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function createWatermarkImageThumbnailSourcePath(string $image): string
    {
        if ($this->pluginParameters['resize_images']) {
            return $this->absolutePath . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $image;
        }

        return $this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $image;
    }

    /**
     * Creates the watermark image copy
     *
     * @param resource $imageSource
     * @param resource $imageWatermark
     * @param int      $watermarkHeight
     * @param int      $watermarkWidth
     *
     * @return mixed
     * @since 3.4.0-FREE
     */
    private function createWatermarkImageCopy($imageSource, $imageWatermark, int $watermarkHeight, int $watermarkWidth)
    {
        $widthOriginal = imagesx($imageSource);
        $heightOriginal = imagesy($imageSource);
        $watermarkPosition = (int)$this->pluginParameters['watermarkposition'];

        if ($watermarkPosition === 1) {
            imagecopy($imageSource, $imageWatermark, 0, 0, 0, 0, $watermarkWidth, $watermarkHeight);
        } elseif ($watermarkPosition === 2) {
            imagecopy($imageSource, $imageWatermark, $widthOriginal - $watermarkWidth, 0, 0, 0, $watermarkWidth, $watermarkHeight);
        } elseif ($watermarkPosition === 3) {
            imagecopy($imageSource, $imageWatermark, 0, $heightOriginal - $watermarkHeight, 0, 0, $watermarkWidth, $watermarkHeight);
        } elseif ($watermarkPosition === 4) {
            imagecopy($imageSource, $imageWatermark, $widthOriginal - $watermarkWidth, $heightOriginal - $watermarkHeight, 0, 0, $watermarkWidth, $watermarkHeight);
        } else {
            imagecopy($imageSource, $imageWatermark, ($widthOriginal - $watermarkWidth) / 2, ($heightOriginal - $watermarkHeight) / 2, 0, 0, $watermarkWidth, $watermarkHeight);
        }

        return $imageSource;
    }

    /**
     * Limits the image list if corresponding parameter is set
     *
     * @param int $imagesLoaded
     * @param int $imagesLoadedRest
     *
     * @since 3.4.0-FREE
     */
    private function limitImageList(int &$imagesLoaded, int &$imagesLoadedRest)
    {
        if ($this->pluginParameters['limit'] && (empty($this->pluginParameters['single']) || empty($this->pluginParameters['single_gallery']))) {
            $imagesLoadedRest = $imagesLoaded;

            if ($imagesLoaded > $this->pluginParameters['limit_quantity']) {
                $imagesLoaded = $this->pluginParameters['limit_quantity'];
            }
        }
    }

    /**
     * Creates and stores thumbnails of the original images
     *
     * @param array $images
     * @param int   $imagesLoaded
     *
     * @since 3.4.0-FREE
     */
    private function createThumbnails(array $images, int $imagesLoaded)
    {
        if (empty($this->pluginParameters['list']) && empty($this->pluginParameters['word'])) {
            $this->createEmptyDirectory($this->absolutePath . $this->rootFolder . $this->imagesDir . '/thumbs');

            for ($a = 0; $a < $imagesLoaded; $a++) {
                $this->createThumbnail($images[$a]['filename']);
            }
        }
    }

    /**
     * Creates a thumbnail from a specific image
     *
     * @param string $image
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function createThumbnail(string $image)
    {
        if (!empty($image)) {
            $fileNameThumb = $this->absolutePath . $this->rootFolder . $this->imagesDir . '/thumbs/' . $image;

            if ($this->pluginParameters['watermark']) {
                $fileNameThumb = $this->absolutePath . $this->rootFolder . $this->imagesDir . '/thumbs/' . $this->encryptImageName($image);
            }

            if (!empty($this->pluginParameters['thumbs_new']) || !File::exists($fileNameThumb)) {
                $imageSourcePath = $this->createThumbnailSourceImagePath($image);
                $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

                if ($imageType === 'jpg' || $imageType === 'jpeg') {
                    $imageSource = imagecreatefromjpeg($imageSourcePath);
                    $imageThumb = $this->createThumbnailResize($image, $imageSource);
                    imagejpeg($imageThumb, $this->createThumbnailDestinationImagePath($image), $this->pluginParameters['quality']);
                } elseif ($imageType === 'png') {
                    $imageSource = imagecreatefrompng($imageSourcePath);
                    $imageThumb = $this->createThumbnailResize($image, $imageSource);
                    imagepng($imageThumb, $this->createThumbnailDestinationImagePath($image), $this->pluginParameters['quality_png']);
                } elseif ($imageType === 'gif') {
                    $imageSource = imagecreatefromgif($imageSourcePath);
                    $imageThumb = $this->createThumbnailResize($image, $imageSource);
                    imagegif($imageThumb, $this->createThumbnailDestinationImagePath($image));
                }

                if (isset($imageSource) && is_resource($imageSource)) {
                    imagedestroy($imageSource);
                }

                if (isset($imageThumb) && is_resource($imageThumb)) {
                    imagedestroy($imageThumb);
                }
            }
        }
    }

    /**
     * Creates the thumbnail source image path
     *
     * @param string $image
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function createThumbnailSourceImagePath(string $image): string
    {
        if ($this->pluginParameters['watermark']) {
            return $this->absolutePath . $this->rootFolder . $this->imagesDir . '/wm/' . $this->encryptImageName($image);
        }

        return $this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $image;
    }

    /**
     * Creates the resized thumbnail copy
     *
     * @param string   $image
     * @param resource $imageSource
     *
     * @return resource
     * @since 3.4.0-FREE
     */
    private function createThumbnailResize(string $image, $imageSource)
    {
        [$heightNew, $widthNew] = $this->calculateSize($image, true);

        $heightOriginal = (int)imagesy($imageSource);
        $widthOriginal = (int)imagesx($imageSource);
        $imageThumb = imagecreatetruecolor($widthNew, $heightNew);

        if ($this->pluginParameters['crop'] && ($this->pluginParameters['crop_factor'] > 0 && $this->pluginParameters['crop_factor'] < 100)) {
            [$cropWidth, $cropHeight, $xCoordinate, $yCoordinate] = $this->getCropInformation($widthOriginal, $heightOriginal);
            imagecopyresampled($imageThumb, $imageSource, 0, 0, $xCoordinate, $yCoordinate, $widthNew, $heightNew, $cropWidth, $cropHeight);

            return $imageThumb;
        }

        $thumbnailDetail = (int)$this->pluginParameters['thumbdetail'];

        if ($thumbnailDetail === 1) {
            imagecopyresampled($imageThumb, $imageSource, 0, 0, 0, 0, $widthNew, $heightNew, $widthNew, $heightNew);
        } elseif ($thumbnailDetail === 2) {
            imagecopyresampled($imageThumb, $imageSource, 0, 0, $widthOriginal - $widthNew, 0, $widthNew, $heightNew, $widthNew, $heightNew);
        } elseif ($thumbnailDetail === 3) {
            imagecopyresampled($imageThumb, $imageSource, 0, 0, 0, $heightOriginal - $heightNew, $widthNew, $heightNew, $widthNew, $heightNew);
        } elseif ($thumbnailDetail === 4) {
            imagecopyresampled($imageThumb, $imageSource, 0, 0, $widthOriginal - $widthNew, $heightOriginal - $heightNew, $widthNew, $heightNew, $widthNew, $heightNew);
        } else {
            imagecopyresampled($imageThumb, $imageSource, 0, 0, 0, 0, $widthNew, $heightNew, $widthOriginal, $heightOriginal);
        }

        return $imageThumb;
    }

    /**
     * Gets correct crop information from specified parameter values
     *
     * @param int $widthOriginal
     * @param int $heightOriginal
     *
     * @return array
     * @since   3.4.0-FREE
     * @version 3.4.2-FRE
     */
    private function getCropInformation(int $widthOriginal, int $heightOriginal): array
    {
        $biggestSide = $heightOriginal;

        if ($widthOriginal > $heightOriginal) {
            $biggestSide = $widthOriginal;
        }

        $cropPercent = (1 - ($this->pluginParameters['crop_factor'] / 100));

        $cropWidth = $widthOriginal * $cropPercent;
        $cropHeight = $heightOriginal * $cropPercent;

        if (!$this->pluginParameters['ratio']) {
            if ($this->pluginParameters['width'] === $this->pluginParameters['height']) {
                $cropWidth = $biggestSide * $cropPercent;
                $cropHeight = $biggestSide * $cropPercent;
            } elseif ($this->pluginParameters['width'] !== $this->pluginParameters['height']) {
                $cropWidth = ($this->pluginParameters['width'] * ($heightOriginal / $this->pluginParameters['height'])) * $cropPercent;
                $cropHeight = $heightOriginal * $cropPercent;

                if (($widthOriginal / $this->pluginParameters['width']) < ($heightOriginal / $this->pluginParameters['height'])) {
                    $cropWidth = $widthOriginal * $cropPercent;
                    $cropHeight = ($this->pluginParameters['height'] * ($widthOriginal / $this->pluginParameters['width'])) * $cropPercent;
                }
            }
        }

        $xCoordinate = ($widthOriginal - $cropWidth) / 2;
        $yCoordinate = ($heightOriginal - $cropHeight) / 2;

        return [$cropWidth, $cropHeight, $xCoordinate, $yCoordinate];
    }

    /**
     * Creates the thumbnail destination image path
     *
     * @param string $image
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function createThumbnailDestinationImagePath(string $image): string
    {
        if ($this->pluginParameters['watermark']) {
            return $this->absolutePath . $this->rootFolder . $this->imagesDir . '/thumbs/' . $this->encryptImageName($image);
        }

        return $this->absolutePath . $this->rootFolder . $this->imagesDir . '/thumbs/' . $image;
    }

    /**
     * Creates the dynamic Swipe class ID
     *
     * @return mixed
     * @since 3.4.0-FREE
     */
    private function getSwipeClassId()
    {
        $swipeClassId = $this->sigCount;

        if ($this->pluginParameters['connect']) {
            $swipeClassId = $this->pluginParameters['connect'];
        }

        return $swipeClassId;
    }

    /**
     * Creates the HTML code for a specific image in the gallery
     *
     * @param string $image
     * @param string $html
     * @param int    $hidden
     * @param array  $fileInfo
     * @param int    $imageCount
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function htmlImage(string $image, string &$html, int $hidden, array &$fileInfo, int $imageCount)
    {
        if (!empty($image)) {
            $this->image = $image;
            $this->setImageInformation($fileInfo);

            if (!empty($hidden)) {
                $this->htmlImageHidden($html);

                return;
            }

            if ($this->pluginParameters['list'] && !$this->pluginParameters['word']) {
                $html .= '<li>';
            } elseif ($this->pluginParameters['word']) {
                $html .= '<span class="' . $this->getSingleElementClass(true) . '">';
            } else {
                $html .= '<li class="' . $this->getSingleElementClass() . '"><span class="sige_thumb">';
            }

            $this->htmlImageAnchorTag($html);

            if (!$this->pluginParameters['list'] && !$this->pluginParameters['word']) {
                $this->htmlImageImgTag($html);
            } elseif ($this->pluginParameters['list'] && !$this->pluginParameters['word']) {
                $html .= $this->imageInfo['image_title'];

                if (!empty($this->imageInfo['image_description'])) {
                    $html .= ' - ' . $this->imageInfo['image_description'];
                }
            } elseif ($this->pluginParameters['word']) {
                $html .= Text::_($this->pluginParameters['word']);
            }

            if ($this->pluginParameters['css_image'] && !$this->pluginParameters['image_link']) {
                $this->htmlImageImgTagCssImage($html);
            }

            if (!$this->pluginParameters['noslim'] || $this->pluginParameters['image_link'] || $this->pluginParameters['css_image'] || !empty($this->imageInfo['image_link_file'])) {
                $html .= '</a>';
            }

            if ($this->pluginParameters['caption']) {
                $this->htmlImageCaption($html);
            }

            if ($this->pluginParameters['list'] && !$this->pluginParameters['word']) {
                $html .= '</li>';
            } elseif ($this->pluginParameters['word']) {
                $html .= '</span>';
            } elseif (!$this->pluginParameters['caption']) {
                $html .= '</span></li>';
            }
        }

        if ($this->pluginParameters['column_quantity']) {
            if (($imageCount + 1) % $this->pluginParameters['column_quantity'] === 0) {
                $html .= '<br class="sige_clr"/>';
            }
        }
    }

    /**
     * Sets image information and converts special characters to HTML entities
     *
     * @param array $fileInfo
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function setImageInformation(array &$fileInfo)
    {
        $this->imageInfo = [
            'image_hash'        => $this->encryptImageName($this->image),
            'image_title'       => pathinfo($this->image, PATHINFO_FILENAME),
            'image_alt'         => pathinfo($this->image, PATHINFO_FILENAME),
            'image_description' => '',
            'image_link_file'   => '',
        ];

        if (!empty($fileInfo)) {
            $this->htmlImageFileInfo($fileInfo);
        }

        if ((int)$this->pluginParameters['iptc'] === 1) {
            $this->iptcInfo();
        }

        $this->imageInfo = array_map([$this, 'cleanImageInformation'], $this->imageInfo);
    }

    /**
     * Defines file info information if provided for the loaded image
     *
     * @param array $fileInfo
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function htmlImageFileInfo(array &$fileInfo)
    {
        foreach ($fileInfo as $key => $value) {
            if ($value[0] === $this->image) {
                // Image title
                if (!empty($value[1])) {
                    $this->imageInfo['image_title'] = $value[1];
                }

                // Image description
                if (!empty($value[2])) {
                    $this->imageInfo['image_description'] = $value[2];
                }

                // Alt attribute for image
                if (!empty($value[3])) {
                    $this->imageInfo['image_alt'] = $value[3];
                }

                // Link for image
                if (!empty($value[4])) {
                    $this->imageInfo['image_link_file'] = $value[4];
                }

                // Remove information from file_info array to speed up the process for the following images
                unset($fileInfo[$key]);
                break;
            }
        }
    }

    /**
     * Sets IPTC information if set and provided
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function iptcInfo()
    {
        $iptcTitle = '';
        $iptcCaption = '';
        $info = [];

        getimagesize(JPATH_SITE . $this->rootFolder . $this->imagesDir . '/' . $this->image, $info);

        if (isset($info['APP13'])) {
            $iptcPhp = iptcparse($info['APP13']);

            if (is_array($iptcPhp)) {
                $data = ['caption' => '', 'title' => ''];

                if (isset($iptcPhp["2#120"][0])) {
                    $data['caption'] = $iptcPhp["2#120"][0];
                }

                if (isset($iptcPhp["2#005"][0])) {
                    $data['title'] = $iptcPhp["2#005"][0];
                }

                $iptcTitle = utf8_encode(html_entity_decode($data['title'], ENT_NOQUOTES));
                $iptcCaption = utf8_encode(html_entity_decode($data['caption'], ENT_NOQUOTES));

                if ((int)$this->pluginParameters['iptcutf8'] === 1) {
                    $iptcTitle = html_entity_decode($data['title'], ENT_NOQUOTES);
                    $iptcCaption = html_entity_decode($data['caption'], ENT_NOQUOTES);
                }
            }
        }

        if (!empty($iptcTitle)) {
            $this->imageInfo['image_title'] = $iptcTitle;
        }

        if (!empty($iptcCaption)) {
            $this->imageInfo['image_description'] = $iptcCaption;
        }
    }

    /**
     * Creates the hidden output for the gallery - e.g. used in the lightbox gallery view
     *
     * @param string $html
     *
     * @return string
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function htmlImageHidden(string &$html): string
    {
        $singleElementClass = $this->getSingleElementClass(true);

        if (!$this->pluginParameters['noslim']) {
            if ($this->pluginParameters['watermark']) {
                $html .= '<span class="sige_hidden ' . $singleElementClass . '"><a href="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/wm/' . $this->imageInfo['image_hash'] . '"';
            } else {
                if ($this->pluginParameters['resize_images']) {
                    $html .= '<span class="sige_hidden ' . $singleElementClass . '"><a href="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $this->image . '"';
                } else {
                    $html .= '<span class="sige_hidden ' . $singleElementClass . '"><a href="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/' . $this->image . '"';
                }
            }

            if ((int)$this->pluginParameters['view'] === 7) {
                $html .= ' data-size="' . $this->getDataSizeAttribute() . '"';
            }

            $this->htmlImageRelAttribute($html);
            $html .= ' title="';
            $this->htmlImageAddTitleAttribute($html);
            $html .= '"></a></span>';
        }

        return $html;
    }

    /**
     * Gets the CSS class for a single image element
     *
     * @param bool $swipeOnly
     *
     * @return string
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function getSingleElementClass(bool $swipeOnly = false): string
    {
        $class = '';

        if (!$swipeOnly) {
            $class = 'sige_cont_' . $this->sigCount;
        }

        // PhotoSwipe - Add specific class for the PhotoSwipe library
        if ((int)$this->pluginParameters['view'] === 7) {
            // Do not add PhotoSwipe class if link is set
            if (empty($this->imageInfo['image_link_file'])) {
                $swipeClassId = $this->sigCount;

                if ($this->pluginParameters['connect']) {
                    $swipeClassId = $this->pluginParameters['connect'];
                }

                $class .= ' sige_swipe sige_swipe_single_' . $swipeClassId;
            }
        }

        return $class;
    }

    /**
     * Gets the correct image sizes for the data-size attribute, required by PhotoSwipe
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function getDataSizeAttribute(): string
    {
        $imageSize = getimagesize($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $this->image);

        if (empty($imageSize) || !is_array($imageSize)) {
            return '';
        }

        return $imageSize[0] . 'x' . $imageSize[1];
    }

    /**
     * Creates the image rel attribute code for a specific image
     *
     * @param string $html
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function htmlImageRelAttribute(string &$html)
    {
        $view = (int)$this->pluginParameters['view'];

        if ($this->pluginParameters['connect']) {
            if ($view === 0 || $view === 5) {
                $html .= ' rel="lightbox.sig' . $this->pluginParameters['connect'] . '"';
            } elseif ($view === 1) {
                $html .= ' rel="lytebox.sig' . $this->pluginParameters['connect'] . '"';
            } elseif ($view === 2) {
                $html .= ' rel="lyteshow.sig' . $this->pluginParameters['connect'] . '"';
            } elseif ($view === 3) {
                $html .= ' rel="shadowbox[sig' . $this->pluginParameters['connect'] . ']"';
            } elseif ($view === 4) {
                $html .= ' data-milkbox="milkbox-' . $this->pluginParameters['connect'] . '"';
            } elseif ($view === 6) {
                $html .= ' class="venobox" data-gall="venobox-' . $this->pluginParameters['connect'] . '"';
            }

            return;
        }

        if ($view === 0 || $view === 5) {
            $html .= ' rel="lightbox.sig' . $this->sigCount . '"';
        } elseif ($view === 1) {
            $html .= ' rel="lytebox.sig' . $this->sigCount . '"';
        } elseif ($view === 2) {
            $html .= ' rel="lyteshow.sig' . $this->sigCount . '"';
        } elseif ($view === 3) {
            $html .= ' rel="shadowbox[sig' . $this->sigCount . ']"';
        } elseif ($view === 4) {
            $html .= ' data-milkbox="milkbox-' . $this->sigCount . '"';
        } elseif ($view === 6) {
            $html .= ' class="venobox" data-gall="venobox-' . $this->sigCount . '"';
        }
    }

    /**
     * Creates the title attribute data for a specific image
     *
     * @param string $html
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function htmlImageAddTitleAttribute(string &$html)
    {
        if ($this->pluginParameters['displaynavtip'] && !empty($this->pluginParameters['navtip'])) {
            $html .= $this->pluginParameters['navtip'] . '&lt;br /&gt;';
        }

        if ($this->pluginParameters['displaymessage'] && !empty($this->articleTitle)) {
            if (!empty($this->pluginParameters['message'])) {
                $html .= $this->pluginParameters['message'] . ': ';
            }

            $html .= '&lt;span class=&quot;sige_js_title&quot;&gt;' . $this->articleTitle . '&lt;/span&gt;&lt;br /&gt;';
        }

        if ($this->pluginParameters['image_info']) {
            $html .= '&lt;span class=&quot;sige_js_title&quot;&gt;' . $this->imageInfo['image_title'] . '&lt;/span&gt;';

            if (!empty($this->imageInfo['image_description'])) {
                $html .= ' - ' . $this->imageInfo['image_description'];
            }
        }

        if ((bool)$this->pluginParameters['print']) {
            $html .= ' &lt;a href=&quot;' . $this->liveSite . '/plugins/content/sige/assets/print.php?img=' . rawurlencode($this->htmlImagePrintPath()) . '&amp;name=' . rawurlencode($this->imageInfo['image_title']) . '&quot; title=&quot;Print&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;' . $this->liveSite . '/plugins/content/sige/assets/print.png&quot; /&gt;&lt;/a&gt;';
        }

        if ((bool)$this->pluginParameters['download']) {
            $html .= ' &lt;a href=&quot;' . $this->liveSite . '/plugins/content/sige/assets/download.php?img=' . rawurlencode($this->htmlImageDownloadPath()) . '&quot; title=&quot;Download&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;' . $this->liveSite . '/plugins/content/sige/assets/download.png&quot; /&gt;&lt;/a&gt;';
        }
    }

    /**
     * Returns the correct print path
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function htmlImagePrintPath(): string
    {
        if ($this->pluginParameters['watermark']) {
            return $this->liveSite . $this->rootFolder . $this->imagesDir . '/wm/' . $this->imageInfo['image_hash'];
        }

        if ($this->pluginParameters['resize_images']) {
            return $this->liveSite . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $this->image;
        }

        return $this->liveSite . $this->rootFolder . $this->imagesDir . '/' . $this->image;
    }

    /**
     * Returns the correct download path
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function htmlImageDownloadPath(): string
    {
        if ($this->pluginParameters['watermark']) {
            return $this->rootFolder . $this->imagesDir . '/wm/' . $this->imageInfo['image_hash'];
        }

        if ($this->pluginParameters['resize_images']) {
            return $this->rootFolder . $this->imagesDir . '/resizedimages/' . $this->image;
        }

        return $this->rootFolder . $this->imagesDir . '/' . $this->image;
    }

    /**
     * Creates the anchor tag code for a specific image
     *
     * @param string $html
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function htmlImageAnchorTag(string &$html)
    {
        if ($this->pluginParameters['image_link'] || !empty($this->imageInfo['image_link_file'])) {
            // Use link from captions.txt if provided
            if (!empty($this->imageInfo['image_link_file'])) {
                // Add http:// if not already set
                if (!preg_match('@http.?://@', $this->imageInfo['image_link_file'])) {
                    $this->imageInfo['image_link_file'] = 'http://' . $this->imageInfo['image_link_file'];
                }

                $html .= '<a href="' . $this->imageInfo['image_link_file'] . '" title="' . $this->imageInfo['image_link_file'] . '" ';
            } else {
                $imageLinkLocal = '';

                if ($this->pluginParameters['image_link_local']) {
                    $imageLinkLocal = $this->liveSite . '/';
                }

                $html .= '<a href="' . $imageLinkLocal . $this->pluginParameters['image_link'] . '" title="' . $this->pluginParameters['image_link'] . '" ';
            }

            if ($this->pluginParameters['image_link_new']) {
                $html .= 'target="_blank"';
            }

            $html .= '>';

            return;
        }

        if ($this->pluginParameters['noslim'] && $this->pluginParameters['css_image']) {
            $html .= '<a class="sige_css_image" href="#sige_thumbnail">';

            return;
        }

        if (!$this->pluginParameters['noslim']) {
            if ($this->pluginParameters['watermark']) {
                $html .= '<a href="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/wm/' . $this->imageInfo['image_hash'] . '"';
            } elseif ($this->pluginParameters['resize_images']) {
                $html .= '<a href="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $this->image . '"';
            } else {
                $html .= '<a href="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/' . $this->image . '"';
            }

            if ($this->pluginParameters['css_image']) {
                $html .= ' class="sige_css_image';

                // Add Venobox class if this JS application is selected
                if ($this->pluginParameters['view'] == 6) {
                    $html .= ' venobox';
                }

                $html .= '"';
            }

            if ((int)$this->pluginParameters['view'] === 7) {
                $html .= ' data-size="' . $this->getDataSizeAttribute() . '"';
            }

            $this->htmlImageRelAttribute($html);

            $modalTitle = ' title="';

            if (!empty($this->pluginParameters['modaltitle'])) {
                $modalTitle = ' title="' . $this->imageInfo['image_title'] . '" ' . $this->pluginParameters['modaltitle'] . '="';
            } elseif ((int)$this->pluginParameters['view'] === 7) {
                $modalTitle = ' title="' . $this->imageInfo['image_title'] . '" data-title="';
            }

            $html .= $modalTitle;
            $this->htmlImageAddTitleAttribute($html);
            $html .= '" >';
        }
    }

    /**
     * Creates the image tag code for a specific image
     *
     * @param string $html
     *
     * @since 3.4.0-FREE
     */
    private function htmlImageImgTag(string &$html)
    {
        if ($this->pluginParameters['thumbs']) {
            $html .= '<img alt="' . $this->imageInfo['image_alt'] . '" title="' . $this->imageInfo['image_title'];

            if (!empty($this->imageInfo['image_description'])) {
                $html .= ' - ' . $this->imageInfo['image_description'];
            }

            if ($this->pluginParameters['watermark']) {
                $html .= '" src="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/thumbs/' . $this->imageInfo['image_hash'] . '" />';
            } else {
                $html .= '" src="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/thumbs/' . $this->image . '" />';
            }

            return;
        }

        $this->htmlImageImgTagDynamic($html);
    }

    /**
     * Creates the image tag code for a specific image using on-the-fly thumbnail generation
     *
     * @param string $html
     *
     * @since 3.4.0-FREE
     */
    private function htmlImageImgTagDynamic(string &$html)
    {
        $html .= '<img alt="' . $this->imageInfo['image_alt'] . '" title="' . $this->imageInfo['image_title'];

        if ($this->imageInfo['image_description']) {
            $html .= ' - ' . $this->imageInfo['image_description'];
        }

        if ($this->pluginParameters['watermark']) {
            $html .= '" src="' . $this->liveSite . '/plugins/content/sige/assets/showthumb.php?img=' . $this->rootFolder . $this->imagesDir . '/wm/' . $this->imageInfo['image_hash'] . '&amp;width=' . $this->pluginParameters['width'] . '&amp;height=' . $this->pluginParameters['height'] . '&amp;quality=' . $this->pluginParameters['quality'] . '&amp;ratio=' . $this->pluginParameters['ratio'] . '&amp;crop=' . $this->pluginParameters['crop'] . '&amp;crop_factor=' . $this->pluginParameters['crop_factor'] . '&amp;thumbdetail=' . $this->pluginParameters['thumbdetail'] . '" />';

            return;
        }

        if ($this->pluginParameters['resize_images']) {
            $html .= '" src="' . $this->liveSite . '/plugins/content/sige/assets/showthumb.php?img=' . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $this->image . '&amp;width=' . $this->pluginParameters['width'] . '&amp;height=' . $this->pluginParameters['height'] . '&amp;quality=' . $this->pluginParameters['quality'] . '&amp;ratio=' . $this->pluginParameters['ratio'] . '&amp;crop=' . $this->pluginParameters['crop'] . '&amp;crop_factor=' . $this->pluginParameters['crop_factor'] . '&amp;thumbdetail=' . $this->pluginParameters['thumbdetail'] . '" />';

            return;
        }

        $html .= '" src="' . $this->liveSite . '/plugins/content/sige/assets/showthumb.php?img=' . $this->rootFolder . $this->imagesDir . '/' . $this->image . '&amp;width=' . $this->pluginParameters['width'] . '&amp;height=' . $this->pluginParameters['height'] . '&amp;quality=' . $this->pluginParameters['quality'] . '&amp;ratio=' . $this->pluginParameters['ratio'] . '&amp;crop=' . $this->pluginParameters['crop'] . '&amp;crop_factor=' . $this->pluginParameters['crop_factor'] . '&amp;thumbdetail=' . $this->pluginParameters['thumbdetail'] . '" />';
    }

    /**
     * Creates the image tag code for a specific image using the CSS image tooltip
     *
     * @param string $html
     *
     * @since 3.4.0-FREE
     */
    private function htmlImageImgTagCssImage(string &$html)
    {
        $html .= '<span>';

        if ($this->pluginParameters['watermark']) {
            $html .= '<img src="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/wm/' . $this->imageInfo['image_hash'] . '"';
        } else {
            if ($this->pluginParameters['resize_images']) {
                $html .= '<img src="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/resizedimages/' . $this->image . '"';
            } else {
                $html .= '<img src="' . $this->liveSite . $this->rootFolder . $this->imagesDir . '/' . $this->image . '"';
            }
        }

        if ($this->pluginParameters['css_image_half'] && !$this->pluginParameters['list']) {
            $imageData = getimagesize($this->absolutePath . $this->rootFolder . $this->imagesDir . '/' . $this->image);
            $html .= ' width="' . ($imageData[0] / 2) . '" height="' . ($imageData[1] / 2) . '"';
        }

        $html .= ' alt="' . $this->imageInfo['image_alt'] . '" title="' . $this->imageInfo['image_title'];

        if ($this->imageInfo['image_description']) {
            $html .= ' - ' . $this->imageInfo['image_description'];
        }

        $html .= '" /></span>';
    }

    /**
     * Adds image caption to a specific image
     *
     * @param string $html
     *
     * @since 3.4.0-FREE
     */
    private function htmlImageCaption(string &$html)
    {
        if (!$this->pluginParameters['list'] && !$this->pluginParameters['word']) {
            if ($this->pluginParameters['single'] && !empty($this->pluginParameters['scaption'])) {
                $html .= '</span><span class="sige_caption">' . $this->pluginParameters['scaption'] . '</span></li>';
            } else {
                $html .= '</span><span class="sige_caption">' . $this->imageInfo['image_title'] . '</span></li>';
            }
        }
    }

    /**
     * Loads PhotoSwipe dynamic JavaScript code from the cache file
     *
     * @since 3.4.0-FREE
     */
    private function loadPhotoSwipeJs()
    {
        if (File::exists($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_js-' . $this->pluginParameters['lang'] . '.txt')) {
            $photoswipeJs = file_get_contents($this->absolutePath . $this->rootFolder . $this->imagesDir . '/sige_turbo_js-' . $this->pluginParameters['lang'] . '.txt');
            $this->photoswipeJs[] = $photoswipeJs;
        }
    }

    /**
     * Adds data like the PhotoSwipe template and JS start code to the end of the article
     *
     * @param string $article
     *
     * @since   3.4.0-FREE
     * @version 3.4.2-FREE
     */
    private function addDataToBottom(string &$article)
    {
        $data = '';

        if ((int)$this->pluginParameters['view'] === 7) {
            $data .= file_get_contents(__DIR__ . '/assets/photoswipe/pswp.txt');

            if (!empty($this->photoswipeJs)) {
                $data .= '<script type="text/javascript">' . implode("\n", $this->photoswipeJs) . '</script>';
            }
        }

        if (!empty($data)) {
            $article .= $data;
        }
    }

    /**
     * Cleans the image information - removes HTML tags and converts special characters
     *
     * @param string $value
     *
     * @return string
     * @since 3.4.0-FREE
     */
    private function cleanImageInformation(string $value): string
    {
        return htmlspecialchars(strip_tags($value));
    }

    /**
     * Compares timestamps of images - ascending
     *
     * @param array $imageOne
     * @param array $imageTwo
     *
     * @return int
     * @since 3.4.0-FREE
     */
    private function timeasc(array $imageOne, array $imageTwo): int
    {
        return strcmp($imageOne['timestamp'], $imageTwo['timestamp']);
    }

    /**
     * Compares timestamps of images - descending
     *
     * @param $imageOne
     * @param $imageTwo
     *
     * @return int
     * @since 3.4.0-FREE
     */
    private function timedesc($imageOne, $imageTwo): int
    {
        return strcmp($imageTwo['timestamp'], $imageOne['timestamp']);
    }
}
