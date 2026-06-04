// Validação do formulário

const firstnameForm = document.querySelector("#firstname");
const emailForm = document.querySelector("#email");

const formActive = document.querySelector(".form-inscricao");

const isRequired = (value) => (value === "" ? false : true);

const isEmailValid = (email) => {
    const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const showError = (input, message) => {
    const formField = input.parentElement;

    formField.classList.remove("sucesso");
    formField.classList.add("erro");

    const erro = formField.querySelector("small");
    erro.textContent = message;
};

const showSuccess = (input) => {
    const formField = input.parentElement;

    formField.classList.remove("erro");
    formField.classList.add("sucesso");

    const error = formField.querySelector("small");
    error.textContent = "";
};

const checkFirstname = () => {
    let valid = false;
    const firstname = firstnameForm.value.trim();

    if (!isRequired(firstname)) {
        showError(firstnameForm, "Seu primeiro nome não pode ser vazio.");
    } else {
        showSuccess(firstnameForm);
        valid = true;
    }
    return valid;
};

const checkEmail = () => {
    let valid = false;
    const email = emailForm.value.trim();

    if (!isRequired(email)) {
        showError(emailForm, "Seu e-mail não pode ser vazio.");
    } else if (!isEmailValid(email)) {
        showError(emailForm, "O e-mail digitado não é válido.");
    } else {
        showSuccess(emailForm);
        valid = true;
    }
    return valid;
};

formActive.addEventListener(
    "input",
    debounce(function (e) {
        switch (e.target.id) {
            case "firstname":
                checkFirstname();
                break;
            case "email":
                checkEmail();
                break;
        }
    })
);

formActive.addEventListener("submit", function (e) {
    e.preventDefault();

    let isFirstnameValid = checkFirstname(),
        isEmailValid = checkEmail();

    let isFormValid = isFirstnameValid && isEmailValid;

    if (isFormValid) {
        formActive.submit();
    }
});
