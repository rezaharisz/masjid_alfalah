<?php

namespace PHPMaker2021\project1;

// Page object
$BarangView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbarangview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbarangview = currentForm = new ew.Form("fbarangview", "view");
    loadjs.done("fbarangview");
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
<form name="fbarangview" id="fbarangview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NAMA_BARANG->Visible) { // NAMA_BARANG ?>
    <tr id="r_NAMA_BARANG">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_NAMA_BARANG"><?= $Page->NAMA_BARANG->caption() ?></span></td>
        <td data-name="NAMA_BARANG" <?= $Page->NAMA_BARANG->cellAttributes() ?>>
<span id="el_barang_NAMA_BARANG">
<span<?= $Page->NAMA_BARANG->viewAttributes() ?>>
<?= $Page->NAMA_BARANG->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
    <tr id="r_JUMLAH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_JUMLAH"><?= $Page->JUMLAH->caption() ?></span></td>
        <td data-name="JUMLAH" <?= $Page->JUMLAH->cellAttributes() ?>>
<span id="el_barang_JUMLAH">
<span<?= $Page->JUMLAH->viewAttributes() ?>>
<?= $Page->JUMLAH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
    <tr id="r_KONDISI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_KONDISI"><?= $Page->KONDISI->caption() ?></span></td>
        <td data-name="KONDISI" <?= $Page->KONDISI->cellAttributes() ?>>
<span id="el_barang_KONDISI">
<span<?= $Page->KONDISI->viewAttributes() ?>>
<?= $Page->KONDISI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
    <tr id="r_TANGGAL_PEMBELIAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_TANGGAL_PEMBELIAN"><?= $Page->TANGGAL_PEMBELIAN->caption() ?></span></td>
        <td data-name="TANGGAL_PEMBELIAN" <?= $Page->TANGGAL_PEMBELIAN->cellAttributes() ?>>
<span id="el_barang_TANGGAL_PEMBELIAN">
<span<?= $Page->TANGGAL_PEMBELIAN->viewAttributes() ?>>
<?= $Page->TANGGAL_PEMBELIAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
    <tr id="r_TANGGAL_BELI_GANTI_BARU">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_TANGGAL_BELI_GANTI_BARU"><?= $Page->TANGGAL_BELI_GANTI_BARU->caption() ?></span></td>
        <td data-name="TANGGAL_BELI_GANTI_BARU" <?= $Page->TANGGAL_BELI_GANTI_BARU->cellAttributes() ?>>
<span id="el_barang_TANGGAL_BELI_GANTI_BARU">
<span<?= $Page->TANGGAL_BELI_GANTI_BARU->viewAttributes() ?>>
<?= $Page->TANGGAL_BELI_GANTI_BARU->getViewValue() ?></span>
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
