// Function to automatically close the modal and redirect after 3 seconds
function closeModalAndRedirect(redirectUrl) {
  setTimeout(function () {
    const modal = document.querySelector("dialog[open]");
    if (modal) {
      modal.close();
    }
    window.location.href = redirectUrl;
  }, 2500);
}

// Simple client-side validation
function validateForm() {
  let isValid = true;
  const fields = [
    "productName",
    "productCode",
    "productCategory",
    "productDescription",
    "productPrice",
    "stockQuantity",
    "productImage",
  ];

  fields.forEach(function (field) {
    const input = document.getElementById(field);
    if (!input.value) {
      alert("Please fill out the " + field.replace("product", "") + " field.");
      isValid = false;
      return false;
    }
  });

  return isValid;
}
