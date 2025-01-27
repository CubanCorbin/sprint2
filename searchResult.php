<?php
/****************************************************************
* This class is used to connect to the db and display the       *
* search results for CNMT-310 Sprint 1                          *
*                                                                *
* @author Tim, Filip and Corbin                                 *
* @FileName: searchResults.php                                  *
*                                                               *
* Changelog:                                                    *
* 20190926 - Original code constructed                          *
* 20191031 - included the DB Class, connection error checking,  *
*            sanitization                                       *
* 20191107 - corrected php catch                                *
****************************************************************/
session_start();
require_once("classes/DB.class.php");
require_once("classes/Template.php");
$page = new Template("Action Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/stylesheet.css">');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/searchResultTables.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
include("topNavBar.php");

//checks if post is set, and not an empty string or a single space
if(isset($_POST['Search_Bar_Name']) && $_POST['Search_Bar_Name'] != '' && $_POST['Search_Bar_Name'] != ' ') { 
	//New datbase connection
	$con = new DB(); 
	//Check the connection
	print 	'<div class="content">';
	if (!$con->getConnStatus()) {
		print "\n\nAn error has occurred with connection\n";
		exit;
	}else{
		//Sanitize the user input
		$searchTerm = $con->dbESC($_POST['Search_Bar_Name']);
		//query the db for the search results	
		$query = "SELECT * FROM albums WHERE albums.albumArtist LIKE '%$searchTerm%' or albums.AlbumTitle LIKE '%$searchTerm%'";
		$result = $con->dbCall($query);
		if (!$result) { 
			print '<h2>No results match your query</h2>';
		}else{
			print '<table id="t01">
			<caption><h2>Search Results:</h2></caption>
			<thead>
			<tr>
				<th class = "r1">ID#</th>
				<th class = "r2">Album Artist</th>
				<th class = "r3">Album Title</th>
				<th class = "r4">Album Duration</th>
				<th class = "r5"></th>
			</tr>
			</thead><tbody>
			<tbody>';
			foreach ($result as $row) {	
			print '<tr>
				<td class = "r1">';echo $row["albumId"];              print '</td>';
				print ' <td class = "r2">';echo $row["albumArtist"]; print'</td>';
				print ' <td class = "r3">';echo $row["albumTitle"];  print' </td>';
				print ' <td class = "r4">';echo $row["duration"];  print' </td>';
				print ' <td class = "r5"> <a href="'; echo $row["albumLink"];  print' target = "_blank"><img src="images/amazon-badge.png" width="150px" height="20px" title ="Buy at Amazon" alt="Buy at Amazon"></a> </td>';
				print' </tr>';
			}//end foreach
			print '</tbody>
			</table><br>';
		}//end if
		$result = false; //Reset result when done with it to prevent interfering with later calls.
	}//endif
}//end if
else
{
	print '<div class="content">
	<h2> Please click "Search" from the top bar and fill out the field to search</h2>';
}
//Show the button to search again
print '<form class="formStyle" name="frmSearchResults" id="searchResults" method ="Post" action="search.php">
		<button type="submit" class="button" id="btnSubmit" name="btnSubmit">Search Again</button>	
		</form>
</div>';
print $page->getBottomSection();
?>