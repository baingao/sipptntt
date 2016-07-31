<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TableData {

    private $nama;
    private $sql;
    private $baris = array();
    private $kolom = array();
    private $field = array();

    function setNama($input_nama) {
        $this->nama = $input_nama;
    }
    
    function getNama() {
        return $this->nama;
    }
    
    function setSql($input_sql) {
        $this->sql = $input_sql;   
    }
    
    function getSql() {
        return $this->sql;
    }
    
    function setBaris($input_baris) {
        $this->baris = $input_baris;
    }
    
    function getBaris() {
        return $this->baris;
    }
    
    function setKolom($input_kolom) {
        $this->kolom = $input_kolom;
    }
    
    function getKolom() {
        return $this->kolom;
    }
    
    function setField($input_field) {
        $this->field = $input_field;
    }
    
    function getField() {
        return $this->field;
    }

    public static function tableFromSql($sql, $limit, $keyfield, $totalfields, $select=false, $edit=false, $terbit=false, $delete=false) {
        $db = new DbConnect();
        // echo $sql . "<br/>";
        echo "<table class=\"table table-hover\">";
        echo "<tr>";
        $headerset = $db->connect()->query($sql . " LIMIT 1");
        $rows = $headerset->fetch(PDO::FETCH_ASSOC);
        $keys = array();
        $total = array();
        if ($select == true) {
            echo "<th>Pilih</th>"; // dummy for selection
           // echo "<th> <input type=\"checkbox\" value=\"all\"> </input> </th>"; 
        }
        foreach ($rows as $key => $value) {
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

        $dataset = $db->connect()->query($sql . " LIMIT {$limit}");
        while ($row = $dataset->fetch(PDO::FETCH_ASSOC)) {
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
                echo "<td> <button class=\"btn btn-danger\" type=\"submit\" id=\"button_hapus\" name=\"button_delete\" value=\"$row[$keyfield]\" onclick=\"dataDelete(this.value)\"><i class=\"glyphicon glyphicon-trash\"></i></button> </td>"; // edit button
            }
            echo "</tr>";
        }

        echo "<tfoot><tr>";
        if ($select == true) {
            echo "<td> &nbsp </td>"; // dummy for select checkbox
        }
        if ($edit == true) {
            echo "<td> &nbsp </td>"; // dummy for edit button
        }
        foreach ($total as $value) {
            echo "<td>";
            if (((int) $value) or ( (float) $value)) {
                echo $value;
            }
            echo "</td>";
        }
        echo "</tr></tfoot>";
        echo "</table>";
    }

}
