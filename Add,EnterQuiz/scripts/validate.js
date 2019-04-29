const form = document.querySelector('form');
const inputs = document.querySelectorAll('input,textarea');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let shouldSubmit = true;
    inputs.forEach((input) => {
        if (!input.value.length) {
            input.classList.add('error');
            shouldSubmit = false;
        }
    });
    if (shouldSubmit) form.submit();
});

inputs.forEach((input) => {
    input.addEventListener('input', () => {
        input.classList.remove('error');
    });
});
