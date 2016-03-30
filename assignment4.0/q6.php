<?php
include "top.php";
$count = 0;

$columns = 1;
//now print out each record
 print '<table>';  
$query = 'Select fldCourseName FROM tblCourses WHERE fldCourseName LIKE "%data%" AND fldDepartment != "CS" '; //Query to select the desired result (q01 etc.)
    $info2 = $thisDatabaseReader->select($query, "", 1, 2, 4, 0, false, false);

    //$info2 = $thisDatabaseReader->testquery($query, "", 1, 0, 2, 0, false, false);
    $highlight = 0; // used to highlight alternate rows
    foreach ($info2 as $rec) {
        $highlight++;
        if ($highlight % 2 != 0) {
            $style = ' odd ';
        } else {
            $style = ' even ';
        }
        print '<tr class="' . $style . '">';
        for ($i = 0; $i < $columns; $i++) 
        {
            print '<td>' . $rec[$i] . '</td>';
            
        }
        $count++;
        print '</tr>';
    }
   print 'Courses with the word data in it not in Computer Science: ' . $count;
    print'</table>'; //
   
?>