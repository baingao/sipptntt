<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_table
 *
 * @author billrp
 * harus pake css bootstrap -> getbootstrap.com
 */
class Table {

    private $nama;
    private $label;
    private $placeholder;
    private $sql;
    private $select_sql;
    private $insert_sql;
    private $update_sql;
    private $delete_sql;
    private $key_field;
    private $baris = array();
    private $kolom = array();
    private $field = array();
    private $tipe_data = array();
    private $kecuali = array();
    private $custom_select_field_key_value_pair;
    private $ajax_onchange_function_callback;
    private $ajax_div;

    function __construct() {
        
    }

    function __destruct() {
        
    }

    function setNama($input_nama) {
        $this->nama = $input_nama;
    }

    function getNama() {
        return $this->nama;
    }

    function setKeyField($input_key_field_from_comment) {
        $this->key_field = $input_key_field_from_comment;
    }

    function getKeyField() {
        return $this->key_field;
    }

    function setLabel($input_label) {
        $this->label = $input_label;
    }

    function setLabelFromComment($input_nama_kolom, $input_label_from_comment) {
        $label_value = getStringBetween($input_label_from_comment, "<LABEL>", "</LABEL>");
        if (strlen($label_value) > 0) {
            $this->label = $label_value;
        } else {
            $this->label = $input_nama_kolom;
        }
    }

    function getLabel() {
        return $this->label;
    }

    function setPlaceholder($input_placeholder) {
        $this->placeholder = $input_placeholder;
    }

    function setPlaceholderFromComment($input_placeholder_from_comment) {
        // format <HINT> </HINT>
        $placeholder_value = getStringBetween($input_placeholder_from_comment, "<HINT>", "</HINT>");
        if (strlen($placeholder_value) > 0) {
            $this->placeholder = $placeholder_value;
        } else
            $this->placeholder = "";
    }

    function getPlaceholder() {
        return $this->placeholder;
    }

    function clearSql() {
        $this->sql = null;
    }

    function setSql($input_sql) {
        $this->sql = $input_sql;
    }

    function getSql() {
        return $this->sql;
    }

    function setSelectSql($input_select_sql) {
        $this->select_sql = $input_select_sql;
    }

    function createSelectSql($key_field) {
        $param = implode(", ", $this->getField());
        $sql = "SELECT " . $param;
        $sql .= " FROM " . $this->getNama();
        $sql .= " WHERE " . $key_field . " = ?";
        $this->setSelectSql($sql);
    }

    function getSelectSql() {
        return $this->select_sql;
    }

    function setInsertSql($input_insert_sql) {
        $this->insert_sql = $input_insert_sql;
    }

    function executeInsertSql($array_input_values) {
        $db = new DbConnect();
        $stmt = $db->connect()->prepare($this->createInsertSql());
        $stmt->execute($array_input_values);
    }

    function createInsertSql() {
//        $result = array();
//        foreach ($this->getField() as $array_field) {
//            $result[$array_field] = ":" . $array_field; 
//        }
//        $this->setField($result);

        $sql = "INSERT INTO " . $this->getNama() . " (";
        $param = implode(", ", $this->getField());
        $sql .= $param . ") VALUES (:";
        $value = implode(", :", $this->getField());
        $sql .= $value . ")";
        $this->setInsertSql($sql);
    }

    function getInsertSql() {
        return $this->insert_sql;
    }

    function setUpdateSql($input_update_sql) {
        $this->update_sql = $input_update_sql;
    }

    function createUpdateSql() {

        $key_value = array();
        foreach ($this->getField() as $array_field) {
            if ($array_field != $this->getKeyField()) {
                array_push($key_value, $array_field . "=:" . $array_field);
            }
        }

        $sql = "UPDATE " . $this->getNama() . " SET ";
        $key_value_string = implode(", ", $key_value);
        $sql .= $key_value_string . " WHERE ";
        $sql .= $this->getKeyField() . "=:" . $this->getKeyField();
        $this->setUpdateSql($sql);
    }

    function getUpdateSql() {
        return $this->update_sql;
    }

    function setDeleteSql($input_delete_sql) {
        $this->delete_sql = $input_delete_sql;
    }

    function createDeleteSql() {
        $sql = "DELETE FROM " . $this->getNama();
        $sql .= " WHERE " . $this->getKeyField() . "=:" . $this->getKeyField();
        $this->setDeleteSql($sql);
    }

    function getDeleteSql() {
        return $this->delete_sql;
    }

    function clearBaris() {
        $this->baris = null;
    }

    function setBaris($input_baris) {
        $this->baris = $input_baris;
    }

