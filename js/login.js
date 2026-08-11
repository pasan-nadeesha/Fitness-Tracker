document.addEventListener("DOMContentLoaded", function() {
  
    const targetTab = window.location.hash;

    //login check
    if (targetTab === '#toggle-login') {
        // Force the login
        document.getElementById('toggle-login').checked = true;
    } 
    // register button check
    else if (targetTab === '#toggle-register') {
        document.getElementById('toggle-register').checked = true;
    }
});