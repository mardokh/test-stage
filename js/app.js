
// * SUBMIT HANDLER * //
async function handleFormSubmit(e, url, successRedirect, errorElementId, data) {
    try {
        // Prevent default submit behavior
        e.preventDefault();

        // Send credentials to the server
        const request = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        // Await response
        const response = await request.json();

        // Check response and handle accordingly
        if (response.status === 200) {
            if (response.successfully_registered || response.connected) {
                window.location.href = successRedirect;
            } else {
                document.getElementById(errorElementId).innerHTML = response.registered_failed || response.failed;
            }
        }
    } catch (err) {
        console.log("An error occurred during the process", err);
    }
}


// * ADMIN REGISTRATION * //
document.querySelector(".form_registration_container").addEventListener('submit', (e) => {
    // Catching input values
    const data = {
        firstName: document.getElementById("firstName_registration_input").value,
        lastName: document.getElementById("lastName_registration_input").value,
        email: document.getElementById("email_registration_input").value,
        password: document.getElementById("password_registration_input").value
    }
    // Set submit handler
    handleFormSubmit(e, "../server/registration.php", "http://127.0.0.1:5500/views/connection.html", "form_registration_error", data);
});


// * ADMIN CONNECTION * //
document.querySelector(".form_connection_container").addEventListener('submit', (e) => {
    // Catching input values
    const data = {
        email: document.getElementById("email_registration_input").value,
        password: document.getElementById("password_registration_input").value
    }
    // Set submit handler
    handleFormSubmit(e, "../server/connection.php", "./dashboard.html", data);
});