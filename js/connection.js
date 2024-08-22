// * LOGIN HANDLER * //
document.querySelector(".form_connection_container").addEventListener('submit', async (e) => {

    // Prevent default submit behavior
    e.preventDefault();

    // Catching input values
    const data = {
        email: document.getElementById("email_connection_input").value,
        password: document.getElementById("password_connection_input").value
    }

    try {
        // Send credentials to the server
        const response = await fetch("../api/connection.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        // Extract text from the response
        const result = await response.text();

        console.log(result)

        if (result.trim() === 'connect_success') {
            window.location.href = "http://localhost/views/dashboard.php";
        }
        else {
            const input_email = document.getElementById("email_connection_input")
            const input_password = document.getElementById("password_connection_input")
            input_email.classList.add('input_failed_connection')
            input_password.classList.add('input_failed_connection')
            document.getElementById("form_connection_display_error").textContent = "incorrect password or email !";
        }
    }
    catch (err) {
        console.log("An error occurred during the connect process", err);
    }

});