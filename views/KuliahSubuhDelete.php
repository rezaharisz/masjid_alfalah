<?php

namespace PHPMaker2021\project1;

// Page object
$KuliahSubuhDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkuliah_subuhdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkuliah_subuhdelete = currentForm = new ew.Form("fkuliah_subuhdelete", "delete");
    loadjs.done("fkuliah_subuhdelete");
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
<form name="fkuliah_subuhdelete" id="fkuliah_subuhdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kuliah_subuh">
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
<?php if ($Page->NAMA_PENGISI->Visible) { // NAMA_PENGISI ?>
        <th class="<?= $Page->NAMA_PENGISI->headerCellClass() ?>"><span id="elh_kuliah_subuh_NAMA_PENGISI" class="kuliah_subuh_NAMA_PENGISI"><?= $Page->NAMA_PENGISI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <th class="<?= $Page->NO_TELP->headerCellClass() ?>"><span id="elh_kuliah_subuh_NO_TELP" class="kuliah_subuh_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL->Visible) { // TANGGAL ?>
        <th class="<?= $Page->TANGGAL->headerCellClass() ?>"><span id="elh_kuliah_subuh_TANGGAL" class="kuliah_subuh_TANGGAL"><?= $Page->TANGGAL->caption() ?></span></th>
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
<?php if ($Page->NAMA_PENGISI->Visible) { // NAMA_PENGISI ?>
        <td <?= $Page->NAMA_PENGISI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kuliah_subuh_NAMA_PENGISI" class="kuliah_subuh_NAMA_PENGISI">
<span<?= $Page->NAMA_PENGISI->viewAttributes() ?>>
<?= $Page->NAMA_PENGISI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <td <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kuliah_subuh_NO_TELP" class="kuliah_subuh_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL->Visible) { // TANGGAL ?>
        <td <?= $Page->TANGGAL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kuliah_subuh_TANGGAL" class="kuliah_subuh_TANGGAL">
<span<?= $Page->TANGGAL->viewAttributes() ?>>
<?= $Page->TANGGAL->getViewValue() ?></span>
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
