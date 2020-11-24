<?php

namespace PHPMaker2021\project1;

// Page object
$PengurusMasjidEdit = &$Page;
?>
<script>
if (!ew.vars.tables.pengurus_masjid) ew.vars.tables.pengurus_masjid = <?= JsonEncode(GetClientVar("tables", "pengurus_masjid")) ?>;
var currentForm, currentPageID;
var fpengurus_masjidedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpengurus_masjidedit = currentForm = new ew.Form("fpengurus_masjidedit", "edit");

    // Add fields
    var fields = ew.vars.tables.pengurus_masjid.fields;
    fpengurus_masjidedit.addFields([
        ["ID_PENGURUS", [fields.ID_PENGURUS.required ? ew.Validators.required(fields.ID_PENGURUS.caption) : null], fields.ID_PENGURUS.isInvalid],
        ["NAMA", [fields.NAMA.required ? ew.Validators.required(fields.NAMA.caption) : null], fields.NAMA.isInvalid],
        ["NO_TELP", [fields.NO_TELP.required ? ew.Validators.required(fields.NO_TELP.caption) : null], fields.NO_TELP.isInvalid],
        ["ALAMAT", [fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["TGL_LAHIR", [fields.TGL_LAHIR.required ? ew.Validators.required(fields.TGL_LAHIR.caption) : null, ew.Validators.datetime(7)], fields.TGL_LAHIR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpengurus_masjidedit,
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
    fpengurus_masjidedit.validate = function () {
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
    fpengurus_masjidedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpengurus_masjidedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpengurus_masjidedit");
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
<form name="fpengurus_masjidedit" id="fpengurus_masjidedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengurus_masjid">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->ID_PENGURUS->Visible) { // ID_PENGURUS ?>
    <div id="r_ID_PENGURUS" class="form-group row">
        <label id="elh_pengurus_masjid_ID_PENGURUS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID_PENGURUS->caption() ?><?= $Page->ID_PENGURUS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ID_PENGURUS->cellAttributes() ?>>
<span id="el_pengurus_masjid_ID_PENGURUS">
<span<?= $Page->ID_PENGURUS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID_PENGURUS->getDisplayValue($Page->ID_PENGURUS->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="pengurus_masjid" data-field="x_ID_PENGURUS" data-hidden="1" name="x_ID_PENGURUS" id="x_ID_PENGURUS" value="<?= HtmlEncode($Page->ID_PENGURUS->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
    <div id="r_NAMA" class="form-group row">
        <label id="elh_pengurus_masjid_NAMA" for="x_NAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA->caption() ?><?= $Page->NAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA->cellAttributes() ?>>
<span id="el_pengurus_masjid_NAMA">
<input type="<?= $Page->NAMA->getInputTextType() ?>" data-table="pengurus_masjid" data-field="x_NAMA" name="x_NAMA" id="x_NAMA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA->getPlaceHolder()) ?>" value="<?= $Page->NAMA->EditValue ?>"<?= $Page->NAMA->editAttributes() ?> aria-describedby="x_NAMA_help">
<?= $Page->NAMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <div id="r_NO_TELP" class="form-group row">
        <label id="elh_pengurus_masjid_NO_TELP" for="x_NO_TELP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_TELP->caption() ?><?= $Page->NO_TELP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_pengurus_masjid_NO_TELP">
<input type="<?= $Page->NO_TELP->getInputTextType() ?>" data-table="pengurus_masjid" data-field="x_NO_TELP" name="x_NO_TELP" id="x_NO_TELP" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->NO_TELP->getPlaceHolder()) ?>" value="<?= $Page->NO_TELP->EditValue ?>"<?= $Page->NO_TELP->editAttributes() ?> aria-describedby="x_NO_TELP_help">
<?= $Page->NO_TELP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_TELP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_pengurus_masjid_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_pengurus_masjid_ALAMAT">
<textarea data-table="pengurus_masjid" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TGL_LAHIR->Visible) { // TGL_LAHIR ?>
    <div id="r_TGL_LAHIR" class="form-group row">
        <label id="elh_pengurus_masjid_TGL_LAHIR" for="x_TGL_LAHIR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TGL_LAHIR->caption() ?><?= $Page->TGL_LAHIR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TGL_LAHIR->cellAttributes() ?>>
<span id="el_pengurus_masjid_TGL_LAHIR">
<input type="<?= $Page->TGL_LAHIR->getInputTextType() ?>" data-table="pengurus_masjid" data-field="x_TGL_LAHIR" data-format="7" name="x_TGL_LAHIR" id="x_TGL_LAHIR" placeholder="<?= HtmlEncode($Page->TGL_LAHIR->getPlaceHolder()) ?>" value="<?= $Page->TGL_LAHIR->EditValue ?>"<?= $Page->TGL_LAHIR->editAttributes() ?> aria-describedby="x_TGL_LAHIR_help">
<?= $Page->TGL_LAHIR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TGL_LAHIR->getErrorMessage() ?></div>
<?php if (!$Page->TGL_LAHIR->ReadOnly && !$Page->TGL_LAHIR->Disabled && !isset($Page->TGL_LAHIR->EditAttrs["readonly"]) && !isset($Page->TGL_LAHIR->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpengurus_masjidedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fpengurus_masjidedit", "x_TGL_LAHIR", {"ignoreReadonly":true,"useCurrent":false,"format":7});
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
    ew.addEventHandlers("pengurus_masjid");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
