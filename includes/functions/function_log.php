<?php

/* 
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */

function logIzin($no_reg, $id_transaksi, $transaksi, $no_izin, $proses, $user_id, $username, $api_key) {
    $db = new DbConnect();
    $sql = "INSERT INTO log (NoReg, idTransaksi, Transaksi, NoIzin, Proses, UserId, User, ApiKey)"
            . " VALUES (:NoReg, :idTransaksi, :Transaksi, :NoIzin, :Proses, :UserId, :User, :ApiKey)";
    $stmt = $db->connect()->prepare($sql);
    $array_values = array (
                                ":NoReg" => $no_reg,
                                ":idTransaksi" => $id_transaksi,
                                ":Transaksi" => $transaksi,
                                ":NoIzin" => $no_izin,
                                ":Proses" => $proses,
                                ":UserId" => $user_id,
                                ":User" => $user,
                                ":ApiKey" => $api_key
                            ); 
    $stmt->execute($array_values);
    $stmt = null;
}