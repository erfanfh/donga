const input = document.getElementById('tag-input');
const container = document.getElementById('tag-container');

input.addEventListener('keydown', (event) => {
    if (event.key === 'Tab' && input.value.trim() !== '') {
        event.preventDefault();
        createTag(input.value.trim());
        input.value = '';
    }
});

function createTag(text) {
    const tag = document.createElement('span');
    tag.classList.add('bg-gray-200', 'px-2', 'py-1', 'rounded', 'text-sm', 'mr-1', 'mb-1');
    tag.classList.add('stored-tag');
    tag.textContent = text;

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('ml-1', 'text-gray-500', 'hover:text-gray-700');
    removeBtn.textContent = '×';
    removeBtn.onclick = () => tag.remove();

    tag.appendChild(removeBtn);
    container.insertBefore(tag, input);
}

document.getElementById('submit').addEventListener('click', function () {
    const spans = document.querySelectorAll('.stored-tag');
    let spanValues = [];

    spans.forEach(span => {
        spanValues.push(span.textContent);
    });

    document.getElementById('tag-input').value = JSON.stringify(spanValues);
});
