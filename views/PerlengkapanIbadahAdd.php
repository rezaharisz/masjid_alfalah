<?php

namespace PHPMaker2021\project1;

// Page object
$PerlengkapanIbadahAdd = &$Page;
?>
<script>
if (!ew.vars.tables.perlengkapan_ibadah) ew.vars.tables.perlengkapan_ibadah = <?= JsonEncode(GetClientVar("tables", "perlengkapan_ibadah")) ?>;
var currentForm, currentPageID;
var fperlengkapan_ibadahadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fperlengkapan_ibadahadd = currentForm = new ew.Form("fperlengkapan_ibadahadd", "add");

    // Add fields
    var fields = ew.vars.tables.perlengkapan_ibadah.fields;
    fperlengkapan_ibadahadd.addFields([
        ["NAMA_PERLENGKAPAN_IBADAH", [fields.NAMA_PERLENGKAPAN_IBADAH.required ? ew.Validators.required(fields.NAMA_PERLENGKAPAN_IBADAH.caption) : null], fields.NAMA_PERLENGKAPAN_IBADAH.isInvalid],
        ["JUMLAH", [fields.JUMLAH.required ? ew.Validators.required(fields.JUMLAH.caption) : null, ew.Validators.integer], fields.JUMLAH.isInvalid],
        ["KONDISI", [fields.KONDISI.required ? ew.Validators.required(fields.KONDISI.caption) : null], fields.KONDISI.isInvalid],
        ["TANGGAL_PEMBELIAN", [fields.TANGGAL_PEMBELIAN.required ? ew.Validators.required(fields.TANGGAL_PEMBELIAN.caption) : null, ew.Validators.datetime(7)], fields.TANGGAL_PEMBELIAN.isInvalid],
        ["TANGGAL_BELI_GANTI_BARU", [fields.TANGGAL_BELI_GANTI_BARU.required ? ew.Validators.required(fields.TANGGAL_BELI_GANTI_BARU.caption) : null, ew.Validators.datetime(7)], fields.TANGGAL_BELI_GANTI_BARU.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fperlengkapan_ibadahadd,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fperlengkapan_ibadahadd.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fperlengkapan_ibadahadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fperlengkapan_ibadahadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fperlengkapan_ibadahadd.lists.KONDISI = <?= $Page->KONDISI->toClientList($Page) ?>;
    loadjs.done("fperlengkapan_ibadahadd");
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
<form name="fperlengkapan_ibadahadd" id="fperlengkapan_ibadahadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="perlengkapan_ibadah">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NAMA_PERLENGKAPAN_IBADAH->Visible) { // NAMA_PERLENGKAPAN_IBADAH ?>
    <div id="r_NAMA_PERLENGKAPAN_IBADAH" class="form-group row">
        <label id="elh_perlengkapan_ibadah_NAMA_PERLENGKAPAN_IBADAH" for="x_NAMA_PERLENGKAPAN_IBADAH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_PERLENGKAPAN_IBADAH->caption() ?><?= $Page->NAMA_PERLENGKAPAN_IBADAH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_PERLENGKAPAN_IBADAH->cellAttributes() ?>>
<span id="el_perlengkapan_ibadah_NAMA_PERLENGKAPAN_IBADAH">
<input type="<?= $Page->NAMA_PERLENGKAPAN_IBADAH->getInputTextType() ?>" data-table="perlengkapan_ibadah" data-field="x_NAMA_PERLENGKAPAN_IBADAH" name="x_NAMA_PERLENGKAPAN_IBADAH" id="x_NAMA_PERLENGKAPAN_IBADAH" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_PERLENGKAPAN_IBADAH->getPlaceHolder()) ?>" value="<?= $Page->NAMA_PERLENGKAPAN_IBADAH->EditValue ?>"<?= $Page->NAMA_PERLENGKAPAN_IBADAH->editAttributes() ?> aria-describedby="x_NAMA_PERLENGKAPAN_IBADAH_help">
<?= $Page->NAMA_PERLENGKAPAN_IBADAH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_PERLENGKAPAN_IBADAH->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JUMLAH->Visible) { // JUMLAH ?>
    <div id="r_JUMLAH" class="form-group row">
        <label id="elh_perlengkapan_ibadah_JUMLAH" for="x_JUMLAH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JUMLAH->caption() ?><?= $Page->JUMLAH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JUMLAH->cellAttributes() ?>>
<span id="el_perlengkapan_ibadah_JUMLAH">
<input type="<?= $Page->JUMLAH->getInputTextType() ?>" data-table="perlengkapan_ibadah" data-field="x_JUMLAH" name="x_JUMLAH" id="x_JUMLAH" size="30" placeholder="<?= HtmlEncode($Page->JUMLAH->getPlaceHolder()) ?>" value="<?= $Page->JUMLAH->EditValue ?>"<?= $Page->JUMLAH->editAttributes() ?> aria-describedby="x_JUMLAH_help">
<?= $Page->JUMLAH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JUMLAH->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KONDISI->Visible) { // KONDISI ?>
    <div id="r_KONDISI" class="form-group row">
        <label id="elh_perlengkapan_ibadah_KONDISI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KONDISI->caption() ?><?= $Page->KONDISI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KONDISI->cellAttributes() ?>>
<span id="el_perlengkapan_ibadah_KONDISI">
<template id="tp_x_KONDISI">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" data-table="perlengkapan_ibadah" data-field="x_KONDISI" name="x_KONDISI" id="x_KONDISI"<?= $Page->KONDISI->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_KONDISI" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_KONDISI[]"
    name="x_KONDISI[]"
    value="<?= HtmlEncode($Page->KONDISI->CurrentValue) ?>"
    data-type="select-multiple"
    data-template="tp_x_KONDISI"
    data-target="dsl_x_KONDISI"
    data-repeatcolumn="5"
    class="form-control<?= $Page->KONDISI->isInvalidClass() ?>"
    data-table="perlengkapan_ibadah"
    data-field="x_KONDISI"
    data-value-separator="<?= $Page->KONDISI->displayValueSeparatorAttribute() ?>"
    <?= $Page->KONDISI->editAttributes() ?>>
<?= $Page->KONDISI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KONDISI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TANGGAL_PEMBELIAN->Visible) { // TANGGAL_PEMBELIAN ?>
    <div id="r_TANGGAL_PEMBELIAN" class="form-group row">
        <label id="elh_perlengkapan_ibadah_TANGGAL_PEMBELIAN" for="x_TANGGAL_PEMBELIAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TANGGAL_PEMBELIAN->caption() ?><?= $Page->TANGGAL_PEMBELIAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TANGGAL_PEMBELIAN->cellAttributes() ?>>
<span id="el_perlengkapan_ibadah_TANGGAL_PEMBELIAN">
<input type="<?= $Page->TANGGAL_PEMBELIAN->getInputTextType() ?>" data-table="perlengkapan_ibadah" data-field="x_TANGGAL_PEMBELIAN" data-format="7" name="x_TANGGAL_PEMBELIAN" id="x_TANGGAL_PEMBELIAN" placeholder="<?= HtmlEncode($Page->TANGGAL_PEMBELIAN->getPlaceHolder()) ?>" value="<?= $Page->TANGGAL_PEMBELIAN->EditValue ?>"<?= $Page->TANGGAL_PEMBELIAN->editAttributes() ?> aria-describedby="x_TANGGAL_PEMBELIAN_help">
<?= $Page->TANGGAL_PEMBELIAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TANGGAL_PEMBELIAN->getErrorMessage() ?></div>
<?php if (!$Page->TANGGAL_PEMBELIAN->ReadOnly && !$Page->TANGGAL_PEMBELIAN->Disabled && !isset($Page->TANGGAL_PEMBELIAN->EditAttrs["readonly"]) && !isset($Page->TANGGAL_PEMBELIAN->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fperlengkapan_ibadahadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fperlengkapan_ibadahadd", "x_TANGGAL_PEMBELIAN", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TANGGAL_BELI_GANTI_BARU->Visible) { // TANGGAL_BELI_GANTI_BARU ?>
    <div id="r_TANGGAL_BELI_GANTI_BARU" class="form-group row">
        <label id="elh_perlengkapan_ibadah_TANGGAL_BELI_GANTI_BARU" for="x_TANGGAL_BELI_GANTI_BARU" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TANGGAL_BELI_GANTI_BARU->caption() ?><?= $Page->TANGGAL_BELI_GANTI_BARU->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TANGGAL_BELI_GANTI_BARU->cellAttributes() ?>>
<span id="el_perlengkapan_ibadah_TANGGAL_BELI_GANTI_BARU">
<input type="<?= $Page->TANGGAL_BELI_GANTI_BARU->getInputTextType() ?>" data-table="perlengkapan_ibadah" data-field="x_TANGGAL_BELI_GANTI_BARU" data-format="7" name="x_TANGGAL_BELI_GANTI_BARU" id="x_TANGGAL_BELI_GANTI_BARU" placeholder="<?= HtmlEncode($Page->TANGGAL_BELI_GANTI_BARU->getPlaceHolder()) ?>" value="<?= $Page->TANGGAL_BELI_GANTI_BARU->EditValue ?>"<?= $Page->TANGGAL_BELI_GANTI_BARU->editAttributes() ?> aria-describedby="x_TANGGAL_BELI_GANTI_BARU_help">
<?= $Page->TANGGAL_BELI_GANTI_BARU->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TANGGAL_BELI_GANTI_BARU->getErrorMessage() ?></div>
<?php if (!$Page->TANGGAL_BELI_GANTI_BARU->ReadOnly && !$Page->TANGGAL_BELI_GANTI_BARU->Disabled && !isset($Page->TANGGAL_BELI_GANTI_BARU->EditAttrs["readonly"]) && !isset($Page->TANGGAL_BELI_GANTI_BARU->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fperlengkapan_ibadahadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fperlengkapan_ibadahadd", "x_TANGGAL_BELI_GANTI_BARU", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= GetUrl($Page->getReturnUrl()) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("perlengkapan_ibadah");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
