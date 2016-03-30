code exec 4: <?php
session_start();
include('connection.php');
$fname=$_POST['fldFirstName'];
$lname=$_POST['fldLastName'];
$mname=$_POST['pmkEmail'];
$address=$_POST['fldGender'];
$contact=$_POST['fldHeight'];
$pic=$_POST['fldStartWeight'];
$username=$_POST['fldGoalWeight'];
mysql_query("INSERT INTO tblUsers(fldFirstName, fldLastName, pmkEmail, fldGender, fldHeight, fldStartWeight, fldGoalWeight)"
        . "VALUES('$fname', '$lname', '$mname', '$address', '$contact', '$pic', '$username')");
header("location: form4.php?remarks=success");
mysql_close($con);

if (isset($_POST["btnSubmit"]) ) { // closing of if marked with: end body submit
    $username = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
$email = $username + "@uvm.edu"; 
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
$to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "";
        $from = "the fit family <jmdyer@uvm.edu>";
        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Your Info: " . $todaysDate;
        $mail($to, $cc, $bcc, $from, $subject, $message);

        
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
       


    }
?>