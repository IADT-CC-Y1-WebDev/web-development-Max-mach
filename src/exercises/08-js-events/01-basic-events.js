let box = document.getElementById("box");
let toggleBoxBtn = document.getElementById("toggle_box_btn");
let preview = document.getElementById("preview");
let previewInput = document.getElementById("preview_input");
toggleBoxBtn.addEventListener("click", selectedBox);
function selectedBox(e) {
  console.log(e.target);
  box.classList.toggle("hidden");
}
previewInput.addEventListener("change", (e) => {
  updatePreview(preview, e.target.value);
});
function updatePreview(previewElement, text) {
  console.log();
  const trimmed = text.trim();
  if (trimmed === "") {
    previewElement.textContent = "(nothing yet)";
    previewElement.classList.add("empty");
  } else {
    previewElement.textContent = trimmed;
    previewElement.classList.remove("empty");
  }
}
