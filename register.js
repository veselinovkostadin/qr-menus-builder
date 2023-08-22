let registerPassword = document.getElementById("password");
let confirmPassword = document.getElementById("password1");
let form = document.getElementById("registerForm");
let registerName = document.getElementById("name");
let registerSurname = document.getElementById("surname");
let registerEmail = document.getElementById("email");

// form.addEventListener("submit", function (e) {
//   e.preventDefault();

//   //   console.log(registerPassword.value);
//   //   console.log(confirmPassword.value);

//
//   let allDiv = document.querySelectorAll("#registerForm div");

//   const errors = [];

//   let nameError = document.createElement("p");
//   if (registerName.value.length < 3) {
//     nameError.innerHTML =
//       "<p style='color:red;'>*First Name should be at least 3 characters long</p>";
//     allDiv[0].appendChild(nameError);
//   } else {
//     nameError.style.display = "none";
//   }

//   if (registerSurname.value.length < 3) {
//     let surnameError = document.createElement("p");
//     surnameError.innerHTML =
//       "<p style='color:red;'>*Last Name should be at least 3 characters long</p>";

//     allDiv[1].appendChild(surnameError);
//   }

//   if (registerPassword.value.length < 8) {
//     let registerPassError = "Password should be at least 8 characters long";
//     errors.push(registerPassError);
//   }

//   if (registerPassword.value !== confirmPassword) {
//     let passwordsError = "Passwords do not match each other";
//     errors.push(passwordsError);
//   }

//   if (errors.length != 0) {
//     e.preventDefault();
//     printMessages(errors);
//   }
// });

// form.addEventListener("submit", function (e) {
//   e.preventDefault();

//   validateInputs();

// });

// const form = document.querySelector("form");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  if (validateInputs()) {
    form.submit();
  }
});

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
  const nameValue = registerName.value;
  const surnameValue = registerSurname.value;
  const emailValue = registerEmail.value;
  const passwordValue = registerPassword.value;
  const confirmPasswordValue = confirmPassword.value;

  if (nameValue === "") {
    setError(registerName, "*This is a required field");
    valid = false;
  } else if (nameValue.length < 3) {
    setError(registerName, "*First Name should be at least 3 characters long");
    valid = false;
  } else {
    setSucces(registerName);
  }

  if (surnameValue === "") {
    setError(registerSurname, "*This is a required field");
    valid = false;
  } else if (surnameValue.length < 3) {
    setError(
      registerSurname,
      "*Last Name should be at least 3 characters long"
    );
    valid = false;
  } else {
    setSucces(registerSurname);
  }

  if (emailValue === "") {
    setError(registerEmail, "This is a required field");
    valid = false;
  } else {
    setSucces(registerEmail);
  }

  if (passwordValue === "") {
    setError(registerPassword, "*This is a required field");
    valid = false;
  } else if (passwordValue.length < 8) {
    setError(
      registerPassword,
      "*Password should be at least 8 characters long"
    );
    valid = false;
  } else {
    setSucces(registerPassword);
  }

  if (confirmPasswordValue === "") {
    setError(confirmPassword, "*This is a required field");
    valid = false;
  } else if (passwordValue !== confirmPasswordValue) {
    setError(confirmPassword, "*Passwords are not matching with each other");
    valid = false;
  } else {
    setSucces(confirmPassword);
  }

  return valid;
}
