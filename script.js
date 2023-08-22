document.addEventListener("DOMContentLoaded", () => {
  let moreBtn = document.querySelector("#moreBtn");
  let counter = 0;
  let form = document.querySelector("form");
  let allinputs = document.getElementsByTagName("input");

  moreBtn.addEventListener("click", () => {
    counter++;
    let input = document.createElement("input");
    let label = document.createElement("label");
    label.innerHTML += `<label for='category${counter}' class='form-label'>Category ${counter}:</label>`;
    input.setAttribute("text", "text");
    input.setAttribute("class", "form-control");
    input.setAttribute("placeholder", "Enter category");
    input.setAttribute("name", `category${counter}`);
    input.setAttribute("id", `category${counter}`);
    input.setAttribute("required", "");
    form.appendChild(label);
    form.appendChild(input);
  });

  const errorMsg = document.getElementById("errorMsg");

  // validacija za da ne se submitira dokolku ima pod 2 karakteri
  form.addEventListener("submit", function (e) {
    let canSubmit = true;
    e.preventDefault();
    for (let i = 0; i < allinputs.length; i++) {
      if (allinputs[i].value.length < 2) {
        e.preventDefault();
        showError("Too short name category!");
        canSubmit = false;
      }
    }

    if (canSubmit) {
      let modalList = document.getElementById("modalList");
      modalList.innerHTML = "";
      for (let i = 0; i < allinputs.length; i++) {
        modalList.innerHTML += "<li>" + allinputs[i].value + "</li>";
      }
      var myModal = new bootstrap.Modal(document.getElementById("myModal"), {
        backdrop: true,
        keyboard: true,
        focus: true,
      });
      myModal.toggle();

      document.querySelector("#myModal #submit").onclick = () => {
        form.submit();
        document
          .querySelector("body")
          .appendChild(showSuccess("Successfully added new category."));
      };
    }
  });

  function showError(string) {
    let errorDiv = document.createElement("div");
    errorDiv.innerHTML = `<div class='container-lg mt-2 top-0' id='errorMsg'>
    <div class='alert alert-danger d-flex align-items-center' role='alert'>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle mx-2" viewBox="0 0 16 16">
  <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
  <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
</svg>
        <div>
            ${string}
        </div>
    </div>
</div>`;

    document.querySelector("body").appendChild(errorDiv);
  }

  function showSuccess(string) {
    let successDiv = document.createElement("div");
    successDiv.innerHTML = `<div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-bs-delay="10000">
        <div role="alert" aria-live="assertive" aria-atomic="true">${string}</div>
      </div>`;
    return successDiv;
  }
});
