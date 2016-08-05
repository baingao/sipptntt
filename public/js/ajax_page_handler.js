function showCustomTernakSelect(id_kab) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("idTernak").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "get_ipptlamp_ternak_select.php?ID_KAB="+ id_kab, true);
    xmlhttp.send();
}

function showLampiranIzin(nama_izin, nama_izin_panjang, nama_izin_lampiran, param_id) {
    var no_izin;
    no_izin = document.getElementById('AI').value;
    window.location.href = ('izin_lampiran_data.php?NAMA_IZIN=' + nama_izin + '&NAMA_IZIN_PANJANG=' + nama_izin_panjang + '&NAMA_IZIN_LAMPIRAN=' + nama_izin_lampiran +'&NO_IZIN=' + no_izin + "&PARAM_ID=" + param_id);
}

function showUpdateLampiranButton() {
    document.getElementById("button-container").innerHTML =
            '<button type="submit" name="button_tambah" id="button_tambah" class="btn btn-success btn-space" method="POST"><span><i class="glyphicon glyphicon-plus"></i> Tambah</span></button>'
            + '<button type="button" class="btn btn-default btn-space" method="POST" value="insert-form" onclick="formCloseLampiran(this.value)"><span><i class="glyphicon glyphicon-share"></i> Keluar</span></button>';
}

function showLampiranButton(nama_izin, nama_izin_panjang, param_id=0) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("button-lampiran").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "get_lampiran_button.php?NAMA_IZIN=" + nama_izin + "&NAMA_IZIN_PANJANG=" + nama_izin_panjang + "&PARAM_ID=" + param_id, true);
    xmlhttp.send();
}

function showRegisterData() {
    showPage("register_data.php", "Register: Data", false);
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

function showUserUpdateButton() {
    var html;
    html = '<button type="submit" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="userFormUpdate(this.value)"><span><i class="glyphicon glyphicon-ok"></i> Update</span></button>'
            + '<button type="reset" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="formReset(this.value)"><span><i class="glyphicon glyphicon-remove"></i> Batal</span></button>';
    document.getElementById("button-container").innerHTML = html;
    document.getElementById("lower-button-container").innerHTML = html;
}

function showUpdateButton() {
    var html, btn_keluar_upper, btn_keluar_lower;
    html = '<button type="submit" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="formUpdate(this.value)"><span><i class="glyphicon glyphicon-ok"></i> Update</span></button>'
            + '<button type="reset" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="formReset(this.value)"><span><i class="glyphicon glyphicon-remove"></i> Batal</span></button>';
//    btn_keluar_upper = '<button type="button" class="btn btn-default btn-space" method="POST" value="insert-form" onclick="formClose(this.value)"><span><i class="glyphicon glyphicon-share"></i> Keluar</span></button>';        
//    btn_keluar_lower = '<button type="button" class="btn btn-danger btn-space" method="POST" value="insert-form" onclick="formClose(this.value)"><span><i class="glyphicon glyphicon-share"></i> Keluar</span></button>';
    document.getElementById("button-container").innerHTML = html;
    document.getElementById("lower-button-container").innerHTML = html;
}

function hideUpdateButton() {
    document.getElementById("button-container").innerHTML = "";
    document.getElementById("lower-button-container").innerHTML = "";
}

function showUserBaruSubmitButton() {
    var html;
    html = '<button type="submit" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="userFormSubmit(this.value)"><span><i class="glyphicon glyphicon-ok"></i> Simpan</span></button>'
            + '<button type="reset" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="formReset(this.value)"><span><i class="glyphicon glyphicon-remove"></i> Batal</span></button>';   
    document.getElementById("button-container").innerHTML = html;
    document.getElementById("lower-button-container").innerHTML = html;
}

function showRegisterBaruSubmitButton() {
    var html, btn_keluar_upper, btn_keluar_lower;
    html = '<button type="submit" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="registerFormSubmit(this.value)"><span><i class="glyphicon glyphicon-ok"></i> Simpan</span></button>'
            + '<button type="reset" class="btn btn-warning btn-space" method="POST" value="insert-form" onclick="formReset(this.value)"><span><i class="glyphicon glyphicon-remove"></i> Batal</span></button>';
    
//    btn_keluar_upper = '<button type="button" class="btn btn-default btn-space" method="POST" value="insert-form" onclick="formClose(this.value)"><span><i class="glyphicon glyphicon-share"></i> Keluar</span></button>';        
//    btn_keluar_lower = '<button type="button" class="btn btn-danger btn-space" method="POST" value="insert-form" onclick="formClose(this.value)"><span><i class="glyphicon glyphicon-share"></i> Keluar</span></button>';        
    
    document.getElementById("button-container").innerHTML = html;
    document.getElementById("lower-button-container").innerHTML = html;
}

function hideSubmitButton() {
    document.getElementById("button-container").innerHTML = "";
    document.getElementById("lower-button-container").innerHTML = "";
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