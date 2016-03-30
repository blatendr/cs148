<!DOCTYPE html>
<html lang="en"><head>
        <title>The Fit Family</title>
        <meta charset="utf-8">
        <meta name="author" content="Jaime Simmons">
        <meta name="description" content="The Fit Family">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

            <!--[if lt IE 9]>
                    <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
            <![endif]-->

        <link rel="stylesheet" href="style.css" media="screen">
        <link rel="stylesheet" href="print.css" media="print">	

        </head>


<body id="table">

<header>

    <a href="http://jsimmon1.w3.uvm.edu/cs148/assignment10/main.php"><img id="logo" src="images/logo.png" alt="logo"></a>
</header>
<nav id="nav">
        <ul>
            <li class="navItem"><a href="main.php">Home</a></li>
            <li class="navItem"><a href="portfolio.php">Transformations</a></li>
            <li class="navItem"><a href="form.php">Your Account</a></li>
            <li class="navItem"><a href="services.php">Fitness Plans</a></li>
            <li id="active" class="navItem"><a href="table.php?getRecordsFor=tblPlan#tblPlan">View Status</a></li>
            <li class="navItem"><a href="contact.php">Contact</a></li>
        </ul>
</nav>

<?php

//##############################################################################
//
// This is where we join all three tables and display the information
// 
//##############################################################################
include "top.php";

$tableName = "";

if (isset($_GET['getRecordsFor'])) {
    $tableName = $_GET['getRecordsFor'];
}

// Begin output
print '<article>';
print '<h2>Database: ' . DATABASE_NAME . '</h2>';

// print out a list of all the tables and their description
// make each table name a link to display the record
print '<section id="tables2" class="float_left">';

print '<table>';

$query = 'SHOW TABLES';

$results = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

// loop through all the tables in the database, display fields and properties
foreach ($results as $row) {

    // table name link
    print '<tr class="odd">';
    print '<th colspan="6">';
    print '<a href="?getRecordsFor=' . htmlentities($row[0], ENT_QUOTES) . "#" . htmlentities($row[0], ENT_QUOTES) . '">';
    print htmlentities($row[0], ENT_QUOTES) . '</a>';
    print '</th>';
    print '</tr>';

    //get the fields and any information about them
    $query = 'SHOW COLUMNS FROM ' . $row[0];
    $results2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

    foreach ($results2 as $row2) {
        print '<tr>';
        print '<td>' . $row2['Field'] . '</td>';
        print '<td>' . $row2['Type'] . '</td>';
        print '<td>' . $row2['Null'] . '</td>';
        print '<td>' . $row2['Key'] . '</td>';
        print '<td>' . $row2['Default'] . '</td>';
        print '<td>' . $row2['Extra'] . '</td>';
        print '</tr>';
    }
}
print '</table>';
print '</section>';

// Display all the records for a given table
if ($tableName != "") {
    print '<aside id="records">';

    $query = 'SHOW COLUMNS FROM ' . $tableName;
    $info = $thisDatabaseReader->select($query,  "", 0, 0, 0, 0, false, false);

    $span = count($info);

    //print out the table name and how many records there are
    print '<table>';

    $query = 'SELECT * FROM ' . $tableName;
    $a = $thisDatabaseReader->select($query,  "", 0, 0, 0, 0, false, false);

    print '<tr>';
    print '<th colspan=' . $span . '>' . $query;
    print '</th>';
    print '</tr>';

    print '<tr>';
    print '<th colspan=' . $span . '>' . $tableName;
    print ' ' . count($a) . ' records';
    print '</th>';
    print '</tr>';

    // print out the column headings, note i always use a 3 letter prefix
    // and camel case like pmkCustomerId and fldFirstName
    print '<tr>';
    $columns = 0;
    foreach ($info as $field) {
        print '<td>';
        $camelCase = preg_split('/(?=[A-Z])/', substr($field[0], 3));

        foreach ($camelCase as $one) {
            print $one . " ";
        }

        print '</td>';
        $columns++;
    }
    print '</tr>';

    //now print out each record
    $query = 'SELECT * FROM tblPlan'; //Query to select the desired result (q01 etc.)
    $info2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

    $highlight = 0; // used to highlight alternate rows
    foreach ($info2 as $rec) {
        $highlight++;
        if ($highlight % 2 != 0) {
            $style = ' odd ';
        } else {
            $style = ' even ';
        }
        print '<tr class="' . $style . '">';
        for ($i = 0; $i < $columns; $i++) {
            print '<td>' . $rec[$i] . '</td>';
        }
        print '</tr>';
    }

    // all done
    print '</table>';
    print '</aside>';
}
print '</article>';
include "footer.php";
?>