let editform = document.getElementById('editform');
let editproductname = document.getElementById('editname');
let editdescription = document.getElementById('editdescription');
let editprice = document.getElementById('editprice');



editform.addEventListener("submit", function (e) {
    e.preventDefault();

    if (validateEditInputs()) {
        editform.submit();
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

function validateEditInputs() {
    let valid = true;
    const PRODUCTNAMEVALUE = editproductname.value;
    const DESCRIPTIONVALUE = editdescription.value;
    const PRICEVALUE = editprice.value;


    if (PRODUCTNAMEVALUE === "") {
        setError(editproductname, "This is a required field");
        valid = false;
    } else if (PRODUCTNAMEVALUE.length < 3) {
        setError(editproductname, "Product name should be at least 3 characters long");
        valid = false;
    } else {
        setSucces(editproductname);
    }

    if (DESCRIPTIONVALUE === "") {
        setError(editdescription, "This is a required field");
        valid = false;
    } else if (DESCRIPTIONVALUE.length < 10) {
        setError(
            editdescription,
            "Description must be at least 10 charachters"
        );
        valid = false;
    } else {
        setSucces(editdescription);
    }

    if (PRICEVALUE === "") {
        setError(editprice, "This is a required field");
        valid = false;
    } else {
        setSucces(editprice);
    }

    return valid;
}
