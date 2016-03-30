 
<?php
include "top.php";
$count = 0;

$columns = 1;
//now print out each record
 print '<table>';  
// $query = 'SELECT'. $fieldName. 'FROM' . $tableName;
$query = 'Select fldDepartment FROM tblCourses WHERE fldCourseName like "Introduction%"';   
 
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
            $count++;
        }
        print '</tr>';
    }
   print 'Departments with "Introduction" in them: ' . $count;
    print'</table>'; //
   
?>