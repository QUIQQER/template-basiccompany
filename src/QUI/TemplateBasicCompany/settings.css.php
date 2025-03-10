<?php

/**
 * @var QUI\Projects\Project $Project
 * @var QUI\Projects\Site $Site
 **/

$Convert = new \QUI\Utils\Convert();

if (!isset($fullsize)) {
    $fullsize = false;
}

if (!isset($pageMaxWidth)) {
    $pageMaxWidth = 1920;
}

if (!isset($showHeader)) {
    $showHeader = true;
}

/**
 * colors
 */
$colorFooterBackground = '#414141';
$colorFooterFont       = '#D1D1D1';
$colorMain             = '#dd151b';
$buttonFontColor       = '#ffffff';
$colorBackground       = '#F7F7F7';
$colorFooterLinks      = '#E6E6E6';
$colorMainContentBg    = '#ffffff';
$colorFont             = '#5d5d5d';
$mobileMenuBackground  = '#252122';

if ($Project->getConfig('templateBasicCompany.settings.colorFooterBackground')) {
    $colorFooterBackground = $Project->getConfig('templateBasicCompany.settings.colorFooterBackground');
}

if ($Project->getConfig('templateBasicCompany.settings.colorFooterFont')) {
    $colorFooterFont = $Project->getConfig('templateBasicCompany.settings.colorFooterFont');
}

if ($Project->getConfig('templateBasicCompany.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateBasicCompany.settings.colorMain');
}

if ($Project->getConfig('templateBasicCompany.settings.buttonFontColor')) {
    $buttonFontColor = $Project->getConfig('templateBasicCompany.settings.buttonFontColor');
}

if ($Project->getConfig('templateBasicCompany.settings.colorBackground')) {
    $colorBackground = $Project->getConfig('templateBasicCompany.settings.colorBackground');
}

if ($Project->getConfig('templateBasicCompany.settings.colorFooterLinks')) {
    $colorFooterLinks = $Project->getConfig('templateBasicCompany.settings.colorFooterLinks');
}

if ($Project->getConfig('templateBasicCompany.settings.colorMainContentBg')) {
    $colorMainContentBg = $Project->getConfig('templateBasicCompany.settings.colorMainContentBg');
}

if ($Project->getConfig('templateBasicCompany.settings.colorFont')) {
    $colorFont = $Project->getConfig('templateBasicCompany.settings.colorFont');
}

if ($Project->getConfig('templateBasicCompany.settings.mobileMenuBackground')) {
    $mobileMenuBackground = $Project->getConfig('templateBasicCompany.settings.mobileMenuBackground');
}

$headerHeight = false;
$headerHeightValue  = 400;
$headerImagePosition = 'center';

if ($Project->getConfig('templateBasicCompany.settings.headerHeight')) {
    $headerHeight = $Project->getConfig('templateBasicCompany.settings.headerHeight');
}

if ($Project->getConfig('templateBasicCompany.settings.headerHeightValue')) {
    $headerHeightValue = $Project->getConfig('templateBasicCompany.settings.headerHeightValue');
}

if ($Project->getConfig('templateBasicCompany.settings.headerImagePosition')) {
    $headerImagePosition = $Project->getConfig('templateBasicCompany.settings.headerImagePosition');
}

$Background = false;

if ($Project->getConfig('templateBasicCompany.settings.pageBackground')) {
    try {
        $Background = QUI\Projects\Media\Utils::getImageByUrl(
            $Project->getConfig('templateBasicCompany.settings.pageBackground')
        );
    } catch (QUI\Exception $Exception) {
        \QUI\System\Log::writeRecursive($Exception->getMessage());
    }
}

ob_start();

?>
/**
 * Colors
 */
.control-background,
.header-bar,
.header-bar-inner-nav,
#page input[type='checkbox']:checked + label::before,
#page input[type='radio']:checked + label::before,
a.link-slide-up-color::before,
.page-header-navigation-sub-entry-link:hover {
    background-color: <?php echo $colorMain; ?>;
}

/* mobile nav background */
.slideout-menu .page-menu {
    background-color: <?php echo  $mobileMenuBackground; ?>;
}

/* nav bar */
.quiqqer-menu-megaMenu-list-item-menu.control-background,
.header-bar-search:hover,
.quiqqer-menu-megaMenu-list-item:hover {
    background-color: <?php echo $Convert->colorBrightness($colorMain, 0.9); ?>;
}

