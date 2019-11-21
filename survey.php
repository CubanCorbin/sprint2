<?php
/****************************************************************
* This class is used to enter the users survey input data.      *
* The form is validated with Javascript (if available on the    *
* client) and also self-validates with a separate validation    *
* function from the class folder.                               *
*                                                               *
* @author Tim, Filip and Corbin                                 *
* @FileName: survey.php                                         *
*                                                               *
* Changelog:                                                    *
* 20190926 - Original code constructed                          *
* 20191031 - Updated code and removed php echo/error markers    *
* 20191101 - Added php class form validation                    *
*                                                               *
****************************************************************/
session_start();
require_once("classes/DB.class.php");
require_once("classes/Template.php");
require_once("functions/surveyValidation.php");
$page = new Template("Survey Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/stylesheet.css">');
$page->addHeadElement("<script src='js/survey.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
include("topNavBar.php");

print	'
<div class="content">	
	<form name="survey" action="surveyResult.php" method="post">
		<div class="formboxes">
			<span>Email:</span><br><br>			
			<input type="text" id="txtEmail" name="email" placeholder="Enter a valid Email">
			<br>
			<span id="emailError"></span>
		</div>		
		<div class="formboxes" id="Majors">
			<span>What is your major?</span><br><br>
			<input type="checkbox" id="chkMajor1" name="major[0]" value="CIS-AppDev"> CIS-AppDev<br>
			<input type="checkbox" id="chkMajor2" name="major[1]" value="CIS-Networking"> CIS-Networking<br>
			<input type="checkbox" id="chkMajor3" name="major[2]" value="WDMD"> WDMD<br>
			<input type="checkbox" id="chkMajor4" name="major[3]" value="WD"> WD<br>
			<input type="checkbox" id="chkMajor5" name="major[4]" value="HTI"> HTI<br>
			<input type="checkbox" id="chkMajor6" name="major[5]" value="Other"> Other<br>
			<span id="checkBoxError"></span>
		</div>		
		<div class="formboxes">
			<span>What grade do you expect to receive in CNMT 310?</span><br><br>
			
			<input type="radio" name="grade" id="rdoGradeA" value="A"> A<br>
			<input type="radio" name="grade" id="rdoGradeB" value="B"> B<br>
			<input type="radio" name="grade" id="rdoGradeC" value="C"> C<br>
			<input type="radio" name="grade" id="rdoGradeD" value="D"> D<br>
			<input type="radio" name="grade" id="rdoGradeF" value="F"> F<br>
			
			<span id="gradeError"></span>
		</div>			
		<div class="formboxes">
			<span>What is your favorite pizza topping?</span><br><br>
			<input type="radio" name="pizzaTopping" id="rdoPizzaToppingPepperoni" value="Pepperoni"> Pepperoni<br>
			<input type="radio" name="pizzaTopping" id="rdoPizzaToppingSausage" value="Sausage"> Sausage<br>
			<input type="radio" name="pizzaTopping" id="rdoPizzaToppingBacon" value="Bacon"> Bacon<br>
			<input type="radio" name="pizzaTopping" id="rdoPizzaToppingMushroom" value="Mushroom"> Mushroom<br>
			<input type="radio" name="pizzaTopping" id="rdoPizzaToppingPineapple" value="Pineapple"> Pineapple<br>
			<span id="pizzaError"></span>
		</div>			
		<br>	
		<input class="button" name ="surveySubmit" type="submit" value="Submit" onclick="return validateForm()">			
	</form>
</div>';
print $page->getBottomSection();
?>
