<?php
// is a PHP function that starts a new or resumes an existing session. 
// A session is a way to store data (variables) on the server 
// that can be used across multiple pages of a website.
session_start();
ob_start(); //turning on output buffer ////? To prevent header() errors

// Turn on output buffering
// This function will turn output buffering on. While output buffering is 
// active, no output is sent from the script (other than headers), instead the output is stored


// database connection details

$host="127.0.0.1";// server name or IP address where MySQL is running
$user="cueagmsAC"; // MySQL user name
$password="password";// MySQL password
$dbname="cueagms"; // MySQL database name

// create a new MySQL connection using the above details
$connection = mysqli_connect($host, $user, $password, $dbname);

// check if the connection was successful
if ($connection === false) {
    // if the connection failed, stop the script and display an error message
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
html,
body {
    font-family: Consolas, monaco, monospace;
}

#chart {
    padding: 20px;
}

table {
    width: 100%;
    height: 400px;
}

.charttitle {
    text-align: center;
}

.bars td {
    vertical-align: bottom;
}

.bars div:hover {
    opacity: 0.6;
}

.legend {
    vertical-align: bottom;
    padding-left: 20px;
    text-align: left;
}

.legbox {
    display: block;
    clear: both;
}

.xaxisname {
    margin: 5px;
    color: #fff;
    font-size: 77%;
    padding: 5px;
    float: left;
}

/*Flat UI colors*/
.one {
    background: #16A085;
}

.two {
    background: #2ECC71;
}

.three {
    background: #27AE60;
}

.four {
    background: #3498DB;
}

.five {
    background: #2980B9;
}

.six {
    background: #9B59B6;
}

.seven {
    background: #8E44AD;
}

.eight {
    background: #34495E;
}

.nine {
    background: #2C3E50;
}

.ten {
    background: #22313f;
}

.eleven {
    background: #F1C40F;
}

.twelve {
    background: #F39C12;
}

.thirteen {
    background: #E67E22;
}

.fourteen {
    background: #D35400;
}

.fifteen {
    background: #E74C3C;
}

.sixteen {
    background: #C0392B;
}

.seventeen {
    background: #ECF0F1;
}

.seventeen.clouds {
    color: #BDC3C7;
}

.eighteen {
    background: #BDC3C7;
}

.nineteen {
    background: #95A5A6;
}

.twenty {
    background: #7F8C8D;
}
</style>

<body>
    <div id="chart"></div>

    <script>
    <?php
    
    $sql = "SELECT c.clr_id,c.reason_for_clearance
    FROM clearance c 
    INNER JOIN fin_clearance_request r ON c.clr_id = r.clr_id";
    
    // Execute the query
    $result = mysqli_query($connection, $sql);
    
    // Variables to hold the counts
    $completionCount = 0;
    $transferCount = 0;
    $withdrawalCount = 0;
    $othersCount = 0;
    
    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $reason = $row['reason_for_clearance'];
    
        // Increment the respective count variable based on the reason
        if ($reason == 'Completion') {
            $completionCount++;
        } elseif ($reason == 'Transfer') {
            $transferCount++;
        } elseif ($reason == 'Withdrawal') {
            $withdrawalCount++;
        } else {
            $othersCount++;
        }
    }
    
            ?>
    //chart data 
    var chartjson = {
        "title": "Students Reasons for Clearances Statistics ",
        "data": [{
                "name": "Completion",
                "score": <?php echo $completionCount;?>
            },
            {
                "name": "Transfer",
                "score": <?php echo $transferCount;?>
            },
            {
                "name": "Widthdrawal",
                "score": <?php echo $withdrawalCount;?>
            },
            {
                "name": "Others",
                "score": <?php echo $othersCount;?>
            }
        ],
        "xtitle": "Reasons for clearances",
        "ytitle": "Counts",
        "ymax": 100,
        "ykey": 'score',
        "xkey": "name",
        "prefix": "%"
    }
    //chart colors 
    var colors = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve',
        'thirteen', 'fourteen'
    ];
    //constants
    var TROW = 'tr',
        TDATA = 'td';
    var chart = document.createElement('div');
    //create the chart canvas 
    var barchart = document.createElement('table');
    //create the title row 
    var titlerow = document.createElement(TROW);
    //create the title data 
    var titledata = document.createElement(TDATA);
    //make the colspan to number of records 
    titledata.setAttribute('colspan', chartjson.data.length + 1);
    titledata.setAttribute('class', 'charttitle');
    titledata.innerText = chartjson.title;
    titlerow.appendChild(titledata);
    barchart.appendChild(titlerow);
    chart.appendChild(barchart);
    //create the bar row 
    var barrow = document.createElement(TROW);
    //lets add data to the chart 
    for (var i = 0; i < chartjson.data.length; i++) {
        barrow.setAttribute('class', 'bars');
        var prefix = chartjson.prefix || '';
        //create the bar data 
        var bardata = document.createElement(TDATA);
        var bar = document.createElement('div');
        bar.setAttribute('class', colors[i]);
        bar.style.height = chartjson.data[i][chartjson.ykey] + prefix;
        bardata.innerText = chartjson.data[i][chartjson.ykey] + prefix;
        bardata.appendChild(bar);
        barrow.appendChild(bardata);
    }
    //create legends 
    var legendrow = document.createElement(TROW);
    var legend = document.createElement(TDATA);
    legend.setAttribute('class', 'legend');
    legend.setAttribute('colspan', chartjson.data.length);
    //add legend data 
    for (var i = 0; i < chartjson.data.length; i++) {
        var legbox = document.createElement('span');
        legbox.setAttribute('class', 'legbox');
        var barname = document.createElement('span');
        barname.setAttribute('class', colors[i] + ' xaxisname');
        var bartext = document.createElement('span');
        bartext.innerText = chartjson.data[i][chartjson.xkey];
        legbox.appendChild(barname);
        legbox.appendChild(bartext);
        legend.appendChild(legbox);
    }
    barrow.appendChild(legend);
    barchart.appendChild(barrow);
    barchart.appendChild(legendrow);
    chart.appendChild(barchart);
    document.getElementById('chart').innerHTML = chart.outerHTML;
    </script>
</body>

</html>