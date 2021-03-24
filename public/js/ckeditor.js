if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
  CKEDITOR.tools.enableHtml5Elements(document);
var initEditor = (function () {
  var wysiwygareaAvailable = isWysiwygareaAvailable()

  return function () {
    var editorElement = CKEDITOR.document.getById('editor');

    if (wysiwygareaAvailable) {
      CKEDITOR.replace('editor');
    } else {
      editorElement.setAttribute('contenteditable', 'true');
      CKEDITOR.inline('editor');
    }
  };

  function isWysiwygareaAvailable() {
    return !!CKEDITOR.plugins.get('wysiwygarea');
  }
})();