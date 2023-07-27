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
    height: 100px;
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

/* Set styles for the links in the navbar */
.navbar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Align images vertically in the middle */
img {
    vertical-align: middle;
}

/* Container for the slideshow */
.slideshow-container {
    width: 100%;
    position: relative;
    margin: auto;
    height: 500px;
    /* Set the height of the slideshow */
}


/* Media query for smaller screens */
@media screen and (max-width: 768px) {
    .header .logo p {
        font-size: 15px;
    }

    .navbar li a {
        padding: 8px 16px;
    }

    .column {
        width: 100%;
        display: block;
    }

    /* Additional styling for smaller screens */
    .header .logo img {
        width: 80px;
    }

    .header .logo p {
        width: 50%;
        font-size: 15px;
    }

    .navbar li a {
        padding: 8px;
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


    <!--SLIDER SECTION  -->

    <div class="section">

        <div class="slideshow-container">

            <div class="mySlides">
                <img src="assets/images/Graduation CUEA.JPG" style="width:100%">

                <div class="text">
                    <h1>WELCOME CUEAGMS</h1>
                </div>
            </div>


        </div>


        <!-- Footer -->

        <div class="footer">
            <p><strong> &copy; 2023 CUEAGMS</strong></p>

        </div>




</body>

</html>