// Add the current year to the footer
document.getElementById('year').textContent = new Date().getFullYear();




// Grab all the <details> elements
const detailsList = document.querySelectorAll("details");
  
detailsList.forEach((detail) => {
  // Listen for the 'toggle' event
  detail.addEventListener("toggle", () => {
    // If this one just opened, close all others
    if (detail.open) {
      detailsList.forEach((otherDetail) => {
        if (otherDetail !== detail) {
          otherDetail.open = false;
        }
      });
    }
  });
});