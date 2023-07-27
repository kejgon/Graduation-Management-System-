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

/* Set styles for the navbar */
.navbar {
    background-color: #7E0524;
}

/* Set styles for the items in the navbar */
.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

/* Set styles for the links in the navbar */
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

/* Set styles for the active link in the navbar */
.navbar li a:hover {
    background-color: #F09910;
}

/* Center the content in the section */
.section {
    display: flex;
    margin: 0 auto;
    clear: both;
    margin-top: 100px;

}


/* Style the about section */
.about-section {
    padding: 50px;
    text-align: left;
    background-color: #F09910;
    color: white;
}

/* Style the title of a section */
.title {
    color: grey;
}

/* Style the footer */
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #7E0524;
    color: white;
    text-align: center;
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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About GMS</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li style="float:right"><a href="login.php">Login</a></li>
        </ul>
    </div>

    <div class="section">
        <div class="column">
            <div class="about-section">
                <h1>CUEAGMS</h1>
                <p>CUEAGMS provides a streamlined process for students to apply for clearance, which is required for
                    graduation. The clearance process involves several departments, including Heads of Department,
                    Deans of students, Finance, Library, and Registrars. Students are expected to fulfill all
                    requirements and obtain clearance from each department before they can graduate. Overall,
                    CUEAGMS plays a critical role in facilitating academic success and administrative efficiency for
                    both students and institutions.</p>
            </div>
        </div>

        <div class="column">
            <img style="width:100%" src="assets/images/cueag.jpg">
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong> &copy; 2023 CUEAGMS</strong></p>
    </div>
</body>

</html>