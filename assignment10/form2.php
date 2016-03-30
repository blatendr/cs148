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
        <!--script type="text/javascript">
function validateForm()
{
var a=document.forms["reg"]["fname"].value;
var b=document.forms["reg"]["lname"].value;
var c=document.forms["reg"]["mname"].value;
var d=document.forms["reg"]["address"].value;
var e=document.forms["reg"]["contact"].value;
var f=document.forms["reg"]["pic"].value;
var g=document.forms["reg"]["pic"].value;
var h=document.forms["reg"]["pic"].value;
if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e=="") && (f==null || f==""))
  {
  alert("All Field must be filled out");
  return false;
  }
if (a==null || a=="")
  {
  alert("First name must be filled out");
  return false;
  }
if (b==null || b=="")
  {
  alert("Last name must be filled out");
  return false;
  }
if (c==null || c=="")
  {
  alert("Gender name must be filled out");
  return false;
  }
if (d==null || d=="")
  {
  alert("address must be filled out");
  return false;
  }
if (e==null || e=="")
  {
  alert("contact must be filled out");
  return false;
  }
if (f==null || f=="")
  {
  alert("picture must be filled out");
  return false;
  }
if (g==null || g=="")
  {
  alert("username must be filled out");
  return false;
  }
if (h==null || h=="")
  {
  alert("password must be filled out");
  return false;
  }
}
</script-->
        <script type="text/javascript">

</script>
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
   <!--?php  
    $username = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
                            $email = $username + "@uvm.edu";
                                $existingUser = false;

//$query = 'Select email from member5';

$results = $thisDatabaseReader->select($query, "", 1, 0, 0, 0, false, false);

foreach ($results as $result)
{
   if ($email = $result)
    {
      $returningUser = true;  
        
    }
    
    
}
          ?>-->
    
    
    
    
    <form name="reg" action="code_exec4.php" onsubmit="" method="post">
            <table width="274" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                    <td colspan="2">
                        <div align="center">
                            <?php
                            $remarks = $_GET['remarks'];
                       
    
                            print '<h1> sdkjfhskdjfhskjdfh</h1>'; 
                                                if ($remarks == null and $remarks == "") {
                                echo 'Register Here';
                            }
                            if ($remarks == 'success') {
                                echo 'Registration Success';
                            }
                            ?>	
                        </div></td>
                </tr>
                
                <tr>
                    <td width="95"><div align="right">First Name:</div></td>
                    <td width="171"><input type="varchar" size="50" name="fldFirstName" /></td>
                </tr>
                <tr>
                    <td><div align="right">Last Name:</div></td>
                    <td><input type="varchar" name="fldLastName" size="50"/></td>
                </tr>
                <tr>
                    <td><div align="right">Email:</div></td>
                    <td><input type="varchar" name="pmkEmail" size="50"/></td>
                </tr>
                <tr>
                    <td><div align="right">Gender:</div></td>
                    <td><input type="radio" name="fldGender" value="0"/>Male</td>
                    <td><input type="radio" name="fldGender" value="1"/>Female</td>
                    <td><input type="radio" name="fldGender" value="0"/>Other</td>
                </tr>
                <tr>
                    <td><div align="right">Goal Weight:</div></td>
                    <td><input type="int" name="fldGoalWeight" min="1" max="4" /></td>
                </tr>
                <tr>
                    <td><div align="right">Start Weight:</div></td>
                    <td><input type="int" name="fldStartWeight" min="1" max="4"/></td>
                </tr>
                <tr>
                    <td><div align="right">Height:</div></td>
                    <td><input type="int" name="fldHeight" min="1" max="4"/></td>
                </tr>
                <tr>
                    <td><div align="right"></div></td>
                    <td><input name="submit" type="submit" value="Submit" /></td>
                </tr>
            </table>
        </form>
</article>    

        <footer>
            <p>The Fit Family</p>
            <p>100 Campus Drive</p>
            <p>Burlington, VT 05401 </p>
            <p>TheFitFamily@fit.com</p>
        </footer>

    </body></html>
