 function checkmysqlconnection(host, user, password) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/checkmysqlconnection",
        data: {hostname: host, username: user, password: password},
        cache: false,
        success: function (result) {
            return result;
        }});
}

function getStates(id) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getStates",
        data: {id: id},
        cache: false,
        success: function (result) {
            $("#state_id").html(result);
            $("#state_id").selectpicker('refresh');
        }});
}

function getDeanaries(id, role) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getDeanaries",
        data: {id: id, role: role},
        cache: false,
        success: function (result) {
            $("#deanaries").html(result);
        }});

}

function getDeanarieslist(id) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getDeanarieslist",
        data: {id: id},
        cache: false,
        success: function (result) {
            $("#deanary_id").html(result);
            $("#deanary_id").selectpicker('refresh');
        }});

}

function getParishes(deanary_id = null, diocese_id = null, role) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getParishes",
        data: {deanary_id: deanary_id, diocese_id: diocese_id, role: role},
        cache: false,
        success: function (result) {
            $("#parishes").html(result);
        }});
}

function getLogins(target_id, role, role_name) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getLogins",
        data: {target_id: target_id, role: role, role_name: role_name},
        cache: false,
        success: function (result) {
            $("#logins").html(result);
        }});
}

function getLastLogins(user_id) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getLastLogins",
        data: {mlogin_id: user_id},
        cache: false,
        success: function (result) {
            $("#lastlogins").html(result);
        }});
}

function getFamilies(scc) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getFamilies",
        data: {id: scc},
        cache: false,
        success: function (result) {
            $("#family_id").html(result);
            $("#family_id").selectpicker('refresh');
        }});
}

function getAddress(family, op) {
    var base_url = window.location.origin;
    $.ajax({
        type: "POST",
        url: base_url + "/ParishManager/getFamilyAddress",
        data: {id: family, op: op},
        success: function (result) {
            var data = JSON.parse(result);
            $("#addressline1").val(data['family']['addressline1']);
            $("#addressline2").val(data['family']['addressline2']);
            $("#city").val(data['family']['city']);
            $("#country_id").html(data['country']);
            $("#country_id").selectpicker('refresh');
            $("#state_id").html(data['state']);
            $("#state_id").selectpicker('refresh');
            $("#pincode").val(data['family']['pincode']);
        }});
}

function changeTheme(theme_id, login_id) {
    var base_url = window.location.origin;
    swal({
        title: "Apply New Theme?",
        text: "Note:- This process will log you out.",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
    }, function () {
        window.location = base_url + "/ParishManager/parish/settheme?user_id=" + login_id + "&theme_id=" + theme_id;
    });
}