
<?php
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
        $errorMsg[] = "Please enter your uvm affliated email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    }
     if ($height == "") {
        $errorMsg[] = "Please enter your height (in numeric inches)";
        $heightERROR = true;
    } elseif (!verifyNumeric($height)) {
        $errorMsg[] = "Your height appears to be incorrect. Make sure it is in numeric inches";
        $heightERROR= true;
    }

    


?>



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
                               maxlength="45" placeholder="Enter a valid UVM affiliated email address" onfocus="this.select()" 
                               required="" type="email"                            
                            <?php if ($emailERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
                      
                        
                        <label for="txtHeight" class="required">*Height (in inches)
                        <input id="txtHeight" name="txtHeight" value="" 
                           accept=""tabindex="100" maxlength="25" placeholder="Enter your starting height" 
                           accesskey="" autofocus="" onfocus="this.select()" required="" type="text"
                                   <?php if ($heightERROR) print 'class="mistake"'; ?>
                                   >
                        </label>
                    
                         <fieldset class="radio">
                        <legend>*What is your Gender?</legend>
                        <label><input type="radio" 
                                      id="radWorkInterior" 
                                      name="radWork" 
                                      value="1"
                                      <?php if ($gender == 1) print 'checked' ?>
                                      tabindex="530"> Male</label>
                        <label><input type="radio" 
                                      id="radWorkExterior" 
                                      name="radWork" 
                                      value="0"
                                      <?php if ($gender == 0) print 'checked' ?>
                                      tabindex="540"> Female</label>
                        <label><input type="radio" 
                                      id="radWorkBoth" 
                                      name="radWork" 
                                      value="2"
                                      <?php if ($gender == 2) print 'checked' ?>
                                      tabindex="550"> Other</label>
                    </fieldset> <!-- ends radio -->
                    </fieldset> <!-- ends text -->
