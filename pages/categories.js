let form = document.getElementById("form");




form.addEventListener("submit", function (e) {

    let name = document.getElementById("categoryname");
    e.preventDefault();
    if (name.value.length >= 3) {
        form.submit();
    } else {
        document.getElementById('error').innerText = 'Category name should be at least three characters';
        return false;
    }
  
});