var form = document.getElementById("uTranscriptFees");
var transcript = document.getElementById("transcript");
var fees = document.getElementById("fees");







form.addEventListener('submit', function (evt) {
    evt.preventDefault();

    // Get the uploaded file for transcript and fees
    var fileTranscipt = transcript.files[0];
    var fileFees = fees.files[0];

    // Check if the transcript file exists
    if (!fileTranscipt) {
        // If the file doesn't exist, show an alert to the user
        alert("No file selected.");
        // Return false to stop the code from executing further
        return false;
    }

    // Check if the file type of transcript is a PDF
    if (fileTranscipt.type !== "application/pdf") {
        // If the file type is not a PDF, show an alert to the user
        alert("Invalid file type. Only PDF files are allowed.");
        // Return false to stop the code from executing further
        return false;
    }

    // Check if the size of transcript file is less than 5 MB
    if (fileTranscipt.size > 5000000) {
        // If the file size is greater than 5 MB, show an alert to the user
        alert("File size too large. Maximum allowed size is 5 MB.");
        // Return false to stop the code from executing further
        return false;
    }

    // Check if the fees file exists
    if (!fileFees) {
        // If the file doesn't exist, show an alert to the user
        alert("No file selected.");
        // Return false to stop the code from executing further
        return false;
    }

    // Check if the file type of fees is a PDF
    if (fileFees.type !== "application/pdf") {
        // If the file type is not a PDF, show an alert to the user
        alert("Invalid file type. Only PDF files are allowed.");
        // Return false to stop the code from executing further
        return false;
    }

    // Check if the size of fees file is less than 5 MB
    if (fileFees.size > 5000000) {
        // If the file size is greater than 5 MB, show an alert to the user
        alert("File size too large. Maximum allowed size is 5 MB.");
        // Return false to stop the code from executing further
        return false;
    }


    // Create a FormData object to store the form data
    var formData = new FormData(form);

    // Create an XMLHttpRequest object to send the form data
    var xhr = new XMLHttpRequest();

    // Open a POST request to the PHP script
    xhr.open("POST", "../../student/uploadTranscriptFeesScript.php");

    // Send the form data
    xhr.send(formData);

    // Handle the response from the PHP script
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            alert(response);
        }
    };


    return true;
});
