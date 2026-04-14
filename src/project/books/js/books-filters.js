let applyBtn = document.getElementById("apply_filters");
let clearBTN = document.getElementById("clear_filters");
let form = document.getElementById("filters");
let cards = document.querySelectorAll(".card");
let cardsContainer = document.getElementById("book-cards");
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
    if (!match) {
      card.classList.add("hidden");
    } else {
      card.classList.remove("hidden");
    }
  }
  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, filters.yearFilter);
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
    if (sortBy === "before" || sortBy === "later") return yearA - yearB;
    return titleA.localeCompare(titleB);
  });
  return list;
}
function getFilters() {
  const titleEl = form.elements["title_filter"];
  const yearEl = form.elements["sort_by"];
  const publisherEl = form.elements["sort_publisher"];
  const formatsEL = form.querySelectorAll('input[name="formats[]"]:checked');
  // const formatsEL = form.elements["formats[0]"];
  // const formats = Array.from(form.elements["formats[]"])
  //   .filter((cb) => cb.checked)
  //   .map((cb) => cb.value);
  const selectedFormats = Array.from(formatsEL).map((f) => f.defaultValue);
  console.log(selectedFormats);

  let titleFilter = (titleEl.value || "").trim().toLowerCase();
  let yearFilter = yearEl.value || "all";
  let publisherFilter = publisherEl.value || "all_publisher";
  let formatsFilter = formatsEL.value || "all_formats";

  return {
    titleFilter,
    yearFilter,
    publisherFilter,
    formatsFilter: selectedFormats,
  };
}
function clearFilters() {
  form.reset();
  cards.forEach((card) => {
    card.classList.remove("hidden");
  });
  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, "all");
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
}
function cardMatches(card, filter) {
  let title = card.dataset.title.toLowerCase();
  let year = Number(card.dataset.year);
  let publisher = card.dataset.publisher;
  let formats = card.dataset.formats;

  let yearMatch;

  let matchTitle = !filter.titleFilter || title.includes(filter.titleFilter);

  let matchPublisher =
    filter.publisherFilter === "all_publisher" ||
    publisher.includes(filter.publisherFilter);

  let matchFormats = filter.formatsFilter.some((f) => {
    return formats.includes(f);
  });

  console.log(formats);
  console.log(matchFormats);

  // let matchFormats =
  //   filter.formatsFilter === "all_formats" ||
  //   formats.includes(filter.formatsFilter);

  if (filter.yearFilter === "all") {
    yearMatch = year;
  }
  if (filter.yearFilter === "before") {
    yearMatch = year < 2000;
  }
  if (filter.yearFilter === "later") {
    yearMatch = year >= 2000;
  }

  return matchTitle && yearMatch && matchPublisher && matchFormats;
}
