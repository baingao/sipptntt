function showLampiran(no_izin) {
    window.location.href = ('izin_lampiran_data.php?NO_IZIN=' + no_izin);
}

function lampiranConfirmDelete(no_reg, table_name, return_url) {
    if (window.confirm('Hapus data lampiran ini ?')==true) {
        window.location.href = ('submit_delete.php?DELETE_KEY=' + no_reg + '&DELETE_TABLE_NAME='+table_name);
        window.alert('Data sudah terhapus.');
        window.open(return_url, '_self');
    }
}

function confirmDelete(no_reg) {
    if (window.confirm('Hapus data dengan nomor registrasi : ' + no_reg + ' ?')==true) {
        window.location.href = ('submit_delete.php?DELETE_KEY=' + no_reg + '&DELETE_TABLE_NAME=register&DELETE_RETURN_TO=register_data.php');
    }
}

function userConfirmDelete(id_user) {
    if (window.confirm('Hapus user dengan id : ' + id_user + ' ?')==true) {
        window.location.href = ('submit_delete.php?DELETE_KEY=' + id_user + '&DELETE_TABLE_NAME=user&DELETE_RETURN_TO=konfigurasi_user_data.php');
    }
}

function userGantiPasswordFormUpdate(form_id) {
    var elementValues, id_user, username, role;
    var array_delimiter = "|", key_delimiter = "<K>", value_delimiter = "<V>";
    if (window.confirm('Simpan data?')==true) {
        id_user = document.getElementById('idUser').value;
        password_lama = document.getElementById('password_lama').value;
        token = document.getElementById('token').value;
        password_baru = document.getElementById('password_baru').value;
        konfirmasi_password = document.getElementById('konfirmasi_password').value;
        if (hex_md5(password_lama)==token) {
            if (password_baru==konfirmasi_password) {
                elementValues = key_delimiter + ":idUser" + key_delimiter + "=>" + value_delimiter + id_user + value_delimiter;
                elementValues += array_delimiter + key_delimiter + ":password" + key_delimiter + "=>" + value_delimiter + hex_md5(password_baru)+ value_delimiter;
                showPageWithParam("user_submit_ganti_password.php?params=", elementValues, "Update data berhasil", false);
            } else {
                window.alert('Konfirmasi password tidak sama dengan password baru.');
            }
        } else {
            window.alert('Password salah.');
        }
    }
}

function userFormUpdate(form_id) {
    var elementValues, id_user, username, role;
    var array_delimiter = "|", key_delimiter = "<K>", value_delimiter = "<V>";
    if (window.confirm('Simpan data?')==true) {
        id_user = document.getElementById('idUser').value;
        username = document.getElementById('username').value;
        role = document.getElementById('role').value;
        elementValues = key_delimiter + ":idUser" + key_delimiter + "=>" + value_delimiter + id_user + value_delimiter;
        elementValues += array_delimiter + key_delimiter + ":username" + key_delimiter + "=>" + value_delimiter + username + value_delimiter;
        elementValues += array_delimiter + key_delimiter + ":role" + key_delimiter + "=>" + value_delimiter + role + value_delimiter;
        showPageWithParam("user_submit_update.php?params=", elementValues, "Update data berhasil", false);
    }
}

function formUpdate(form_id) {
    var elementValuesById;
    if (window.confirm('Update data?')==true) {
        try {
            elementValuesById = getElementValuesById(form_id);
            showPageWithParam("submit_update.php?params=", elementValuesById, "Update data berhasil", false);
            window.alert('Update data berhasil.');
            window.open('register_data.php', '_self');
        } catch(err) {
            window.alert('Update data gagal.\n' + err.message);
        }    
    }
}

function userFormSubmit(form_id) {
    var elementValues, username, password, konfirmasi_password, role;
    var array_delimiter = "|", key_delimiter = "<K>", value_delimiter = "<V>";
    password = document.getElementById('password').value;
    konfirmasi_password = document.getElementById('konfirmasi_password').value;
    if (password==konfirmasi_password) {
        if (window.confirm('Simpan data?')==true) {
            username = document.getElementById('username').value;
            role = document.getElementById('role').value;
            elementValues = key_delimiter + ":username" + key_delimiter + "=>" + value_delimiter + username + value_delimiter;
            elementValues += array_delimiter + key_delimiter + ":password" + key_delimiter + "=>" + value_delimiter + hex_md5(password) + value_delimiter;
            elementValues += array_delimiter + key_delimiter + ":role" + key_delimiter + "=>" + value_delimiter + role + value_delimiter;
            showPageWithParam("user_submit_insert.php?params=", elementValues, "Insert data berhasil", false);
        }
    } else {
        window.alert('Konfirmasi password salah.\n\nPassword dan Konfirmasi password harus sama.');
    }
}

