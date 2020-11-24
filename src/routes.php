<?php

namespace PHPMaker2021\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // barang
    $app->any('/baranglist[/{NAMA_BARANG}]', BarangController::class . ':list')->add(PermissionMiddleware::class)->setName('baranglist-barang-list'); // list
    $app->any('/barangadd[/{NAMA_BARANG}]', BarangController::class . ':add')->add(PermissionMiddleware::class)->setName('barangadd-barang-add'); // add
    $app->any('/barangview[/{NAMA_BARANG}]', BarangController::class . ':view')->add(PermissionMiddleware::class)->setName('barangview-barang-view'); // view
    $app->any('/barangedit[/{NAMA_BARANG}]', BarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('barangedit-barang-edit'); // edit
    $app->any('/barangdelete[/{NAMA_BARANG}]', BarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('barangdelete-barang-delete'); // delete
    $app->group(
        '/barang',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NAMA_BARANG}]', BarangController::class . ':list')->add(PermissionMiddleware::class)->setName('barang/list-barang-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NAMA_BARANG}]', BarangController::class . ':add')->add(PermissionMiddleware::class)->setName('barang/add-barang-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NAMA_BARANG}]', BarangController::class . ':view')->add(PermissionMiddleware::class)->setName('barang/view-barang-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NAMA_BARANG}]', BarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('barang/edit-barang-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NAMA_BARANG}]', BarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('barang/delete-barang-delete-2'); // delete
        }
    );

    // khatib
    $app->any('/khatiblist[/{NAMA_KHATIB}]', KhatibController::class . ':list')->add(PermissionMiddleware::class)->setName('khatiblist-khatib-list'); // list
    $app->any('/khatibadd[/{NAMA_KHATIB}]', KhatibController::class . ':add')->add(PermissionMiddleware::class)->setName('khatibadd-khatib-add'); // add
    $app->any('/khatibview[/{NAMA_KHATIB}]', KhatibController::class . ':view')->add(PermissionMiddleware::class)->setName('khatibview-khatib-view'); // view
    $app->any('/khatibedit[/{NAMA_KHATIB}]', KhatibController::class . ':edit')->add(PermissionMiddleware::class)->setName('khatibedit-khatib-edit'); // edit
    $app->any('/khatibdelete[/{NAMA_KHATIB}]', KhatibController::class . ':delete')->add(PermissionMiddleware::class)->setName('khatibdelete-khatib-delete'); // delete
    $app->group(
        '/khatib',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NAMA_KHATIB}]', KhatibController::class . ':list')->add(PermissionMiddleware::class)->setName('khatib/list-khatib-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NAMA_KHATIB}]', KhatibController::class . ':add')->add(PermissionMiddleware::class)->setName('khatib/add-khatib-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NAMA_KHATIB}]', KhatibController::class . ':view')->add(PermissionMiddleware::class)->setName('khatib/view-khatib-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NAMA_KHATIB}]', KhatibController::class . ':edit')->add(PermissionMiddleware::class)->setName('khatib/edit-khatib-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NAMA_KHATIB}]', KhatibController::class . ':delete')->add(PermissionMiddleware::class)->setName('khatib/delete-khatib-delete-2'); // delete
        }
    );

    // kuliah_subuh
    $app->any('/kuliahsubuhlist[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':list')->add(PermissionMiddleware::class)->setName('kuliahsubuhlist-kuliah_subuh-list'); // list
    $app->any('/kuliahsubuhadd[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':add')->add(PermissionMiddleware::class)->setName('kuliahsubuhadd-kuliah_subuh-add'); // add
    $app->any('/kuliahsubuhview[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':view')->add(PermissionMiddleware::class)->setName('kuliahsubuhview-kuliah_subuh-view'); // view
    $app->any('/kuliahsubuhedit[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':edit')->add(PermissionMiddleware::class)->setName('kuliahsubuhedit-kuliah_subuh-edit'); // edit
    $app->any('/kuliahsubuhdelete[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':delete')->add(PermissionMiddleware::class)->setName('kuliahsubuhdelete-kuliah_subuh-delete'); // delete
    $app->group(
        '/kuliah_subuh',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':list')->add(PermissionMiddleware::class)->setName('kuliah_subuh/list-kuliah_subuh-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':add')->add(PermissionMiddleware::class)->setName('kuliah_subuh/add-kuliah_subuh-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':view')->add(PermissionMiddleware::class)->setName('kuliah_subuh/view-kuliah_subuh-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':edit')->add(PermissionMiddleware::class)->setName('kuliah_subuh/edit-kuliah_subuh-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NAMA_PENGISI}]', KuliahSubuhController::class . ':delete')->add(PermissionMiddleware::class)->setName('kuliah_subuh/delete-kuliah_subuh-delete-2'); // delete
        }
    );

    // muadzin
    $app->any('/muadzinlist[/{NAMA_MUADZIN}]', MuadzinController::class . ':list')->add(PermissionMiddleware::class)->setName('muadzinlist-muadzin-list'); // list
    $app->any('/muadzinadd[/{NAMA_MUADZIN}]', MuadzinController::class . ':add')->add(PermissionMiddleware::class)->setName('muadzinadd-muadzin-add'); // add
    $app->any('/muadzinview[/{NAMA_MUADZIN}]', MuadzinController::class . ':view')->add(PermissionMiddleware::class)->setName('muadzinview-muadzin-view'); // view
    $app->any('/muadzinedit[/{NAMA_MUADZIN}]', MuadzinController::class . ':edit')->add(PermissionMiddleware::class)->setName('muadzinedit-muadzin-edit'); // edit
    $app->any('/muadzindelete[/{NAMA_MUADZIN}]', MuadzinController::class . ':delete')->add(PermissionMiddleware::class)->setName('muadzindelete-muadzin-delete'); // delete
    $app->group(
        '/muadzin',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NAMA_MUADZIN}]', MuadzinController::class . ':list')->add(PermissionMiddleware::class)->setName('muadzin/list-muadzin-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NAMA_MUADZIN}]', MuadzinController::class . ':add')->add(PermissionMiddleware::class)->setName('muadzin/add-muadzin-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NAMA_MUADZIN}]', MuadzinController::class . ':view')->add(PermissionMiddleware::class)->setName('muadzin/view-muadzin-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NAMA_MUADZIN}]', MuadzinController::class . ':edit')->add(PermissionMiddleware::class)->setName('muadzin/edit-muadzin-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NAMA_MUADZIN}]', MuadzinController::class . ':delete')->add(PermissionMiddleware::class)->setName('muadzin/delete-muadzin-delete-2'); // delete
        }
    );

    // pengurus_masjid
    $app->any('/pengurusmasjidlist[/{ID_PENGURUS}]', PengurusMasjidController::class . ':list')->add(PermissionMiddleware::class)->setName('pengurusmasjidlist-pengurus_masjid-list'); // list
    $app->any('/pengurusmasjidadd[/{ID_PENGURUS}]', PengurusMasjidController::class . ':add')->add(PermissionMiddleware::class)->setName('pengurusmasjidadd-pengurus_masjid-add'); // add
    $app->any('/pengurusmasjidview[/{ID_PENGURUS}]', PengurusMasjidController::class . ':view')->add(PermissionMiddleware::class)->setName('pengurusmasjidview-pengurus_masjid-view'); // view
    $app->any('/pengurusmasjidedit[/{ID_PENGURUS}]', PengurusMasjidController::class . ':edit')->add(PermissionMiddleware::class)->setName('pengurusmasjidedit-pengurus_masjid-edit'); // edit
    $app->any('/pengurusmasjiddelete[/{ID_PENGURUS}]', PengurusMasjidController::class . ':delete')->add(PermissionMiddleware::class)->setName('pengurusmasjiddelete-pengurus_masjid-delete'); // delete
    $app->group(
        '/pengurus_masjid',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID_PENGURUS}]', PengurusMasjidController::class . ':list')->add(PermissionMiddleware::class)->setName('pengurus_masjid/list-pengurus_masjid-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID_PENGURUS}]', PengurusMasjidController::class . ':add')->add(PermissionMiddleware::class)->setName('pengurus_masjid/add-pengurus_masjid-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID_PENGURUS}]', PengurusMasjidController::class . ':view')->add(PermissionMiddleware::class)->setName('pengurus_masjid/view-pengurus_masjid-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID_PENGURUS}]', PengurusMasjidController::class . ':edit')->add(PermissionMiddleware::class)->setName('pengurus_masjid/edit-pengurus_masjid-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID_PENGURUS}]', PengurusMasjidController::class . ':delete')->add(PermissionMiddleware::class)->setName('pengurus_masjid/delete-pengurus_masjid-delete-2'); // delete
        }
    );

    // perlengkapan_ibadah
    $app->any('/perlengkapanibadahlist[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':list')->add(PermissionMiddleware::class)->setName('perlengkapanibadahlist-perlengkapan_ibadah-list'); // list
    $app->any('/perlengkapanibadahadd[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':add')->add(PermissionMiddleware::class)->setName('perlengkapanibadahadd-perlengkapan_ibadah-add'); // add
    $app->any('/perlengkapanibadahview[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':view')->add(PermissionMiddleware::class)->setName('perlengkapanibadahview-perlengkapan_ibadah-view'); // view
    $app->any('/perlengkapanibadahedit[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':edit')->add(PermissionMiddleware::class)->setName('perlengkapanibadahedit-perlengkapan_ibadah-edit'); // edit
    $app->any('/perlengkapanibadahdelete[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':delete')->add(PermissionMiddleware::class)->setName('perlengkapanibadahdelete-perlengkapan_ibadah-delete'); // delete
    $app->group(
        '/perlengkapan_ibadah',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':list')->add(PermissionMiddleware::class)->setName('perlengkapan_ibadah/list-perlengkapan_ibadah-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':add')->add(PermissionMiddleware::class)->setName('perlengkapan_ibadah/add-perlengkapan_ibadah-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':view')->add(PermissionMiddleware::class)->setName('perlengkapan_ibadah/view-perlengkapan_ibadah-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':edit')->add(PermissionMiddleware::class)->setName('perlengkapan_ibadah/edit-perlengkapan_ibadah-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NAMA_PERLENGKAPAN_IBADAH}]', PerlengkapanIbadahController::class . ':delete')->add(PermissionMiddleware::class)->setName('perlengkapan_ibadah/delete-perlengkapan_ibadah-delete-2'); // delete
        }
    );

    // users
    $app->any('/userslist[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('userslist-users-list'); // list
    $app->any('/usersadd[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('usersadd-users-add'); // add
    $app->any('/usersview[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('usersview-users-view'); // view
    $app->any('/usersedit[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('usersedit-users-edit'); // edit
    $app->any('/usersdelete[/{id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('usersdelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->any('/userlevelpermissionslist[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissionslist-userlevelpermissions-list'); // list
    $app->any('/userlevelpermissionsadd[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissionsadd-userlevelpermissions-add'); // add
    $app->any('/userlevelpermissionsview[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissionsview-userlevelpermissions-view'); // view
    $app->any('/userlevelpermissionsedit[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissionsedit-userlevelpermissions-edit'); // edit
    $app->any('/userlevelpermissionsdelete[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissionsdelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->any('/userlevelslist[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelslist-userlevels-list'); // list
    $app->any('/userlevelsadd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelsadd-userlevels-add'); // add
    $app->any('/userlevelsview[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelsview-userlevels-view'); // view
    $app->any('/userlevelsedit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelsedit-userlevels-edit'); // edit
    $app->any('/userlevelsdelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelsdelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // userpriv
    $app->any('/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->setName('index');
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