    function getBaris() {
        return $this->baris;
    }

    function clearField() {
        $this->field = null;
    }

    function setField($input_field_name) {
        $this->field = $input_field_name;
    }

    function getField() {
        return $this->field;
    }

    function setKolom($input_kolom, $input_value) {
        $this->kolom[$input_kolom] = $input_value;
    }

    function getKolom($input_kolom) {
        return $this->kolom[$input_kolom];
    }

    function setTipeData($input_tipe_data) {
        $this->tipe_data = $input_tipe_data;
    }

    function getTipeData() {
        return $this->tipe_data;
    }

    function setKecuali($input_kecuali) {
        $this->kecuali = $input_kecuali;
    }

    function getKecuali() {
        return $this->kecuali;
    }

    function setCustomSelectFieldKeyValuePair($input_key_value_array_map) {
        $this->custom_select_field_key_value_pair = $input_key_value_array_map;
    }

    function setCustomSelectFieldKeyValuePairFromComment($option_from_comment) {
        // set div id untuk diupdate oleh javascript, ambil nilainya dari comment <DIV></DIV>
        $this->setAjaxDiv(getStringBetween($option_from_comment, "<DIV>", "</DIV>"));
        // key tag <KEY> </KEY> => value tag <VALUE> </VALUE>
        $option_key = explode(",", getStringBetween($option_from_comment, "<KEY>", "</KEY>"));
        $option_value = explode(",", getStringBetween($option_from_comment, "<VALUE>", "</VALUE>"));
        if (count($option_key) == count($option_value)) {
            for ($i = 0; $i < count($option_key); $i++) {
                $keyValuePair[$option_key[$i]] = $option_value[$i];
            }
        } else {
            $keyValuePair = array("(key => value) tidak sama banyak" => "!0");
        }
        $this->custom_select_field_key_value_pair = $keyValuePair;
    }

    function setCustomSelectFieldKeyValuePairFromSql($option_from_comment) {
        $this->clearSql();
        $this->clearBaris();
        // set div id untuk diupdate oleh javascript, ambil nilainya dari comment <DIV></DIV>
        $this->setAjaxDiv(getStringBetween($option_from_comment, "<DIV>", "</DIV>"));
        $reference_table = getStringBetween($option_from_comment, "<TABLE>", "</TABLE>");
        $ref_key_field = getStringBetween($option_from_comment, "<KEY>", "</KEY>");
        $ref_value_field = getStringBetween($option_from_comment, "<VALUE>", "</VALUE>");
        $this->setSql("SELECT " . $ref_key_field . " AS key_field," . $ref_value_field . " AS value_field FROM " . $reference_table . " ORDER BY " . $ref_key_field);
        $this->getQueryResult();
        foreach ($this->getBaris() as $row) {
            $keyValuePair[$row["key_field"]] = $row["value_field"];
        }
        $this->custom_select_field_key_value_pair = $keyValuePair;
    }

    function setCustomSelectFieldKeyValuePairFromSqlForAjax($option_from_comment) {
        $this->clearSql();
        $this->clearBaris();
        // set function call ajax, ambil dari comment <AJAX></AJAX>
        $this->setAjaxOnchangeFunctionCallback(getStringBetween($option_from_comment, "<AJAX>", "</AJAX>"));
        $reference_table = getStringBetween($option_from_comment, "<TABLE>", "</TABLE>");
        $ref_key_field = getStringBetween($option_from_comment, "<KEY>", "</KEY>");
        $ref_value_field = getStringBetween($option_from_comment, "<VALUE>", "</VALUE>");
        $this->setSql("SELECT " . $ref_key_field . " AS key_field," . $ref_value_field . " AS value_field FROM " . $reference_table . " ORDER BY " . $ref_key_field);
        $this->getQueryResult();
        foreach ($this->getBaris() as $row) {
            $keyValuePair[$row["key_field"]] = $row["value_field"];
        }
        $this->custom_select_field_key_value_pair = $keyValuePair;
    }

    function getCustomSelectFieldKeyValuePair() {
        return $this->custom_select_field_key_value_pair;
    }

    function setAjaxOnchangeFunctionCallback($input_ajax_onchange_function_callback) {
        $this->ajax_onchange_function_callback = $input_ajax_onchange_function_callback;
    }

    function getAjaxOnchangeFunctionCallback() {
        return $this->ajax_onchange_function_callback;
    }

    function setAjaxDiv($input_ajax_div) {
        $this->ajax_div = $input_ajax_div;
    }

    function getAjaxDiv() {
        return $this->ajax_div;
    }

