<?php

namespace PHPMaker2021\project1;

// Page object
$KhatibView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkhatibview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkhatibview = currentForm = new ew.Form("fkhatibview", "view");
    loadjs.done("fkhatibview");
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
<form name="fkhatibview" id="fkhatibview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="khatib">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NAMA_KHATIB->Visible) { // NAMA_KHATIB ?>
    <tr id="r_NAMA_KHATIB">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_khatib_NAMA_KHATIB"><?= $Page->NAMA_KHATIB->caption() ?></span></td>
        <td data-name="NAMA_KHATIB" <?= $Page->NAMA_KHATIB->cellAttributes() ?>>
<span id="el_khatib_NAMA_KHATIB">
<span<?= $Page->NAMA_KHATIB->viewAttributes() ?>>
<?= $Page->NAMA_KHATIB->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <tr id="r_NO_TELP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_khatib_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></td>
        <td data-name="NO_TELP" <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_khatib_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <tr id="r_ALAMAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_khatib_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></td>
        <td data-name="ALAMAT" <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_khatib_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL_KHOTBAH->Visible) { // TANGGAL_KHOTBAH ?>
    <tr id="r_TANGGAL_KHOTBAH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_khatib_TANGGAL_KHOTBAH"><?= $Page->TANGGAL_KHOTBAH->caption() ?></span></td>
        <td data-name="TANGGAL_KHOTBAH" <?= $Page->TANGGAL_KHOTBAH->cellAttributes() ?>>
<span id="el_khatib_TANGGAL_KHOTBAH">
<span<?= $Page->TANGGAL_KHOTBAH->viewAttributes() ?>>
<?= $Page->TANGGAL_KHOTBAH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MATERI_KHOTBAH->Visible) { // MATERI_KHOTBAH ?>
    <tr id="r_MATERI_KHOTBAH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_khatib_MATERI_KHOTBAH"><?= $Page->MATERI_KHOTBAH->caption() ?></span></td>
        <td data-name="MATERI_KHOTBAH" <?= $Page->MATERI_KHOTBAH->cellAttributes() ?>>
<span id="el_khatib_MATERI_KHOTBAH">
<span<?= $Page->MATERI_KHOTBAH->viewAttributes() ?>>
<?= $Page->MATERI_KHOTBAH->getViewValue() ?></span>
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
