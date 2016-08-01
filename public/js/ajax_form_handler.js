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

function getElementValuesById(form_name, is_for_display = false) {
    var form = document.getElementById(form_name);
    var param_values = "";
    var id_tanggal, id_text;
    var tanggal, bulan, tahun, tanggalYMD;
    var array_delimiter = "|", key_delimiter = "<K>", value_delimiter = "<V>";
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
            param_values += key_delimiter + ":" + id_tanggal + key_delimiter + "=>" + value_delimiter + tanggalYMD + value_delimiter;
            if (i < form.length - 1) {
                param_values += array_delimiter;
            }
        } else {
            if (form.elements[i].id.startsWith("text_")) { // coba handle textarea, linebreak bermasalah
                id_text = form.elements[i].id.substring(5);
                if (is_for_display == true) {
                    param_values += key_delimiter + ":" + id_text + key_delimiter + "=>" + value_delimiter + form.elements[i].value.replace(/<br\s*[\/]?>/gi, "\n") + value_delimiter;
                } else {
                    param_values += key_delimiter + ":" + id_text + key_delimiter + "=>" + value_delimiter + form.elements[i].value.replace(/\n/g, '<br/>') + value_delimiter;
                }
                if (i < form.length - 1) {
                    param_values += array_delimiter;
                }
            } else {
                param_values += key_delimiter + ":" + form.elements[i].id + key_delimiter + "=>" + value_delimiter + form.elements[i].value + value_delimiter;
                if (i < form.length - 1) {
                    param_values += array_delimiter;
                }
            }
        }
    }
    //window.alert(param_values);
    return param_values;
}