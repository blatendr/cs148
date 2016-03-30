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


         <?php
        $debug = false;
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;
        $domain = "http://";
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $domain = "https://";
            }
        }
        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
        $domain .= $server;
        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
        $path_parts = pathinfo($phpSelf);
        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries
//
        require_once('lib/security.php');
        if ($path_parts['filename'] == "form") {
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
        }
        ?>	
        
        </head>

     
<body id="form">

<header>
    <a href="http://jsimmon1.w3.uvm.edu/cs142/assignment10/main.php"><img id="logo" src="images/logo.png" alt="logo"></a>
</header>



<nav id="nav">
        <ul>
            <li class="navItem"><a href="main.php">Home</a></li>
            <li class="navItem"><a href="portfolio.php">Transformations</a></li>
            <li id="active" class="navItem"><a href="form.php">Your Account</a></li>
            <li class="navItem"><a href="services.php">Fitness Plans</a></li>
            <li class="navItem"><a href="table.php?getRecordsFor=tblPlan#tblPlan">View Status</a></li>
            <li class="navItem"><a href="contact.php">Contact</a></li>
        </ul>
</nav>


<article id="formarticle">

    <p>If you have never filled out a form before, do not worry! This is the easiest form you will ever fill out. 
       All you have to do is type out your first and last name and email. The rest is just clicking on the check boxes and menus!
       Choose the options that best describe your ideal workout routine and conform to your schedule.
       When you have filled it out to the best of your ability just hit submit on the bottom and you will receive an email
       with all of your responses! 
    </p>
    
    <p>
       A few things to know before hitting submit: 
       <br>
       Do not type in any information you do not want others to see. 
       You have to fill out ALL of the contact information and click each box you want. Otherwise, the form will not submit
       and I will not know what to prepare for your workout! 
    </p>
    
    <p>Once your registration is sent, I will call you to confirm your routine!</p>
         
<?php
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// SECTION: 1 Initialize variables//

//
// SECTION: 1a.
// variables for the classroom purposes to help find errors.

if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}
if ($debug)
    print "<p>DEBUG MODE IS ON</p>";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$yourURL = $domain . $phpSelf;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form
$firstName = "";
$lastName = "";
$email = "";
$startWeight = "";
$goalWeight = "";
$height = "";
$work = "upperBody";
$gender = 0;
$move1 = 0;
$move2 = 0;
$move3 = 0;
$planID = "";

$username = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
$email = $username + "@uvm.edu";
 $existingUser = false;

$query = 'Select pmkEmail from tblUsers';

//$results = $thisDatabaseReader->select($query, "", 1, 0, 0, 0, false, false);
//
//foreach ($results as $result)
//{
//   if ($username = $result)
//    {
//      $returningUser = true;  
//        
//    }
//    
//    
//}



