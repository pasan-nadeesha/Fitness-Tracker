document.addEventListener("DOMContentLoaded", function () {
    const targetTab = window.location.hash;

    // Login check
    if (targetTab === '#toggle-login') {
        document.getElementById('toggle-login').checked = true;
    } 
    // Register button check
    else if (targetTab === '#toggle-register') {
        document.getElementById('toggle-register').checked = true;
    }

    // Check for Error parameter in URL to show Center Popup Box
    const urlParams = new URLSearchParams(window.location.search);
    const errorType = urlParams.get('error');

    if (errorType) {
        // Force switch to Login Tab when an error occurs
        const loginRadio = document.getElementById('toggle-login');
        if (loginRadio) loginRadio.checked = true;

        const modal = document.getElementById('errorPopupModal');
        const modalMsg = document.getElementById('modalErrorMessage');
        const modalTitle = document.getElementById('modalTitle');

        if (errorType === 'incorrect_password') {
            modalTitle.innerText = "Incorrect Password";
            modalMsg.innerText = "The password you entered is incorrect. Please try again.";
        } else if (errorType === 'email_not_found') {
            modalTitle.innerText = "Account Not Found";
            modalMsg.innerText = "No account found with this email. Please check your email or register first.";
        }

        if (modal) {
            modal.style.display = 'flex';
        }
    }
});

// Close popup modal function
function closeErrorPopup() {
    const modal = document.getElementById('errorPopupModal');
    if (modal) {
        modal.style.display = 'none';
        // Clean URL parameters without reloading
        window.history.replaceState({}, document.title, window.location.pathname + '#toggle-login');
    }
}