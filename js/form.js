
var stack = {
    _answers: new Set(),
    get answers() {
        return this._answers;
    },
    get size() {
        return this._answers.size;
    },
    clear: function() {
        this._answers.clear();
    },
    add: function(data) {
        this._answers.add(data);
    },
    delete: function(data) {
        this._answers.delete(data);
    }
};

var radios = document.querySelectorAll('.answers');
var labels = document.querySelectorAll('label');
var input = document.querySelector('#other');
var other = document.querySelector('input[value="Другое"]');
var submit = document.querySelector('.submit');
var form = document.querySelector('.form');

var complexCheck = function () {
    if (other.checked) {
        input.removeAttribute('disabled');
        input.style.visibility = 'visible';
        input.focus();
    } else {
        input.style.visibility = 'hidden';
        input.setAttribute('disabled', true);
    }

    if (stack.size > 0) {
        submit.style.visibility = 'visible';
    } else {
        submit.style.visibility = 'hidden';
    }
};

for (var i = 0; i < radios.length; i++) {
    radios[i].addEventListener('click', function (evt) {
        evt.currentTarget.nextElementSibling.blur();
        if(stack.size >= 3) {
            evt.currentTarget.checked = false;
        }

        if(evt.currentTarget.type === 'radio') {
            if (evt.currentTarget.checked) {
                stack.clear();
                stack.add(evt.currentTarget.id);
            } else if (!evt.currentTarget.checked) {
                stack.delete(evt.currentTarget.id);
            }
        } else if (evt.currentTarget.type === 'checkbox') {
            if (evt.currentTarget.checked) {
                stack.add(evt.currentTarget.id);
            } else if (!evt.currentTarget.checked) {
                stack.delete(evt.currentTarget.id);
            }
        }

        complexCheck();
    });
}

form.addEventListener('submit', function () {
   stack.clear();
});

for (var j = 0; j < labels.length; j++) {
    labels[j].addEventListener('keydown', function (evt) {
        if (evt.keyCode === 32) {
            if(evt.currentTarget.previousElementSibling.type === 'checkbox') {
                evt.currentTarget.previousElementSibling.checked = !evt.currentTarget.previousElementSibling.checked;
            } else if (evt.keyCode === 32 && evt.currentTarget.previousElementSibling.type === 'radio') {
                evt.currentTarget.previousElementSibling.checked = true;
            }

            if (stack.size >= 3) {
                evt.currentTarget.previousElementSibling.checked = false;
            }

            if(evt.currentTarget.previousElementSibling.type === 'radio') {
                if (evt.currentTarget.previousElementSibling.checked) {
                    stack.clear();
                    stack.add(evt.currentTarget.previousElementSibling.id);
                    console.log(stack.size);
                } else if (!evt.currentTarget.previousElementSibling.checked) {
                    stack.delete(evt.currentTarget.previousElementSibling.id);
                    console.log(stack.size);
                }
            } else if (evt.currentTarget.previousElementSibling.type === 'checkbox') {
                if (evt.currentTarget.previousElementSibling.checked) {
                    stack.add(evt.currentTarget.previousElementSibling.id);
                    console.log(stack.size);
                } else if (!evt.currentTarget.previousElementSibling.checked) {
                    stack.delete(evt.currentTarget.previousElementSibling.id);
                    console.log(stack.size);
                }
            }

        }
        complexCheck();
    });
}