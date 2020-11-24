<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class BarangEdit extends Barang
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'barang';

    // Page object name
    public $PageObjName = "BarangEdit";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;
        $this->TokenTimeout = SessionTimeoutTime();

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (barang)
        if (!isset($GLOBALS["barang"]) || get_class($GLOBALS["barang"]) == PROJECT_NAMESPACE . "barang") {
            $GLOBALS["barang"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'barang');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("barang"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "barangview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['NAMA_BARANG'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->NAMA_BARANG->setVisibility();
        $this->JUMLAH->setVisibility();
        $this->KONDISI->setVisibility();
        $this->TANGGAL_PEMBELIAN->setVisibility();
        $this->TANGGAL_BELI_GANTI_BARU->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("NAMA_BARANG") ?? Key(0) ?? Route(2)) !== null) {
                $this->NAMA_BARANG->setQueryStringValue($keyValue);
                $this->NAMA_BARANG->setOldValue($this->NAMA_BARANG->QueryStringValue);
            } elseif (Post("NAMA_BARANG") !== null) {
                $this->NAMA_BARANG->setFormValue(Post("NAMA_BARANG"));
                $this->NAMA_BARANG->setOldValue($this->NAMA_BARANG->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName));
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("NAMA_BARANG") ?? Route("NAMA_BARANG")) !== null) {
                    $this->NAMA_BARANG->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->NAMA_BARANG->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("baranglist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "baranglist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Rendering event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'NAMA_BARANG' first before field var 'x_NAMA_BARANG'
        $val = $CurrentForm->hasValue("NAMA_BARANG") ? $CurrentForm->getValue("NAMA_BARANG") : $CurrentForm->getValue("x_NAMA_BARANG");
        if (!$this->NAMA_BARANG->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_BARANG->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_BARANG->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_NAMA_BARANG")) {
            $this->NAMA_BARANG->setOldValue($CurrentForm->getValue("o_NAMA_BARANG"));
        }

        // Check field name 'JUMLAH' first before field var 'x_JUMLAH'
        $val = $CurrentForm->hasValue("JUMLAH") ? $CurrentForm->getValue("JUMLAH") : $CurrentForm->getValue("x_JUMLAH");
        if (!$this->JUMLAH->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JUMLAH->Visible = false; // Disable update for API request
            } else {
                $this->JUMLAH->setFormValue($val);
            }
        }

        // Check field name 'KONDISI' first before field var 'x_KONDISI'
        $val = $CurrentForm->hasValue("KONDISI") ? $CurrentForm->getValue("KONDISI") : $CurrentForm->getValue("x_KONDISI");
        if (!$this->KONDISI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KONDISI->Visible = false; // Disable update for API request
            } else {
                $this->KONDISI->setFormValue($val);
            }
        }

        // Check field name 'TANGGAL_PEMBELIAN' first before field var 'x_TANGGAL_PEMBELIAN'
        $val = $CurrentForm->hasValue("TANGGAL_PEMBELIAN") ? $CurrentForm->getValue("TANGGAL_PEMBELIAN") : $CurrentForm->getValue("x_TANGGAL_PEMBELIAN");
        if (!$this->TANGGAL_PEMBELIAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TANGGAL_PEMBELIAN->Visible = false; // Disable update for API request
            } else {
                $this->TANGGAL_PEMBELIAN->setFormValue($val);
            }
            $this->TANGGAL_PEMBELIAN->CurrentValue = UnFormatDateTime($this->TANGGAL_PEMBELIAN->CurrentValue, 7);
        }

        // Check field name 'TANGGAL_BELI_GANTI_BARU' first before field var 'x_TANGGAL_BELI_GANTI_BARU'
        $val = $CurrentForm->hasValue("TANGGAL_BELI_GANTI_BARU") ? $CurrentForm->getValue("TANGGAL_BELI_GANTI_BARU") : $CurrentForm->getValue("x_TANGGAL_BELI_GANTI_BARU");
        if (!$this->TANGGAL_BELI_GANTI_BARU->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TANGGAL_BELI_GANTI_BARU->Visible = false; // Disable update for API request
            } else {
                $this->TANGGAL_BELI_GANTI_BARU->setFormValue($val);
            }
            $this->TANGGAL_BELI_GANTI_BARU->CurrentValue = UnFormatDateTime($this->TANGGAL_BELI_GANTI_BARU->CurrentValue, 7);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NAMA_BARANG->CurrentValue = $this->NAMA_BARANG->FormValue;
        $this->JUMLAH->CurrentValue = $this->JUMLAH->FormValue;
        $this->KONDISI->CurrentValue = $this->KONDISI->FormValue;
        $this->TANGGAL_PEMBELIAN->CurrentValue = $this->TANGGAL_PEMBELIAN->FormValue;
        $this->TANGGAL_PEMBELIAN->CurrentValue = UnFormatDateTime($this->TANGGAL_PEMBELIAN->CurrentValue, 7);
        $this->TANGGAL_BELI_GANTI_BARU->CurrentValue = $this->TANGGAL_BELI_GANTI_BARU->FormValue;
        $this->TANGGAL_BELI_GANTI_BARU->CurrentValue = UnFormatDateTime($this->TANGGAL_BELI_GANTI_BARU->CurrentValue, 7);
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->NAMA_BARANG->setDbValue($row['NAMA_BARANG']);
        $this->JUMLAH->setDbValue($row['JUMLAH']);
        $this->KONDISI->setDbValue($row['KONDISI']);
        $this->TANGGAL_PEMBELIAN->setDbValue($row['TANGGAL_PEMBELIAN']);
        $this->TANGGAL_BELI_GANTI_BARU->setDbValue($row['TANGGAL_BELI_GANTI_BARU']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NAMA_BARANG'] = null;
        $row['JUMLAH'] = null;
        $row['KONDISI'] = null;
        $row['TANGGAL_PEMBELIAN'] = null;
        $row['TANGGAL_BELI_GANTI_BARU'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NAMA_BARANG

        // JUMLAH

        // KONDISI

        // TANGGAL_PEMBELIAN

        // TANGGAL_BELI_GANTI_BARU
        if ($this->RowType == ROWTYPE_VIEW) {
            // NAMA_BARANG
            $this->NAMA_BARANG->ViewValue = $this->NAMA_BARANG->CurrentValue;
            $this->NAMA_BARANG->ViewCustomAttributes = "";

            // JUMLAH
            $this->JUMLAH->ViewValue = $this->JUMLAH->CurrentValue;
            $this->JUMLAH->ViewCustomAttributes = "";

            // KONDISI
            if (strval($this->KONDISI->CurrentValue) != "") {
                $this->KONDISI->ViewValue = $this->KONDISI->optionCaption($this->KONDISI->CurrentValue);
            } else {
                $this->KONDISI->ViewValue = null;
            }
            $this->KONDISI->ViewCustomAttributes = "";

            // TANGGAL_PEMBELIAN
            $this->TANGGAL_PEMBELIAN->ViewValue = $this->TANGGAL_PEMBELIAN->CurrentValue;
            $this->TANGGAL_PEMBELIAN->ViewValue = FormatDateTime($this->TANGGAL_PEMBELIAN->ViewValue, 7);
            $this->TANGGAL_PEMBELIAN->ViewCustomAttributes = "";

            // TANGGAL_BELI_GANTI_BARU
            $this->TANGGAL_BELI_GANTI_BARU->ViewValue = $this->TANGGAL_BELI_GANTI_BARU->CurrentValue;
            $this->TANGGAL_BELI_GANTI_BARU->ViewValue = FormatDateTime($this->TANGGAL_BELI_GANTI_BARU->ViewValue, 7);
            $this->TANGGAL_BELI_GANTI_BARU->ViewCustomAttributes = "";

            // NAMA_BARANG
            $this->NAMA_BARANG->LinkCustomAttributes = "";
            $this->NAMA_BARANG->HrefValue = "";
            $this->NAMA_BARANG->TooltipValue = "";

            // JUMLAH
            $this->JUMLAH->LinkCustomAttributes = "";
            $this->JUMLAH->HrefValue = "";
            $this->JUMLAH->TooltipValue = "";

            // KONDISI
            $this->KONDISI->LinkCustomAttributes = "";
            $this->KONDISI->HrefValue = "";
            $this->KONDISI->TooltipValue = "";

            // TANGGAL_PEMBELIAN
            $this->TANGGAL_PEMBELIAN->LinkCustomAttributes = "";
            $this->TANGGAL_PEMBELIAN->HrefValue = "";
            $this->TANGGAL_PEMBELIAN->TooltipValue = "";

            // TANGGAL_BELI_GANTI_BARU
            $this->TANGGAL_BELI_GANTI_BARU->LinkCustomAttributes = "";
            $this->TANGGAL_BELI_GANTI_BARU->HrefValue = "";
            $this->TANGGAL_BELI_GANTI_BARU->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NAMA_BARANG
            $this->NAMA_BARANG->EditAttrs["class"] = "form-control";
            $this->NAMA_BARANG->EditCustomAttributes = "";
            if (!$this->NAMA_BARANG->Raw) {
                $this->NAMA_BARANG->CurrentValue = HtmlDecode($this->NAMA_BARANG->CurrentValue);
            }
            $this->NAMA_BARANG->EditValue = HtmlEncode($this->NAMA_BARANG->CurrentValue);
            $this->NAMA_BARANG->PlaceHolder = RemoveHtml($this->NAMA_BARANG->caption());

            // JUMLAH
            $this->JUMLAH->EditAttrs["class"] = "form-control";
            $this->JUMLAH->EditCustomAttributes = "";
            if (!$this->JUMLAH->Raw) {
                $this->JUMLAH->CurrentValue = HtmlDecode($this->JUMLAH->CurrentValue);
            }
            $this->JUMLAH->EditValue = HtmlEncode($this->JUMLAH->CurrentValue);
            $this->JUMLAH->PlaceHolder = RemoveHtml($this->JUMLAH->caption());

            // KONDISI
            $this->KONDISI->EditAttrs["class"] = "form-control";
            $this->KONDISI->EditCustomAttributes = "";
            $this->KONDISI->EditValue = $this->KONDISI->options(true);
            $this->KONDISI->PlaceHolder = RemoveHtml($this->KONDISI->caption());

            // TANGGAL_PEMBELIAN
            $this->TANGGAL_PEMBELIAN->EditAttrs["class"] = "form-control";
            $this->TANGGAL_PEMBELIAN->EditCustomAttributes = "";
            $this->TANGGAL_PEMBELIAN->EditValue = HtmlEncode(FormatDateTime($this->TANGGAL_PEMBELIAN->CurrentValue, 7));
            $this->TANGGAL_PEMBELIAN->PlaceHolder = RemoveHtml($this->TANGGAL_PEMBELIAN->caption());

            // TANGGAL_BELI_GANTI_BARU
            $this->TANGGAL_BELI_GANTI_BARU->EditAttrs["class"] = "form-control";
            $this->TANGGAL_BELI_GANTI_BARU->EditCustomAttributes = "";
            $this->TANGGAL_BELI_GANTI_BARU->EditValue = HtmlEncode(FormatDateTime($this->TANGGAL_BELI_GANTI_BARU->CurrentValue, 7));
            $this->TANGGAL_BELI_GANTI_BARU->PlaceHolder = RemoveHtml($this->TANGGAL_BELI_GANTI_BARU->caption());

            // Edit refer script

            // NAMA_BARANG
            $this->NAMA_BARANG->LinkCustomAttributes = "";
            $this->NAMA_BARANG->HrefValue = "";

            // JUMLAH
            $this->JUMLAH->LinkCustomAttributes = "";
            $this->JUMLAH->HrefValue = "";

            // KONDISI
            $this->KONDISI->LinkCustomAttributes = "";
            $this->KONDISI->HrefValue = "";

            // TANGGAL_PEMBELIAN
            $this->TANGGAL_PEMBELIAN->LinkCustomAttributes = "";
            $this->TANGGAL_PEMBELIAN->HrefValue = "";

            // TANGGAL_BELI_GANTI_BARU
            $this->TANGGAL_BELI_GANTI_BARU->LinkCustomAttributes = "";
            $this->TANGGAL_BELI_GANTI_BARU->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->NAMA_BARANG->Required) {
            if (!$this->NAMA_BARANG->IsDetailKey && EmptyValue($this->NAMA_BARANG->FormValue)) {
                $this->NAMA_BARANG->addErrorMessage(str_replace("%s", $this->NAMA_BARANG->caption(), $this->NAMA_BARANG->RequiredErrorMessage));
            }
        }
        if ($this->JUMLAH->Required) {
            if (!$this->JUMLAH->IsDetailKey && EmptyValue($this->JUMLAH->FormValue)) {
                $this->JUMLAH->addErrorMessage(str_replace("%s", $this->JUMLAH->caption(), $this->JUMLAH->RequiredErrorMessage));
            }
        }
        if ($this->KONDISI->Required) {
            if (!$this->KONDISI->IsDetailKey && EmptyValue($this->KONDISI->FormValue)) {
                $this->KONDISI->addErrorMessage(str_replace("%s", $this->KONDISI->caption(), $this->KONDISI->RequiredErrorMessage));
            }
        }
        if ($this->TANGGAL_PEMBELIAN->Required) {
            if (!$this->TANGGAL_PEMBELIAN->IsDetailKey && EmptyValue($this->TANGGAL_PEMBELIAN->FormValue)) {
                $this->TANGGAL_PEMBELIAN->addErrorMessage(str_replace("%s", $this->TANGGAL_PEMBELIAN->caption(), $this->TANGGAL_PEMBELIAN->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->TANGGAL_PEMBELIAN->FormValue)) {
            $this->TANGGAL_PEMBELIAN->addErrorMessage($this->TANGGAL_PEMBELIAN->getErrorMessage(false));
        }
        if ($this->TANGGAL_BELI_GANTI_BARU->Required) {
            if (!$this->TANGGAL_BELI_GANTI_BARU->IsDetailKey && EmptyValue($this->TANGGAL_BELI_GANTI_BARU->FormValue)) {
                $this->TANGGAL_BELI_GANTI_BARU->addErrorMessage(str_replace("%s", $this->TANGGAL_BELI_GANTI_BARU->caption(), $this->TANGGAL_BELI_GANTI_BARU->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->TANGGAL_BELI_GANTI_BARU->FormValue)) {
            $this->TANGGAL_BELI_GANTI_BARU->addErrorMessage($this->TANGGAL_BELI_GANTI_BARU->getErrorMessage(false));
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssoc($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // NAMA_BARANG
            $this->NAMA_BARANG->setDbValueDef($rsnew, $this->NAMA_BARANG->CurrentValue, "", $this->NAMA_BARANG->ReadOnly);

            // JUMLAH
            $this->JUMLAH->setDbValueDef($rsnew, $this->JUMLAH->CurrentValue, "", $this->JUMLAH->ReadOnly);

            // KONDISI
            $this->KONDISI->setDbValueDef($rsnew, $this->KONDISI->CurrentValue, "", $this->KONDISI->ReadOnly);

            // TANGGAL_PEMBELIAN
            $this->TANGGAL_PEMBELIAN->setDbValueDef($rsnew, UnFormatDateTime($this->TANGGAL_PEMBELIAN->CurrentValue, 7), CurrentDate(), $this->TANGGAL_PEMBELIAN->ReadOnly);

            // TANGGAL_BELI_GANTI_BARU
            $this->TANGGAL_BELI_GANTI_BARU->setDbValueDef($rsnew, UnFormatDateTime($this->TANGGAL_BELI_GANTI_BARU->CurrentValue, 7), CurrentDate(), $this->TANGGAL_BELI_GANTI_BARU->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("baranglist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_KONDISI":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
