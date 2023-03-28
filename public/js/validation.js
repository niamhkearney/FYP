
function check_delete() {
    let text = "Are you sure you want to delete this image?";
    if (confirm(text) === true) {
        let form = document.getElementById("delete_upload");
        form.submit();
    }
}

function empty_comment() {
    let form = document.getElementById("comment_form");

    if(!form.checkValidity()) {
        form.classList.add('was-validated');
    } else {
        form.submit();
    }
}
