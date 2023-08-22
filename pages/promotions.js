let form = document.getElementById("addform");
let addname = document.getElementById("addname");
let discount = document.getElementById("adddiscount");
let start_date = document.getElementById("addstart_date");
let end_date = document.getElementById("addend_date");
let editname = document.getElementById("editname");
let editform = document.getElementById("editform");
let editdiscount = document.getElementById("editdiscount");
let editstart_date = document.getElementById("editstart_date");
let editend_date = document.getElementById("editend_date");

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
    const nameValue = addname.value;
    const DiscountValue = discount.value;
    const startdate = start_date.value;
    const endate = end_date.value;

    if (nameValue === "") {
        setError(addname, "This is a required field");
        valid = false;
    } else if (nameValue.length < 3) {
        setError(addname, "Promotion name should be at least 3 characters long");
        valid = false;
    } else {
        setSucces(addname);
    }

    if (DiscountValue === "") {
        setError(discount, "This is a required field");
        valid = false;
    } else if (DiscountValue < 5) {
        setError(
            discount,
            "Discount must be at least 5%"
        );
        valid = false;
    } else {
        setSucces(discount);
    }

    if (startdate === "") {
        setError(start_date, "This is a required field");
        valid = false;
    } else {
        setSucces(start_date);
    }

    if (endate === "") {
        setError(end_date, "This is a required field");
        valid = false;

    } else {
        setSucces(end_date);
    }

    return valid;
}



editform.addEventListener("submit", function (e) {
    e.preventDefault();

    if (validateEditInputs()) {

        editform.submit();
    }
}

);

function validateEditInputs() {
    let valid = true;
    const EDITNAME = editname.value;
    const EDITDISCOUNT = editdiscount.value;
    const EDITSTARTDATE = editstart_date.value;
    const EDITENDDATE = editend_date.value;

    if (EDITNAME === "") {
        setError(editname, "This is a required field");
        valid = false;
    } else if (EDITNAME.length < 3) {
        setError(editname, "Promotion name should be at least 3 characters long");
        valid = false;
    } else {
        setSucces(editname);
    }

    if (EDITDISCOUNT === "") {
        setError(editdiscount, "This is a required field");
        valid = false;
    } else if (EDITDISCOUNT < 5) {
        setError(
            editdiscount,
            "Discount must be at least 5%"
        );
        valid = false;
    } else {
        setSucces(editdiscount);
    }

    if (EDITSTARTDATE === "") {
        setError(editstart_date, "This is a required field");
        valid = false;
    } else {
        setSucces(editstart_date);
    }

    if (EDITENDDATE === "") {
        setError(editend_date, "This is a required field");
        valid = false;

    } else {
        setSucces(editend_date);
    }

    return valid;
}


// console.log(editdiscount.value);










// form.addEventListener("submit", function (e) {
//     e.preventDefault();

//     if (validateInputs()) {
//         form.submit();
//     }
// }

// );



