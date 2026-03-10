let myh1 = document.getElementById("hid");
console.log(myh1);
let myh2s = document.querySelectorAll(".hs");
let myinput = document.getElementById("text");
console.log(myh2s);
let myButton = document.getElementById("myBtn");
let div = document.getElementById("output");
function clickme() {
  const value = myinput.value;
  const p = document.createElement("p");
  p.innerHTML = value;
  div.appendChild(p);
  console.log("MEOW");
}
myButton.addEventListener("click", clickme);
myinput.addEventListener("keypress", function (e) {
  if (e.key === "Enter") {
    clickme();
  }
});
