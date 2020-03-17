<?php

$Convert = new \QUI\Utils\Convert();

$colorMain  = '#46ab4b';

if ($Project->getConfig('templateWhoIAm.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateWhoIAm.settings.colorMain');
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


<?php if ($Background) { ?>
body {
    background-image : url('<?php $Background->getSizeCacheUrl() ?>');
    background-attachment: fixed;
    -webkit-background-size: cover;
    background-size: cover;
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

<?php
}
?>

<?php

$settingsCSS = ob_get_contents();
ob_end_clean();

return $settingsCSS;

?>
