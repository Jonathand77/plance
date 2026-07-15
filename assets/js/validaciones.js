document.addEventListener("DOMContentLoaded", function () {
  const toggleIcon = document.getElementById("toggleIcon");
  const input = document.getElementById("registerPassword");

  if (toggleIcon && input) {
    toggleIcon.addEventListener("click", function () {
      if (input.type === "password") {
        input.type = "text";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
      } else {
        input.type = "password";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
      }
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const toggleIcon = document.getElementById("toggleIconLogin");
  const input = document.getElementById("loginpassword");

  if (toggleIcon && input) {
    toggleIcon.addEventListener("click", function () {
      if (input.type === "password") {
        input.type = "text";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
      } else {
        input.type = "password";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
      }
    });
  }
});

const passwordInput = document.getElementById("registerPassword");

if (passwordInput) {
  passwordInput.addEventListener("input", function () {
    const password = passwordInput.value;
    const bar = document.getElementById("strengthLevel");
    const text = document.getElementById("strengthText");

    let strength = 0;

    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[\W]/.test(password)) strength++;

    if (strength <= 1) {
      bar.style.width = "20%";
      bar.style.background = "red";
      text.innerText = "Muy débil";
    } else if (strength === 2) {
      bar.style.width = "40%";
      bar.style.background = "orange";
      text.innerText = "Débil";
    } else if (strength === 3) {
      bar.style.width = "60%";
      bar.style.background = "yellow";
      text.innerText = "Media";
    } else if (strength === 4) {
      bar.style.width = "80%";
      bar.style.background = "lightgreen";
      text.innerText = "Fuerte";
    } else {
      bar.style.width = "100%";
      bar.style.background = "green";
      text.innerText = "Muy fuerte";
    }
  });
}
//Para que al subir una foto se vea antes de guardar:
document.querySelectorAll("input[type='file']").forEach((input) => {
  input.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        input.previousElementSibling.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
});
