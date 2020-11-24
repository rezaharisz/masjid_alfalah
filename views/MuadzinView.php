<?php

namespace PHPMaker2021\project1;

// Page object
$MuadzinView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmuadzinview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fmuadzinview = currentForm = new ew.Form("fmuadzinview", "view");
    loadjs.done("fmuadzinview");
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
<form name="fmuadzinview" id="fmuadzinview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="muadzin">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NAMA_MUADZIN->Visible) { // NAMA_MUADZIN ?>
    <tr id="r_NAMA_MUADZIN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_muadzin_NAMA_MUADZIN"><?= $Page->NAMA_MUADZIN->caption() ?></span></td>
        <td data-name="NAMA_MUADZIN" <?= $Page->NAMA_MUADZIN->cellAttributes() ?>>
<span id="el_muadzin_NAMA_MUADZIN">
<span<?= $Page->NAMA_MUADZIN->viewAttributes() ?>>
<?= $Page->NAMA_MUADZIN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <tr id="r_NO_TELP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_muadzin_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></td>
        <td data-name="NO_TELP" <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_muadzin_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <tr id="r_ALAMAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_muadzin_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></td>
        <td data-name="ALAMAT" <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_muadzin_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->WAKTU_ADZAN->Visible) { // WAKTU_ADZAN ?>
    <tr id="r_WAKTU_ADZAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_muadzin_WAKTU_ADZAN"><?= $Page->WAKTU_ADZAN->caption() ?></span></td>
        <td data-name="WAKTU_ADZAN" <?= $Page->WAKTU_ADZAN->cellAttributes() ?>>
<span id="el_muadzin_WAKTU_ADZAN">
<span<?= $Page->WAKTU_ADZAN->viewAttributes() ?>>
<?= $Page->WAKTU_ADZAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL_ADZAN->Visible) { // TANGGAL_ADZAN ?>
    <tr id="r_TANGGAL_ADZAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_muadzin_TANGGAL_ADZAN"><?= $Page->TANGGAL_ADZAN->caption() ?></span></td>
        <td data-name="TANGGAL_ADZAN" <?= $Page->TANGGAL_ADZAN->cellAttributes() ?>>
<span id="el_muadzin_TANGGAL_ADZAN">
<span<?= $Page->TANGGAL_ADZAN->viewAttributes() ?>>
<?= $Page->TANGGAL_ADZAN->getViewValue() ?></span>
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
