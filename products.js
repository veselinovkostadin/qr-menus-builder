let form = document.getElementById('form');
let productname = document.getElementById('name');
let description = document.getElementById('description');
let price = document.getElementById('price');



form.addEventListener("submit", function (e) {
    e.preventDefault();

    if (validateInputs()) {
        form.submit();
    }
}

);


const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");

    errorDisplay.innerText = message;
    inputControl.classList.add("error");
    inputControl.classList.remove("success");
};

const setSucces = (element) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");

    errorDisplay.innerText = "";
    inputControl.classList.add("success");
    inputControl.classList.remove("error");
};

function validateInputs() {
    let valid = true;
    const nameValue = productname.value;
    const PriceValue = price.value;


    if (nameValue === "") {
        setError(productname, "This is a required field");
        valid = false;
    } else if (nameValue.length < 3) {
        setError(productname, "Product name should be at least 3 characters long");
        valid = false;
    } else {
        setSucces(productname);
    }


    if (PriceValue === "") {
        setError(price, "This is a required field");
        valid = false;
    } else {
        setSucces(price);
    }

    return valid;
}



