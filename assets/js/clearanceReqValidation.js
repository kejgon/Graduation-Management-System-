var form = document.getElementById("clearancReqForm");
var fname = document.getElementById("fullname");
var regNo = document.getElementById("regNo");
var faculties = document.getElementById("faculties");
var departments = document.getElementById("departments");
var levels = document.getElementById("levels");
var programs = document.getElementById("programs");
var specializations = document.getElementById("specializations");
var mode_of_study = document.getElementById("mode_of_study");
var years = document.getElementById("year");
// var compus = document.getElementById("compus");
// var cl_reason = document.getElementById("cl_reason");
var date = document.getElementById("date");





form.addEventListener('submit', function (evt) {
    evt.preventDefault();
    // //! FUll NAME VALIDATION
    var fnameVal = fname.value;
    if (fnameVal.length == 0) {
        window.alert("Full name is required?");
        return false
    }
    //?To remove the extra spaces within the string
    var newFname = fnameVal[0];
    for (var i = 1; i < fnameVal.length; i++) {
        if (!(fnameVal[i - 1] === " " && fnameVal[i] === " ")) {
            newFname += fnameVal[i];
        }
    }
    //? This to make sure that user input are basically aphabets, spaces and  doesn't contain any symbols
    var index = 0;
    for (var i = 0; i < newFname.length; i++) {
        if (!((newFname[i] >= 'a' && newFname[i] <= 'z') || (newFname[i] >= 'A' && newFname[i] <= 'Z') || newFname[i] === ' ')) {
            window.alert("Please enter a valid name!");
            return false;
        }
        if (newFname[i] === ' ') {
            index++;
        }
    }
    if (index < 1) {
        window.alert("Please enter at least two names!");
        return false;
    }



    //! REGISTRATION NUMBER VALIDATION
    var regNoVal = regNo.value;

    if (regNoVal.length == 0) {
        window.alert("Registration number is required");
        return false;
    }
    //?To remove the extra spaces within the string
    if (regNoVal.indexOf(" ") !== -1) {
        window.alert("The registration number shoudn't contain any spaces");

        return false;
    }
    console.log(regNoVal);





    //! FACULTIES VALIDATION
    var facultyVal = faculties.value;
    if (facultyVal == 0) {
        window.alert("Please select your faculty");
        return false;
    }

    // //! DEPARTMENTS VALIDATION
    var departmentVal = departments.value;
    if (departmentVal == 0) {
        window.alert("Please select your departments ");
        return false;
    }

    //! LEVELS VALIDATION
    var levelVal = levels.value;
    if (levelVal == 0) {
        window.alert("Please select your level!");
        return false;
    }

    //! PROGRAMS VALIDATION
    var progamVal = programs.value;
    if (progamVal == 0) {
        window.alert("Please select your program!");
        return false;
    }


    //! SPECIALAZTION VALIDATION
    var specialVal = specializations.value;
    if (specialVal == 0) {
        window.alert("Please select your specialization!");
        return false;
    }

    //! MODE OF STUDY VALIDATION
    var mode_of_studyVal = mode_of_study.value;
    if (mode_of_studyVal == 0) {
        window.alert("Please select your mode of study!");
        return false;
    }

    //! YEAR VALIDATION
    var yearVal = years.value;
    if (yearVal == 0) {
        window.alert("Please select your year!");
        return false;
    }

    //! COMPUS VALIDATION
    if ((compus[0].checked == false) && (compus[1].checked == false)) {
        alert("Please choose your compus!");
        return false;
    }


    //! CLEARANCE REASON VALIDATION
    if ((cl_reason[0].checked == false) && (cl_reason[1].checked == false) && (cl_reason[2].checked == false)) {
        alert("Please choose your reason for clearance!");
        return false;
    }



    //////!      DATE VALIDATION       
    // Get the value of the date input
    var dateVal = date.value;

    // Initialize variables to store year, month and day values extracted from input
    var year = "";
    var month = "";
    var day = "";

    // Initialize variable to count the number of dashes in the input
    var dashCount = 0;

    // Check if the input is empty
    if (dateVal.length == 0) {
        window.alert("Please enter the date!");
        return false;
    }

    // Loop through the input characters and extract year, month, and day values
    for (var i = 0; i < dateVal.length; i++) {
        var currentChar = dateVal[i];

        if (currentChar === "-") {
            dashCount++;
        } else if (currentChar >= "0" && currentChar <= "9") {
            if (dashCount === 0) {
                year += currentChar;
            } else if (dashCount === 1) {
                month += currentChar;
            } else if (dashCount === 2) {
                day += currentChar;
            }
        } else {
            // If a non-numeric or non-dash character is encountered, return false
            return false;
        }
    }

    // Check if the year, month, and day values have the correct number of digits
    if (year.length !== 4 || month.length !== 2 || day.length !== 2) {
        window.alert("The year must contain 4 digits, the month must contain 2 digits and the day must contain 2 digits.");
        return false;
    }

    // Convert the year, month, and day values to integers
    year = parseInt(year);
    month = parseInt(month);
    day = parseInt(day);

    // Create Date objects for the input date and today's date
    var inputDate = new Date(year, month - 1, day);
    var today = new Date();

    // Compare the input date to today's date
    if (inputDate.setHours(0, 0, 0, 0) < today.setHours(0, 0, 0, 0)) {
        window.alert("Please enter today's date.");
        return false;
    }

    if (inputDate.setHours(0, 0, 0, 0) > today.setHours(0, 0, 0, 0)) {
        window.alert("Please do not enter future date.");
        return false;
    }

    // Check if the month value is between 1 and 12
    if (month < 1 || month > 12) {
        window.alert("The number of month must be between 1 and 12");
        return false;
    }

    // Check if the day value is between 1 and 31 depending on the month
    if (day < 1 || day > 31) {
        window.alert("The number of days must be between 1 and 31 depending on the month.");
        return false;
    }

    // Check if the day value is between 1 and 30 depending on the month (April, June, September, November)
    if ((month === 4 || month === 6 || month === 9 || month === 11) && day > 30) {
        window.alert("The number of days must be between 1 and 30 depending on the month.");
        return false;
    }

    // Check if the day value is valid for February
    if (month === 2) {
        // If the day value is greater than 29, it's invalid
        if (day > 29) {
            window.alert("Sorry! The number of days in February must be between 1 and 29.");
            return false;

        }
        if (day === 29) {
            if (year % 4 !== 0 || (year % 100 === 0 && year % 400 !== 0)) {
                window.alert("Sorry! This is not a leap year day.");
                return false;
            }
        }
        if (day > 28 && (!(year % 4 === 0 && year % 100 !== 0) && year % 400 !== 0)) {
            return false;
        }
    }






    // Create a FormData object to store the form data
    var formData = new FormData(form);

    // Create an XMLHttpRequest object to send the form data
    var xhr = new XMLHttpRequest();

    // Open a POST request to the PHP script
    xhr.open("POST", "../../student/clearanceReqScript.php");

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
