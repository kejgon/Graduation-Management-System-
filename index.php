<!DOCTYPE html>
<html lang="en">

<head>
    <!-- specifies the character encoding used on the page. In this case, it is set to UTF-8,
 which is a widely used character encoding that supports a wide 
 range of characters and scripts. -->
    <meta charset="UTF-8">
    <!-- sets the compatibility mode for Internet Explorer.
    The value "IE=edge" tells IE to use the latest version of its rendering engine,
    regardless of the document mode. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- sets the viewport settings for the page. The "width=device-width" 
    tells the browser to set the width of the viewport to the width of the device. 
    The "initial-scale=1.0" sets the initial zoom level of the page to 1.0, 
    which means it is not zoomed in or out by default. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

/* Set styles for the navbar */
.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #7E0524;
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

/* Hide all slideshow images by default */
.mySlides {
    display: none
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

/* Previous and Next buttons */
.prev,
.next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    /* Set the position of the buttons */
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
}

/* Position the Next button to the right */
.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

/* Position the Previous button to the left */
.prev {
    left: 0;
}

/* Add a black background on hover for the buttons */
.prev:hover,
.next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Slideshow caption text */
.text {
    color: #f2f2f2;
    font-size: 2rem;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    /* Set the position of the caption */
    width: 100%;
    text-align: left;
    background-color: #FD841F;
    opacity: 0;
    /* Hide the caption by default */
}

.text h1 {
    font-weight: bold;
    /* Make the caption title bold */
}

/* Slideshow number text */
.numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
}

/* Slideshow dots/bullets/indicators */
.dot {
    cursor: pointer;
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
}

/* Set the active dot to a darker color */
.active,
.dot:hover {
    background-color: #717171;
}

/* Slideshow fading animation */
.fade {
    animation-name: fade;
    animation-duration: 1.5s;
}

/* Define the fading animation */
@keyframes fade {
    from {
        opacity: .4
    }

    to {
        opacity: 1
    }
}

/* Decrease button and caption text size on small screens */
@media only screen and (max-width: 300px) {

    .prev,
    .next,
    .text {
        font-size: 11px
    }
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

    .column {
        width: 100%;
        display: block;
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

            <div class="mySlides fade">
                <img src="assets/images/Graduation CUEA.JPG" style="width:100%">

                <div class="text">
                    <h1>WELCOME CUEAGMS</h2>
                </div>
            </div>

            <div class="mySlides fade">
                <img src="assets/images/Graduands.jpg" style="width:100%">
            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>


    <!-- Footer -->

    <div class="footer">
        <p><strong>©Copyright CUEAGMS</strong></p>

    </div>



    <script>
    // Set the starting slide index and show the first slide
    let slideIndex = 1;
    showSlides(slideIndex);

    // Move to the next or previous slide
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Move to a specific slide
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    // Display the current slide
    function showSlides(n) {
        let i;
        // Get all the slide elements and dot elements
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        // Reset the slide index if it exceeds the number of slides
        if (n > slides.length) {
            slideIndex = 1;
        }
        // Set the slide index to the last slide if it goes below 1
        if (n < 1) {
            slideIndex = slides.length;
        }
        // Hide all slides
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        // Remove the "active" class from all dots
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        // Display the current slide and add the "active" class to its dot
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
    </script>
</body>

</html>