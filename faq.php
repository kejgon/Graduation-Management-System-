<!DOCTYPE html>

<head>

    <title>CUEAGMS</title>


</head>

<style>
/* Set box-sizing to border-box for all elements */
* {
    box-sizing: border-box;
}

/* Set default styles for the body */
body {
    font-family: 'Work Sans', sans-serif;
    text-align: center;
    margin: 0;
}

/***********************Headers and Navbar**************************/
/******************************************************************/

/* Set styles for the header, navbar, sections, and footer */
.header,
.navbar,
.section,
.footer {
    float: left;
    width: 100%;
    /* The width is 100%, by default */
}

/* Set styles for the header */
.header {
    height: 100;
    background-color: #fff;
}

/* Set styles for the logo in the header */
.header .logo img {
    float: left;
}

/* Set styles for the text in the logo in the header */
.header .logo p {
    float: left;
    width: 25%;
    font-size: 20px;
    color: #7E0524;
}

.navbar {
    background-color: #7E0524;
}

/* Set styles for the navbar */
.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

/* Set styles for the items in the navbar */
.navbar li {
    float: left;
    border-right: 1px solid #bbb;
}

/* Set styles for the last item in the navbar */
.navbar li:last-child {
    border-right: none;
}

/* Set styles for the links in the navbar */
.navbar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Set styles for the active link in the navbar */
.navbar li a:hover:not(.active) {
    background-color: #F09910;
}

/* Set styles for the active item in the navbar */
.navbar .active {
    background-color: #F09910;
}

/* Use a media query to add a breakpoint at 800px */
@media screen and (max-width: 768px) {

    /* Set the width of the left, main, and right sections to 100% when the viewport is 800px or smaller */
    .left,
    .main,
    .right {
        width: 100%;
    }

    /* Set the styles for the items in the navbar when the viewport is 800px or smaller */
    .header .logo p {
        float: left;
        font-size: 15px;
    }

    /* Set the styles for the links in the navbar when the viewport is 800px or smaller */
    .navbar li a {
        padding: 8px 16px;
    }

    /* Set the styles for the active item in the navbar when the viewport is 800px or smaller */
    .navbar .active {
        background-color: #F09910;
        color: white;
    }
}


/************************* FAQ style ********************************/
/******************************************************************/
/* Style for the heading of the FAQ section */
.faq-heading {
    border-bottom: #777;
    padding: 20px 60px;
}

/* Container for the FAQ section */
.faq-container {
    display: flex;
    justify-content: center;
    flex-direction: column;
    margin-bottom: 50px;
}

/* Horizontal line for separating sections */
.hr-line {
    width: 40%;
    margin: auto;
}

/* Style for the buttons that open and close the FAQ page */
.faq-page {
    /* background-color: #eee; */
    color: #F09910;
    font-size: 20px;
    cursor: pointer;
    padding: 30px 20px;
    width: 40%;
    border: none;
    outline: none;
    transition: 0.4s;
    margin: auto;
    text-align: left;
}

/* Style for the FAQ page content */
.faq-body {
    margin: auto;
    text-align: left;
    width: 30%;
    padding: auto;
}

/* Add a background color to the button when clicked or hovered over */
.active,
.faq-page:hover {
    background-color: #F9F9F9;
}

/* Style for the FAQ page panel. Hidden by default */
.faq-body {
    padding: 0 18px;
    background-color: white;
    display: none;
    overflow: hidden;
}

/* Plus sign icon next to the button */
.faq-page:after {
    content: '\02795';
    /* Unicode character for "plus" sign (+) */
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}

/* Minus sign icon next to the button when clicked */
.active:after {
    content: "\2796";
    /* Unicode character for "minus" sign (-) */
}

/* Media query for smaller screens */
@media screen and (max-width: 768px) {

    /* Set the width of the left, main, and right sections to 100% when the viewport is 800px or smaller */
    .left,
    .main,
    .right {
        width: 100%;
    }

    /* Set the styles for the items in the navbar when the viewport is 800px or smaller */
    .header .logo p {
        float: left;
        font-size: 15px;
    }

    /* Set the styles for the links in the navbar when the viewport is 800px or smaller */
    .navbar li a {
        padding: 8px 16px;
    }

    /* Reduce the width and font size of the button */
    .faq-page {
        width: 70%;
        font-size: 18px;
    }

    /* Reduce the width and font size of the FAQ page content */
    .faq-body {
        width: 60%;
        font-size: 14px;
    }

    /* Adjust the padding of the FAQ heading */
    .faq-heading {
        padding: 20px 30px;
    }

    /* Adjust the width of the horizontal line */
    .hr-line {
        width: 60%;
    }
}


