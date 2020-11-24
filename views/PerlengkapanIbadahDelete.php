<?php

namespace PHPMaker2021\project1;

// Page object
$PerlengkapanIbadahDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fperlengkapan_ibadahdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fperlengkapan_ibadahdelete = currentForm = new ew.Form("fperlengkapan_ibadahdelete", "delete");
    loadjs.done("fperlengkapan_ibadahdelete");
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
<form name="fperlengkapan_ibadahdelete" id="fperlengkapan_ibadahdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="perlengkapan_ibadah">
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
<?php if ($Page->NAMA_PERLENGKAPAN_IBADAH->Visible) { // NAMA_PERLENGKAPAN_IBADAH ?>
        <th class="<?= $Page->NAMA_PERLENGKAPAN_IBADAH->headerCellClass() ?>"><span id="elh_perlengkapan_ibadah_NAMA_PERLENGKAPAN_IBADAH" class="perlengkapan_ibadah_NAMA_PERLENGKAPAN_IBADAH"><?= $Page->NAMA_PERLENGKAPAN_IBADAH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
        <th class="<?= $Page->JUMLAH->headerCellClass() ?>"><span id="elh_perlengkapan_ibadah_JUMLAH" class="perlengkapan_ibadah_JUMLAH"><?= $Page->JUMLAH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
        <th class="<?= $Page->KONDISI->headerCellClass() ?>"><span id="elh_perlengkapan_ibadah_KONDISI" class="perlengkapan_ibadah_KONDISI"><?= $Page->KONDISI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
        <th class="<?= $Page->TANGGAL_PEMBELIAN->headerCellClass() ?>"><span id="elh_perlengkapan_ibadah_TANGGAL_PEMBELIAN" class="perlengkapan_ibadah_TANGGAL_PEMBELIAN"><?= $Page->TANGGAL_PEMBELIAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
        <th class="<?= $Page->TANGGAL_BELI_GANTI_BARU->headerCellClass() ?>"><span id="elh_perlengkapan_ibadah_TANGGAL_BELI_GANTI_BARU" class="perlengkapan_ibadah_TANGGAL_BELI_GANTI_BARU"><?= $Page->TANGGAL_BELI_GANTI_BARU->caption() ?></span></th>
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
<?php if ($Page->NAMA_PERLENGKAPAN_IBADAH->Visible) { // NAMA_PERLENGKAPAN_IBADAH ?>
        <td <?= $Page->NAMA_PERLENGKAPAN_IBADAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_perlengkapan_ibadah_NAMA_PERLENGKAPAN_IBADAH" class="perlengkapan_ibadah_NAMA_PERLENGKAPAN_IBADAH">
<span<?= $Page->NAMA_PERLENGKAPAN_IBADAH->viewAttributes() ?>>
<?= $Page->NAMA_PERLENGKAPAN_IBADAH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
        <td <?= $Page->JUMLAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_perlengkapan_ibadah_JUMLAH" class="perlengkapan_ibadah_JUMLAH">
<span<?= $Page->JUMLAH->viewAttributes() ?>>
<?= $Page->JUMLAH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
        <td <?= $Page->KONDISI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_perlengkapan_ibadah_KONDISI" class="perlengkapan_ibadah_KONDISI">
<span<?= $Page->KONDISI->viewAttributes() ?>>
<?= $Page->KONDISI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
        <td <?= $Page->TANGGAL_PEMBELIAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_perlengkapan_ibadah_TANGGAL_PEMBELIAN" class="perlengkapan_ibadah_TANGGAL_PEMBELIAN">
<span<?= $Page->TANGGAL_PEMBELIAN->viewAttributes() ?>>
<?= $Page->TANGGAL_PEMBELIAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
        <td <?= $Page->TANGGAL_BELI_GANTI_BARU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_perlengkapan_ibadah_TANGGAL_BELI_GANTI_BARU" class="perlengkapan_ibadah_TANGGAL_BELI_GANTI_BARU">
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
