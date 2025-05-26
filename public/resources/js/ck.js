function createCKEditor(id) {
     const {
         ClassicEditor,
         Essentials,
         Bold,
         Italic,
         Font,
         Paragraph
     } = CKEDITOR;

     ClassicEditor
         .create(document.querySelector(id), {
             licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDkxNjc5OTksImp0aSI6ImRlYzcyNTZjLWM3OGItNDE2OS04YmNiLTUzOWJmNzdhZTAxOCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImQyOGU1NjUyIn0.mmAvIRIeZbY6ubaV7nbFDcAJJ8A9lAT7jWZhCinTmF041N3bmKHLoehEhw4TexJ0TD098Zl8jJK-VMuDUDwfWQ',
             plugins: [Essentials, Bold, Italic, Font, Paragraph],
             toolbar: [
                 'undo', 'redo', '|', 'bold', 'italic', '|',
                 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
             ]
         })
         .then()
         .catch( /* ... */ );
}
createCKEditor("#editor");
