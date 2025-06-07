function setupPasswordToggle(
    toggleButtonId,
    passwordInputId,
    openIconId,
    closedIconId
) {
    const toggleButton = document.getElementById(toggleButtonId);
    const passwordInput = document.getElementById(passwordInputId);
    const openIcon = document.getElementById(openIconId);
    const closedIcon = document.getElementById(closedIconId);

    if (toggleButton && passwordInput && openIcon && closedIcon) {
        toggleButton.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);

            openIcon.classList.toggle("hidden");
            closedIcon.classList.toggle("hidden");
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    setupPasswordToggle("togglePassword", "password", "eye-open", "eye-closed");

    setupPasswordToggle(
        "togglePasswordConfirmation",
        "password_confirmation",
        "eye-open-confirmation",
        "eye-closed-confirmation"
    );
});
