const signModalDiv = document.getElementsByClassName("sign-modal")[0];
const loginModalDiv = document.getElementsByClassName("login-modal")[0];
const registerModalDiv = document.getElementsByClassName("sign-modal")[0];
const confirmModalDiv = document.getElementsByClassName("confirm-modal")[0];
const password = document.getElementById("register-password");

function onClickLogin() {
  if (loginModalDiv.classList[1] === "open-modal")
    loginModalDiv.classList.remove("open-modal");
  else if (signModalDiv.classList[1] === "open-modal") {
    signModalDiv.classList.remove("open-modal");
    loginModalDiv.classList.add("open-modal");
  } else loginModalDiv.classList.add("open-modal");
}

function onClickSign() {
  if (signModalDiv.classList[1] === "open-modal") {
    signModalDiv.classList.remove("open-modal");
  } else if (loginModalDiv.classList[1] === "open-modal") {
    loginModalDiv.classList.remove("open-modal");
    signModalDiv.classList.add("open-modal");
  } else {
    signModalDiv.classList.add("open-modal");
  }
}

function onClickSignClose() {
  signModalDiv.classList.remove("open-modal");
}

function onClickLoginClose() {
  loginModalDiv.classList.remove("open-modal");
  registerModalDiv.classList.remove("open-modal");
}

function onCloseConfirmModal() {
  confirmModalDiv.classList.remove("open-modal-confirm");
  location.reload();
}

function onCloseConfirmLoginModal() {
  confirmModalDiv.classList.remove("open-modal-confirm");
  location.reload();
}

function onCloseConfirmSignModal() {
  confirmModalDiv.classList.remove("open-modal-confirm");
  location.reload();
}

function onSubmit(ev) {
  ev.preventDefault();
  console.log(confirmModalDiv);
  confirmModalDiv.classList.add("open-modal-confirm");
}

function onSubmitLogin(ev) {
  ev.preventDefault();
  confirmModalDiv.classList.add("open-modal-confirm");
}

function onSubmitSign(ev) {
  ev.preventDefault();
  confirmModalDiv.classList.add("open-modal-confirm");
}
