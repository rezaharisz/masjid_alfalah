<?php

namespace PHPMaker2021\project1;

// Page object
$PengurusMasjidView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpengurus_masjidview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpengurus_masjidview = currentForm = new ew.Form("fpengurus_masjidview", "view");
    loadjs.done("fpengurus_masjidview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpengurus_masjidview" id="fpengurus_masjidview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengurus_masjid">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->ID_PENGURUS->Visible) { // ID_PENGURUS ?>
    <tr id="r_ID_PENGURUS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengurus_masjid_ID_PENGURUS"><?= $Page->ID_PENGURUS->caption() ?></span></td>
        <td data-name="ID_PENGURUS" <?= $Page->ID_PENGURUS->cellAttributes() ?>>
<span id="el_pengurus_masjid_ID_PENGURUS">
<span<?= $Page->ID_PENGURUS->viewAttributes() ?>>
<?= $Page->ID_PENGURUS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
    <tr id="r_NAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengurus_masjid_NAMA"><?= $Page->NAMA->caption() ?></span></td>
        <td data-name="NAMA" <?= $Page->NAMA->cellAttributes() ?>>
<span id="el_pengurus_masjid_NAMA">
<span<?= $Page->NAMA->viewAttributes() ?>>
<?= $Page->NAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <tr id="r_NO_TELP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengurus_masjid_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></td>
        <td data-name="NO_TELP" <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_pengurus_masjid_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <tr id="r_ALAMAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengurus_masjid_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></td>
        <td data-name="ALAMAT" <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_pengurus_masjid_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TGL_LAHIR->Visible) { // TGL_LAHIR ?>
    <tr id="r_TGL_LAHIR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengurus_masjid_TGL_LAHIR"><?= $Page->TGL_LAHIR->caption() ?></span></td>
        <td data-name="TGL_LAHIR" <?= $Page->TGL_LAHIR->cellAttributes() ?>>
<span id="el_pengurus_masjid_TGL_LAHIR">
<span<?= $Page->TGL_LAHIR->viewAttributes() ?>>
<?= $Page->TGL_LAHIR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
