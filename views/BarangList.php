<?php

namespace PHPMaker2021\project1;

// Page object
$BarangList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbaranglist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fbaranglist = currentForm = new ew.Form("fbaranglist", "list");
    fbaranglist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fbaranglist");
});
var fbaranglistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fbaranglistsrch = currentSearchForm = new ew.Form("fbaranglistsrch");

    // Dynamic selection lists

    // Filters
    fbaranglistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbaranglistsrch");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fbaranglistsrch" id="fbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fbaranglistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="barang">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> barang">
<form name="fbaranglist" id="fbaranglist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
<div id="gmp_barang" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_baranglist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->NAMA_BARANG->Visible) { // NAMA_BARANG ?>
        <th data-name="NAMA_BARANG" class="<?= $Page->NAMA_BARANG->headerCellClass() ?>"><div id="elh_barang_NAMA_BARANG" class="barang_NAMA_BARANG"><?= $Page->renderSort($Page->NAMA_BARANG) ?></div></th>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
        <th data-name="JUMLAH" class="<?= $Page->JUMLAH->headerCellClass() ?>"><div id="elh_barang_JUMLAH" class="barang_JUMLAH"><?= $Page->renderSort($Page->JUMLAH) ?></div></th>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
        <th data-name="KONDISI" class="<?= $Page->KONDISI->headerCellClass() ?>"><div id="elh_barang_KONDISI" class="barang_KONDISI"><?= $Page->renderSort($Page->KONDISI) ?></div></th>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
        <th data-name="TANGGAL_PEMBELIAN" class="<?= $Page->TANGGAL_PEMBELIAN->headerCellClass() ?>"><div id="elh_barang_TANGGAL_PEMBELIAN" class="barang_TANGGAL_PEMBELIAN"><?= $Page->renderSort($Page->TANGGAL_PEMBELIAN) ?></div></th>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
        <th data-name="TANGGAL_BELI_GANTI_BARU" class="<?= $Page->TANGGAL_BELI_GANTI_BARU->headerCellClass() ?>"><div id="elh_barang_TANGGAL_BELI_GANTI_BARU" class="barang_TANGGAL_BELI_GANTI_BARU"><?= $Page->renderSort($Page->TANGGAL_BELI_GANTI_BARU) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_barang", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->NAMA_BARANG->Visible) { // NAMA_BARANG ?>
        <td data-name="NAMA_BARANG" <?= $Page->NAMA_BARANG->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_NAMA_BARANG">
<span<?= $Page->NAMA_BARANG->viewAttributes() ?>>
<?= $Page->NAMA_BARANG->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
        <td data-name="JUMLAH" <?= $Page->JUMLAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_JUMLAH">
<span<?= $Page->JUMLAH->viewAttributes() ?>>
<?= $Page->JUMLAH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KONDISI->Visible) { // KONDISI ?>
        <td data-name="KONDISI" <?= $Page->KONDISI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_KONDISI">
<span<?= $Page->KONDISI->viewAttributes() ?>>
<?= $Page->KONDISI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
        <td data-name="TANGGAL_PEMBELIAN" <?= $Page->TANGGAL_PEMBELIAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_TANGGAL_PEMBELIAN">
<span<?= $Page->TANGGAL_PEMBELIAN->viewAttributes() ?>>
<?= $Page->TANGGAL_PEMBELIAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
        <td data-name="TANGGAL_BELI_GANTI_BARU" <?= $Page->TANGGAL_BELI_GANTI_BARU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_TANGGAL_BELI_GANTI_BARU">
<span<?= $Page->TANGGAL_BELI_GANTI_BARU->viewAttributes() ?>>
<?= $Page->TANGGAL_BELI_GANTI_BARU->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl() ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("barang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
