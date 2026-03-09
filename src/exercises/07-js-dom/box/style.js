const input = document.getElementById("my_input");
const mybuton = document.getElementById("my_btn");
const div = document.getElementById("output");
mybuton.addEventListener("click", addtext);
function addtext() {
  const value = input.value;
  const p = document.createElement("p");
  p.innerHTML = value;
  div.appendChild(p);
}
