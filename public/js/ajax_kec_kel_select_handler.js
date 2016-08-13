function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

function showKecamatan(id_kab, id_kec) {
    id_kab = typeof id_kab !== 'undefined' ? id_kab : "0";
    id_kec = typeof id_kec !== 'undefined' ? id_kec : "0";
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("div_idKecamatan").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "get_kecamatan.php?id_kab=" + id_kab + "&id_kec=" + id_kec, true);
    xmlhttp.send();
}

function showKelurahan(id_kec, id_kel) {
    id_kec = typeof id_kec !== 'undefined' ? id_kec : "0";
    id_kel = typeof id_kel !== 'undefined' ? id_kel : "0";
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("div_idKelurahan").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "get_kelurahan.php?id_kec=" + id_kec + "&id_kel=" + id_kel, true);
    xmlhttp.send();
}

function showKecKel(id_kab, id_kec, id_kel) {
    id_kab = typeof id_kab !== 'undefined' ? id_kab : "0";
    id_kec = typeof id_kec !== 'undefined' ? id_kec : "0";
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("div_idKecamatan").innerHTML = xmlhttp.responseText;
            sleep(500).then(() => {showKelurahan(id_kec, id_kel)});
        }
    };
    xmlhttp.open("GET", "get_kecamatan.php?id_kab=" + id_kab + "&id_kec=" + id_kec, true);
    xmlhttp.send();
}
