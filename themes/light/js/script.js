function initializeEditableText(textContainer, editorContainer, editor, saveButton) {
  // Отримуємо елементи DOM
  var textContainerElement = document.getElementById(textContainer);
  var editorContainerElement = document.getElementById(editorContainer);
  var editorElement = document.getElementById(editor);
  var saveButtonElement = document.getElementById(saveButton);

  // Обробник події при натисканні на елемент textContainer
  textContainerElement.addEventListener('click', function() {
    // Приховуємо елемент textContainer
    textContainerElement.style.display = 'none';

    // Відображаємо елемент editorContainer
    editorContainerElement.style.display = 'block';

    // Фокусуємося на полі для вводу тексту
    editorElement.focus();
  });

  // Обробник події при натисканні на кнопку Зберегти
  saveButtonElement.addEventListener('click', function() {
    // Отримуємо введений текст
    var content = editorElement.value;

    // Оновлюємо вміст елемента displayText
    displayText.innerHTML = content;

    // Приховуємо елемент editorContainer
    editorContainerElement.style.display = 'none';

    // Відображаємо елемент textContainer
    textContainerElement.style.display = 'block';

    // Очищуємо поле для вводу тексту
    editorElement.value = '';
  });
}

   // Виклик функції для ініціалізації редагованого тексту
   initializeEditableText('textContainer', 'editorContainer', 'editor', 'saveButton');