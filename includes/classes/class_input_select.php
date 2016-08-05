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
    private $ajax_onchange;

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

    function setAjaxOnchange($input_ajax_onchange) {
        $this->ajax_onchange = $input_ajax_onchange;
    }
    
    function getAjaxOnchange() {
        return $this->ajax_onchange;
    }

    function createSelection($input_selection_name) {
        $result = "<select id=\"" . $input_selection_name . "\" class=\"form-control\" name=\"input_" . $input_selection_name . "\">";
        $result .= "<option value=\"0\">Silahkan Pilih...</option>";
        foreach ($this->options as $option) {
            $result = $result . "<option class=\"form-control\" value=\"" . $option . "\">" . $option . "</option>";
        }
        $result = $result . "</select>";
        echo $result;
    }

    function createKeyValueSelection($input_selection_name, $input_div = "") {
        $result="";
        if ($input_div != "") {
            $result .= "<div id=\"" . $input_div . "\">";
        }
        $result .= "<select id=\"" . $input_selection_name . "\" class=\"form-control\" name=\"input_" . $input_selection_name . "\">";
        $result .= "<option value=\"0\">Silahkan Pilih...</option>";
        foreach ($this->key_value_pair as $key => $value) {
            $result .= "<option value=\"" . $value . "\">" . $key . "</option>";
        }
        $result .= "</select>";
        if ($input_div != "") {
            $result .= "</div>";
        }
        echo $result;
    }
    
    function createKeyValueSelectionWithValue($input_selection_name, $input_div = "", $field_value) {
        $result="";
        if ($input_div != "") {
            $result .= "<div id=\"" . $input_div . "\">";
        }
        $result .= "<select id=\"" . $input_selection_name . "\" class=\"form-control\" name=\"input_" . $input_selection_name . "\">";
        $result .= "<option value=\"0\">Silahkan Pilih...</option>";
        foreach ($this->key_value_pair as $key => $value) {
            if ($field_value==$value) {
                $result .= "<option value=\"" . $value . "\" selected>" . $key . "</option>";
            } else {
                $result .= "<option value=\"" . $value . "\">" . $key . "</option>";
            }
        }
        $result .= "</select>";
        if ($input_div != "") {
            $result .= "</div>";
        }
        echo $result;
    }

    function createKeyValueSelectionForAjax($input_selection_name, $input_onchange = "") {
        $result = "<select id=\"" . $input_selection_name . "\" class=\"form-control\" name=\"input_" . $input_selection_name . "\" onchange=\"" . $input_onchange . "\">";
        $result .= "<option value=\"0\">Silahkan Pilih...</option>";
        foreach ($this->key_value_pair as $key => $value) {
            $result = $result . "<option value=\"" . $value . "\">" . $key . "</option>";
        }
        $result = $result . "</select>";
        echo $result;
    }
    
    function createKeyValueSelectionForAjaxWithValue($input_selection_name, $input_onchange = "", $field_value) {
        $result = "<select id=\"" . $input_selection_name . "\" class=\"form-control\" name=\"input_" . $input_selection_name . "\" onchange=\"" . $input_onchange . "\">";
        $result .= "<option value=\"0\">Silahkan Pilih...</option>";
        foreach ($this->key_value_pair as $key => $value) {
            if ($field_value==$value) {
                $result .= "<option value=\"" . $value . "\" selected>" . $key . "</option>";
            } else {
                $result .= "<option value=\"" . $value . "\">" . $key . "</option>";
            }
        }
        $result = $result . "</select>";
        echo $result;
    }

    function createDateMonthYearSelection($input_selection_name, $tahun_mulai, $tahun_selesai) {
        $result = "<select id=\"tgl_" . $input_selection_name . "\" class=\"form-control\" name=\"input_tgl_" . $input_selection_name . "\">";
        for ($tgl = 1; $tgl <= 31; $tgl++) {
            $result .= "<option value=\"" . $tgl . "\">" . $tgl . "</option>";
        }
        $result .= "</select> &nbsp";

        $result .= "<select id=\"bln_" . $input_selection_name . "\" class=\"form-control\" name=\"input_bln_" . $input_selection_name . "\">";
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

        $result .= "<select id=\"thn_" . $input_selection_name . "\" class=\"form-control\" name=\"input_thn_" . $input_selection_name . "\">";
        for ($thn = $tahun_mulai; $thn <= $tahun_selesai; $thn++) {
            $result .= "<option value=\"" . $thn . "\">" . $thn . "</option>";
        }
        $result .= "</select>";

        echo $result;
    }
    
    function createDateMonthYearSelectionWithValue($input_selection_name, $tahun_mulai, $tahun_selesai, $value) {
        $fulldate = date_parse($value);
        $day = $fulldate["day"];
        $month = $fulldate["month"];
        $year = $fulldate["year"];
        
        $result = "<select id=\"tgl_" . $input_selection_name . "\" class=\"form-control\" name=\"input_tgl_" . $input_selection_name . "\">";
        for ($tgl = 1; $tgl <= 31; $tgl++) {
            if ($tgl == $day) {
                $result .= "<option value=\"" . $tgl . "\" selected>" . $tgl . "</option>";
            } else {
                $result .= "<option value=\"" . $tgl . "\">" . $tgl . "</option>";
            }
        }
        $result .= "</select> &nbsp";

        $result .= "<select id=\"bln_" . $input_selection_name . "\" class=\"form-control\" name=\"input_bln_" . $input_selection_name . "\">";
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
            if ($bln == $month) {
                $result .= "<option value=\"" . $bln . "\" selected>" . $bln_value . "</option>";
            } else {
                $result .= "<option value=\"" . $bln . "\">" . $bln_value . "</option>";
            }
        }
        $result .= "</select> &nbsp";

        $result .= "<select id=\"thn_" . $input_selection_name . "\" class=\"form-control\" name=\"input_thn_" . $input_selection_name . "\">";
        for ($thn = $tahun_mulai; $thn <= $tahun_selesai; $thn++) {
            if ($thn == $year) {
                $result .= "<option value=\"" . $thn . "\" selected>" . $thn . "</option>";
            } else {
                $result .= "<option value=\"" . $thn . "\">" . $thn . "</option>";
            }
        }
        $result .= "</select>";

        echo $result;
    }
    
    public static function parseDate($value) {
        $fulldate = date_parse($value);
        $day = $fulldate["day"];
        $month = $fulldate["month"];
        $year = $fulldate["year"];
        
		if ($month==1){
			$month = "Januari";
		}
		
		else if ($month==2){
			$month = "Februari";
		}
		
		else if ($month==3){
			$month = "Maret";
		}
		
		else if ($month==4){
			$month = "April";
		}
		
		else if ($month==5){
			$month = "Mei";
		}
		
		else if ($month==6){
			$month = "Juni";
		}
		
        else if ($month==7){
			$month = "Juli";
		}
		
		else if ($month==8){
			$month = "Agustus";
		}
		
		else if ($month==9){
			$month = "September";
		}
		
		else if ($month==10){
			$month = "Oktober";
		}
		
		else if ($month==11){
			$month = "November";
		}
		
		else if ($month=12){
			$month = "Desember";
		}
		
		
        $result = $day." ".$month." ".$year ;
		return $result;
    }


}
