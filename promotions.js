// za kaj produktite checkbox-ot
function promotions(checkbox) {

    let promotionDiv = checkbox.nextElementSibling;

    if (checkbox.checked) {
        promotionDiv.style.display = "inline-block";
    } else {
        promotionDiv.style.display = "none";
    }

}
