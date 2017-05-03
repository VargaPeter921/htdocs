<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateTermeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Termeks", 'termeks', 'cikkid', 'fa-cube', [
            ["cikkid", "CikkAzonosító", "String", false, "", 0, 256, true],
            ["cikkszam", "Cikkszám", "String", false, "", 0, 256, true],
            ["cikkszam2", "Cikkszám 2", "String", false, "", 0, 256, false],
            ["cikknev", "Cikknév", "String", false, "", 0, 256, false],
            ["mennyiseg", "Mennyiség", "String", false, "db", 0, 256, false],
            ["kshszam", "KSHSzám", "String", false, "NULL", 0, 256, false],
            ["gyarto", "Gyártó", "Integer", false, "", 0, 11, false],
            ["cikkcsoportkod", "Cikkcsoport Kód", "String", false, "", 0, 256, false],
            ["cikkcsoportnev", "Cikkcsoport Név", "String", false, "", 0, 256, false],
            ["tipus", "Típus", "String", false, "", 0, 256, false],
            ["beszerzesiallapot", "Beszerzési Állapot", "Integer", false, "", 0, 11, false],
            ["webigendatum", "Web Gen Dátum", "Date", false, "", 0, 0, false],
            ["webmegjel", "Web Megjelenítés", "Integer", false, "1", 0, 11, false],
            ["leiras", "Leírás", "TextField", false, "", 0, 256, false],
            ["tomeg", "Tömeg", "String", false, "NULL", 0, 256, false],
            ["gartipusid", "Garancia Tipus", "Integer", false, "1", 0, 11, false],
            ["garido", "Garancia Idő", "Integer", false, "1", 0, 11, false],
            ["garidotipus", "Garancia Idő Tipus", "String", false, "NULL", 0, 256, false],
            ["garhely", "Garancia Hely", "String", false, "NULL", 0, 256, false],
            ["meret", "Méret", "String", false, "NULL", 0, 256, false],
            ["garhelytipus", "Garancaia Hely Tipus", "String", false, "NULL", 0, 256, false],
            ["arlistapoz", "Árlista Pozíció", "String", false, "NULL", 0, 256, false],
            ["megj", "Megjegyzés", "TextField", false, "", 0, 256, false],
            ["cikkfajta", "Cikk Fajta", "String", false, "", 0, 256, false],
            ["gycikkszam", "Gyártói Cikkszám", "String", false, "", 0, 256, false],
            ["focsoportkod", "Fő Csoport Kód", "String", false, "", 0, 256, false],
            ["focsoportnev", "Fő Csoport Név", "String", false, "", 0, 256, false],
            ["cikkjellnev", "Cikk Jellemző Név", "String", false, "", 0, 256, false],
            ["ertmenny", "Érték Mennyiség", "String", false, "", 0, 256, false],
            ["szigoru_szamadasu", "Szigorú Számadású", "String", false, "", 0, 256, false],
            ["stockvalue", "Raktárkészlet", "Integer", false, "0", 0, 11, false],
            ["source", "Nagyker", "Integer", false, "1", 0, 11, false],
        ]);
		
		/*
		Row Format:
		["field_name_db", "Label", "UI Type", "Unique", "Default_Value", "min_length", "max_length", "Required", "Pop_values"]
        Module::generate("Module_Name", "Table_Name", "view_column_name" "Fields_Array");
        
		Module::generate("Books", 'books', 'name', [
            ["address",     "Address",      "Address",  false, "",          0,  1000,   true],
            ["restricted",  "Restricted",   "Checkbox", false, false,       0,  0,      false],
            ["price",       "Price",        "Currency", false, 0.0,         0,  0,      true],
            ["date_release", "Date of Release", "Date", false, "date('Y-m-d')", 0, 0,   false],
            ["time_started", "Start Time",  "Datetime", false, "date('Y-m-d H:i:s')", 0, 0, false],
            ["weight",      "Weight",       "Decimal",  false, 0.0,         0,  20,     true],
            ["publisher",   "Publisher",    "Dropdown", false, "Marvel",    0,  0,      false, ["Bloomsbury","Marvel","Universal"]],
            ["publisher",   "Publisher",    "Dropdown", false, 3,           0,  0,      false, "@publishers"],
            ["email",       "Email",        "Email",    false, "",          0,  0,      false],
            ["file",        "File",         "File",     false, "",          0,  1,      false],
            ["files",       "Files",        "Files",    false, "",          0,  10,     false],
            ["weight",      "Weight",       "Float",    false, 0.0,         0,  20.00,  true],
            ["biography",   "Biography",    "HTML",     false, "<p>This is description</p>", 0, 0, true],
            ["profile_image", "Profile Image", "Image", false, "img_path.jpg", 0, 250,  false],
            ["pages",       "Pages",        "Integer",  false, 0,           0,  5000,   false],
            ["mobile",      "Mobile",       "Mobile",   false, "+91  8888888888", 0, 20,false],
            ["media_type",  "Media Type",   "Multiselect", false, ["Audiobook"], 0, 0,  false, ["Print","Audiobook","E-book"]],
            ["media_type",  "Media Type",   "Multiselect", false, [2,3],    0,  0,      false, "@media_types"],
            ["name",        "Name",         "Name",     false, "John Doe",  5,  250,    true],
            ["password",    "Password",     "Password", false, "",          6,  250,    true],
            ["status",      "Status",       "Radio",    false, "Published", 0,  0,      false, ["Draft","Published","Unpublished"]],
            ["author",      "Author",       "String",   false, "JRR Tolkien", 0, 250,   true],
            ["genre",       "Genre",        "Taginput", false, ["Fantacy","Adventure"], 0, 0, false],
            ["description", "Description",  "Textarea", false, "",          0,  1000,   false],
            ["short_intro", "Introduction", "TextField",false, "",          5,  250,    true],
            ["website",     "Website",      "URL",      false, "http://dwij.in", 0, 0,  false],
        ]);
		*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('termeks')) {
            Schema::drop('termeks');
        }
    }
}
