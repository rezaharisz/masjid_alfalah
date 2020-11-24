<?php

namespace PHPMaker2021\project1;

// Page object
$BarangDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbarangdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbarangdelete = currentForm = new ew.Form("fbarangdelete", "delete");
    loadjs.done("fbarangdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbarangdelete" id="fbarangdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->NAMA_BARANG->Visible) { // NAMA_BARANG ?>
        <th class="<?= $Page->NAMA_BARANG->headerCellClass() ?>"><span id="elh_barang_NAMA_BARANG" class="barang_NAMA_BARANG"><?= $Page->NAMA_BARANG->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
        <th class="<?= $Page->JUMLAH->headerCellClass() ?>"><span id="elh_barang_JUMLAH" class="barang_JUMLAH"><?= $Page->JUMLAH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
        <th class="<?= $Page->KONDISI->headerCellClass() ?>"><span id="elh_barang_KONDISI" class="barang_KONDISI"><?= $Page->KONDISI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
        <th class="<?= $Page->TANGGAL_PEMBELIAN->headerCellClass() ?>"><span id="elh_barang_TANGGAL_PEMBELIAN" class="barang_TANGGAL_PEMBELIAN"><?= $Page->TANGGAL_PEMBELIAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
        <th class="<?= $Page->TANGGAL_BELI_GANTI_BARU->headerCellClass() ?>"><span id="elh_barang_TANGGAL_BELI_GANTI_BARU" class="barang_TANGGAL_BELI_GANTI_BARU"><?= $Page->TANGGAL_BELI_GANTI_BARU->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->NAMA_BARANG->Visible) { // NAMA_BARANG ?>
        <td <?= $Page->NAMA_BARANG->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_NAMA_BARANG" class="barang_NAMA_BARANG">
<span<?= $Page->NAMA_BARANG->viewAttributes() ?>>
<?= $Page->NAMA_BARANG->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
        <td <?= $Page->JUMLAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_JUMLAH" class="barang_JUMLAH">
<span<?= $Page->JUMLAH->viewAttributes() ?>>
<?= $Page->JUMLAH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
        <td <?= $Page->KONDISI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_KONDISI" class="barang_KONDISI">
<span<?= $Page->KONDISI->viewAttributes() ?>>
<?= $Page->KONDISI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
        <td <?= $Page->TANGGAL_PEMBELIAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_TANGGAL_PEMBELIAN" class="barang_TANGGAL_PEMBELIAN">
<span<?= $Page->TANGGAL_PEMBELIAN->viewAttributes() ?>>
<?= $Page->TANGGAL_PEMBELIAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
        <td <?= $Page->TANGGAL_BELI_GANTI_BARU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_TANGGAL_BELI_GANTI_BARU" class="barang_TANGGAL_BELI_GANTI_BARU">
<span<?= $Page->TANGGAL_BELI_GANTI_BARU->viewAttributes() ?>>
<?= $Page->TANGGAL_BELI_GANTI_BARU->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= GetUrl($Page->getReturnUrl()) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
