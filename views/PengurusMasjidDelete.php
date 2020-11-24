<?php

namespace PHPMaker2021\project1;

// Page object
$PengurusMasjidDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpengurus_masjiddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpengurus_masjiddelete = currentForm = new ew.Form("fpengurus_masjiddelete", "delete");
    loadjs.done("fpengurus_masjiddelete");
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
<form name="fpengurus_masjiddelete" id="fpengurus_masjiddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengurus_masjid">
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
<?php if ($Page->ID_PENGURUS->Visible) { // ID_PENGURUS ?>
        <th class="<?= $Page->ID_PENGURUS->headerCellClass() ?>"><span id="elh_pengurus_masjid_ID_PENGURUS" class="pengurus_masjid_ID_PENGURUS"><?= $Page->ID_PENGURUS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
        <th class="<?= $Page->NAMA->headerCellClass() ?>"><span id="elh_pengurus_masjid_NAMA" class="pengurus_masjid_NAMA"><?= $Page->NAMA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <th class="<?= $Page->NO_TELP->headerCellClass() ?>"><span id="elh_pengurus_masjid_NO_TELP" class="pengurus_masjid_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TGL_LAHIR->Visible) { // TGL_LAHIR ?>
        <th class="<?= $Page->TGL_LAHIR->headerCellClass() ?>"><span id="elh_pengurus_masjid_TGL_LAHIR" class="pengurus_masjid_TGL_LAHIR"><?= $Page->TGL_LAHIR->caption() ?></span></th>
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
<?php if ($Page->ID_PENGURUS->Visible) { // ID_PENGURUS ?>
        <td <?= $Page->ID_PENGURUS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengurus_masjid_ID_PENGURUS" class="pengurus_masjid_ID_PENGURUS">
<span<?= $Page->ID_PENGURUS->viewAttributes() ?>>
<?= $Page->ID_PENGURUS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
        <td <?= $Page->NAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengurus_masjid_NAMA" class="pengurus_masjid_NAMA">
<span<?= $Page->NAMA->viewAttributes() ?>>
<?= $Page->NAMA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
        <td <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengurus_masjid_NO_TELP" class="pengurus_masjid_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TGL_LAHIR->Visible) { // TGL_LAHIR ?>
        <td <?= $Page->TGL_LAHIR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengurus_masjid_TGL_LAHIR" class="pengurus_masjid_TGL_LAHIR">
<span<?= $Page->TGL_LAHIR->viewAttributes() ?>>
<?= $Page->TGL_LAHIR->getViewValue() ?></span>
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
