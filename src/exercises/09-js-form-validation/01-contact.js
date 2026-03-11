let submitBtn = document.getElementById("submit_btn");
let commentForm = document.getElementById("comment_form");
let nameInput = document.getElementById("name");
let errors = {};
let nameError = document.getElementById("name_error");
submitBtn.addEventListener("click", onSubmitForm);
function addError(fieldName, message) {
  errors[fieldName] = message;
}
function showFieldErrors() {
  nameError.innerHTML = errors.name || "";
}
function onSubmitForm(e) {
  e.preventDefault();
  errors = {};
  console.log(nameInput.value);
  let name = nameInput.value.trim();
  const nameRE = /^[A-Za-z ]+$/;
  if (name == "") {
    addError("name", "Name is required");
  } else if (!nameRE.test(name)) {
    addError("name", "Name can contain only letter and spaces");
  }
  console.log(name.length);

  if (Object.keys(errors).length === 0) {
    commentForm.submit();
  } else {
    showFieldErrors();
  }
}
