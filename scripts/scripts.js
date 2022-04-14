const btns = document.querySelectorAll(".calc__button");
const btnValues = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '(', ')', '+', '-', '*', '/'];
const input = document.querySelector(".calc__input");

input.value = res;

for (let i = 0; i < btns.length - 7; i++) {
    btns[i].addEventListener("click", function() {
        if ('+-/*()'.includes(btnValues[i]) || '+-/*()'.includes(input.value[input.value.length - 1])) {
            input.value += ' ' + btnValues[i];
        } else {
            input.value += btnValues[i];
        }
    })
}

for (let i = btns.length - 7; i < btns.length - 3; i++) {
    btns[i].addEventListener("click", function() {
        if ('+-/*'.includes(input.value[input.value.length - 1]) || input.value.length == 0) {
            input.value += '';
        } else {
            input.value += ' ' + btnValues[i];
        }
    })
}

btns[btns.length - 3].addEventListener("click", () => {
    input.value = '';
})

btns[btns.length - 2].addEventListener("click", () => {
    if (input.value[input.value.length - 2] == ' ') {
        input.value = input.value.slice(0, -2);
    } else {
        input.value = input.value.slice(0, -1);
    }
    
})