//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
$startWeightERROR = false;
$goalWeightERROR = false;
$heightERROR = false;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
// array used to hold form values that will be written to a CSV file
$dataRecord = array();
$mailed = false; // have we mailed the information to the user?
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    // 
    //if (!securityCheck(true)) {
      //  $msg = "<p>Sorry you cannot access this page. ";
        //$msg.= "Security breach detected and reported</p>";
        //die($msg);
    //}

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;
    
    $height = filter_var($_POST["txtheight"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $height;

    
    $startWeight = filter_var($_POST["txtStartWeight"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $startWeight;
    
    
    
    $goalWeight = filter_var($_POST["txtGoalWeight"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $goalWeight;
    
       $work = htmlentities($_POST["radWork"], ENT_QUOTES, "UTF-8");
   $dataRecord[] = $work;
    

    if (isset($_POST["chkMorning1"])) {
        if ($work == 0)
            $move1 = 4; 
    } else {
        $move1 = 0;
    }
    
    if (isset($_POST["chkMorning2"])) {
       if ($work == 0)
        $move2 = 5; 
    } else {
         $move2 = 0; 
    }
    
     if (isset($_POST["chkMorning3"])) {
       if ($work == 0)
        $move3 = 6; 
    } else {
         $move3 = 0; 
    }
    
    
  
 if (isset($_POST["chkMorning1"])) {
        if ($work == 1 || $work ==2)
            $move1 = 1; 
    } else {
        $move1 = 0;
    }
    
    $dataRecord[] = $move1;
 if (isset($_POST["chkMorning2"])) {
        if ($work == 1 || $work ==2)
            $move2 = 2; 
    } else {
        $move2 = 0;
    }
    
    $dataRecord[] = $move2;
 if (isset($_POST["chkMorning3"])) {
        if ($work == 1 || $work ==2)
            $move3 = 3; 
    } else {
        $move3 = 0;
    }
    
    $dataRecord[] =$move3;
   
    
}





    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    
      if ($startWeight == "") {
        $errorMsg[] = "Please enter your starting weight";
        $startWeightERROR = true;
    } elseif (!verifyNumeric($startWeight)) {
        $errorMsg[] = "Your starting weight appears to be incorrect.";
        $startWeightERROR = true;
    }
      if ($goalWeight == "") {
        $errorMsg[] = "Please enter your goal weight";
        $startWeightERROR = true;
    } elseif (!verifyNumeric($goalWeight)) {
        $errorMsg[] = "Your goal weight appears to be incorrect.";
        $goalWeightERROR= true;
    }
   
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //
    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.
        $fileExt = ".csv";
        $myFileName = "data/registration";
        $filename = $myFileName . $fileExt;
        if ($debug)
            print "\n\n<p>filename is " . $filename;
        // now we just open the file for append
        $file = fopen($filename, 'a');
        // write the forms informations
        fputcsv($file, $dataRecord);
        // close the file
        fclose($file);
       
       
       
           $fname = $dataRecord[0];
           $lname = $dataRecord[1];
            $email = $dataRecord[2];
            $height = $dataRecord[3];
            $startWeight = $dataRecord[4];
            $goalWeight= $dataRecord[5];
            $gender = $dataRecord[6];
            $moveOne = $dataRecord[7];
            $moveTwo = $dataRecord[8];
           $moveThree = $dataRecord[9];
           
           
       
        //mysql_query("INSERT INTO member(fname=?, lname=?, email=?, height=?, sWeight=?, gWeight=?, gender=? )"
        //. "VALUES('$fname', '$lname', '$email', '$height', '$startWeight', '$goalWeight', '$gender')");
        
        $query = 'INSERT INTO tbl_Users (fname=?, lname=?, email=?, height=?, sWeight=?, gWeight=?, gender=? )';
        //$thisDatabaseWriter->testquery($query, $dataRecord, 0, 0, 18, 0, false, false);
        
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).
        $message = '<h3>Your information.</h3>';

        foreach ($_POST as $key => $value) {
            if ($key != btnSubmit) {
                $message .= "<p>";

                $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));

                foreach ($camelCase as $one) {
                    $message .= $one . " ";
                }
                $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
            }
        }
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "";
        $from = "the fit family <jmdyer@uvm.edu>";
        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Your Info sdflskdfsldkf: " . $todaysDate;
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end form is valid
 // ends if form was submitted.
//#############################################################################
//
// SECTION 3 Display Form
//
?>


    <?php
//####################################
//
    // SECTION 3a.
//
    // 
// 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
         
        
        print "<h1>Your Request has ";
        if (!$mailed) {
            print "not ";
        }
        print "been processed</h1>";
        print "<p>A copy of this message has ";
        if (!$mailed) {
            print "not ";
        }
   
        
        print "been sent</p>";
        print "<p>To: " . $email . "</p>";
        print "<p>Mail Message:</p>";
        print $message;
    } else {
        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form
        if ($errorMsg) {
            print '<div id="errors">';
            print "<ol>\n";
            foreach ($errorMsg as $err) {
                print "<li>" . $err . "</li>\n";
            }
            print "</ol>\n";
            print '</div>';
        }
        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:
          value="<?php print $email; ?>
          this makes the form sticky by displaying either the initial default value (line 35)
          or the value they typed in (line 84)
          NOTE this line:
          <?php if($emailERROR) print 'class="mistake"'; ?>
          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.
         */
        ?>
        
        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
            
                <?php
                if ($existingUser == false)
            {
                
                include"loginForm.php";
            }
              
                ?>
                   
            <fieldset class ="form">    
                   <label for="txtStartWeight" class="required">*Current Weight
                        <input id="txtStartWeight" name="txtStartWeight" value="" 
                           accept=""tabindex="100" maxlength="25" placeholder="Enter your current weight" 
                           accesskey="" autofocus="" onfocus="this.select()" required="" type="text"
                                   <?php if ($startWeightERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
                
                
                
                <label for="txtGoalWeight" class="required">*Goal Weight
                        <input id="txtGoalWeight" name="txtGoalWeight" value="" 
                           accept=""tabindex="100" maxlength="25" placeholder="Enter your Goal weight" 
                           accesskey="" autofocus="" onfocus="this.select()" required="" type="text"
                                   <?php if ($goalWeightERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
            </fieldset>
            
            
            
               
                <!--
                    <fieldset  class="lists">	
                        <legend>*What is your gender?</legend>
                        <select id="lstDay" 
                                name="lstDay" 
                                tabindex="150" >
                            <option <?php if ($gender == 1) print " selected "; ?>
                                value=1>Male</option>
                            <option <?php if ($day == 0) print " selected "; ?>
                                value=0>Female</option>
                            <option <?php if ($day == 2) print " selected "; ?>
                                value=2>Other</option>
                            
               
                        </select>
                    </fieldset> <!-- ends lists -->    
                        
                    <fieldset class="checkbox">
                        <legend>*What type workout are you looking for? (check all that apply):</legend>
                        <label><input type="checkbox" 
                                      id="chkMorning1" 
                                      name="chkMorning1" 
                                      value="1"
                                      <?php if ($move1) print " checked "; ?>
                                      tabindex="420"> Upper Body</label>
                        <label><input type="checkbox" 
                                      id="chkMorning2" 
                                      name="chkMorning2" 
                                      value="2"
                                      <?php if ($move2) print " checked "; ?>
                                      tabindex="430"> Lower Body</label>
                        <label><input type="checkbox" 
                                      id="chkMorning3" 
                                      name="chkMorning3" 
                                      value="3"
                                      <?php if ($move3) print " checked "; ?>
                                      tabindex="430">Abs</label>
                        
            </fieldset> <!-- ends checkbox -->
                   

                </fieldset> <!-- ends form -->

                <fieldset class="buttons">
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
                    <input type="reset" id="btnReset" name="btnReset" value="Reset Form" tabindex="990" class="button">
                </fieldset> <!-- ends buttons -->

            </fieldset> <!-- Ends Wrapper -->
        </form>

        <?php
    } // end body submit
    ?>

</article>

    
<footer>
    <p>The Fit Family</p>
    <p>100 Campus Drive</p>
    <p>Burlington, VT 05401 </p>
    <p>TheFitFamily@fit.com</p>
        </footer>

</body></html>