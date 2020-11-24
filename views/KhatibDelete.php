<?php

namespace PHPMaker2021\project1;

// Page object
$KhatibDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkhatibdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkhatibdelete = currentForm = new ew.Form("fkhatibdelete", "delete");
    loadjs.done("fkhatibdelete");
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
<form name="fkhatibdelete" id="fkhatibdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="khatib">
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
<?php if ($Page->NAMA_KHATIB->Visible) { // NAMA_KHATIB ?>
        <th class="<?= $Page->NAMA_KHATIB->headerCellClass() ?>"><span id="elh_khatib_NAMA_KHATIB" class="khatib_NAMA_KHATIB"><?= $Page->NAMA_KHATIB->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <th class="<?= $Page->NO_TELP->headerCellClass() ?>"><span id="elh_khatib_NO_TELP" class="khatib_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TANGGAL_KHOTBAH->Visible) { // TANGGAL_KHOTBAH ?>
        <th class="<?= $Page->TANGGAL_KHOTBAH->headerCellClass() ?>"><span id="elh_khatib_TANGGAL_KHOTBAH" class="khatib_TANGGAL_KHOTBAH"><?= $Page->TANGGAL_KHOTBAH->caption() ?></span></th>
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
<?php if ($Page->NAMA_KHATIB->Visible) { // NAMA_KHATIB ?>
        <td <?= $Page->NAMA_KHATIB->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_khatib_NAMA_KHATIB" class="khatib_NAMA_KHATIB">
<span<?= $Page->NAMA_KHATIB->viewAttributes() ?>>
<?= $Page->NAMA_KHATIB->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <td <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_khatib_NO_TELP" class="khatib_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TANGGAL_KHOTBAH->Visible) { // TANGGAL_KHOTBAH ?>
        <td <?= $Page->TANGGAL_KHOTBAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_khatib_TANGGAL_KHOTBAH" class="khatib_TANGGAL_KHOTBAH">
<span<?= $Page->TANGGAL_KHOTBAH->viewAttributes() ?>>
<?= $Page->TANGGAL_KHOTBAH->getViewValue() ?></span>
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
