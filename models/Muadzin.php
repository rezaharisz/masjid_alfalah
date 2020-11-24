<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for muadzin
 */
class Muadzin extends DbTable
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
    public $NAMA_MUADZIN;
    public $NO_TELP;
    public $ALAMAT;
    public $WAKTU_ADZAN;
    public $TANGGAL_ADZAN;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'muadzin';
        $this->TableName = 'muadzin';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`muadzin`";
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

        // NAMA_MUADZIN
        $this->NAMA_MUADZIN = new DbField('muadzin', 'muadzin', 'x_NAMA_MUADZIN', 'NAMA_MUADZIN', '`NAMA_MUADZIN`', '`NAMA_MUADZIN`', 200, 100, -1, false, '`NAMA_MUADZIN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_MUADZIN->IsPrimaryKey = true; // Primary key field
        $this->NAMA_MUADZIN->Nullable = false; // NOT NULL field
        $this->NAMA_MUADZIN->Required = true; // Required field
        $this->NAMA_MUADZIN->Sortable = true; // Allow sort
        $this->Fields['NAMA_MUADZIN'] = &$this->NAMA_MUADZIN;

        // NO_TELP
        $this->NO_TELP = new DbField('muadzin', 'muadzin', 'x_NO_TELP', 'NO_TELP', '`NO_TELP`', '`NO_TELP`', 200, 15, -1, false, '`NO_TELP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_TELP->Nullable = false; // NOT NULL field
        $this->NO_TELP->Required = true; // Required field
        $this->NO_TELP->Sortable = true; // Allow sort
        $this->Fields['NO_TELP'] = &$this->NO_TELP;

        // ALAMAT
        $this->ALAMAT = new DbField('muadzin', 'muadzin', 'x_ALAMAT', 'ALAMAT', '`ALAMAT`', '`ALAMAT`', 201, 65535, -1, false, '`ALAMAT`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ALAMAT->Nullable = false; // NOT NULL field
        $this->ALAMAT->Required = true; // Required field
        $this->ALAMAT->Sortable = true; // Allow sort
        $this->Fields['ALAMAT'] = &$this->ALAMAT;

        // WAKTU_ADZAN
        $this->WAKTU_ADZAN = new DbField('muadzin', 'muadzin', 'x_WAKTU_ADZAN', 'WAKTU_ADZAN', '`WAKTU_ADZAN`', '`WAKTU_ADZAN`', 200, 100, -1, false, '`WAKTU_ADZAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->WAKTU_ADZAN->Nullable = false; // NOT NULL field
        $this->WAKTU_ADZAN->Required = true; // Required field
        $this->WAKTU_ADZAN->Sortable = true; // Allow sort
        $this->WAKTU_ADZAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->WAKTU_ADZAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->WAKTU_ADZAN->Lookup = new Lookup('WAKTU_ADZAN', 'muadzin', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->WAKTU_ADZAN->OptionCount = 5;
        $this->Fields['WAKTU_ADZAN'] = &$this->WAKTU_ADZAN;

        // TANGGAL_ADZAN
        $this->TANGGAL_ADZAN = new DbField('muadzin', 'muadzin', 'x_TANGGAL_ADZAN', 'TANGGAL_ADZAN', '`TANGGAL_ADZAN`', CastDateFieldForLike("`TANGGAL_ADZAN`", 7, "DB"), 133, 10, 7, false, '`TANGGAL_ADZAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_ADZAN->Nullable = false; // NOT NULL field
        $this->TANGGAL_ADZAN->Required = true; // Required field
        $this->TANGGAL_ADZAN->Sortable = true; // Allow sort
        $this->TANGGAL_ADZAN->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->Fields['TANGGAL_ADZAN'] = &$this->TANGGAL_ADZAN;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`muadzin`";
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
            if (array_key_exists('NAMA_MUADZIN', $rs)) {
                AddFilter($where, QuotedName('NAMA_MUADZIN', $this->Dbid) . '=' . QuotedValue($rs['NAMA_MUADZIN'], $this->NAMA_MUADZIN->DataType, $this->Dbid));
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
        $this->NAMA_MUADZIN->DbValue = $row['NAMA_MUADZIN'];
        $this->NO_TELP->DbValue = $row['NO_TELP'];
        $this->ALAMAT->DbValue = $row['ALAMAT'];
        $this->WAKTU_ADZAN->DbValue = $row['WAKTU_ADZAN'];
        $this->TANGGAL_ADZAN->DbValue = $row['TANGGAL_ADZAN'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`NAMA_MUADZIN` = '@NAMA_MUADZIN@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NAMA_MUADZIN->CurrentValue : $this->NAMA_MUADZIN->OldValue;
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
                $this->NAMA_MUADZIN->CurrentValue = $keys[0];
            } else {
                $this->NAMA_MUADZIN->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NAMA_MUADZIN', $row) ? $row['NAMA_MUADZIN'] : null;
        } else {
            $val = $this->NAMA_MUADZIN->OldValue !== null ? $this->NAMA_MUADZIN->OldValue : $this->NAMA_MUADZIN->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NAMA_MUADZIN@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("muadzinlist");
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
        if ($pageName == "muadzinview") {
            return $Language->phrase("View");
        } elseif ($pageName == "muadzinedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "muadzinadd") {
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
                return "MuadzinView";
            case Config("API_ADD_ACTION"):
                return "MuadzinAdd";
            case Config("API_EDIT_ACTION"):
                return "MuadzinEdit";
            case Config("API_DELETE_ACTION"):
                return "MuadzinDelete";
            case Config("API_LIST_ACTION"):
                return "MuadzinList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "muadzinlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("muadzinview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("muadzinview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "muadzinadd?" . $this->getUrlParm($parm);
        } else {
            $url = "muadzinadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("muadzinedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("muadzinadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("muadzindelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NAMA_MUADZIN:" . JsonEncode($this->NAMA_MUADZIN->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NAMA_MUADZIN->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NAMA_MUADZIN->CurrentValue);
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
            if (($keyValue = Param("NAMA_MUADZIN") ?? Route("NAMA_MUADZIN")) !== null) {
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
                $this->NAMA_MUADZIN->CurrentValue = $key;
            } else {
                $this->NAMA_MUADZIN->OldValue = $key;
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
        $this->NAMA_MUADZIN->setDbValue($row['NAMA_MUADZIN']);
        $this->NO_TELP->setDbValue($row['NO_TELP']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->WAKTU_ADZAN->setDbValue($row['WAKTU_ADZAN']);
        $this->TANGGAL_ADZAN->setDbValue($row['TANGGAL_ADZAN']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NAMA_MUADZIN

        // NO_TELP

        // ALAMAT

        // WAKTU_ADZAN

        // TANGGAL_ADZAN

        // NAMA_MUADZIN
        $this->NAMA_MUADZIN->ViewValue = $this->NAMA_MUADZIN->CurrentValue;
        $this->NAMA_MUADZIN->ViewCustomAttributes = "";

        // NO_TELP
        $this->NO_TELP->ViewValue = $this->NO_TELP->CurrentValue;
        $this->NO_TELP->ViewCustomAttributes = "";

        // ALAMAT
        $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->ViewCustomAttributes = "";

        // WAKTU_ADZAN
        if (strval($this->WAKTU_ADZAN->CurrentValue) != "") {
            $this->WAKTU_ADZAN->ViewValue = $this->WAKTU_ADZAN->optionCaption($this->WAKTU_ADZAN->CurrentValue);
        } else {
            $this->WAKTU_ADZAN->ViewValue = null;
        }
        $this->WAKTU_ADZAN->ViewCustomAttributes = "";

        // TANGGAL_ADZAN
        $this->TANGGAL_ADZAN->ViewValue = $this->TANGGAL_ADZAN->CurrentValue;
        $this->TANGGAL_ADZAN->ViewValue = FormatDateTime($this->TANGGAL_ADZAN->ViewValue, 7);
        $this->TANGGAL_ADZAN->ViewCustomAttributes = "";

        // NAMA_MUADZIN
        $this->NAMA_MUADZIN->LinkCustomAttributes = "";
        $this->NAMA_MUADZIN->HrefValue = "";
        $this->NAMA_MUADZIN->TooltipValue = "";

        // NO_TELP
        $this->NO_TELP->LinkCustomAttributes = "";
        $this->NO_TELP->HrefValue = "";
        $this->NO_TELP->TooltipValue = "";

        // ALAMAT
        $this->ALAMAT->LinkCustomAttributes = "";
        $this->ALAMAT->HrefValue = "";
        $this->ALAMAT->TooltipValue = "";

        // WAKTU_ADZAN
        $this->WAKTU_ADZAN->LinkCustomAttributes = "";
        $this->WAKTU_ADZAN->HrefValue = "";
        $this->WAKTU_ADZAN->TooltipValue = "";

        // TANGGAL_ADZAN
        $this->TANGGAL_ADZAN->LinkCustomAttributes = "";
        $this->TANGGAL_ADZAN->HrefValue = "";
        $this->TANGGAL_ADZAN->TooltipValue = "";

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

        // NAMA_MUADZIN
        $this->NAMA_MUADZIN->EditAttrs["class"] = "form-control";
        $this->NAMA_MUADZIN->EditCustomAttributes = "";
        if (!$this->NAMA_MUADZIN->Raw) {
            $this->NAMA_MUADZIN->CurrentValue = HtmlDecode($this->NAMA_MUADZIN->CurrentValue);
        }
        $this->NAMA_MUADZIN->EditValue = $this->NAMA_MUADZIN->CurrentValue;
        $this->NAMA_MUADZIN->PlaceHolder = RemoveHtml($this->NAMA_MUADZIN->caption());

        // NO_TELP
        $this->NO_TELP->EditAttrs["class"] = "form-control";
        $this->NO_TELP->EditCustomAttributes = "";
        if (!$this->NO_TELP->Raw) {
            $this->NO_TELP->CurrentValue = HtmlDecode($this->NO_TELP->CurrentValue);
        }
        $this->NO_TELP->EditValue = $this->NO_TELP->CurrentValue;
        $this->NO_TELP->PlaceHolder = RemoveHtml($this->NO_TELP->caption());

        // ALAMAT
        $this->ALAMAT->EditAttrs["class"] = "form-control";
        $this->ALAMAT->EditCustomAttributes = "";
        $this->ALAMAT->EditValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

        // WAKTU_ADZAN
        $this->WAKTU_ADZAN->EditAttrs["class"] = "form-control";
        $this->WAKTU_ADZAN->EditCustomAttributes = "";
        $this->WAKTU_ADZAN->EditValue = $this->WAKTU_ADZAN->options(true);
        $this->WAKTU_ADZAN->PlaceHolder = RemoveHtml($this->WAKTU_ADZAN->caption());

        // TANGGAL_ADZAN
        $this->TANGGAL_ADZAN->EditAttrs["class"] = "form-control";
        $this->TANGGAL_ADZAN->EditCustomAttributes = "";
        $this->TANGGAL_ADZAN->EditValue = FormatDateTime($this->TANGGAL_ADZAN->CurrentValue, 7);
        $this->TANGGAL_ADZAN->PlaceHolder = RemoveHtml($this->TANGGAL_ADZAN->caption());

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
                    $doc->exportCaption($this->NAMA_MUADZIN);
                    $doc->exportCaption($this->NO_TELP);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->WAKTU_ADZAN);
                    $doc->exportCaption($this->TANGGAL_ADZAN);
                } else {
                    $doc->exportCaption($this->NAMA_MUADZIN);
                    $doc->exportCaption($this->NO_TELP);
                    $doc->exportCaption($this->WAKTU_ADZAN);
                    $doc->exportCaption($this->TANGGAL_ADZAN);
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
                        $doc->exportField($this->NAMA_MUADZIN);
                        $doc->exportField($this->NO_TELP);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->WAKTU_ADZAN);
                        $doc->exportField($this->TANGGAL_ADZAN);
                    } else {
                        $doc->exportField($this->NAMA_MUADZIN);
                        $doc->exportField($this->NO_TELP);
                        $doc->exportField($this->WAKTU_ADZAN);
                        $doc->exportField($this->TANGGAL_ADZAN);
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
