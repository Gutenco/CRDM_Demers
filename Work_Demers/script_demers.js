
let count = 5;

for (let i = 1; i <= count; i++) {
    let formGroup = `
      <div class="form-group">
        <span>${i}. </span>
        <label> denumirea: </label>
        <label> <input type="text" name="request-name"> </label>
        <label>cantitatea: </label>
        <label> <input type="number" name="quantity"> </label>
        <label>buc. </label>
          <div class="delete-container">
            <button class="btn btn-outline-danger delete-btn btn-sm">
              <i class="bi bi-trash3"></i>
            </button>
          </div>
      </div>
    `;
    $("#inputs").append(formGroup);
}

/*-----------------alert-message-------------------------------------*/
function showAlert(message, type = "info", timeout = 3000) {
    const alert = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
    $("#alert-container").append(alert);
    setTimeout(function() {
        $(".alert").alert("close");
    }, timeout);
}

/*-------------------------------------------------------------*/

function addInput() {
    if (count < 18) {
        count++;
        let formGroup = `
            <div class="form-group">
                <span>${count}. </span>
                <label> denumirea: </label>
                <label> <input type="text" name="request-name"> </label>
                <label>cantitatea: </label>
                <label> <input type="number" name="quantity"> </label>
                <label>buc. </label>

                <div class="delete-container">
                    <button class="btn btn-outline-danger delete-btn btn-sm">
                        <i class="bi bi-trash3"></i>
                    </button>
                </div>
            </div>
        `;
        $("#inputs").append(formGroup);
        $(".form-group:last").hide().slideDown(150);
    } else {
        // display an error message or disable the add button
        showAlert("You cannot add more than 18 input fields", "warning");
    }
}

/*-------------------------------------------------------------*/

$(document).on("click", ".delete-btn", function (event) {
    event.preventDefault();
    let formGroup = $(this).closest(".form-group");
    formGroup.animate({
        height: 0,
        opacity: 0.8
    }, 150, function () {
        formGroup.remove();
        let formGroups = $(".form-group");
        for (let i = 0; i < formGroups.length; i++) {
            $(formGroups[i]).find("span").text(`${i + 1}. `);
        }
        count--;
    });
});

/*------------------datepicker----------------------*/
flatpickr("#datepicker", {
    dateFormat: "d/m/Y",
    defaultDate: new Date(),
});

/*--------------------menu------------------------*/

const navBar = document.querySelector("nav"),
    menuBtns = document.querySelectorAll(".menu-icon"),
    overlay = document.querySelector(".overlay");

menuBtns.forEach((menuBtn) => {
    menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
    });
});

overlay.addEventListener("click", () => {
    navBar.classList.remove("open");
});

/*-------------------------pdf save---------------------------*/

function generatePDF() {
    // Hide the delete containers
    $('.delete-container').hide();
    $('.buttons-container').hide();


    // Clone the #no-border-content element and copy its styles and properties
    const contentClone = $('#no-border-content').clone();
    contentClone.css({
        'border': 'none',
        'position': 'absolute',
        'left': 0,
        'top': 0

    });
    $('body').append(contentClone);

    html2canvas(contentClone.get(0)).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const pdf = new pdfMake.createPdf({
            content: [
                {
                    image: imgData,
                    width: 595 // A4 page width in points
                }
            ],
            pageSize: "A4",
            pageOrientation: "portrait",
            pageMargins: [0, 0, 0, 0],
            styles: {
                content: {
                    backgroundColor: '#ffffff'

                }
            }
        });
        pdf.download("form.pdf");

        // Remove the cloned element
        contentClone.remove();


        $('.delete-container').show();
        $('.buttons-container').show();
    });
}


/*---------alert----------*/

setTimeout(function () {

    // Closing the alert
    $('.alert').alert('close');
}, 3000);

