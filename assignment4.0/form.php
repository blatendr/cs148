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
            <li class="navItem"><a href="table.php">View Status</a></li>
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
$debug = false;
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
$work = "Interior";
$day = "Monday";
$Morning1 = false;
$Morning2 = false;
$Morning3 = false;
$Afternoon1 = false;
$Afternoon2 = false;
$Afternoon3 = false;

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
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
    if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

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

    $day = htmlentities($_POST["lstDay"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $day;

    if (isset($_POST["chkMorning1"])) {
        $Morning1 = true;
    } else {
        $Morning1 = false;
    }
    $dataRecord[] = $Morning1;
    if (isset($_POST["chkMorning2"])) {
        $Morning2 = true;
    } else {
        $Morning2 = false;
    }
    $dataRecord[] = $Morning2;
    if (isset($_POST["chkMorning3"])) {
        $Morning3 = true;
    } else {
        $Morning3 = false;
    }
    $dataRecord[] = $Morning3;
    if (isset($_POST["chkAfternoon1"])) {
        $Afternoon1 = true;
    } else {
        $Afternoon1 = false;
    }
    $dataRecord[] = $Afternoon1;
    
        if (isset($_POST["chkAfternoon2"])) {
        $Afternoon2 = true;
    } else {
        $Afternoon2 = false;
    }
    $dataRecord[] = $Afternoon2;
    
        if (isset($_POST["chkAfternoon3"])) {
        $Afternoon3 = true;
    } else {
        $Afternoon3 = false;
    }
    $dataRecord[] = $Afternoon3;

    $work = htmlentities($_POST["radWork"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $work;
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
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $firstNameERROR = true;
    }
    if ($lastName == "") {
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your last name appears to have an extra character.";
        $lastNameERROR = true;
    }
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
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
        $from = "Kelly's Painting <jmdyer@uvm.edu>";
        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Your Info: " . $todaysDate;
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end form is valid
} // ends if form was submitted.
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

            <fieldset class="wrapper">
                <legend>Join the Fit Family Today</legend>

                <fieldset class="form">
                    <legend>Please fill out the following registration form to become a member! (*Required)</legend>

                    <fieldset class="contact">
                        <legend>*Contact Information</legend>
                        <label for="txtFirstName" class="required">*First Name
<input id="txtFirstName" name="txtFirstName" value="" 
       tabindex="100" maxlength="25" placeholder="Enter your first name" 
       autofocus="" onfocus="this.select()" required="" type="text"
                                   <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
                        <label for="txtLastName" class="required">*Last Name
                        <input id="txtLastName" name="txtLastName" value="" tabindex="110" maxlength="25" 
                               placeholder="Enter your last name" autofocus="" onfocus="this.select()" required="" type="text"
                                   <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
                        <label for="txtEmail" class="required">*Email
                        <input id="txtEmail" name="txtEmail" value="" tabindex="120" 
                               maxlength="45" placeholder="Enter a valid email address" onfocus="this.select()" 
                               required="" type="email"                            
                            <?php if ($emailERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
                    </fieldset> <!-- ends text -->
                    
                   <fieldset class="radio">
                        <legend>*What kind of workouts are you looking for?</legend>
                        <label><input type="radio" 
                                      id="radWorkInterior" 
                                      name="radWork" 
                                      value="Interior"
                                      <?php if ($work == "Interior") print 'checked' ?>
                                      tabindex="530"> Uppoer Body</label>
                        <label><input type="radio" 
                                      id="radWorkExterior" 
                                      name="radWork" 
                                      value="Exterior"
                                      <?php if ($work == "Exterior") print 'checked' ?>
                                      tabindex="540"> Lower Body</label>
                        <label><input type="radio" 
                                      id="radWorkBoth" 
                                      name="radWork" 
                                      value="Both"
                                      <?php if ($work == "Both") print 'checked' ?>
                                      tabindex="550"> Both</label>
                    </fieldset> <!-- ends radio -->

                    <fieldset  class="lists">	
                        <legend>*Which day is your off day?</legend>
                        <select id="lstDay" 
                                name="lstDay" 
                                tabindex="150" >
                            <option <?php if ($day == "Monday") print " selected "; ?>
                                value="Monday">Monday</option>

                            <option <?php if ($day == "Tuesday") print " selected "; ?>
                                value="Tuesday">Tuesday</option>

                            <option <?php if ($day == "Wednesday") print " selected "; ?>
                                value="Wednesday">Wednesday</option>

                            <option <?php if ($day == "Thursday") print " selected "; ?>
                                value="Thursday">Thursday</option>

                            <option <?php if ($day == "Friday") print " selected "; ?>
                                value="Friday">Friday</option>
                        </select>
                    </fieldset> <!-- ends lists -->    

                    <fieldset class="checkbox">
                        <legend>*What time are you available to workout? (check all that apply):</legend>
                        <label><input type="checkbox" 
                                      id="chkMorning1" 
                                      name="chkMorning1" 
                                      value="Morning1"
                                      <?php if ($Morning1) print " checked "; ?>
                                      tabindex="420"> 8-9 AM</label>
                        <label><input type="checkbox" 
                                      id="chkMorning2" 
                                      name="chkMorning2" 
                                      value="Morning2"
                                      <?php if ($Morning2) print " checked "; ?>
                                      tabindex="430"> 9-10 AM</label>
                        <label><input type="checkbox" 
                                      id="chkMorning3" 
                                      name="chkMorning3" 
                                      value="Morning3"
                                      <?php if ($Morning3) print " checked "; ?>
                                      tabindex="430"> 10-11 AM</label>
                        <label><input type="checkbox" 
                                      id="chkAfternoon1" 
                                      name="chkAfternoon1" 
                                      value="Afternoon1"
                                      <?php if ($Afternoon1) print " checked "; ?>
                                      tabindex="430"> 12-1 PM</label>
                        <label><input type="checkbox" 
                                      id="chkAfternoon2" 
                                      name="chkAfternoon2" 
                                      value="Afternoon2"
                                      <?php if ($Afternoon2) print " checked "; ?>
                                      tabindex="430"> 1-2 PM</label>  
                        <label><input type="checkbox" 
                                      id="chkAfternoon3" 
                                      name="chkAfternoon3" 
                                      value="Afternoon3"
                                      <?php if ($Afternoon3) print " checked "; ?>
                                      tabindex="430"> 2-3 PM</label>  
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