/* Style the footer */
.footer {
    position: fixed;
    /* Fix the position of the footer */
    left: 0;
    /* Set the left edge of the footer to the left edge of the screen */
    bottom: 0;
    /* Set the bottom edge of the footer to the bottom of the screen */
    width: 100%;
    /* Set the width of the footer to 100% of the screen */
    background-color: #7E0524;
    /* Set the background color */
    color: white;
    /* Set the font color */
    text-align: center;
    /* Align the text to the center */
}
</style>

<body>


    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="assets/images/logo/CUEA-logo.png" width="100">
            <p>Catholic University of Eastern Africa Graduation Management System</p>
        </div>
    </div>



    <!-- NAVBAR -->
    <div class="navbar">

        <ul>
            <li><a class="" href="index.php">Home</a></li>
            <li><a href="about.php">About GMS</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li style="float:right"><a href="login.php">Login</a></li>
        </ul>
    </div>


    <div class="section">
        <h1 class="faq-heading">Have any question?</h1>
        <section class="faq-container">
            <div class="faq-one">
                <!-- faq question -->
                <h1 class="faq-page">How do I login to CUEAGMS?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>You can login to CUEAGMS by entering your login credentials, which should have been provided to
                        you by your institution. If you are having trouble logging
                        in, you may need to contact your institution's IT department for assistance.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-two">
                <!-- faq question -->
                <h1 class="faq-page">What does the clearance proceedure invlves?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>The clearance procedure for CUEAGMS involves several departments, which work together to ensure
                        that the student has fulfilled all necessary requirements before being cleared. These
                        departments include:
                    <ul>

                        <li> <b>Heads of Department:</b> This department is responsible for verifying that the student
                            has
                            completed
                            all required academic requirements, including completing the required number of units, all
                            core
                            units, and any other liabilities in the department.</li>

                        <li> <b>Deans of Students:</b> The Deans of Students are responsible for confirming that the
                            student
                            has
                            been cleared from the sports section and any other areas related to welfare. They also
                            confirm
                            that the student does not have any academic or non-academic disciplinary issues.</li>

                        <li> <b>Finance Department:</b> The Finance Department plays a central role, they confirm
                            whether the
                            student does not owe the university any
                            fees.</li>

                        <li> <b>Library Department:</b> The Library Department is responsible for confirming that the
                            student
                            does
                            not owe the university any book(s), overdue fines, or any other library information
                            material.</li>

                        <li><b>Registrars:</b> The Registrars are responsible for checking the complete clearance form
                            from
                            other
                            relevant departments. They receive the student’s school ID card and records, and then the
                            student proceeds to clear with finance.</li>
                    </ul>
                    </p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
                <h1 class="faq-page">How long does the clearance process takes?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>The duration of the clearance process in CUEAGMS depends on whether the student has met all
                        requirements requested by each department. If all requirements are met, the process can be
                        completed quickly. However, outstanding issues or missing requirements may cause delays.
                        Communication with relevant departments and fulfilling all requirements is crucial to avoid
                        delays.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
                <h1 class="faq-page">What do I expect after the clearane?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>Once the clearance process in CUEAGMS is complete and approved, students can expect to receive an
                        approved clearance report. They should also be listed on the graduation list, provided they have
                        met all graduation requirements.</p>
                </div>
            </div>

    </div>
    </section>
    </div>


    <!-- Footer -->

    <div class="footer">
        <p><strong> &copy; 2023 CUEAGMS</strong></p>

    </div>

    <script>
    // Select all elements with class name "faq-page"
    var faq = document.getElementsByClassName("faq-page");

    // Loop through each faq-page element
    for (var i = 0; i < faq.length; i++) {
        // Add a click event listener to the current faq-page element
        faq[i].addEventListener("click", function() {

            // Toggle the "active" class for the clicked button
            this.classList.toggle("active");

            // Select the next element (answer panel) after the clicked button
            var body = this.nextElementSibling;

            // Toggle the display style of the answer panel
            if (body.style.display === "block") {
                body.style.display = "none";
            } else {
                body.style.display = "block";
            }
        });
    }
    </script>

</body>

</html>