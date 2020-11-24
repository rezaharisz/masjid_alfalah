<?php

namespace PHPMaker2021\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_barang", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "baranglist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang'), false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_khatib", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "khatiblist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib'), false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_kuliah_subuh", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "kuliahsubuhlist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh'), false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_muadzin", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "muadzinlist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_pengurus_masjid", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "pengurusmasjidlist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid'), false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_perlengkapan_ibadah", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "perlengkapanibadahlist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah'), false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_users", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "userslist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users'), false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "userlevelpermissionslist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions'), false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_userlevels", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "userlevelslist", -1, "", AllowListMenu('{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels'), false, false, "", "", false);
echo $sideMenu->toScript();
