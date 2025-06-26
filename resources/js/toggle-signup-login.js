document.addEventListener("DOMContentLoaded", function () {
    const signupLoginLink = document.getElementById("signup-login");

    signupLoginLink.addEventListener("click", function () {
        if (this.textContent.trim() === "Sign Up") {
            window.location.href = "{{ route('signup') }}";
        } else if (this.textContent.trim() === "Login") {
            window.location.href = "{{ route('login') }}";
        }
    });
});
