<?php

namespace PHPMaker2021\project1;

// Page object
$KuliahSubuhView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkuliah_subuhview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkuliah_subuhview = currentForm = new ew.Form("fkuliah_subuhview", "view");
    loadjs.done("fkuliah_subuhview");
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
<form name="fkuliah_subuhview" id="fkuliah_subuhview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kuliah_subuh">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NAMA_PENGISI->Visible) { // NAMA_PENGISI ?>
    <tr id="r_NAMA_PENGISI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kuliah_subuh_NAMA_PENGISI"><?= $Page->NAMA_PENGISI->caption() ?></span></td>
        <td data-name="NAMA_PENGISI" <?= $Page->NAMA_PENGISI->cellAttributes() ?>>
<span id="el_kuliah_subuh_NAMA_PENGISI">
<span<?= $Page->NAMA_PENGISI->viewAttributes() ?>>
<?= $Page->NAMA_PENGISI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <tr id="r_NO_TELP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kuliah_subuh_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></td>
        <td data-name="NO_TELP" <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_kuliah_subuh_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <tr id="r_ALAMAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kuliah_subuh_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></td>
        <td data-name="ALAMAT" <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_kuliah_subuh_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL->Visible) { // TANGGAL ?>
    <tr id="r_TANGGAL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kuliah_subuh_TANGGAL"><?= $Page->TANGGAL->caption() ?></span></td>
        <td data-name="TANGGAL" <?= $Page->TANGGAL->cellAttributes() ?>>
<span id="el_kuliah_subuh_TANGGAL">
<span<?= $Page->TANGGAL->viewAttributes() ?>>
<?= $Page->TANGGAL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MATERI_KULIAH_SUBUH->Visible) { // MATERI_KULIAH_SUBUH ?>
    <tr id="r_MATERI_KULIAH_SUBUH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kuliah_subuh_MATERI_KULIAH_SUBUH"><?= $Page->MATERI_KULIAH_SUBUH->caption() ?></span></td>
        <td data-name="MATERI_KULIAH_SUBUH" <?= $Page->MATERI_KULIAH_SUBUH->cellAttributes() ?>>
<span id="el_kuliah_subuh_MATERI_KULIAH_SUBUH">
<span<?= $Page->MATERI_KULIAH_SUBUH->viewAttributes() ?>>
<?= $Page->MATERI_KULIAH_SUBUH->getViewValue() ?></span>
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
