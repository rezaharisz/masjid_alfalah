<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for barang
 */
class Barang extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $NAMA_BARANG;
    public $JUMLAH;
    public $KONDISI;
    public $TANGGAL_PEMBELIAN;
    public $TANGGAL_BELI_GANTI_BARU;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'barang';
        $this->TableName = 'barang';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`barang`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // NAMA_BARANG
        $this->NAMA_BARANG = new DbField('barang', 'barang', 'x_NAMA_BARANG', 'NAMA_BARANG', '`NAMA_BARANG`', '`NAMA_BARANG`', 200, 200, -1, false, '`NAMA_BARANG`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_BARANG->IsPrimaryKey = true; // Primary key field
        $this->NAMA_BARANG->Nullable = false; // NOT NULL field
        $this->NAMA_BARANG->Required = true; // Required field
        $this->NAMA_BARANG->Sortable = true; // Allow sort
        $this->Fields['NAMA_BARANG'] = &$this->NAMA_BARANG;

        // JUMLAH
        $this->JUMLAH = new DbField('barang', 'barang', 'x_JUMLAH', 'JUMLAH', '`JUMLAH`', '`JUMLAH`', 200, 100, -1, false, '`JUMLAH`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JUMLAH->Nullable = false; // NOT NULL field
        $this->JUMLAH->Required = true; // Required field
        $this->JUMLAH->Sortable = true; // Allow sort
        $this->Fields['JUMLAH'] = &$this->JUMLAH;

        // KONDISI
        $this->KONDISI = new DbField('barang', 'barang', 'x_KONDISI', 'KONDISI', '`KONDISI`', '`KONDISI`', 200, 10, -1, false, '`KONDISI`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KONDISI->Nullable = false; // NOT NULL field
        $this->KONDISI->Required = true; // Required field
        $this->KONDISI->Sortable = true; // Allow sort
        $this->KONDISI->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KONDISI->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KONDISI->Lookup = new Lookup('KONDISI', 'barang', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->KONDISI->OptionCount = 2;
        $this->Fields['KONDISI'] = &$this->KONDISI;

        // TANGGAL_PEMBELIAN
        $this->TANGGAL_PEMBELIAN = new DbField('barang', 'barang', 'x_TANGGAL_PEMBELIAN', 'TANGGAL_PEMBELIAN', '`TANGGAL_PEMBELIAN`', CastDateFieldForLike("`TANGGAL_PEMBELIAN`", 7, "DB"), 133, 10, 7, false, '`TANGGAL_PEMBELIAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_PEMBELIAN->Nullable = false; // NOT NULL field
        $this->TANGGAL_PEMBELIAN->Required = true; // Required field
        $this->TANGGAL_PEMBELIAN->Sortable = true; // Allow sort
        $this->TANGGAL_PEMBELIAN->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->Fields['TANGGAL_PEMBELIAN'] = &$this->TANGGAL_PEMBELIAN;

        // TANGGAL_BELI_GANTI_BARU
        $this->TANGGAL_BELI_GANTI_BARU = new DbField('barang', 'barang', 'x_TANGGAL_BELI_GANTI_BARU', 'TANGGAL_BELI_GANTI_BARU', '`TANGGAL_BELI_GANTI_BARU`', CastDateFieldForLike("`TANGGAL_BELI_GANTI_BARU`", 7, "DB"), 133, 10, 7, false, '`TANGGAL_BELI_GANTI_BARU`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_BELI_GANTI_BARU->Nullable = false; // NOT NULL field
        $this->TANGGAL_BELI_GANTI_BARU->Required = true; // Required field
        $this->TANGGAL_BELI_GANTI_BARU->Sortable = true; // Allow sort
        $this->TANGGAL_BELI_GANTI_BARU->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->Fields['TANGGAL_BELI_GANTI_BARU'] = &$this->TANGGAL_BELI_GANTI_BARU;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`barang`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sql = $sql->resetQueryPart("orderBy")->getSQL();
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('NAMA_BARANG', $rs)) {
                AddFilter($where, QuotedName('NAMA_BARANG', $this->Dbid) . '=' . QuotedValue($rs['NAMA_BARANG'], $this->NAMA_BARANG->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->NAMA_BARANG->DbValue = $row['NAMA_BARANG'];
        $this->JUMLAH->DbValue = $row['JUMLAH'];
        $this->KONDISI->DbValue = $row['KONDISI'];
        $this->TANGGAL_PEMBELIAN->DbValue = $row['TANGGAL_PEMBELIAN'];
        $this->TANGGAL_BELI_GANTI_BARU->DbValue = $row['TANGGAL_BELI_GANTI_BARU'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`NAMA_BARANG` = '@NAMA_BARANG@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NAMA_BARANG->CurrentValue : $this->NAMA_BARANG->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->NAMA_BARANG->CurrentValue = $keys[0];
            } else {
                $this->NAMA_BARANG->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NAMA_BARANG', $row) ? $row['NAMA_BARANG'] : null;
        } else {
            $val = $this->NAMA_BARANG->OldValue !== null ? $this->NAMA_BARANG->OldValue : $this->NAMA_BARANG->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NAMA_BARANG@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if (ReferUrl() != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login") { // Referer not same page or login page
            $_SESSION[$name] = ReferUrl(); // Save to Session
        }
        if (@$_SESSION[$name] != "") {
            return $_SESSION[$name];
        } else {
            return GetUrl("baranglist");
        }
    }

    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "barangview") {
            return $Language->phrase("View");
        } elseif ($pageName == "barangedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "barangadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "BarangView";
            case Config("API_ADD_ACTION"):
                return "BarangAdd";
            case Config("API_EDIT_ACTION"):
                return "BarangEdit";
            case Config("API_DELETE_ACTION"):
                return "BarangDelete";
            case Config("API_LIST_ACTION"):
                return "BarangList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "baranglist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("barangview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("barangview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "barangadd?" . $this->getUrlParm($parm);
        } else {
            $url = "barangadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("barangedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("barangadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("barangdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NAMA_BARANG:" . JsonEncode($this->NAMA_BARANG->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NAMA_BARANG->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NAMA_BARANG->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("NAMA_BARANG") ?? Route("NAMA_BARANG")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->NAMA_BARANG->CurrentValue = $key;
            } else {
                $this->NAMA_BARANG->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->NAMA_BARANG->setDbValue($row['NAMA_BARANG']);
        $this->JUMLAH->setDbValue($row['JUMLAH']);
        $this->KONDISI->setDbValue($row['KONDISI']);
        $this->TANGGAL_PEMBELIAN->setDbValue($row['TANGGAL_PEMBELIAN']);
        $this->TANGGAL_BELI_GANTI_BARU->setDbValue($row['TANGGAL_BELI_GANTI_BARU']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NAMA_BARANG

        // JUMLAH

        // KONDISI

        // TANGGAL_PEMBELIAN

        // TANGGAL_BELI_GANTI_BARU

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

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // NAMA_BARANG
        $this->NAMA_BARANG->EditAttrs["class"] = "form-control";
        $this->NAMA_BARANG->EditCustomAttributes = "";
        if (!$this->NAMA_BARANG->Raw) {
            $this->NAMA_BARANG->CurrentValue = HtmlDecode($this->NAMA_BARANG->CurrentValue);
        }
        $this->NAMA_BARANG->EditValue = $this->NAMA_BARANG->CurrentValue;
        $this->NAMA_BARANG->PlaceHolder = RemoveHtml($this->NAMA_BARANG->caption());

        // JUMLAH
        $this->JUMLAH->EditAttrs["class"] = "form-control";
        $this->JUMLAH->EditCustomAttributes = "";
        if (!$this->JUMLAH->Raw) {
            $this->JUMLAH->CurrentValue = HtmlDecode($this->JUMLAH->CurrentValue);
        }
        $this->JUMLAH->EditValue = $this->JUMLAH->CurrentValue;
        $this->JUMLAH->PlaceHolder = RemoveHtml($this->JUMLAH->caption());

        // KONDISI
        $this->KONDISI->EditAttrs["class"] = "form-control";
        $this->KONDISI->EditCustomAttributes = "";
        $this->KONDISI->EditValue = $this->KONDISI->options(true);
        $this->KONDISI->PlaceHolder = RemoveHtml($this->KONDISI->caption());

        // TANGGAL_PEMBELIAN
        $this->TANGGAL_PEMBELIAN->EditAttrs["class"] = "form-control";
        $this->TANGGAL_PEMBELIAN->EditCustomAttributes = "";
        $this->TANGGAL_PEMBELIAN->EditValue = FormatDateTime($this->TANGGAL_PEMBELIAN->CurrentValue, 7);
        $this->TANGGAL_PEMBELIAN->PlaceHolder = RemoveHtml($this->TANGGAL_PEMBELIAN->caption());

        // TANGGAL_BELI_GANTI_BARU
        $this->TANGGAL_BELI_GANTI_BARU->EditAttrs["class"] = "form-control";
        $this->TANGGAL_BELI_GANTI_BARU->EditCustomAttributes = "";
        $this->TANGGAL_BELI_GANTI_BARU->EditValue = FormatDateTime($this->TANGGAL_BELI_GANTI_BARU->CurrentValue, 7);
        $this->TANGGAL_BELI_GANTI_BARU->PlaceHolder = RemoveHtml($this->TANGGAL_BELI_GANTI_BARU->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->NAMA_BARANG);
                    $doc->exportCaption($this->JUMLAH);
                    $doc->exportCaption($this->KONDISI);
                    $doc->exportCaption($this->TANGGAL_PEMBELIAN);
                    $doc->exportCaption($this->TANGGAL_BELI_GANTI_BARU);
                } else {
                    $doc->exportCaption($this->NAMA_BARANG);
                    $doc->exportCaption($this->JUMLAH);
                    $doc->exportCaption($this->KONDISI);
                    $doc->exportCaption($this->TANGGAL_PEMBELIAN);
                    $doc->exportCaption($this->TANGGAL_BELI_GANTI_BARU);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->NAMA_BARANG);
                        $doc->exportField($this->JUMLAH);
                        $doc->exportField($this->KONDISI);
                        $doc->exportField($this->TANGGAL_PEMBELIAN);
                        $doc->exportField($this->TANGGAL_BELI_GANTI_BARU);
                    } else {
                        $doc->exportField($this->NAMA_BARANG);
                        $doc->exportField($this->JUMLAH);
                        $doc->exportField($this->KONDISI);
                        $doc->exportField($this->TANGGAL_PEMBELIAN);
                        $doc->exportField($this->TANGGAL_BELI_GANTI_BARU);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
