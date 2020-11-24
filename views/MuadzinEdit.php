<?php

namespace PHPMaker2021\project1;

// Page object
$MuadzinEdit = &$Page;
?>
<script>
if (!ew.vars.tables.muadzin) ew.vars.tables.muadzin = <?= JsonEncode(GetClientVar("tables", "muadzin")) ?>;
var currentForm, currentPageID;
var fmuadzinedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fmuadzinedit = currentForm = new ew.Form("fmuadzinedit", "edit");

    // Add fields
    var fields = ew.vars.tables.muadzin.fields;
    fmuadzinedit.addFields([
        ["NAMA_MUADZIN", [fields.NAMA_MUADZIN.required ? ew.Validators.required(fields.NAMA_MUADZIN.caption) : null], fields.NAMA_MUADZIN.isInvalid],
        ["NO_TELP", [fields.NO_TELP.required ? ew.Validators.required(fields.NO_TELP.caption) : null], fields.NO_TELP.isInvalid],
        ["ALAMAT", [fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["WAKTU_ADZAN", [fields.WAKTU_ADZAN.required ? ew.Validators.required(fields.WAKTU_ADZAN.caption) : null], fields.WAKTU_ADZAN.isInvalid],
        ["TANGGAL_ADZAN", [fields.TANGGAL_ADZAN.required ? ew.Validators.required(fields.TANGGAL_ADZAN.caption) : null, ew.Validators.datetime(7)], fields.TANGGAL_ADZAN.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fmuadzinedit,
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
    fmuadzinedit.validate = function () {
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
    fmuadzinedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmuadzinedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fmuadzinedit.lists.WAKTU_ADZAN = <?= $Page->WAKTU_ADZAN->toClientList($Page) ?>;
    loadjs.done("fmuadzinedit");
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
<form name="fmuadzinedit" id="fmuadzinedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="muadzin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NAMA_MUADZIN->Visible) { // NAMA_MUADZIN ?>
    <div id="r_NAMA_MUADZIN" class="form-group row">
        <label id="elh_muadzin_NAMA_MUADZIN" for="x_NAMA_MUADZIN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_MUADZIN->caption() ?><?= $Page->NAMA_MUADZIN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_MUADZIN->cellAttributes() ?>>
<input type="<?= $Page->NAMA_MUADZIN->getInputTextType() ?>" data-table="muadzin" data-field="x_NAMA_MUADZIN" name="x_NAMA_MUADZIN" id="x_NAMA_MUADZIN" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_MUADZIN->getPlaceHolder()) ?>" value="<?= $Page->NAMA_MUADZIN->EditValue ?>"<?= $Page->NAMA_MUADZIN->editAttributes() ?> aria-describedby="x_NAMA_MUADZIN_help">
<?= $Page->NAMA_MUADZIN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_MUADZIN->getErrorMessage() ?></div>
<input type="hidden" data-table="muadzin" data-field="x_NAMA_MUADZIN" data-hidden="1" name="o_NAMA_MUADZIN" id="o_NAMA_MUADZIN" value="<?= HtmlEncode($Page->NAMA_MUADZIN->OldValue ?? $Page->NAMA_MUADZIN->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <div id="r_NO_TELP" class="form-group row">
        <label id="elh_muadzin_NO_TELP" for="x_NO_TELP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_TELP->caption() ?><?= $Page->NO_TELP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_muadzin_NO_TELP">
<input type="<?= $Page->NO_TELP->getInputTextType() ?>" data-table="muadzin" data-field="x_NO_TELP" name="x_NO_TELP" id="x_NO_TELP" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->NO_TELP->getPlaceHolder()) ?>" value="<?= $Page->NO_TELP->EditValue ?>"<?= $Page->NO_TELP->editAttributes() ?> aria-describedby="x_NO_TELP_help">
<?= $Page->NO_TELP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_TELP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_muadzin_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_muadzin_ALAMAT">
<textarea data-table="muadzin" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->WAKTU_ADZAN->Visible) { // WAKTU_ADZAN ?>
    <div id="r_WAKTU_ADZAN" class="form-group row">
        <label id="elh_muadzin_WAKTU_ADZAN" for="x_WAKTU_ADZAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->WAKTU_ADZAN->caption() ?><?= $Page->WAKTU_ADZAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->WAKTU_ADZAN->cellAttributes() ?>>
<span id="el_muadzin_WAKTU_ADZAN">
    <select
        id="x_WAKTU_ADZAN"
        name="x_WAKTU_ADZAN"
        class="form-control ew-select<?= $Page->WAKTU_ADZAN->isInvalidClass() ?>"
        data-select2-id="muadzin_x_WAKTU_ADZAN"
        data-table="muadzin"
        data-field="x_WAKTU_ADZAN"
        data-value-separator="<?= $Page->WAKTU_ADZAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->WAKTU_ADZAN->getPlaceHolder()) ?>"
        <?= $Page->WAKTU_ADZAN->editAttributes() ?>>
        <?= $Page->WAKTU_ADZAN->selectOptionListHtml("x_WAKTU_ADZAN") ?>
    </select>
    <?= $Page->WAKTU_ADZAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->WAKTU_ADZAN->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='muadzin_x_WAKTU_ADZAN']"),
        options = { name: "x_WAKTU_ADZAN", selectId: "muadzin_x_WAKTU_ADZAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.muadzin.fields.WAKTU_ADZAN.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.muadzin.fields.WAKTU_ADZAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TANGGAL_ADZAN->Visible) { // TANGGAL_ADZAN ?>
    <div id="r_TANGGAL_ADZAN" class="form-group row">
        <label id="elh_muadzin_TANGGAL_ADZAN" for="x_TANGGAL_ADZAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TANGGAL_ADZAN->caption() ?><?= $Page->TANGGAL_ADZAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TANGGAL_ADZAN->cellAttributes() ?>>
<span id="el_muadzin_TANGGAL_ADZAN">
<input type="<?= $Page->TANGGAL_ADZAN->getInputTextType() ?>" data-table="muadzin" data-field="x_TANGGAL_ADZAN" data-format="7" name="x_TANGGAL_ADZAN" id="x_TANGGAL_ADZAN" placeholder="<?= HtmlEncode($Page->TANGGAL_ADZAN->getPlaceHolder()) ?>" value="<?= $Page->TANGGAL_ADZAN->EditValue ?>"<?= $Page->TANGGAL_ADZAN->editAttributes() ?> aria-describedby="x_TANGGAL_ADZAN_help">
<?= $Page->TANGGAL_ADZAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TANGGAL_ADZAN->getErrorMessage() ?></div>
<?php if (!$Page->TANGGAL_ADZAN->ReadOnly && !$Page->TANGGAL_ADZAN->Disabled && !isset($Page->TANGGAL_ADZAN->EditAttrs["readonly"]) && !isset($Page->TANGGAL_ADZAN->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmuadzinedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fmuadzinedit", "x_TANGGAL_ADZAN", {"ignoreReadonly":true,"useCurrent":false,"format":7});
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("muadzin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
