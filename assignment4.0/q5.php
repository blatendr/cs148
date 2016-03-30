<?php
include "top.php";
$count = 0;

$columns = 2;
//now print out each record
 print '<table>';  
$query = 'Select fldFirstName,fldLastName FROM tblTeachers WHERE pmkNetID like "R%" AND pmkNetID like "%O"'; 
// $query = 'SELECT'. $fieldName. 'FROM' . $tableName;
 
    $info2 = $thisDatabaseReader->select($query, "", 1, 1, 4, 0, false, false);
    //$info2 = $thisDatabaseReader->testquery($query, "", 1, 1, 4, 0, false, false);
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
   print 'Number of teachers netid that start with "R" and end with "0" ' . $count;
    print'</table>'; //
   
?>