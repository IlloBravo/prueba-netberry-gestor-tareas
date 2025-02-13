export function showSuccessMessage(message) {
    let successMessage = $("#success-message");
    successMessage.text(message).removeClass("d-none");

    setTimeout(() => {
        successMessage.addClass("d-none");
    }, 5000);
}

export function showErrorMessage(message) {
    let errorMessage = $("#error-message");
    errorMessage.text(message).removeClass("d-none");

    setTimeout(() => {
        errorMessage.addClass("d-none");
    }, 5000);
}
