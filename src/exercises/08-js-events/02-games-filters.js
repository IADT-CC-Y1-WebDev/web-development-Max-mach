let applyBtn = document.getElementById("apply_filters");
let clearBTN = document.getElementById("clear_filters");
let form = document.getElementById("filters");
let cards = document.querySelectorAll(".card");
let cardsContainer = document.getElementById("game_cards");
applyBtn.addEventListener("click", (e) => {
  e.preventDefault();
  applyFilters();
});
clearBTN.addEventListener("click", (e) => {
  e.preventDefault();
  clearFilters();
});

function applyFilters() {
  let filters = getFilters();
  for (let i = 0; i < cards.length; i++) {
    let card = cards[i];
    let match = cardMatches(card, filters);
    card.classList.toggle("hidden", !match);
    console.log(match);
  }
  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, filters.sortBy);
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
}
function sortCards(cards, sortBy) {
  const list = cards.slice();
  list.sort((a, b) => {
    let titleA = a.dataset.title.toLowerCase();
    let titleB = b.dataset.title.toLowerCase();
    let yearA = Number(a.dataset.year);
    let yearB = Number(b.dataset.year);
    if (sortBy === "year_desc") return yearB - yearA;
    if (sortBy === "year_asc") return yearA - yearB;

    return titleA.localeCompare(titleB);
  });
  return list;
}
function getFilters() {
  const titleEl = form.elements["title_filter"];
  const genreEl = form.elements["genre_filter"];
  const platformEl = form.elements["platform_filter"];
  const sortEl = form.elements["sort_by"];

  let titleFilter = (titleEl.value || "").trim().toLowerCase();
  let genreFilter = genreEl.value || "";
  let platformFilter = platformEl.value || "";
  let sortBy = sortEl.value || "title_asc";

  return {
    titleFilter: titleFilter,
    genreFilter: genreFilter,
    platformFilter: platformFilter,
    sortBy: sortBy,
  };
}
function clearFilters() {
  form.reset();
  cards.forEach((card) => {
    card.classList.toggle("hidden");
  });

  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, "title");
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
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
  let title = card.dataset.title.toLowerCase();
  let genre = card.dataset.genre;
  let platform = card.dataset.platform;

  let matchTitle =
    filter.titleFilter === "" || title.includes(filter.titleFilter);
  let matchGenre = filter.genreFilter === "" || genre === filter.genreFilter;
  let matchPlatform =
    filter.platformFilter === "" || platform.includes(filter.platformFilter);
  return matchTitle && matchGenre && matchPlatform;
}
