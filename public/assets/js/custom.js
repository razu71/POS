function readURL(input,name) {
    console.log(name);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#'+name).css('display','block');
            $('#'+name).attr('src', e.target.result)
                .width(50)
                .height(50);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function removeImage(name) {
    $('#'+name).css('display','none');
}