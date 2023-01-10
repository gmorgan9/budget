// page navigation variables
const navigationLinks = document.querySelectorAll("[data-nav-link]");
//const navigationLink = document.getElementByClass('active');
const pages = document.querySelectorAll("[data-page]");

// add event to all nav link
for (let i = 0; i < navigationLinks.length; i++) {
  navigationLinks[i].addEventListener("click", function () {
    

    for (let i = 0; i < pages.length; i++) {
      if (this.innerHTML.toLowerCase() === pages[i].dataset.page) {
        // console.log(this.innerHTML.toLowerCase());
        pages[i].classList.add("active");
        navigationLinks[i].classList.add("active");
        window.scrollTo(0, 0);
      } else {
        pages[i].classList.remove("active");
        navigationLinks[i].classList.remove("active");
      }
    }

  });
}

// page navigation variables
const newLinks = document.querySelectorAll("[new-nav-link]");
//const navigationLink = document.getElementByClass('active');
const newPages = document.querySelectorAll("[new-page]");

// add event to all nav link
for (let i = 0; i < newLinks.length; i++) {
  newLinks[i].addEventListener("click", function () {
    

    for (let i = 0; i < newPages.length; i++) {
      if (this.innerHTML.toLowerCase() === newPages[i].dataset.page) {
        // console.log(this.innerHTML.toLowerCase());
        newPages[i].classList.add("active");
        newLinks[i].classList.add("active");
        window.scrollTo(0, 0);
      } else {
        newPages[i].classList.remove("active");
        newLinks[i].classList.remove("active");
      }
    }

  });
}