    function createCustomSelectField($input_field_name) {
        $select = new InputSelect;
        $select->setKeyValuePairArrayMap($this->getCustomSelectFieldKeyValuePair());
        $select->createKeyValueSelection($input_field_name, $this->getAjaxDiv());
    }

    function createCustomSelectFieldWithValue($input_field_name, $value) {
        $select = new InputSelect;
        $select->setKeyValuePairArrayMap($this->getCustomSelectFieldKeyValuePair());
        $select->createKeyValueSelectionWithValue($input_field_name, $this->getAjaxDiv(), $value);
    }

    function createCustomSelectFieldForAjax($input_field_name) {
        $select = new InputSelect;
        $select->setKeyValuePairArrayMap($this->getCustomSelectFieldKeyValuePair());
        $select->createKeyValueSelectionForAjax($input_field_name, $this->getAjaxOnchangeFunctionCallback());
    }

    function createCustomSelectFieldForAjaxWithValue($input_field_name, $value) {
        $select = new InputSelect;
        $select->setKeyValuePairArrayMap($this->getCustomSelectFieldKeyValuePair());
        $select->createKeyValueSelectionForAjaxWithValue($input_field_name, $this->getAjaxOnchangeFunctionCallback(), $value);
    }

    function getQueryResult() {
        $db = new DbConnect();
        $result = $db->connect()->query($this->sql);
        $this->clearBaris();
        $this->baris = $result->fetchAll(PDO::FETCH_ASSOC);
        return $this->baris;
    }

    function buildTable($input_nama, $echo_insert_form = FALSE) {
        $this->setNama($input_nama);
        $this->clearField();
        $this->clearSql();
        $this->setSql("SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \"" . DB_NAME . "\" AND TABLE_NAME = \"" . $input_nama . "\"");
        $this->getQueryResult();
        $this->loopBaris($echo_insert_form);
        $this->createSelectSql($this->getKeyField());
        $this->createInsertSql();
        $this->createUpdateSql();
        $this->createDeleteSql();
    }

    function buildTableWithValue($input_nama, $value, $echo_insert_form = FALSE) {
        $this->setNama($input_nama);
        $this->clearField();
        $this->clearSql();
        $this->setSql("SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \"" . DB_NAME . "\" AND TABLE_NAME = \"" . $input_nama . "\"");
        $this->getQueryResult();
        $this->loopBarisWithValue($echo_insert_form, $value);
        $this->createSelectSql($this->getKeyField());
        $this->createInsertSql();
        $this->createUpdateSql();
        $this->createDeleteSql();
    }

    function loopBaris($is_echo_insert_form) {
        $array_field = array();
        foreach ($this->getBaris() as $row) {
            // set key field
            if (isInString($row["COLUMN_COMMENT"], "<KEYFIELD>")) {
                $this->setKeyField($row["COLUMN_NAME"]);
            }
            // echo INSERT FORM
            if (!in_array($row["COLUMN_NAME"], $this->getKecuali())) {
                array_push($array_field, $row["COLUMN_NAME"]); //  ambil nama field, masukkan dalam $array_field
                if ($is_echo_insert_form) {
                    $this->echoInsertForm($row["COLUMN_NAME"], $row["COLUMN_TYPE"], $row["COLUMN_COMMENT"]);
                }
            }
        }
        $this->setField($array_field); // Masukkan nama field 
    }

    function loopBarisWithValue($is_echo_insert_form, $value) {
        $array_field = array();
        foreach ($this->getBaris() as $row) {
            // set key field
            if (isInString($row["COLUMN_COMMENT"], "<KEYFIELD>")) {
                $this->setKeyField($row["COLUMN_NAME"]);
            }
            // echo INSERT FORM
            if (!in_array($row["COLUMN_NAME"], $this->getKecuali())) {
                array_push($array_field, $row["COLUMN_NAME"]); //  ambil nama field, masukkan dalam $array_field
                if ($is_echo_insert_form) {
                    $this->echoInsertFormWithValue($row["COLUMN_NAME"], $row["COLUMN_TYPE"], $row["COLUMN_COMMENT"], $value);
                }
            }
        }
        $this->setField($array_field); // Masukkan nama field 
    }

