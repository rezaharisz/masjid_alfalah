<?php

namespace PHPMaker2021\project1;

// Page object
$KuliahSubuhEdit = &$Page;
?>
<script>
if (!ew.vars.tables.kuliah_subuh) ew.vars.tables.kuliah_subuh = <?= JsonEncode(GetClientVar("tables", "kuliah_subuh")) ?>;
var currentForm, currentPageID;
var fkuliah_subuhedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fkuliah_subuhedit = currentForm = new ew.Form("fkuliah_subuhedit", "edit");

    // Add fields
    var fields = ew.vars.tables.kuliah_subuh.fields;
    fkuliah_subuhedit.addFields([
        ["NAMA_PENGISI", [fields.NAMA_PENGISI.required ? ew.Validators.required(fields.NAMA_PENGISI.caption) : null], fields.NAMA_PENGISI.isInvalid],
        ["NO_TELP", [fields.NO_TELP.required ? ew.Validators.required(fields.NO_TELP.caption) : null], fields.NO_TELP.isInvalid],
        ["ALAMAT", [fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["TANGGAL", [fields.TANGGAL.required ? ew.Validators.required(fields.TANGGAL.caption) : null, ew.Validators.datetime(7)], fields.TANGGAL.isInvalid],
        ["MATERI_KULIAH_SUBUH", [fields.MATERI_KULIAH_SUBUH.required ? ew.Validators.required(fields.MATERI_KULIAH_SUBUH.caption) : null], fields.MATERI_KULIAH_SUBUH.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkuliah_subuhedit,
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
    fkuliah_subuhedit.validate = function () {
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
    fkuliah_subuhedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkuliah_subuhedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fkuliah_subuhedit");
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
<form name="fkuliah_subuhedit" id="fkuliah_subuhedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kuliah_subuh">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NAMA_PENGISI->Visible) { // NAMA_PENGISI ?>
    <div id="r_NAMA_PENGISI" class="form-group row">
        <label id="elh_kuliah_subuh_NAMA_PENGISI" for="x_NAMA_PENGISI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_PENGISI->caption() ?><?= $Page->NAMA_PENGISI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_PENGISI->cellAttributes() ?>>
<input type="<?= $Page->NAMA_PENGISI->getInputTextType() ?>" data-table="kuliah_subuh" data-field="x_NAMA_PENGISI" name="x_NAMA_PENGISI" id="x_NAMA_PENGISI" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_PENGISI->getPlaceHolder()) ?>" value="<?= $Page->NAMA_PENGISI->EditValue ?>"<?= $Page->NAMA_PENGISI->editAttributes() ?> aria-describedby="x_NAMA_PENGISI_help">
<?= $Page->NAMA_PENGISI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_PENGISI->getErrorMessage() ?></div>
<input type="hidden" data-table="kuliah_subuh" data-field="x_NAMA_PENGISI" data-hidden="1" name="o_NAMA_PENGISI" id="o_NAMA_PENGISI" value="<?= HtmlEncode($Page->NAMA_PENGISI->OldValue ?? $Page->NAMA_PENGISI->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <div id="r_NO_TELP" class="form-group row">
        <label id="elh_kuliah_subuh_NO_TELP" for="x_NO_TELP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_TELP->caption() ?><?= $Page->NO_TELP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_kuliah_subuh_NO_TELP">
<input type="<?= $Page->NO_TELP->getInputTextType() ?>" data-table="kuliah_subuh" data-field="x_NO_TELP" name="x_NO_TELP" id="x_NO_TELP" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->NO_TELP->getPlaceHolder()) ?>" value="<?= $Page->NO_TELP->EditValue ?>"<?= $Page->NO_TELP->editAttributes() ?> aria-describedby="x_NO_TELP_help">
<?= $Page->NO_TELP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_TELP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_kuliah_subuh_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_kuliah_subuh_ALAMAT">
<textarea data-table="kuliah_subuh" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TANGGAL->Visible) { // TANGGAL ?>
    <div id="r_TANGGAL" class="form-group row">
        <label id="elh_kuliah_subuh_TANGGAL" for="x_TANGGAL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TANGGAL->caption() ?><?= $Page->TANGGAL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TANGGAL->cellAttributes() ?>>
<span id="el_kuliah_subuh_TANGGAL">
<input type="<?= $Page->TANGGAL->getInputTextType() ?>" data-table="kuliah_subuh" data-field="x_TANGGAL" data-format="7" name="x_TANGGAL" id="x_TANGGAL" placeholder="<?= HtmlEncode($Page->TANGGAL->getPlaceHolder()) ?>" value="<?= $Page->TANGGAL->EditValue ?>"<?= $Page->TANGGAL->editAttributes() ?> aria-describedby="x_TANGGAL_help">
<?= $Page->TANGGAL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TANGGAL->getErrorMessage() ?></div>
<?php if (!$Page->TANGGAL->ReadOnly && !$Page->TANGGAL->Disabled && !isset($Page->TANGGAL->EditAttrs["readonly"]) && !isset($Page->TANGGAL->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkuliah_subuhedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fkuliah_subuhedit", "x_TANGGAL", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MATERI_KULIAH_SUBUH->Visible) { // MATERI_KULIAH_SUBUH ?>
    <div id="r_MATERI_KULIAH_SUBUH" class="form-group row">
        <label id="elh_kuliah_subuh_MATERI_KULIAH_SUBUH" for="x_MATERI_KULIAH_SUBUH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MATERI_KULIAH_SUBUH->caption() ?><?= $Page->MATERI_KULIAH_SUBUH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MATERI_KULIAH_SUBUH->cellAttributes() ?>>
<span id="el_kuliah_subuh_MATERI_KULIAH_SUBUH">
<textarea data-table="kuliah_subuh" data-field="x_MATERI_KULIAH_SUBUH" name="x_MATERI_KULIAH_SUBUH" id="x_MATERI_KULIAH_SUBUH" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->MATERI_KULIAH_SUBUH->getPlaceHolder()) ?>"<?= $Page->MATERI_KULIAH_SUBUH->editAttributes() ?> aria-describedby="x_MATERI_KULIAH_SUBUH_help"><?= $Page->MATERI_KULIAH_SUBUH->EditValue ?></textarea>
<?= $Page->MATERI_KULIAH_SUBUH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MATERI_KULIAH_SUBUH->getErrorMessage() ?></div>
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
    ew.addEventHandlers("kuliah_subuh");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
