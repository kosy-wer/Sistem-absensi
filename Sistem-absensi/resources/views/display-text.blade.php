<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Text</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    let showAlert = false;

    function handleShowAlert() {
        showAlert = true;
        renderAlert();
    }

    function handleOption1() {
        // Option 1 action
        alert("Option 1 selected");
    }

    function handleOption2() {
        // Option 2 action
        alert("Option 2 selected");
    }

    function closeAlert() {
        showAlert = false;
        renderAlert();
    }

    function renderAlert() {
        const alertContainer = document.getElementById("alertContainer");
        alertContainer.innerHTML = ""; // Clear previous content

        if (showAlert) {
            const alertDiv = document.createElement("div");
            alertDiv.className = "alert";

            const alertTitle = document.createElement("h2");
            alertTitle.textContent = "Important!";
            alertDiv.appendChild(alertTitle);

            const alertMessage = document.createElement("p");
            alertMessage.textContent = "Do you want to proceed?";
            alertDiv.appendChild(alertMessage);

            const option1Button = document.createElement("button");
            option1Button.textContent = "Option 1";
            option1Button.addEventListener("click", handleOption1);
            alertDiv.appendChild(option1Button);

            const option2Button = document.createElement("button");
            option2Button.textContent = "Option 2";
            option2Button.addEventListener("click", handleOption2);
            alertDiv.appendChild(option2Button);

            const cancelButton = document.createElement("button");
            cancelButton.textContent = "Cancel";
            cancelButton.addEventListener("click", closeAlert);
            alertDiv.appendChild(cancelButton);

            alertContainer.appendChild(alertDiv);
        }
    }

    // Add the main button to show alert
    const showButton = document.createElement("button");
    showButton.textContent = "Show Alert";
    showButton.addEventListener("click", handleShowAlert);
    document.body.appendChild(showButton);

    // Add the alert container
    const alertContainer = document.createElement("div");
    alertContainer.id = "alertContainer";
    document.body.appendChild(alertContainer);
});

    </script>
</body>
</html>

