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
    private $baris = array();
    private $kolom = array();
    private $tipe_data = array();
    private $kecuali = array();
    private $custom_select_field_key_value_pair;

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

    function setLabel($input_label) {
        $this->label = $input_label;
    }

    function setLabelFromComment($input_nama_kolom, $input_label_from_comment) {
        $label_value = getStringBetween($input_label_from_comment, "<LABEL>", "</LABEL>");
        if (strlen($label_value)>0) {
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
        if (strlen($placeholder_value)>0) {
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

    function clearBaris() {
        $this->baris = null;
    }
    
    function setBaris($input_baris) {
        $this->baris = $input_baris;
    }

    function getBaris() {
        return $this->baris;
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

    function createCustomSelectField($input_field_name) {
        $select = new InputSelect;
        $select->setKeyValuePairArrayMap($this->getCustomSelectFieldKeyValuePair());
        $select->createKeyValueSelection($input_field_name);
    }

    function getQueryResult() {
        $db = new DbConnect();
        $result = $db->connect()->query($this->sql);
        $this->clearBaris();
        $this->baris = $result->fetchAll(PDO::FETCH_ASSOC);
        return $this->baris;
    }

    function createInsertForm($input_nama) {
        $this->setNama($input_nama);
        $this->clearSql();
        $this->setSql("SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \"" . DB_NAME . "\" AND TABLE_NAME = \"" . $input_nama . "\"");
        $this->getQueryResult();
        foreach ($this->getBaris() as $row) {
            if (!in_array($row["COLUMN_NAME"], $this->getKecuali())) {
                $this->setLabelFromComment($row["COLUMN_NAME"], $row["COLUMN_COMMENT"]);
                $this->setPlaceholderFromComment($row["COLUMN_COMMENT"]);
//                $label = explode("|", $row["COLUMN_COMMENT"]); // untuk pake custom label & placeholder di kolom COMMENT
                if (isInString($row["COLUMN_COMMENT"], "<SELECT>")) {
                    echo "<div class=\"form-group\">";
                    echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                    if (isInString($row["COLUMN_COMMENT"], "<SQL>")) {  // key value pair dari <TABLE> </TABLE> di comment
                        $this->setCustomSelectFieldKeyValuePairFromSql($row["COLUMN_COMMENT"]);
                        $this->createCustomSelectField($row["COLUMN_NAME"]);
                    } else { // key value pair dari nilai <KEY> </KEY> dan <VALUE> </VALUE> di comment
                        $this->setCustomSelectFieldKeyValuePairFromComment($row["COLUMN_COMMENT"]);
                        $this->createCustomSelectField($row["COLUMN_NAME"]);
                    }
                    echo "</div>";
                } else {
                    if ($row["COLUMN_TYPE"] == "date") {
                        echo "<div class=\"form-group form-inline\">";
                        echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                        $select = new InputSelect();
                        $select->createDateMonthYearSelection($row["COLUMN_NAME"], TAHUN_MULAI, TAHUN_SELESAI);
                        echo "</div>";
                    } else if (substr($row["COLUMN_TYPE"], 0, 3) == "int") {
                        echo "<div class=\"form-group\">";
                        echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                        echo "<input class=\"form-control\" type=\"number\" name=\"input_" . $row["COLUMN_NAME"] . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                        echo "</div>";
                    } else {
                        echo "<div class=\"form-group\">";
                        echo "<label class=\"control-label\">" . $this->getLabel() . "</label><br>";
                        echo "<input class=\"form-control\" type=\"text\" name=\"input_" . $row["COLUMN_NAME"] . "\" placeholder=\"" . $this->getPlaceholder() . "\">";
                        echo "</div>";
                    }
                }
            }
        }
    }

}
