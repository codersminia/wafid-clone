// ============================================
// WAFID TEMPLATE - CUSTOM JAVASCRIPT
// ============================================

document.addEventListener("DOMContentLoaded", () => {
  // Initialize tooltips and popovers if needed
  initializeComponents()

  // Add smooth scroll behavior
  addSmoothScroll()

  // Form validation
  initializeFormValidation()
})

// Initialize Bootstrap components
function initializeComponents() {
  // Tooltips
  var $ = window.jQuery // Declare the $ variable
  $('[data-toggle="tooltip"]').tooltip()

  // Popovers
  $('[data-toggle="popover"]').popover()
}

// Smooth scroll for anchor links
function addSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })
}

// Form validation
function initializeFormValidation() {
  const forms = document.querySelectorAll("form")

  forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
      if (!form.checkValidity()) {
        e.preventDefault()
        e.stopPropagation()
      }
      form.classList.add("was-validated")
    })
  })
}

// Lazy load images for better performance
function lazyLoadImages() {
  if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target
          img.src = img.dataset.src
          img.classList.remove("lazy")
          observer.unobserve(img)
        }
      })
    })

    document.querySelectorAll("img.lazy").forEach((img) => imageObserver.observe(img))
  }
}

// Call lazy load on page load
window.addEventListener("load", lazyLoadImages)

// Mobile menu close on link click
document.querySelectorAll(".navbar-nav a:not(.dropdown-toggle)").forEach((link) => {
  link.addEventListener("click", () => {
    const navbar = document.querySelector(".navbar-collapse")
    if (navbar.classList.contains("show")) {
      document.querySelector(".navbar-toggler").click()
    }
  })
})

// Add active class to current navigation item
function setActiveNavLink() {
  const currentLocation = location.pathname
  const menuItems = document.querySelectorAll(".navbar-nav a")

  menuItems.forEach((item) => {
    if (item.getAttribute("href") === currentLocation) {
      item.classList.add("active")
    }
  })
}

setActiveNavLink()
