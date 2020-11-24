<?php

namespace PHPMaker2021\project1;

// Page object
$KhatibEdit = &$Page;
?>
<script>
if (!ew.vars.tables.khatib) ew.vars.tables.khatib = <?= JsonEncode(GetClientVar("tables", "khatib")) ?>;
var currentForm, currentPageID;
var fkhatibedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fkhatibedit = currentForm = new ew.Form("fkhatibedit", "edit");

    // Add fields
    var fields = ew.vars.tables.khatib.fields;
    fkhatibedit.addFields([
        ["NAMA_KHATIB", [fields.NAMA_KHATIB.required ? ew.Validators.required(fields.NAMA_KHATIB.caption) : null], fields.NAMA_KHATIB.isInvalid],
        ["NO_TELP", [fields.NO_TELP.required ? ew.Validators.required(fields.NO_TELP.caption) : null], fields.NO_TELP.isInvalid],
        ["ALAMAT", [fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["TANGGAL_KHOTBAH", [fields.TANGGAL_KHOTBAH.required ? ew.Validators.required(fields.TANGGAL_KHOTBAH.caption) : null, ew.Validators.datetime(7)], fields.TANGGAL_KHOTBAH.isInvalid],
        ["MATERI_KHOTBAH", [fields.MATERI_KHOTBAH.required ? ew.Validators.required(fields.MATERI_KHOTBAH.caption) : null], fields.MATERI_KHOTBAH.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkhatibedit,
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
    fkhatibedit.validate = function () {
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
    fkhatibedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkhatibedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fkhatibedit");
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
<form name="fkhatibedit" id="fkhatibedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="khatib">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NAMA_KHATIB->Visible) { // NAMA_KHATIB ?>
    <div id="r_NAMA_KHATIB" class="form-group row">
        <label id="elh_khatib_NAMA_KHATIB" for="x_NAMA_KHATIB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_KHATIB->caption() ?><?= $Page->NAMA_KHATIB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_KHATIB->cellAttributes() ?>>
<input type="<?= $Page->NAMA_KHATIB->getInputTextType() ?>" data-table="khatib" data-field="x_NAMA_KHATIB" name="x_NAMA_KHATIB" id="x_NAMA_KHATIB" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_KHATIB->getPlaceHolder()) ?>" value="<?= $Page->NAMA_KHATIB->EditValue ?>"<?= $Page->NAMA_KHATIB->editAttributes() ?> aria-describedby="x_NAMA_KHATIB_help">
<?= $Page->NAMA_KHATIB->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_KHATIB->getErrorMessage() ?></div>
<input type="hidden" data-table="khatib" data-field="x_NAMA_KHATIB" data-hidden="1" name="o_NAMA_KHATIB" id="o_NAMA_KHATIB" value="<?= HtmlEncode($Page->NAMA_KHATIB->OldValue ?? $Page->NAMA_KHATIB->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <div id="r_NO_TELP" class="form-group row">
        <label id="elh_khatib_NO_TELP" for="x_NO_TELP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_TELP->caption() ?><?= $Page->NO_TELP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_khatib_NO_TELP">
<input type="<?= $Page->NO_TELP->getInputTextType() ?>" data-table="khatib" data-field="x_NO_TELP" name="x_NO_TELP" id="x_NO_TELP" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->NO_TELP->getPlaceHolder()) ?>" value="<?= $Page->NO_TELP->EditValue ?>"<?= $Page->NO_TELP->editAttributes() ?> aria-describedby="x_NO_TELP_help">
<?= $Page->NO_TELP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_TELP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_khatib_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_khatib_ALAMAT">
<textarea data-table="khatib" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TANGGAL_KHOTBAH->Visible) { // TANGGAL_KHOTBAH ?>
    <div id="r_TANGGAL_KHOTBAH" class="form-group row">
        <label id="elh_khatib_TANGGAL_KHOTBAH" for="x_TANGGAL_KHOTBAH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TANGGAL_KHOTBAH->caption() ?><?= $Page->TANGGAL_KHOTBAH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TANGGAL_KHOTBAH->cellAttributes() ?>>
<span id="el_khatib_TANGGAL_KHOTBAH">
<input type="<?= $Page->TANGGAL_KHOTBAH->getInputTextType() ?>" data-table="khatib" data-field="x_TANGGAL_KHOTBAH" data-format="7" name="x_TANGGAL_KHOTBAH" id="x_TANGGAL_KHOTBAH" placeholder="<?= HtmlEncode($Page->TANGGAL_KHOTBAH->getPlaceHolder()) ?>" value="<?= $Page->TANGGAL_KHOTBAH->EditValue ?>"<?= $Page->TANGGAL_KHOTBAH->editAttributes() ?> aria-describedby="x_TANGGAL_KHOTBAH_help">
<?= $Page->TANGGAL_KHOTBAH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TANGGAL_KHOTBAH->getErrorMessage() ?></div>
<?php if (!$Page->TANGGAL_KHOTBAH->ReadOnly && !$Page->TANGGAL_KHOTBAH->Disabled && !isset($Page->TANGGAL_KHOTBAH->EditAttrs["readonly"]) && !isset($Page->TANGGAL_KHOTBAH->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkhatibedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fkhatibedit", "x_TANGGAL_KHOTBAH", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MATERI_KHOTBAH->Visible) { // MATERI_KHOTBAH ?>
    <div id="r_MATERI_KHOTBAH" class="form-group row">
        <label id="elh_khatib_MATERI_KHOTBAH" for="x_MATERI_KHOTBAH" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MATERI_KHOTBAH->caption() ?><?= $Page->MATERI_KHOTBAH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MATERI_KHOTBAH->cellAttributes() ?>>
<span id="el_khatib_MATERI_KHOTBAH">
<textarea data-table="khatib" data-field="x_MATERI_KHOTBAH" name="x_MATERI_KHOTBAH" id="x_MATERI_KHOTBAH" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->MATERI_KHOTBAH->getPlaceHolder()) ?>"<?= $Page->MATERI_KHOTBAH->editAttributes() ?> aria-describedby="x_MATERI_KHOTBAH_help"><?= $Page->MATERI_KHOTBAH->EditValue ?></textarea>
<?= $Page->MATERI_KHOTBAH->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MATERI_KHOTBAH->getErrorMessage() ?></div>
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
    ew.addEventHandlers("khatib");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
