// Dropdown menu toggle
const profileBtn = document.getElementById("profile-btn");
const dropdownMenu = document.getElementById("dropdown-menu");

profileBtn.addEventListener("click", () => {
  // Toggle dropdown visibility
  dropdownMenu.classList.toggle("hidden");
});

// Close dropdown if clicked outside
document.addEventListener("click", (event) => {
  if (
    !profileBtn.contains(event.target) &&
    !dropdownMenu.contains(event.target)
  ) {
    dropdownMenu.classList.add("hidden");
  }
});

// Modal elements
const logoutBtn = document.getElementById("logout-btn");
const confirmationModal = document.getElementById("confirmation-modal");
const cancelBtn = document.getElementById("cancel-btn");

// Show the modal with animation
logoutBtn.addEventListener("click", () => {
  confirmationModal.classList.remove("hidden");
  setTimeout(() => {
    confirmationModal.classList.remove("opacity-0");
    confirmationModal.classList.add("opacity-100");
  }, 10); // short delay before animation starts
});

// Hide the modal with animation
cancelBtn.addEventListener("click", () => {
  confirmationModal.classList.remove("opacity-100");
  confirmationModal.classList.add("opacity-0");
  setTimeout(() => {
    confirmationModal.classList.add("hidden");
  }, 500); // after animation ends, hide modal
});

// Close modal if clicked outside
document.addEventListener("click", (event) => {
  if (
    !confirmationModal.contains(event.target) &&
    !logoutBtn.contains(event.target)
  ) {
    confirmationModal.classList.remove("opacity-100");
    confirmationModal.classList.add("opacity-0");
    setTimeout(() => {
      confirmationModal.classList.add("hidden");
    }, 500); // after animation ends, hide modal
  }
});
