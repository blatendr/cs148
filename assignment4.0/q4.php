<?php
include "top.php";
$count = 0;

$columns = 5;
//now print out each record
 print '<table>';  
$query = "SELECT * FROM tblCourses WHERE fldCourseName='Database Design for the Web'";  
// $query = 'SELECT'. $fieldName. 'FROM' . $tableName;
 
    $info2 = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);
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
   print 'There is one of our class: ' . $count;
    print'</table>'; //
   
?>