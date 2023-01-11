// Get the container element
var btnContainer = document.getElementById("test");
var section = document.getElementById("set");

// Get all buttons with class="btn" inside the container
var btns = btnContainer.getElementsByClassName("link");


// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");


    // If there's no active class
    if (current.length > 0) { 
      current[0].className = current[0].className.replace(" active", " ");
    }

    // Add the active class to the current/clicked button
    section.className += " active";
    this.className += " active";
  });
}

// // page navigation variables
// const navigationLinks = document.querySelectorAll("link");
// //const navigationLink = document.getElementByClass('active');
// const pages = document.querySelectorAll("page");

// // add event to all nav link
// for (let i = 0; i < navigationLinks.length; i++) {
//   navigationLinks[i].addEventListener("click", function () {
    

//     for (let i = 0; i < pages.length; i++) {
//       if (this.innerHTML.toLowerCase() === pages[i].dataset.page) {
//         // console.log(this.innerHTML.toLowerCase());
//         pages[i].classList.add("active");
//         navigationLinks[i].classList.add("active");
//         window.scrollTo(0, 0);
//       } else {
//         pages[i].classList.remove("active");
//         navigationLinks[i].classList.remove("active");
//       }
//     }

//   });
// }

