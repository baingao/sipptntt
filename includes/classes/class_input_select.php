<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_input_select
 *
 * @author billrp
 */
class InputSelect {

    private $options;
    private $key_value_pair = array();

    function clearOptions() {
        $this->options = null;
    }

    function setOptions($input_options) {
        $this->options = $input_options;
    }

    function getOptions() {
        return $this->options;
    }

    function clearKeyValuePair() {
        $this->key_value_pair = null;
    }

    function setKeyValuePair($input_key, $input_value) {
        $this->key_value_pair[$input_key] = $input_value;
    }
    
    function setKeyValuePairArrayMap($input_key_value_pair_array_map) {
        $this->key_value_pair = $input_key_value_pair_array_map;
//        Contoh
//        $selection->setKeyValuePairArrayMap(
//                array(
//                    "satu" => "1",
//                    "dua" => "2",
//                    "tiga" => "3"
//                )
//        );
    }
    
    function getKeyValuePair() {
        return $this->key_value_pair;
    }

    function createSelection($input_selection_name) {
        $result = "<select class=\"form-control\" name=\"input_" . $input_selection_name . "\">";
        foreach ($this->options as $option) {
            $result = $result . "<option value=\"" . $option . "\">" . $option . "</option>";
        }
        $result = $result . "</select>";
        echo $result;
    }

    function createKeyValueSelection($input_selection_name) {
        $result = "<select class=\"form-control\" name=\"input_" . $input_selection_name . "\">";
        foreach ($this->key_value_pair as $key => $value) {
            $result = $result . "<option value=\"" . $value . "\">" . $key . "</option>";
        }
        $result = $result . "</select>";
        echo $result;
    }

    function createDateMonthYearSelection($input_selection_name, $tahun_mulai, $tahun_selesai) {
        $result = "<select class=\"form-control\" name=\"input_tgl_" . $input_selection_name . "\">";
        for ($tgl = 1; $tgl <= 31; $tgl++) {
            $result .= "<option value=\"" . $tgl . "\">" . $tgl . "</option>";
        }
        $result .= "</select> &nbsp";

        $result .= "<select class=\"form-control\" name=\"input_bln_" . $input_selection_name . "\">";
        for ($bln = 1; $bln <= 12; $bln++) {
            switch ($bln) {
                case 1: $bln_value = "Januari";
                    break;
                case 2: $bln_value = "Februari";
                    break;
                case 3: $bln_value = "Maret";
                    break;
                case 4: $bln_value = "April";
                    break;
                case 5: $bln_value = "Mei";
                    break;
                case 6: $bln_value = "Juni";
                    break;
                case 7: $bln_value = "Juli";
                    break;
                case 8: $bln_value = "Agustus";
                    break;
                case 9: $bln_value = "September";
                    break;
                case 10: $bln_value = "Oktober";
                    break;
                case 11: $bln_value = "November";
                    break;
                case 12: $bln_value = "Desember";
                    break;
            }
            $result .= "<option value=\"" . $bln . "\">" . $bln_value . "</option>";
        }
        $result .= "</select> &nbsp";

        $result .= "<select class=\"form-control\" name=\"input_thn_" . $input_selection_name . "\">";
        for ($thn = $tahun_mulai; $thn <= $tahun_selesai; $thn++) {
            $result .= "<option value=\"" . $thn . "\">" . $thn . "</option>";
        }
        $result .= "</select>";

        echo $result;
    }

}
