// Function to validate the password
function validatePassword(password) {
    // Regex for at least one capital letter and at least two numbers
    const regex = /^(?=.*[A-Z])(?=.*\d.*\d).+$/;
    return regex.test(password);
}

// * ADMIN REGISTRATION * //
document.querySelector(".form_registration_container").addEventListener('submit', async (e) => {

    // Prevent default submit behavior
    e.preventDefault();

    // Catching input values
    const data = {
        firstName: document.getElementById("firstName_registration_input").value,
        lastName: document.getElementById("lastName_registration_input").value,
        email: document.getElementById("email_registration_input").value,
        password: document.getElementById("password_registration_input").value
    }

    // Validate password
    if (!validatePassword(data.password)) {
        document.getElementById("form_registration_error").innerHTML = "Password must contain at least one capital letter and two numbers.";
        return; // Stop form submission if validation fails
    }

    try {
        // Send credentials to the server
        const response = await fetch("../api/registration.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        console.log(response)
        // Check response and handle accordingly
        if (response.status === 200) {
            window.location.href = "http://localhost/views/connection.html";
        } else {
            document.getElementById("form_registration_error").innerHTML = "Registration failed. Please try again.";
        }
    } 
    catch (err) {
        console.log("An error occurred during the registration process", err);
    }

});
