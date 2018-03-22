tinymce.init({
    menubar : false,
    selector: "textarea",
    height: 500,
    plugins: [
        "link image code fullscreen imageupload",
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    ],
    toolbar: "undo redo  | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | imageupload | code",
    imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
    relative_urls: false
});