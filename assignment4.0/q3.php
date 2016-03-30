<?php
include "top.php";
$count = 0;

$columns = 12;
//now print out each record
 print '<table>';  
$query = 'Select * FROM tblSections WHERE time(fldStart) = time("13:10:00") AND fldBuilding like "KALKIN%"';   
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
   print 'Total class in kalkin that start at 1:10pm: ' . $count;
    print'</table>'; //
   
?>