.control-color,
.mainColor, /* deprecated */
a,
a:hover,
.fa-navicon:hover,
.content-switcher-content h2,
.quiqqer-fa-levels-icon:hover,
.quiqqer-navigation-level-1 a:hover,
a.quiqqer-navigation-home:hover,
.quiqqer-navigation-entry:hover .quiqqer-fa-list-icon,
.qui-list-entry:hover .qui-list-entry-footer-button,
input[type='submit']:hover,
input[type='reset']:hover,
input[type='button']:hover,
button:hover,
.button-active,
.button:active,
.button:hover {
    color: <?php echo $colorMain; ?>;
}

input[type='submit'],
input[type='reset'],
input[type='button'],
button,
.button,
.page-content .button,
button:disabled,
button:disabled:hover {
    background-color: <?php echo $colorMain; ?>;
    color: <?php echo $buttonFontColor; ?>;
    border: 2px solid<?php echo $colorMain; ?>;
}

#page .button.special {
    background: none !important;
    color: <?php echo $colorFont; ?>;
}

#page .button.special:hover {
    border: 3px solid<?php echo $colorMain; ?>;
}

body {
    background-color: <?php echo $colorBackground; ?>;
    color: <?php echo $colorFont; ?> !important;
}

.colorFont,
.fontColor {
    color: <?php echo $colorFont; ?>;
}

.control-news-list-short {
    color: <?php echo $colorFont; ?> !important;
}

textarea:hover,
textarea:focus,
input:hover,
input:focus,
select:hover,
select:focus {
    border-color: <?php echo $colorMain; ?>;
}

.main-content-color-bg {
    background-color: <?php echo $colorMainContentBg; ?>;
}

a.link-simple-color {
    color: <?php echo $colorMain; ?>;
    border-bottom: 1px solid<?php echo $colorMain; ?>;
}

.page-footer button {
    background: <?php echo $colorMain; ?>;
    color: #ffffff;
}

.page-footer {
    background: <?php echo $colorFooterBackground; ?>;
    color: <?php echo $colorFooterFont; ?> !important;
}

.page-footer header,
.page-footer header a {
    color: #ffffff;
}

.page-footer h2,
.page-footer h3,
.page-footer h4 {
    color: <?php echo $colorFooterFont; ?>;
}

.page-footer a,
.page-footer a:hover {
    color: <?php echo $colorFooterLinks; ?>;
}

.quiqqer-sheets-desktop a:hover {
    border: 1px solid <?php echo $colorMain;?> !important;
    color: <?php echo $colorMain; ?> !important;
}

.control-background-active {
    background: <?php echo $colorMain; ?> !important;
    color: #FFFFFF !important;
}

.quiqqer-bricks-promoslider-dot-active {
    background: <?php echo $colorMain; ?> !important;
}

/**
 * Background image
 */
<?php if ($Background) { ?>
body {
    background-image: url('<?php $Background->getSizeCacheUrl() ?>');
    background-attachment: fixed;
    -webkit-background-size: cover;
    background-size: cover;
}

<?php } ?>


/**
 * Background switcher
 */
<?php if ($Project->getConfig('templateBasicCompany.settings.bgColorSwitcherPrefix') == 'display') { ?>
.brick-even-prefix {
    background: #f5f5f5;
}

.brick-odd-prefix {
    background: #e5e5e5;
}

<?php } ?>

<?php if ($Project->getConfig('templateBasicCompany.settings.bgColorSwitcherSuffix') == 'display') { ?>
.brick-even-suffix {
    background: #f5f5f5;
}

.brick-odd-suffix {
    background: #e5e5e5;
}

<?php }?>

/**
 * site width
 * $fullsize and $pageMaxWidth defined in src/QUI/TemplateBasicCompany/Utils.php
 */
<?php if (!$fullsize) { ?>
.main-body {
    display: block !important;
    max-width: <?php echo $pageMaxWidth; ?>px;
    margin: 0 auto;
}

.header-bar {
    max-width: <?php echo $pageMaxWidth; ?>px;
}

.grid-container {
    max-width: <?php echo $pageMaxWidth; ?>px;
}

.page-box-prefix-suffix {
    padding: 30px 0;
}

<?php } ?>

<?php if ($showHeader) { ?>
.header-img {
    display: block !important;
}

.page-header,
.page-header picture {
    display: flex !important;
}

<?php } ?>

<?php
if ($headerHeight && $Site->getAttribute('image_emotion')) { ?>
.page-header {
    height: <?php echo $headerHeightValue ?>px;
    overflow: hidden;
}

.header-img {
    align-self: <?php echo $headerImagePosition ?>;
}

<?php } ?>

<?php

$settingsCSS = ob_get_contents();
ob_end_clean();

return $settingsCSS;

?>
