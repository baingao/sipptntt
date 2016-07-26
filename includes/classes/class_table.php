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

    function setInsertSql($input_insert_sql) {
        $this->insert_sql = $input_insert_sql;
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
//        $key_value = array();
//        foreach ($this->getField() as $array_field) {
//            $key_value[$array_field] = ":" . $array_field; 
//        }

        $key_value = array();
        foreach ($this->getField() as $array_field) {
            array_push($key_value, $array_field . "=:" . $array_field);
        }

        $sql = "UPDATE " . $this->getNama() . " set ";
        $key_value_string = implode(",", $key_value);
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

    function createCustomSelectFieldForAjax($input_field_name) {
        $select = new InputSelect;
        $select->setKeyValuePairArrayMap($this->getCustomSelectFieldKeyValuePair());
        $select->createKeyValueSelectionForAjax($input_field_name, $this->getAjaxOnchangeFunctionCallback());
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
            } else {
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                echo "<input id=\"" . $column_name . "\" class=\"form-control\" type=\"text\" name=\"input_" . $column_name . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                echo "</div>";
            }
        }
    }

}
