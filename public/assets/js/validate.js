/**
 * PHP Email Form Validation - v3.1
 * URL: https://bootstrapmade.com/php-email-form/
 * Author: BootstrapMade.com
 */
(function () {
  "use strict";

  let forms = document.querySelectorAll(".php-email-form");

  forms.forEach(function (e) {
    e.addEventListener("submit", function (event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute("action");
      let recaptcha = thisForm.getAttribute("data-recaptcha-site-key");

      if (!action) {
        displayError(thisForm, "The form action property is not set!");
        return;
      }
      // thisForm.querySelector(".loading").classList.add("d-block");
      // thisForm.querySelector(".error-message").classList.remove("d-block");
      // thisForm.querySelector(".sent-message").classList.remove("d-block");

      let formData = new FormData(thisForm);

      if (recaptcha) {
        if (typeof grecaptcha !== "undefined") {
          grecaptcha.ready(function () {
            try {
              grecaptcha
                .execute(recaptcha, { action: "php_email_form_submit" })
                .then((token) => {
                  formData.set("recaptcha-response", token);
                  php_email_form_submit(thisForm, action, formData);
                });
            } catch (error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(
            thisForm,
            "The reCaptcha javascript API url is not loaded!"
          );
        }
      } else {
        php_email_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    $.ajax({
      url: action,
      method: "POST",
      enctype: "multipart/form-data",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data, textStatus) {
        if (data.param > 0) {
          thisForm.reset();
          Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "Terima kasih atas saran dan masukanya.",
          });
        } else {
          var pesan = "";
          Object.keys(data.pesan).forEach(function (key) {
            pesan += data.pesan[key] + ", ";
          });
          Swal.fire({
            icon: "error",
            title: "Kesalahan !",
            text: pesan,
          });
        }
        // console.log(data);
        // console.log(textStatus);
      },
      error: function (jqXhr, textStatus, errorMessage) {
        // console.log(textStatus)
        // console.log(errorMessage)
        // console.log(jqXhr.responseJSON.message)
        Swal.fire({
          icon: "error",
          title: jqXhr.statusText,
          text: jqXhr.responseJSON.message,
        });
      },
    });
  }
})();
