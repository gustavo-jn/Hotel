<script src="https://cdn.tiny.cloud/1/51bmktq3tktmw6nhwzhoxlhjkuk3qkanx5j1adpchrmk5c2i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
  tinymce.init({
    selector: 'textarea', // aplica em todas as <textarea>
    height: 300,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table help wordcount'
    ],
    toolbar: 'undo redo | bold italic underline | bullist numlist | alignleft aligncenter alignright alignjustify | link | removeformat',
    branding: false,
    language: 'pt_BR',
    setup: function (editor) {
      editor.on('change', function () {
        editor.save(); // garante que o conteúdo vá para o textarea no submit
      });
    }
  });
</script>