function registerFormSubmit(form_id) {
    var elementValuesById;
    if (window.confirm('Simpan data?')==true) {
        elementValuesById = getElementValuesById(form_id);
        showPageWithParam("register_submit_insert.php?params=", elementValuesById, "Registrasi berhasil", false);
    }
}

function formReset(form_id) {
    if (window.confirm('Batalkan pengisian data ini?')==true) {
        document.getElementById(form_id).reset();
    }
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

/*
* START OF HASH
*/
var hexcase = 0; 
var b64pad  = ""; 

function hex_md5(s)    { return rstr2hex(rstr_md5(str2rstr_utf8(s))); }
function b64_md5(s)    { return rstr2b64(rstr_md5(str2rstr_utf8(s))); }
function any_md5(s, e) { return rstr2any(rstr_md5(str2rstr_utf8(s)), e); }
function hex_hmac_md5(k, d)
  { return rstr2hex(rstr_hmac_md5(str2rstr_utf8(k), str2rstr_utf8(d))); }
function b64_hmac_md5(k, d)
  { return rstr2b64(rstr_hmac_md5(str2rstr_utf8(k), str2rstr_utf8(d))); }
function any_hmac_md5(k, d, e)
  { return rstr2any(rstr_hmac_md5(str2rstr_utf8(k), str2rstr_utf8(d)), e); }

function md5_vm_test()
{
  return hex_md5("abc").toLowerCase() == "900150983cd24fb0d6963f7d28e17f72";
}

function rstr_md5(s)
{
  return binl2rstr(binl_md5(rstr2binl(s), s.length * 8));
}

function rstr_hmac_md5(key, data)
{
  var bkey = rstr2binl(key);
  if(bkey.length > 16) bkey = binl_md5(bkey, key.length * 8);

  var ipad = Array(16), opad = Array(16);
  for(var i = 0; i < 16; i++)
  {
    ipad[i] = bkey[i] ^ 0x36363636;
    opad[i] = bkey[i] ^ 0x5C5C5C5C;
  }

  var hash = binl_md5(ipad.concat(rstr2binl(data)), 512 + data.length * 8);
  return binl2rstr(binl_md5(opad.concat(hash), 512 + 128));
}

function rstr2hex(input)
{
  try { hexcase } catch(e) { hexcase=0; }
  var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
  var output = "";
  var x;
  for(var i = 0; i < input.length; i++)
  {
    x = input.charCodeAt(i);
    output += hex_tab.charAt((x >>> 4) & 0x0F)
           +  hex_tab.charAt( x        & 0x0F);
  }
  return output;
}

function rstr2b64(input)
{
  try { b64pad } catch(e) { b64pad=''; }
  var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var output = "";
  var len = input.length;
  for(var i = 0; i < len; i += 3)
  {
    var triplet = (input.charCodeAt(i) << 16)
                | (i + 1 < len ? input.charCodeAt(i+1) << 8 : 0)
                | (i + 2 < len ? input.charCodeAt(i+2)      : 0);
    for(var j = 0; j < 4; j++)
    {
      if(i * 8 + j * 6 > input.length * 8) output += b64pad;
      else output += tab.charAt((triplet >>> 6*(3-j)) & 0x3F);
    }
  }
  return output;
}

function rstr2any(input, encoding)
{
  var divisor = encoding.length;
  var i, j, q, x, quotient;

  var dividend = Array(Math.ceil(input.length / 2));
  for(i = 0; i < dividend.length; i++)
  {
    dividend[i] = (input.charCodeAt(i * 2) << 8) | input.charCodeAt(i * 2 + 1);
  }

  var full_length = Math.ceil(input.length * 8 /
                                    (Math.log(encoding.length) / Math.log(2)));
  var remainders = Array(full_length);
  for(j = 0; j < full_length; j++)
  {
    quotient = Array();
    x = 0;
    for(i = 0; i < dividend.length; i++)
    {
      x = (x << 16) + dividend[i];
      q = Math.floor(x / divisor);
      x -= q * divisor;
      if(quotient.length > 0 || q > 0)
        quotient[quotient.length] = q;
    }
    remainders[j] = x;
    dividend = quotient;
  }

  var output = "";
  for(i = remainders.length - 1; i >= 0; i--)
    output += encoding.charAt(remainders[i]);

  return output;
}

function str2rstr_utf8(input)
{
  var output = "";
  var i = -1;
  var x, y;

  while(++i < input.length)
  {
    x = input.charCodeAt(i);
    y = i + 1 < input.length ? input.charCodeAt(i + 1) : 0;
    if(0xD800 <= x && x <= 0xDBFF && 0xDC00 <= y && y <= 0xDFFF)
    {
      x = 0x10000 + ((x & 0x03FF) << 10) + (y & 0x03FF);
      i++;
    }

    if(x <= 0x7F)
      output += String.fromCharCode(x);
    else if(x <= 0x7FF)
      output += String.fromCharCode(0xC0 | ((x >>> 6 ) & 0x1F),
                                    0x80 | ( x         & 0x3F));
    else if(x <= 0xFFFF)
      output += String.fromCharCode(0xE0 | ((x >>> 12) & 0x0F),
                                    0x80 | ((x >>> 6 ) & 0x3F),
                                    0x80 | ( x         & 0x3F));
    else if(x <= 0x1FFFFF)
      output += String.fromCharCode(0xF0 | ((x >>> 18) & 0x07),
                                    0x80 | ((x >>> 12) & 0x3F),
                                    0x80 | ((x >>> 6 ) & 0x3F),
                                    0x80 | ( x         & 0x3F));
  }
  return output;
}

function str2rstr_utf16le(input)
{
  var output = "";
  for(var i = 0; i < input.length; i++)
    output += String.fromCharCode( input.charCodeAt(i)        & 0xFF,
                                  (input.charCodeAt(i) >>> 8) & 0xFF);
  return output;
}

function str2rstr_utf16be(input)
{
  var output = "";
  for(var i = 0; i < input.length; i++)
    output += String.fromCharCode((input.charCodeAt(i) >>> 8) & 0xFF,
                                   input.charCodeAt(i)        & 0xFF);
  return output;
}

function rstr2binl(input)
{
  var output = Array(input.length >> 2);
  for(var i = 0; i < output.length; i++)
    output[i] = 0;
  for(var i = 0; i < input.length * 8; i += 8)
    output[i>>5] |= (input.charCodeAt(i / 8) & 0xFF) << (i%32);
  return output;
}

function binl2rstr(input)
{
  var output = "";
  for(var i = 0; i < input.length * 32; i += 8)
    output += String.fromCharCode((input[i>>5] >>> (i % 32)) & 0xFF);
  return output;
}

function binl_md5(x, len)
{
  x[len >> 5] |= 0x80 << ((len) % 32);
  x[(((len + 64) >>> 9) << 4) + 14] = len;

  var a =  1732584193;
  var b = -271733879;
  var c = -1732584194;
  var d =  271733878;

  for(var i = 0; i < x.length; i += 16)
  {
    var olda = a;
    var oldb = b;
    var oldc = c;
    var oldd = d;

    a = md5_ff(a, b, c, d, x[i+ 0], 7 , -680876936);
    d = md5_ff(d, a, b, c, x[i+ 1], 12, -389564586);
    c = md5_ff(c, d, a, b, x[i+ 2], 17,  606105819);
    b = md5_ff(b, c, d, a, x[i+ 3], 22, -1044525330);
    a = md5_ff(a, b, c, d, x[i+ 4], 7 , -176418897);
    d = md5_ff(d, a, b, c, x[i+ 5], 12,  1200080426);
    c = md5_ff(c, d, a, b, x[i+ 6], 17, -1473231341);
    b = md5_ff(b, c, d, a, x[i+ 7], 22, -45705983);
    a = md5_ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
    d = md5_ff(d, a, b, c, x[i+ 9], 12, -1958414417);
    c = md5_ff(c, d, a, b, x[i+10], 17, -42063);
    b = md5_ff(b, c, d, a, x[i+11], 22, -1990404162);
    a = md5_ff(a, b, c, d, x[i+12], 7 ,  1804603682);
    d = md5_ff(d, a, b, c, x[i+13], 12, -40341101);
    c = md5_ff(c, d, a, b, x[i+14], 17, -1502002290);
    b = md5_ff(b, c, d, a, x[i+15], 22,  1236535329);

    a = md5_gg(a, b, c, d, x[i+ 1], 5 , -165796510);
    d = md5_gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
    c = md5_gg(c, d, a, b, x[i+11], 14,  643717713);
    b = md5_gg(b, c, d, a, x[i+ 0], 20, -373897302);
    a = md5_gg(a, b, c, d, x[i+ 5], 5 , -701558691);
    d = md5_gg(d, a, b, c, x[i+10], 9 ,  38016083);
    c = md5_gg(c, d, a, b, x[i+15], 14, -660478335);
    b = md5_gg(b, c, d, a, x[i+ 4], 20, -405537848);
    a = md5_gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
    d = md5_gg(d, a, b, c, x[i+14], 9 , -1019803690);
    c = md5_gg(c, d, a, b, x[i+ 3], 14, -187363961);
    b = md5_gg(b, c, d, a, x[i+ 8], 20,  1163531501);
    a = md5_gg(a, b, c, d, x[i+13], 5 , -1444681467);
    d = md5_gg(d, a, b, c, x[i+ 2], 9 , -51403784);
    c = md5_gg(c, d, a, b, x[i+ 7], 14,  1735328473);
    b = md5_gg(b, c, d, a, x[i+12], 20, -1926607734);

    a = md5_hh(a, b, c, d, x[i+ 5], 4 , -378558);
    d = md5_hh(d, a, b, c, x[i+ 8], 11, -2022574463);
    c = md5_hh(c, d, a, b, x[i+11], 16,  1839030562);
    b = md5_hh(b, c, d, a, x[i+14], 23, -35309556);
    a = md5_hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
    d = md5_hh(d, a, b, c, x[i+ 4], 11,  1272893353);
    c = md5_hh(c, d, a, b, x[i+ 7], 16, -155497632);
    b = md5_hh(b, c, d, a, x[i+10], 23, -1094730640);
    a = md5_hh(a, b, c, d, x[i+13], 4 ,  681279174);
    d = md5_hh(d, a, b, c, x[i+ 0], 11, -358537222);
    c = md5_hh(c, d, a, b, x[i+ 3], 16, -722521979);
    b = md5_hh(b, c, d, a, x[i+ 6], 23,  76029189);
    a = md5_hh(a, b, c, d, x[i+ 9], 4 , -640364487);
    d = md5_hh(d, a, b, c, x[i+12], 11, -421815835);
    c = md5_hh(c, d, a, b, x[i+15], 16,  530742520);
    b = md5_hh(b, c, d, a, x[i+ 2], 23, -995338651);

    a = md5_ii(a, b, c, d, x[i+ 0], 6 , -198630844);
    d = md5_ii(d, a, b, c, x[i+ 7], 10,  1126891415);
    c = md5_ii(c, d, a, b, x[i+14], 15, -1416354905);
    b = md5_ii(b, c, d, a, x[i+ 5], 21, -57434055);
    a = md5_ii(a, b, c, d, x[i+12], 6 ,  1700485571);
    d = md5_ii(d, a, b, c, x[i+ 3], 10, -1894986606);
    c = md5_ii(c, d, a, b, x[i+10], 15, -1051523);
    b = md5_ii(b, c, d, a, x[i+ 1], 21, -2054922799);
    a = md5_ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
    d = md5_ii(d, a, b, c, x[i+15], 10, -30611744);
    c = md5_ii(c, d, a, b, x[i+ 6], 15, -1560198380);
    b = md5_ii(b, c, d, a, x[i+13], 21,  1309151649);
    a = md5_ii(a, b, c, d, x[i+ 4], 6 , -145523070);
    d = md5_ii(d, a, b, c, x[i+11], 10, -1120210379);
    c = md5_ii(c, d, a, b, x[i+ 2], 15,  718787259);
    b = md5_ii(b, c, d, a, x[i+ 9], 21, -343485551);

    a = safe_add(a, olda);
    b = safe_add(b, oldb);
    c = safe_add(c, oldc);
    d = safe_add(d, oldd);
  }
  return Array(a, b, c, d);
}

function md5_cmn(q, a, b, x, s, t)
{
  return safe_add(bit_rol(safe_add(safe_add(a, q), safe_add(x, t)), s),b);
}
function md5_ff(a, b, c, d, x, s, t)
{
  return md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function md5_gg(a, b, c, d, x, s, t)
{
  return md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function md5_hh(a, b, c, d, x, s, t)
{
  return md5_cmn(b ^ c ^ d, a, b, x, s, t);
}
function md5_ii(a, b, c, d, x, s, t)
{
  return md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
}

function safe_add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}

function bit_rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * END OF HASH
 */