function dataEdit(value) {
    showPageWithParam("register_edit.php?q=", value, "Register : Edit Data", true);
}

function dataTerbit(value) {
    window.alert('Terbit id: ' + value);
}

function dataDelete(value) {
    window.alert('Delete id: ' + value);
}

function showRegisterData() {
    showPage("register_data.php", "Data Register", false);
}

function showRegister() {
    showPage("register_baru.php", "Register : Daftar Baru", true);
}

function showIPPT() {
    showPage("ippt_baru.php", "Izin Pemasukan dan Pengeluaran Ternak", true)
}

function showHome() {
    showPage("home.php", "Sistem Informasi Pelayanan Perizinan Terpadu<br>Provinsi Nusa Tenggara Timur", false);
}

function showDataControlButton() {
    document.getElementById("button-container").innerHTML =
            '<button type="button" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="dateEdit(this.value)">Simpan</button>'
            + '<button type="button" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="dataDelete(this.value)">Batal</button>'
            + '<button type="button" class="btn btn-default btn-space" method="POST" value="insert-form" onclick="formClose(this.value)">Keluar</button>';
}

function showUpdateButton() {
    document.getElementById("button-container").innerHTML =
            '<button type="submit" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="formUpdate(this.value)">Update</button>'
            + '<button type="reset" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="formReset(this.value)">Batal</button>'
            + '<button type="button" class="btn btn-default btn-space" method="POST" value="insert-form" onclick="formClose(this.value)">Keluar</button>';
}

function hideUpdateButton() {
    document.getElementById("button-container").innerHTML = "";
}

function showSubmitButton() {
    document.getElementById("button-container").innerHTML =
            '<button type="submit" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="formSubmit(this.value)">Simpan</button>'
            + '<button type="reset" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="formReset(this.value)">Batal</button>'
            + '<button type="button" class="btn btn-default btn-space" method="POST" value="insert-form" onclick="formClose(this.value)">Keluar</button>';
}

function hideSubmitButton() {
    document.getElementById("button-container").innerHTML = "";
}

function formSubmit(form_id) {
    var elementValuesById = getElementValuesById(form_id);
    showPageWithParam("submit_insert.php?q=", elementValuesById, "Insert data berhasil", false);
}

function formReset(form_id) {
    document.getElementById(form_id).reset();
}

function formClose(form_id) {
    showHome();
}

function showPageWithParam(target, param, title, submitButton) {
    if (submitButton == true) {
        showUpdateButton();
    } else {
        hideUpdateButton();
    }
    document.getElementById("content-title").innerHTML = "<h3>" + title + "</h3>";
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content-main").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", target + param, true);
    xmlhttp.send();
}

function showPage(target, title, submitButton) {
    if (submitButton == true) {
        showSubmitButton();
    } else {
        hideSubmitButton();
    }

    document.getElementById("content-title").innerHTML = "<h3>" + title + "</h3>";
    str = "";
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content-main").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", target + str, true);
    xmlhttp.send();
}

function getElementValuesById(form_name) {
    var form = document.getElementById(form_name);
    var param_values = "";
    var id_tanggal;
    var tanggal;
    var bulan;
    var tahun;
    var tanggalYMD;
    var i;
    for (i = 0; i < form.length; i++) {
        if (form.elements[i].id.startsWith("tgl_")) {
            tanggal = form.elements[i].value;
            id_tanggal = form.elements[i].id.substring(4);
        } else if (form.elements[i].id.startsWith("bln_")) {
            bulan = form.elements[i].value;
        } else if (form.elements[i].id.startsWith("thn_")) {
            tahun = form.elements[i].value;
            tanggalYMD = tahun + "-" + bulan + "-" + tanggal;
            //window.alert(id_tanggal + " : " + tahun + "-" + bulan + "-" + tanggal);
            param_values += "':" + id_tanggal + "'=>_" + tanggalYMD + "_";
            if (i < form.length - 1) {
                param_values += ",";
            }
        } else {
            param_values += "':" + form.elements[i].id + "'=>_" + form.elements[i].value + "_";
            if (i < form.length - 1) {
                param_values += ",";
            }
        }
    }
    return param_values;
}

function getElementValuesById_old(form_name, target_div) {
    var form = document.getElementById(form_name);
    var param_values = "";
    var i;
    for (i = 0; i < form.length; i++) {
        param_values += "':" + form.elements[i].id + "'=>_" + form.elements[i].value + "_";
        if (i < form.length - 1) {
            param_values += ",";
        }
    }
    //document.getElementById(target_div).innerHTML = param_values;
    return param_values;
}

function showKecamatan(id_kab, id_kec) {
    id_kab = typeof id_kab !== 'undefined' ? id_kab : "";
    id_kec = typeof id_kec !== 'undefined' ? id_kec : "";
    if (id_kab == "") {
        document.getElementById("div_idKecamatan").innerHTML = "";
        return;
    } else {
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
}

function showKelurahan(id_kec, id_kel) {
    id_kec = typeof id_kec !== 'undefined' ? id_kec : "";
    id_kel = typeof id_kel !== 'undefined' ? id_kel : "";
    if (id_kec == "") {
        document.getElementById("div_idKelurahan").innerHTML = "";
        return;
    } else {
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
}

function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

function showKecKel(id_kab, id_kec, id_kel) {
    id_kab = typeof id_kab !== 'undefined' ? id_kab : "";
    id_kec = typeof id_kec !== 'undefined' ? id_kec : "";
    if (id_kab == "") {
        document.getElementById("div_idKecamatan").innerHTML = "";
        return;
    } else {
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
                sleep(500).then(() => {
                    showKelurahan(id_kec, id_kel);
                });
            }
        };
        xmlhttp.open("GET", "get_kecamatan.php?id_kab=" + id_kab + "&id_kec=" + id_kec, true);
        xmlhttp.send();
    }
}
