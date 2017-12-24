var radios = document.querySelectorAll('.answers');
var input = document.querySelector('#other');
var other = document.querySelector('input[value="Другое"]');

for (var i = 0; i < radios.length; i++) {
    radios[i].addEventListener('click', function () {
        if (other.checked) {
            input.attributes.removeNamedItem('disabled');
            input.style.visibility = 'visible';
            input.focus();
        } else {
            input.style.visibility = 'hidden';
            input.setAttribute('disabled', true);
        }
    });
}