const ratingInputs = document.querySelectorAll('.rating input');
const valoracionText = document.querySelector('#valoracion-text');

ratingInputs.forEach(input => {
    input.addEventListener('change', () => {
        valoracionText.textContent = input.value;
    });
});