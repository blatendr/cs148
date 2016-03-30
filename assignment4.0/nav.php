<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($path_parts['filename'] == "select") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="select.php">Home</a></li>';
        }
        
        if ($path_parts['filename'] == "tables") {
            print '<li class="activePage">Display Tables</li>';
        } else {
            print '<li><a href="tables.php">Display Tables</a></li>';
        }
        
        if ($path_parts['filename'] == "q1.php") {
            print '<li class="activePage">Q1</li>';
        } else {
            print '<li><a href="q1.php">Query One</a></li>';
        }
        
          if ($path_parts['filename'] == "q2.php") {
            print '<li class="activePage">Q2</li>';
        } else {
            print '<li><a href="q2.php">Query Two</a></li>';
        }
        
          if ($path_parts['filename'] == "q3.php") {
            print '<li class="activePage">Q3</li>';
        } else {
            print '<li><a href="q3.php">Query Three</a></li>';
        }
        if ($path_parts['filename'] == "q4.php") {
            print '<li class="activePage">Q4</li>';
        } else {
            print '<li><a href="q4.php">Query Four</a></li>';
        }
        
         if ($path_parts['filename'] == "q5.php") {
            print '<li class="activePage">Q5</li>';
        } else {
            print '<li><a href="q5.php">Query Five</a></li>';
        }
        
          if ($path_parts['filename'] == "q6.php") {
            print '<li class="activePage">Q6</li>';
        } else {
            print '<li><a href="q6.php">Query Six</a></li>';
        }
        
        if ($path_parts['filename'] == "q7.php") {
            print '<li class="activePage">Q7</li>';
        } else {
            print '<li><a href="q7.php">Query Seven</a></li>';
        }
        
        if ($path_parts['filename'] == "q8.php") {
            print '<li class="activePage">Q8</li>';
        } else {
            print '<li><a href="q8.php">Query Eight</a></li>';
        }
        
          if ($path_parts['filename'] == "q9.php") {
            print '<li class="activePage">Q9</li>';
        } else {
            print '<li><a href="q9.php">Query NINE</a></li>';
        }
        
           if ($path_parts['filename'] == "q10.php") {
            print '<li class="activePage">Q10</li>';
        } else {
            print '<li><a href="q10.php">Query Ten</a></li>';
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