    function echoInsertForm($column_name, $column_type, $column_comment) {
        $this->setLabelFromComment($column_name, $column_comment);
        $this->setPlaceholderFromComment($column_comment);
        if (isInString($column_comment, "<SELECT>")) {
            echo "<div class=\"form-group\">";
            echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
            if (isInString($column_comment, "<SQL>")) {  // key value pair dari <TABLE> </TABLE> di comment
                if (isInString($column_comment, "<AJAX>")) {
                    $this->setCustomSelectFieldKeyValuePairFromSqlForAjax($column_comment);
                    $this->createCustomSelectFieldForAjax($column_name);
                } else {
                    $this->setCustomSelectFieldKeyValuePairFromSql($column_comment);
                    $this->createCustomSelectField($column_name);
                }
            } else { // key value pair dari nilai <KEY> </KEY> dan <VALUE> </VALUE> di comment
                $this->setCustomSelectFieldKeyValuePairFromComment($column_comment);
                $this->createCustomSelectField($column_name);
            }
            echo "</div>";
        } else {
            if ($column_type == "date") {
                echo "<div class=\"form-group form-inline\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                $select = new InputSelect();
                $select->createDateMonthYearSelection($column_name, TAHUN_MULAI, TAHUN_SELESAI);
                echo "</div>";
            } else if (substr($column_type, 0, 3) == "int") {
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                echo "<input id=\"" . $column_name . "\" class=\"form-control\" type=\"number\" name=\"input_" . $column_name . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                echo "</div>";
            } else if ($column_type == "text") { // tambahan untuk input type textarea
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                echo "<textarea rows=\"4\" id=\"" . $column_name . "\" class=\"form-control\" name=\"input_" . $column_name . "\"></textarea>";
                echo "</div>";
            } else {
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                echo "<input id=\"" . $column_name . "\" class=\"form-control\" type=\"text\" name=\"input_" . $column_name . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                echo "</div>";
            }
        }
    }

    function echoInsertFormWithValue($column_name, $column_type, $column_comment, $value) {
        $this->setLabelFromComment($column_name, $column_comment);
        $this->setPlaceholderFromComment($column_comment);
        if (isInString($column_comment, "<SELECT>")) {
            echo "<div class=\"form-group\">";
            echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
            if (isInString($column_comment, "<SQL>")) {  // key value pair dari <TABLE> </TABLE> di comment
                if (isInString($column_comment, "<AJAX>")) {
                    $this->setCustomSelectFieldKeyValuePairFromSqlForAjax($column_comment);
                    $this->createCustomSelectFieldForAjaxWithValue($column_name, $value[$column_name]);
                } else {
                    $this->setCustomSelectFieldKeyValuePairFromSql($column_comment);
                    $this->createCustomSelectFieldWithValue($column_name, $value[$column_name]);
                }
            } else { // key value pair dari nilai <KEY> </KEY> dan <VALUE> </VALUE> di comment
                $this->setCustomSelectFieldKeyValuePairFromComment($column_comment);
                $this->createCustomSelectFieldWithValue($column_name, $value[$column_name]);
            }
            echo "</div>";
        } else {
            if ($column_type == "date") {
                echo "<div class=\"form-group form-inline\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                $select = new InputSelect();
                $select->createDateMonthYearSelectionWithValue($column_name, TAHUN_MULAI, TAHUN_SELESAI, $value[$column_name]);
                echo "</div>";
            } else if (substr($column_type, 0, 3) == "int") {
                if ($column_name == $this->getKeyField()) {
                    echo "<input value=\"" . $value[$column_name] . "\" id=\"" . $column_name . "\" class=\"form-control\" type=\"hidden\" name=\"input_" . $column_name . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                } else {
                    echo "<div class=\"form-group\">";
                    echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                    echo "<input value=\"" . $value[$column_name] . "\" id=\"" . $column_name . "\" class=\"form-control\" type=\"number\" name=\"input_" . $column_name . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                    echo "</div>";
                }
            } else if ($column_type == "text") { // tambahan untuk input type textarea
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                echo "<textarea rows=\"4\" id=\"text_" . $column_name . "\" class=\"form-control\" name=\"input_" . $column_name . "\">" . $value[$column_name] . "</textarea>";
                echo "</div>";
            } else {
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                echo "<input value=\"" . $value[$column_name] . "\" id=\"" . $column_name . "\" class=\"form-control\" type=\"text\" name=\"input_" . $column_name . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                echo "</div>";
            }
        }
    }

