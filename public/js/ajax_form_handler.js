function formDelete(form_id) {
    var elementValuesById = getElementValuesById(form_id);
    showPageWithParam("submit_delete.php?params=", elementValuesById, "Delete data berhasil", false);
}

function formUpdate(form_id) {
    var elementValuesById = getElementValuesById(form_id);
    showPageWithParam("submit_update.php?params=", elementValuesById, "Update data berhasil", false);
}

function formSubmit(form_id) {
    var elementValuesById = getElementValuesById(form_id);
    showPageWithParam("submit_insert.php?params=", elementValuesById, "Insert data berhasil", false);
}

function formReset(form_id) {
    document.getElementById(form_id).reset();
}

function formClose(form_id) {
    showHome();
}

function getElementValuesById(form_name) {
    var form = document.getElementById(form_name);
    var param_values = "";
    var id_tanggal;
    var id_text;
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
                param_values += "|";
            }
        } else {
            if (form.elements[i].id.startsWith("text_")) { // coba handle textarea, linebreak bermasalah
                id_text = form.elements[i].id.substring(5);
                param_values += "':" + id_text + "'=>_" + form.elements[i].value + "_";
                if (i < form.length - 1) {
                    param_values += "|";
                }
            } else {
                param_values += "':" + form.elements[i].id + "'=>_" + form.elements[i].value + "_";
                if (i < form.length - 1) {
                    param_values += "|";
                }
            }
        }
    }
    return param_values;
}