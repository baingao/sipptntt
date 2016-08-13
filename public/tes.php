<?php

define("BUILD", "RELEASE");
/*
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Original code by Joy Radja Pono
 * Unauthorized use is prohibited
 */

echo angkaTerbilang(215512375); // 279515375

function resolveTriplet($digit, $qualifierGlobalnya) {
    $defDigit = array('satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
    $defPredikatLokal = array('ratus', '', 'puluh');
    $defPredikatGlobal = array('', 'ribu', 'juta', 'miliar', 'triliun');

    $result = '';
    $nolSemua = true;
    $belas = false;
    $qualifierGlobal = $qualifierGlobalnya;
    if (BUILD == "DEBUG") {
        foreach ($digit as $key => $char) {
            echo "digit[{$key}] : {$char}<br/>";
        }
    }
    $i = 0;
    while ($i <= 2) {
        $qualifierLokal = (3 - $i) % 3; //isi qualifierLokal : 0=ratusan, 2=puluhan, 1=satuan

        if (BUILD == "DEBUG") {
            echo "i : {$i}<br/>";
            echo "qualifierLokal : {$qualifierLokal}<br/>";
        }

        if ($digit[$i] != '0') { //angka 0 tidak diproses
            if (BUILD == "DEBUG") {
                echo "*** digit[{$i}] terproses : *** {$digit[$i]} ***<br/>";
            }
            $nolSemua = false;

            //angka dan Predikat Default
            $angka[$i] = $defDigit[$digit[$i] - 1] . ' ';
            $predikat[$i] = $defPredikatLokal[$qualifierLokal] . ' ';
            if (BUILD == "DEBUG") {
                echo "angka[{$i}] : {$angka[$i]}<br/>";
                echo "predikat[{$i}] : {$predikat[$i]}<br/>";
            }
            if ($digit[$i] == '1') {
                //penyebutan 1 sebagai "se"
                //pada saat berada di posisi bukan satuan, atau
                //saat berada di posisi satuan dan sebagai angka ribuan
                //if (qualifierLokal<>1) or ((qualifierLokal=1) and (qualifierGlobal=1)) then
                if (($qualifierLokal != 1) || (($qualifierLokal == 1) && ($qualifierGlobal == 1) && (($i == 3) && ($digit[1] == '0') && ($digit[2] == '0') ))) {
                    $angka[$i] = 'se';
                }

                //penanganan belasan
                if ($qualifierLokal == 2) { //jika angka 1 pada posisi puluhan
                    if ($digit[$i + 1] != '0') { //jika disebelah kanannya ada angka bukan 0
                        if ($digit[$i + 1] == '1') {//jika angka disebelah kanannya itu 1, harus disebut "se"
                            $angka[$i] = 'se';
                        } else {               
                            $angka[$i] = $defDigit[(int) $digit[$i+1]-1] . ' ';               
                        }
                        $predikat[$i] = 'belas ';
                        $belas = true;
                    }
                }
            }
            $result = $result . $angka[$i] . $predikat[$i];
            if ($belas == true) {
                $i = $i + 1;
            } //jika tadi hitung belas, maka maju satu angka krn tadi sudah proses 2 angka sekaligus
        }
        $i = $i + 1;
    }
    if ($nolSemua == false) {
        $result = $result . $defPredikatGlobal[$qualifierGlobalnya] . ' ';
    }
    return $result;
}

function angkaTerbilang($angka = 1253125) {
    //konsep :
    //- susunan angka merupakan rangkaian triplet (3 digit)
    //- tiap triplet punya qualifier yg relatif terhadap letak triplet dalam susunan angka (disebut qualifier global)
    //- tiap digit dalam triplet punya qualifier yg relatif terhadap letak digit tersebut dalam triplet(disebut qualifier lokal)
    //- qualifier2 itu menentukan predikat global dan predikat lokal
    //- predikat lokal menempel pada digit, sedangkan predikat global menempel pada triplet
    //- angka 0 tidak pernah disebutkan
    //- angka 1 harus ditangani secara khusus karena dapat ditulis satu/se
    //    dan dapat mengubah urutan penulisan jika membentuk belasan
    //** PASS PERTAMA : mengubah angka menjadi tulisan
    $result = "";
    $s = (string) $angka;

    if (BUILD == "DEBUG") {
        echo "s awal : {$s}<br/>";
    }

    $panjangAwal = strlen($s);
    if (($panjangAwal % 3) > 0) {
        for ($i = 0; $i <= (2 - ($panjangAwal % 3)); $i++) {
            $s = '0' . $s; //tambahkan '0' didepan string angka hingga pjgnya mencapai kelipatan 3
        }
    }

    if (BUILD == "DEBUG") {
        echo "s akhir : {$s}<br/>";
    }

    $panjangAkhir = strlen($s);
    $jumlahTriplet = ($panjangAkhir / 3); //hitung jumlah triplet

    if (BUILD == "DEBUG") {
        echo "Panjang awal : {$panjangAkhir}<br/>";
        echo "Panjang akhir : {$panjangAkhir}<br/>";
        echo "Jumlah triplet : {$jumlahTriplet}<br/>";
    }

//pengolahan triplet
    for ($i = 1; $i <= $jumlahTriplet; $i++) {
        $triplet = substr($s, (($i - 1) * 3), 3); //bentuk triplet
        //isi qualifierGlobal : 0=kosong (tidak butuh qualifier), 1=ribu, 2=juta, 3=milyar, 4=triliun
        $qualifierGlobal = $jumlahTriplet - $i; //hitung qualifier global
        if (BUILD == "DEBUG") {
            echo "-------------------------------------------<br/>";
            echo "triplet : {$triplet}<br/>";
            echo "qualifierGlobal : {$qualifierGlobal}<br/>";
        }
        $result = $result . ResolveTriplet(str_split($triplet), $qualifierGlobal); //resolve triplet
    }

    //** PASS KEDUA : merapikan tulisan
    $result = str_replace('se ', 'se', $result); //hilangkan spasi setelah "se"
    $result = str_replace('  ', ' ', $result); //ubah dua spasi berurutan menjadi satu spasi

    if (BUILD == "DEBUG") {
        echo "result : {$result}<br/>";
    }
    return $result;
}
