
function resetForm(formid){
    $(formid).trigger('reset');
    $(formid+" #details").text("");
    $(formid+" #title").text("");
    $(formid+" #id").val(0);
    $(formid+" #details").summernote('code', '');
}

function resetStatesForm(formid){
    $(formid).trigger('reset');
    $(formid+" #contact_email").val("");
    $(formid+" #team_code").val("");
    $(formid+" #team_name").val("");
    $(formid+" #id").val(0);
}