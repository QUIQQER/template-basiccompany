<?php

$Convert = new \QUI\Utils\Convert();

$colorMain  = '#46ab4b';

if ($Project->getConfig('templateWhoIAm.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateWhoIAm.settings.colorMain');
}

$headerPos = 'center';
if ($Project->getConfig('templateWhoIAm.settings.headerImagePosition')) {
    $headerPos = $Project->getConfig('templateWhoIAm.settings.headerImagePosition');
}

$headerHeight = 400;
if ($Project->getConfig('templateWhoIAm.settings.headerHeightValue')) {
    $headerHeight = $Project->getConfig('templateWhoIAm.settings.headerHeightValue');
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

a,
.menu-bar-inner-nav .nav-list-entry a:hover,
.menu-bar-inner-nav .nav-list-entry.active a,
.quiqqer-pagination .quiqqer-sheets-desktop a:hover,
.control-color {
    color: <?php echo $colorMain; ?>;
}

@media screen and (max-width: 767px) {
    .menu-bar-inner-nav .nav-list-entry a:hover,
    .menu-bar-inner-nav .nav-list-entry.active a {
        color: <?php echo $colorMain; ?>;
    }
}

/*****************************/
/* button primary & standard */
/*****************************/
input[type="submit"],
input[type="submit"]:disabled,
input[type="submit"][disabled],
input[type="button"],
input[type="button"]:disabled,
input[type="button"][disabled],
input[type="reset"],
input[type="reset"]:disabled,
input[type="reset"][disabled],
.btn,
.btn:disabled,
.btn[disabled],
.button,
.button:disabled,
.button[disabled],
button.qui-button,
button.qui-button:disabled,
button.qui-button[disabled],
button,
button:disabled,
button[disabled],
a.qui-button,
.btn-primary  {
    background-color: <?php echo $colorMain; ?>;
    border-color: <?php echo $colorMain; ?>;
}

input[type="submit"]:hover,
input[type="submit"]:active,
input[type="button"]:hover,
input[type="button"]:active,
input[type="reset"]:hover,
input[type="reset"]:active,
button.qui-button.btn-primary:hover,
button.qui-button.btn-primary:active,
button.qui-button[disabled]:hover,
button.qui-button[disabled]:active,
button.btn-outline:hover,
button.btn-outline:active,
.btn.btn-outline:hover,
.btn.btn-outline:active,
.button.btn-outline:hover,
.button.btn-outline:active,
button:hover,
button:active,
.btn:hover,
.btn:active,
.button:hover,
.button:active,
.btn-primary:hover,
.btn-primary:active  {
    background: <?php echo $Convert->colorBrightness($colorMain, 1.1); ?>;
    outline: none;
}

/* outline */
input[type="submit"].btn-outline,
input[type="button"].btn-outline,
input[type="reset"].btn-outline,
button.qui-button.btn-outline,
button.btn-outline,
.btn.btn-outline,
.button.btn-outline,
.btn-primary.btn-outline,
input[type="submit"].btn-outline:disabled:hover, /* outline disabled */
input[type="submit"].btn-outline:disabled:active,
input[type="button"].btn-outline:disabled:hover,
input[type="button"].btn-outline:disabled:active,
input[type="reset"].btn-outline:disabled:hover,
input[type="reset"].btn-outline:disabled:active,
button.qui-button.btn-primary.btn-outline:disabled:hover,
button.qui-button.btn-primary.btn-outline:disabled:active,
button:disabled.btn-outline:hover,
button:disabled.btn-outline:active,
.btn-primary.btn-disabled.btn-outline:hover,
.btn-primary.btn-disabled.btn-outline:active {
    color: <?php echo $colorMain; ?>;
    background: transparent;
}

.page-header {
    background-position: 0 <?php echo $headerPos; ?>;
}

.page-header-container {
    min-height: <?php echo $headerHeight; ?>px;
}

<?php

$settingsCSS = ob_get_contents();
ob_end_clean();

return $settingsCSS;

?>
