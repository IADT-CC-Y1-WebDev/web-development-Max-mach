let submitBtn = document.getElementById("submit_btn");
let commentForm = document.getElementById("book_form");
let nameInput = document.getElementById("title");
let errorSummaryTop = document.getElementById("error_summary_top")
let authorInput = document.getElementById("author")
let yearInput = document.getElementById("year")
let isbnInput = document.getElementById("isbn")
let descriptionInput = document.getElementById("description")
let errors = {};

let nameError = document.getElementById("title_error");
let authorError = document.getElementById("author_error");
let yearError = document.getElementById("year_error");
let isbnError = document.getElementById("isbn_error");
let descriptionError = document.getElementById("description_error");

if (commentForm && submitBtn) {
  submitBtn.addEventListener("click", onSubmitForm);
}

submitBtn.addEventListener("click", onSubmitForm);
function addError(fieldName, message) {
  errors[fieldName] = message;
}
function showFieldErrors() {
  nameError.innerHTML = errors.name || "";
  authorError.innerHTML = errors.author || "";
  yearError.innerHTML = errors.year || "";
  isbnError.innerHTML = errors.isbn || "";
  descriptionError.innerHTML = errors.description || ""

}
function showErrorSummaryTop() {
   
    const messages = Object.values(errors);
    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }
    errorSummaryTop.innerHTML ='<strong>Please fix the following:</strong><ul>' +
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') +
        '</ul>';
    errorSummaryTop.style.display = 'block';

}
function onSubmitForm(e) {
  e.preventDefault();
  errors = {};
  console.log(nameInput.value);

const stringCheck = /^[A-Za-z ]+$/;
const isbnCheck =  /^[0-9]{13}$/;
const descCheck =  /^[A-Za-z0-9\s.,'"\-!?()]{10,300}$/;

  let title = nameInput.value.trim();
  if (title == "") {
    addError("name", "Title is required");
  } else if (!stringCheck.test(title)) {
    addError("name", "Title can contain only letter and spaces");
  }

let author = authorInput.value.trim();
if(author == ""){
    addError("author","Author is required")
} else if (!stringCheck.test(author)){
    addError("author", "Author can contain only letter and spaces");
}
let year = String(yearInput.value).trim();;
if(year == ""){
   addError("year","Year is required") 
}
let isbn = isbnInput.value.trim()  
if(isbn == ""){
  addError("isbn","Isbn is required")  
} else if (!isbnCheck.test(isbn)){
    addError("isbn","Isbn can contain only 13 numbers")  
}

let description = descriptionInput.value.trim()  
if(description == ""){
  addError("description","Description is required")  
} else if (!descCheck.test(description)){
    addError("description","Description min is 10 letters")  
}

console.log(title.length);
showErrorSummaryTop()
  if (Object.keys(errors).length === 0) {
    commentForm.submit();
  } else {
    showFieldErrors();
  }
}
