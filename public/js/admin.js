function duplicateAddFileBlock(t) {
    $obj = $(t).parent();
    $new = $obj.clone();
    $(t).remove();
    $obj.after($new);
}

function removeUploadedFile(t) {
    $(t).parent().remove();
}