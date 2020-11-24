<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class KuliahSubuhAdd extends KuliahSubuh
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'kuliah subuh';

    // Page object name
    public $PageObjName = "KuliahSubuhAdd";

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

        // Table object (kuliah_subuh)
        if (!isset($GLOBALS["kuliah_subuh"]) || get_class($GLOBALS["kuliah_subuh"]) == PROJECT_NAMESPACE . "kuliah_subuh") {
            $GLOBALS["kuliah_subuh"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'kuliah subuh');
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
                $doc = new $class(Container("kuliah_subuh"));
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
                    if ($pageName == "kuliahsubuhview") {
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
            $key .= @$ar['NAMA_PENGISI'];
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->NAMA_PENGISI->setVisibility();
        $this->NO_TELP->setVisibility();
        $this->ALAMAT->setVisibility();
        $this->TANGGAL->setVisibility();
        $this->MATERI_KULIAH_SUBUH->setVisibility();
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
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("NAMA_PENGISI") ?? Route("NAMA_PENGISI")) !== null) {
                $this->NAMA_PENGISI->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("kuliahsubuhlist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "kuliahsubuhlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "kuliahsubuhview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->NAMA_PENGISI->CurrentValue = null;
        $this->NAMA_PENGISI->OldValue = $this->NAMA_PENGISI->CurrentValue;
        $this->NO_TELP->CurrentValue = null;
        $this->NO_TELP->OldValue = $this->NO_TELP->CurrentValue;
        $this->ALAMAT->CurrentValue = null;
        $this->ALAMAT->OldValue = $this->ALAMAT->CurrentValue;
        $this->TANGGAL->CurrentValue = null;
        $this->TANGGAL->OldValue = $this->TANGGAL->CurrentValue;
        $this->MATERI_KULIAH_SUBUH->CurrentValue = null;
        $this->MATERI_KULIAH_SUBUH->OldValue = $this->MATERI_KULIAH_SUBUH->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'NAMA_PENGISI' first before field var 'x_NAMA_PENGISI'
        $val = $CurrentForm->hasValue("NAMA_PENGISI") ? $CurrentForm->getValue("NAMA_PENGISI") : $CurrentForm->getValue("x_NAMA_PENGISI");
        if (!$this->NAMA_PENGISI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_PENGISI->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_PENGISI->setFormValue($val);
            }
        }

        // Check field name 'NO_TELP' first before field var 'x_NO_TELP'
        $val = $CurrentForm->hasValue("NO_TELP") ? $CurrentForm->getValue("NO_TELP") : $CurrentForm->getValue("x_NO_TELP");
        if (!$this->NO_TELP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_TELP->Visible = false; // Disable update for API request
            } else {
                $this->NO_TELP->setFormValue($val);
            }
        }

        // Check field name 'ALAMAT' first before field var 'x_ALAMAT'
        $val = $CurrentForm->hasValue("ALAMAT") ? $CurrentForm->getValue("ALAMAT") : $CurrentForm->getValue("x_ALAMAT");
        if (!$this->ALAMAT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ALAMAT->Visible = false; // Disable update for API request
            } else {
                $this->ALAMAT->setFormValue($val);
            }
        }

        // Check field name 'TANGGAL' first before field var 'x_TANGGAL'
        $val = $CurrentForm->hasValue("TANGGAL") ? $CurrentForm->getValue("TANGGAL") : $CurrentForm->getValue("x_TANGGAL");
        if (!$this->TANGGAL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TANGGAL->Visible = false; // Disable update for API request
            } else {
                $this->TANGGAL->setFormValue($val);
            }
            $this->TANGGAL->CurrentValue = UnFormatDateTime($this->TANGGAL->CurrentValue, 7);
        }

        // Check field name 'MATERI_KULIAH_SUBUH' first before field var 'x_MATERI_KULIAH_SUBUH'
        $val = $CurrentForm->hasValue("MATERI_KULIAH_SUBUH") ? $CurrentForm->getValue("MATERI_KULIAH_SUBUH") : $CurrentForm->getValue("x_MATERI_KULIAH_SUBUH");
        if (!$this->MATERI_KULIAH_SUBUH->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MATERI_KULIAH_SUBUH->Visible = false; // Disable update for API request
            } else {
                $this->MATERI_KULIAH_SUBUH->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NAMA_PENGISI->CurrentValue = $this->NAMA_PENGISI->FormValue;
        $this->NO_TELP->CurrentValue = $this->NO_TELP->FormValue;
        $this->ALAMAT->CurrentValue = $this->ALAMAT->FormValue;
        $this->TANGGAL->CurrentValue = $this->TANGGAL->FormValue;
        $this->TANGGAL->CurrentValue = UnFormatDateTime($this->TANGGAL->CurrentValue, 7);
        $this->MATERI_KULIAH_SUBUH->CurrentValue = $this->MATERI_KULIAH_SUBUH->FormValue;
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
        $this->NAMA_PENGISI->setDbValue($row['NAMA_PENGISI']);
        $this->NO_TELP->setDbValue($row['NO_TELP']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->TANGGAL->setDbValue($row['TANGGAL']);
        $this->MATERI_KULIAH_SUBUH->setDbValue($row['MATERI_KULIAH_SUBUH']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NAMA_PENGISI'] = $this->NAMA_PENGISI->CurrentValue;
        $row['NO_TELP'] = $this->NO_TELP->CurrentValue;
        $row['ALAMAT'] = $this->ALAMAT->CurrentValue;
        $row['TANGGAL'] = $this->TANGGAL->CurrentValue;
        $row['MATERI_KULIAH_SUBUH'] = $this->MATERI_KULIAH_SUBUH->CurrentValue;
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

        // NAMA_PENGISI

        // NO_TELP

        // ALAMAT

        // TANGGAL

        // MATERI_KULIAH_SUBUH
        if ($this->RowType == ROWTYPE_VIEW) {
            // NAMA_PENGISI
            $this->NAMA_PENGISI->ViewValue = $this->NAMA_PENGISI->CurrentValue;
            $this->NAMA_PENGISI->ViewCustomAttributes = "";

            // NO_TELP
            $this->NO_TELP->ViewValue = $this->NO_TELP->CurrentValue;
            $this->NO_TELP->ViewCustomAttributes = "";

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

            // TANGGAL
            $this->TANGGAL->ViewValue = $this->TANGGAL->CurrentValue;
            $this->TANGGAL->ViewValue = FormatDateTime($this->TANGGAL->ViewValue, 7);
            $this->TANGGAL->ViewCustomAttributes = "";

            // MATERI_KULIAH_SUBUH
            $this->MATERI_KULIAH_SUBUH->ViewValue = $this->MATERI_KULIAH_SUBUH->CurrentValue;
            $this->MATERI_KULIAH_SUBUH->ViewCustomAttributes = "";

            // NAMA_PENGISI
            $this->NAMA_PENGISI->LinkCustomAttributes = "";
            $this->NAMA_PENGISI->HrefValue = "";
            $this->NAMA_PENGISI->TooltipValue = "";

            // NO_TELP
            $this->NO_TELP->LinkCustomAttributes = "";
            $this->NO_TELP->HrefValue = "";
            $this->NO_TELP->TooltipValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // TANGGAL
            $this->TANGGAL->LinkCustomAttributes = "";
            $this->TANGGAL->HrefValue = "";
            $this->TANGGAL->TooltipValue = "";

            // MATERI_KULIAH_SUBUH
            $this->MATERI_KULIAH_SUBUH->LinkCustomAttributes = "";
            $this->MATERI_KULIAH_SUBUH->HrefValue = "";
            $this->MATERI_KULIAH_SUBUH->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NAMA_PENGISI
            $this->NAMA_PENGISI->EditAttrs["class"] = "form-control";
            $this->NAMA_PENGISI->EditCustomAttributes = "";
            if (!$this->NAMA_PENGISI->Raw) {
                $this->NAMA_PENGISI->CurrentValue = HtmlDecode($this->NAMA_PENGISI->CurrentValue);
            }
            $this->NAMA_PENGISI->EditValue = HtmlEncode($this->NAMA_PENGISI->CurrentValue);
            $this->NAMA_PENGISI->PlaceHolder = RemoveHtml($this->NAMA_PENGISI->caption());

            // NO_TELP
            $this->NO_TELP->EditAttrs["class"] = "form-control";
            $this->NO_TELP->EditCustomAttributes = "";
            if (!$this->NO_TELP->Raw) {
                $this->NO_TELP->CurrentValue = HtmlDecode($this->NO_TELP->CurrentValue);
            }
            $this->NO_TELP->EditValue = HtmlEncode($this->NO_TELP->CurrentValue);
            $this->NO_TELP->PlaceHolder = RemoveHtml($this->NO_TELP->caption());

            // ALAMAT
            $this->ALAMAT->EditAttrs["class"] = "form-control";
            $this->ALAMAT->EditCustomAttributes = "";
            $this->ALAMAT->EditValue = HtmlEncode($this->ALAMAT->CurrentValue);
            $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

            // TANGGAL
            $this->TANGGAL->EditAttrs["class"] = "form-control";
            $this->TANGGAL->EditCustomAttributes = "";
            $this->TANGGAL->EditValue = HtmlEncode(FormatDateTime($this->TANGGAL->CurrentValue, 7));
            $this->TANGGAL->PlaceHolder = RemoveHtml($this->TANGGAL->caption());

            // MATERI_KULIAH_SUBUH
            $this->MATERI_KULIAH_SUBUH->EditAttrs["class"] = "form-control";
            $this->MATERI_KULIAH_SUBUH->EditCustomAttributes = "";
            $this->MATERI_KULIAH_SUBUH->EditValue = HtmlEncode($this->MATERI_KULIAH_SUBUH->CurrentValue);
            $this->MATERI_KULIAH_SUBUH->PlaceHolder = RemoveHtml($this->MATERI_KULIAH_SUBUH->caption());

            // Add refer script

            // NAMA_PENGISI
            $this->NAMA_PENGISI->LinkCustomAttributes = "";
            $this->NAMA_PENGISI->HrefValue = "";

            // NO_TELP
            $this->NO_TELP->LinkCustomAttributes = "";
            $this->NO_TELP->HrefValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";

            // TANGGAL
            $this->TANGGAL->LinkCustomAttributes = "";
            $this->TANGGAL->HrefValue = "";

            // MATERI_KULIAH_SUBUH
            $this->MATERI_KULIAH_SUBUH->LinkCustomAttributes = "";
            $this->MATERI_KULIAH_SUBUH->HrefValue = "";
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
        if ($this->NAMA_PENGISI->Required) {
            if (!$this->NAMA_PENGISI->IsDetailKey && EmptyValue($this->NAMA_PENGISI->FormValue)) {
                $this->NAMA_PENGISI->addErrorMessage(str_replace("%s", $this->NAMA_PENGISI->caption(), $this->NAMA_PENGISI->RequiredErrorMessage));
            }
        }
        if ($this->NO_TELP->Required) {
            if (!$this->NO_TELP->IsDetailKey && EmptyValue($this->NO_TELP->FormValue)) {
                $this->NO_TELP->addErrorMessage(str_replace("%s", $this->NO_TELP->caption(), $this->NO_TELP->RequiredErrorMessage));
            }
        }
        if ($this->ALAMAT->Required) {
            if (!$this->ALAMAT->IsDetailKey && EmptyValue($this->ALAMAT->FormValue)) {
                $this->ALAMAT->addErrorMessage(str_replace("%s", $this->ALAMAT->caption(), $this->ALAMAT->RequiredErrorMessage));
            }
        }
        if ($this->TANGGAL->Required) {
            if (!$this->TANGGAL->IsDetailKey && EmptyValue($this->TANGGAL->FormValue)) {
                $this->TANGGAL->addErrorMessage(str_replace("%s", $this->TANGGAL->caption(), $this->TANGGAL->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->TANGGAL->FormValue)) {
            $this->TANGGAL->addErrorMessage($this->TANGGAL->getErrorMessage(false));
        }
        if ($this->MATERI_KULIAH_SUBUH->Required) {
            if (!$this->MATERI_KULIAH_SUBUH->IsDetailKey && EmptyValue($this->MATERI_KULIAH_SUBUH->FormValue)) {
                $this->MATERI_KULIAH_SUBUH->addErrorMessage(str_replace("%s", $this->MATERI_KULIAH_SUBUH->caption(), $this->MATERI_KULIAH_SUBUH->RequiredErrorMessage));
            }
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // NAMA_PENGISI
        $this->NAMA_PENGISI->setDbValueDef($rsnew, $this->NAMA_PENGISI->CurrentValue, "", false);

        // NO_TELP
        $this->NO_TELP->setDbValueDef($rsnew, $this->NO_TELP->CurrentValue, "", false);

        // ALAMAT
        $this->ALAMAT->setDbValueDef($rsnew, $this->ALAMAT->CurrentValue, "", false);

        // TANGGAL
        $this->TANGGAL->setDbValueDef($rsnew, UnFormatDateTime($this->TANGGAL->CurrentValue, 7), CurrentDate(), false);

        // MATERI_KULIAH_SUBUH
        $this->MATERI_KULIAH_SUBUH->setDbValueDef($rsnew, $this->MATERI_KULIAH_SUBUH->CurrentValue, "", false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['NAMA_PENGISI']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("kuliahsubuhlist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
