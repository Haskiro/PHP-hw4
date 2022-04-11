const btns = document.querySelectorAll(".calc__button");
const btnValues = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '(', ')', '+', '-', '*', '/'];
const input = document.querySelector(".calc__input");

for (let i = 0; i < btns.length - 2; i++) {
    btns[i].addEventListener("click", function() {
        input.value += btnValues[i];
    })
}

btns[btns.length - 3].addEventListener("click", () => {
    input.value = '';
})

btns[btns.length - 2].addEventListener("click", () => {
    input.value = input.value.slice(0, -1);
})
