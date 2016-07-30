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