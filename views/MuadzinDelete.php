<?php

namespace PHPMaker2021\project1;

// Page object
$MuadzinDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fmuadzindelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fmuadzindelete = currentForm = new ew.Form("fmuadzindelete", "delete");
    loadjs.done("fmuadzindelete");
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
<form name="fmuadzindelete" id="fmuadzindelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="muadzin">
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
<?php if ($Page->NAMA_MUADZIN->Visible) { // NAMA_MUADZIN ?>
        <th class="<?= $Page->NAMA_MUADZIN->headerCellClass() ?>"><span id="elh_muadzin_NAMA_MUADZIN" class="muadzin_NAMA_MUADZIN"><?= $Page->NAMA_MUADZIN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <th class="<?= $Page->NO_TELP->headerCellClass() ?>"><span id="elh_muadzin_NO_TELP" class="muadzin_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->WAKTU_ADZAN->Visible) { // WAKTU_ADZAN ?>
        <th class="<?= $Page->WAKTU_ADZAN->headerCellClass() ?>"><span id="elh_muadzin_WAKTU_ADZAN" class="muadzin_WAKTU_ADZAN"><?= $Page->WAKTU_ADZAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_ADZAN->Visible) { // TANGGAL_ADZAN ?>
        <th class="<?= $Page->TANGGAL_ADZAN->headerCellClass() ?>"><span id="elh_muadzin_TANGGAL_ADZAN" class="muadzin_TANGGAL_ADZAN"><?= $Page->TANGGAL_ADZAN->caption() ?></span></th>
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
<?php if ($Page->NAMA_MUADZIN->Visible) { // NAMA_MUADZIN ?>
        <td <?= $Page->NAMA_MUADZIN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_muadzin_NAMA_MUADZIN" class="muadzin_NAMA_MUADZIN">
<span<?= $Page->NAMA_MUADZIN->viewAttributes() ?>>
<?= $Page->NAMA_MUADZIN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <td <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_muadzin_NO_TELP" class="muadzin_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->WAKTU_ADZAN->Visible) { // WAKTU_ADZAN ?>
        <td <?= $Page->WAKTU_ADZAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_muadzin_WAKTU_ADZAN" class="muadzin_WAKTU_ADZAN">
<span<?= $Page->WAKTU_ADZAN->viewAttributes() ?>>
<?= $Page->WAKTU_ADZAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_ADZAN->Visible) { // TANGGAL_ADZAN ?>
        <td <?= $Page->TANGGAL_ADZAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_muadzin_TANGGAL_ADZAN" class="muadzin_TANGGAL_ADZAN">
<span<?= $Page->TANGGAL_ADZAN->viewAttributes() ?>>
<?= $Page->TANGGAL_ADZAN->getViewValue() ?></span>
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
