let applyBtn = document.getElementById("apply_filters");
let clearBTN = document.getElementById("clear_filters");
let form = document.getElementById("filters");
let cards = document.querySelectorAll(".cards");
applyBtn.addEventListener("click", (e) => {
  e.preventDefault();
  applyFilters();
});
clearBTN.addEventListener("click", (e) => {
  e.preventDefault();
  clearFilters();
});

function applyFilters() {
  console.log("apply");
  let filters = getFilters();
  let matches = [];
  for (let i = 0; i < cards.length; i++) {
    let card = cards[i];
    matches[i] = cardMatches(card, filters);
  }
  console.log(matches);
}
function getFilters() {
  const titleEl = form.elements["title_filter"];
  const genreEl = form.elements["genre_filter"];
  const platformEl = form.elements["platform_filter"];
  const sortEl = form.elements["sort_by"];

  let titleFilter = (titleEl.value || "").trim().toLowerCase();
  let genreFilter = genreEl.value || "";
  let platformFilter = platformEl.value || "";
  let sortFilter = sortEl.value || "title_asc";

  return {
    titleFilter: titleFilter,
    genreFilter: genreFilter,
    platformFilter: platformFilter,
    sortFilter: sortFilter,
  };
}
function clearFilters() {
  console.log("clear");
}
function matchTitle(card, title) {
  const ttl = title.toLowerCase();
  let match = false;
  if (card.dataset.title.includes(title)) {
    match = true;
  }
  return match;
}
function cardMatches(card, filter) {
  return card.dataset.title.toLowerCase().includes(filter.titleFilter);
}
