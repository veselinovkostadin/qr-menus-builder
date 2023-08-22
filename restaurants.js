let form = document.getElementById('addform');
let restname = document.getElementById('restname');
let wifi = document.getElementById('wifipassword');
let phonenumber = document.getElementById('phonenumber');
let address = document.getElementById('addaddress');
let food = document.getElementById("food");
let drink = document.getElementById("drink");
let both = document.getElementById("both");
let mkd = document.getElementById("mkd");
let eng = document.getElementById("eng");


form.addEventListener("submit", function (e) {
    e.preventDefault();
    
    if (validateInputs()) {
        form.submit();
    }
}

);




function validateInputs() {
    let valid = true;
    const nameValue = restname.value;
    const WifiPASSWORD = wifi.value;
    const PHONENUMBER = phonenumber.value;
    const AddressVALUE = address.value;
    const FOOD = food.value;


    if (nameValue === "") {
        setError(restname, "This is a required field");
        valid = false;
    } else if (nameValue.length < 3) {    
        setError(restname, "Restaurant name should be at least 3 characters long");
        valid = false;
    } else {
        setSucces(restname);
    }

    if (WifiPASSWORD === "") {
        setError(wifi, "This is a required field");
        valid = false;
    } else if (WifiPASSWORD.length < 8) {
        setError(wifi, "Wifi password should be at least 3 characters long");
        valid = false;
    } else {
        setSucces(wifi);
    }

    if (PHONENUMBER === "") {
        setError(phonenumber, "This is a required field");
        valid = false;
    } else {
        setSucces(phonenumber);
    }
    if (AddressVALUE === "") {
        setError(address, "This is a required field");
        valid = false;
    } else {
        setSucces(address);
    }
    if (food.checked || drink.checked || both.checked) {
        setSucces(food);      
    } else {
        setError(food, "You must choose between these categories");
        valid = false;
    }
    if (eng.checked || mkd.checked) {
        setSucces(eng);      
    } else {
        setError(eng, "You must choose at least one language");
        valid = false;
    }

    return valid;
}


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
    // console.log(errorDisplay.value);
    errorDisplay.innerText = "";
    inputControl.classList.add("success");
    inputControl.classList.remove("error");
};