    public static function tableFromSql($sql, $table_name, $limit, $keyfield, $totalfields, $select = false, $terbit = false, $edit = false, $delete = false) {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $max_limit = 1000;
        $perpage = 10;
        $start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

        $db = new DbConnect();

        $stmt = $db->connect()->query("SELECT IF(COUNT(AI)<{$max_limit}, COUNT(AI), {$max_limit}) AS total FROM {$table_name} WHERE Tag>=0");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['total']; //total num of rows
        $pages = ceil($total / $perpage);
        $next = $page - 1;
        $prev = $page + 1;

        echo "<div class=\"pagination\">";
        echo "<a href=\"?page=1\"><< </a>";
        echo "<a href=\"?page={$next}\">| < </a>";
        if ($pages >= 15) {
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 1) {
                    echo "<a href=\"?page={$i}\">| {$i} |</a>";
                } else {
                    echo "<a href=\"?page={$i}\"> {$i} |</a>";
                }
            }
            echo "  . . .  ";
            for ($i = $pages - 4; $i <= $pages; $i++) {
                if ($i == 1) {
                    echo "<a href=\"?page={$i}\">| {$i} |</a>";
                } else {
                    echo "<a href=\"?page={$i}\"> {$i} |</a>";
                }
            }
        } else {
            for ($i = 1; $i <= $pages; $i++) {
                if ($i == 1) {
                    echo "<a href=\"?page={$i}\">| {$i} |</a>";
                } else {
                    echo "<a href=\"?page={$i}\"> {$i} |</a>";
                }
            }
        }
        echo "<a href=\"?page={$prev}\"> > |</a>";
        echo "<a href=\"?page={$pages}\"> >></a>";
        echo "</div>";

        echo "<div class=\"table-responsive\">";
        echo "<form method=\"post\">";

        // LAMA
        echo "<table class=\"table table-hover\">";
        echo "<tr>";

        $dataset = $db->connect()->query($sql . " LIMIT {$start}, {$perpage}");
        $result_array = $dataset->fetchAll(PDO::FETCH_ASSOC);
        $headerset = array_keys($result_array[0]);

        $keys = array();
        $total = array();
        if ($select == true) {
            echo "<th>Pilih</th>"; // dummy for selection
            // echo "<th> <input type=\"checkbox\" value=\"all\"> </input> </th>"; 
        }
        foreach ($headerset as $key) {
            echo "<th>" . $key . "</th>";
            $keys[] = $key;
            $total[$key] = 0; // initialize $total array
        }
        if ($terbit == true) {
            echo "<th> &nbsp </th>"; // dummy for delete button
        }
        if ($edit == true) {
            echo "<th> &nbsp </th>"; // dummy for edit button
        }
        if ($delete == true) {
            echo "<th> &nbsp </th>"; // dummy for delete button
        }
        echo "</tr>";

        //$dataset = $db->connect()->query($sql . " LIMIT {$limit}");
        foreach ($result_array as $row) {
            echo "<tr>";
            if ($select == true) {
                echo "<td> <input type=\"radio\" id=\"button_pilih\" name=\"button_pilih\" value=\"$row[$keyfield]\"> </input> </td>"; // select checkbox
            }
            foreach ($keys as $key) {
                echo "<td>" . $row[$key] . "</td>";
                foreach ($totalfields as $totalfield) {
                    if ($key == $totalfield) {
                        $total[$key] = $total[$key] + $row[$key]; // have to initialize $total array first
                    }
                }
            }
            if ($terbit == true) {
                echo "<td> <button class=\"btn btn-success\" type=\"submit\" id=\"button_terbit\" name=\"button_terbit\" value=\"$row[$keyfield]\" onclick=\"dataTerbit(this.value)\"><i class=\"glyphicon glyphicon-saved\"></i></button> </td>"; // edit button
            }
            if ($edit == true) {
                echo "<td> <button class=\"btn btn-warning\" type=\"submit\" id=\"button_edit\" name=\"button_edit\" value=\"$row[$keyfield]\"><i class=\"glyphicon glyphicon-pencil\"></i></button> </td>"; // edit button
            }
            if ($delete == true) {
                echo "<td> <button class=\"btn btn-danger\" type=\"submit\" id=\"button_hapus\" name=\"button_delete\" value=\"$row[$keyfield]\"><i class=\"glyphicon glyphicon-trash\"></i></button> </td>"; // delete button
            }
            echo "</tr>";
        }

//        echo "<tfoot><tr>";
//        if ($select == true) {
//            echo "<td> &nbsp </td>"; // dummy for select checkbox
//        }
//        if ($edit == true) {
//            echo "<td> &nbsp </td>"; // dummy for edit button
//        }
//        foreach ($total as $value) {
//            echo "<td>";
//            if (((int) $value) or ( (float) $value)) {
//                echo $value;
//            }
//            echo "</td>";
//        }
//        echo "</tr></tfoot>";
        echo "</table>";
        echo "</form>";
        echo "</div>";
    }

}
