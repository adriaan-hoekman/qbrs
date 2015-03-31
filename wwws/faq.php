<?php
	include_once './includes/header.php';
	include_once '../lib/header.func.php';
	include_once '../lib/global.conf.php';
	include_once '../lib/reg.func.php';
?>

<div class="container">
<h2 align='center'>FREQUENTLY ASKED QUESTIONS</h2>
</br>
<?php
if (isset($_SERVER['HTTP_QUEENSU_NETID']) AND is_registered($dbc, $_SERVER['HTTP_QUEENSU_NETID'])) {
?>
<ol style='width:75%; padding-left:28%; font-size: 16px;'>
	<li><a href="#general-faq">General FAQ</a></li>
	<li><a href="#cyclist-faq">Cyclist FAQ</a></li>
<?php
	if (is_admin($dbc, $_SERVER['HTTP_QUEENSU_NETID'])) {
?>
	<li><a href="#admin-faq">Admin FAQ</a></li>
</ol>
<?php
	}
}
?>
<h3 style='padding-left:25%; font-weight:bold;'><a name="general-faq"></a>General FAQ</h3>
<ol style='width:75%; padding-left:28%; font-size: 16px;'>
	<li>How do I login?</li>
	<ul><li>To log into the system, you can simply click the Login button found in the top right corner of the main page. You will need to provide your Queen’s NetID and password to log into the system.</li></ul>
	<br><li>Can I login if I am not a student, staff, or faculty at Queen’s?</li>
	<ul><li>Unfortunately, if you are not a member of the Queen’s University community, you cannot register any bicycles with the system.</li></ul>
	<br><li>In that case, what <strong>can</strong> I do?</li>
	<ul><li>If you are not a member of the Queen’s University community, you are able to search the database by serial number and if it is present in the database, you will be able to file a report with information on where you found the bicycle and how you would like to return it.</li></ul>
	<br><li>How do I file a missing report if I’ve found a bicycle?</li>
	<ul><li>Enter the serial number of the bicycle into the serial search field and click the Search button. If you are unable to find a serial number of the bicycle, you can still submit a report about the bicycle, simply leave the serial search field blank and click the Search button.</li></ul>
	<br><li>I can’t find the bicycle’s serial number!</li>
	<ul><li>Don’t Panic! Within the Useful Links section at the bottom of the page, there should be a link with instructions on how to find a serial number on a bicycle.</li></ul>
</ol>

<?php
if (isset($_SERVER['HTTP_QUEENSU_NETID']) AND is_registered($dbc, $_SERVER['HTTP_QUEENSU_NETID'])) {
?>
<br>
<h3 style='padding-left:25%; font-weight:bold;'><a name="cyclist-faq"></a>Cyclist FAQ</h3>
<ol style='width:75%; padding-left:28%; font-size: 16px;'>
	<li>How do I register a bicycle?</li>
	<ul><li>After you login to the system, you will be directed to the Cyclist home page. Clicking the “Add Bicycle” button will bring you to a page where you can add your bicycle.</li></ul>
	<br><li>How do I file a missing report if I’ve lost my bicycle?</li>
	<ul><li>If you’ve lost your bicycle you can mark your bicycle as missing by clicking the checkbox in the missing column of that bicycle’s row. The checkbox will bring you to a new page where you will be prompted to enter the details of your loss. That is, of course, provided you were smart enough to register your bicycle before losing it.</li></ul>
	<br><li>How do I edit my bicycle’s information?</li>
	<ul><li>To edit any of your bicycle’s information, just click on the information you want to change to open an inline-editing box which will allow you to make your change. Optionally, just get it right the first time.</li></ul>
	<br><li>How do I edit my bicycle’s picture?</li>
	<ul><li>If you hover your mouse over your bicycle’s picture, a camera icon will appear over the picture’s center. Clicking on the picture will bring you to a new page where you can choose a new picture for your bicycle. Try to avoid too much dirt, please.</li></ul>
	<br><li>How do I delete my bicycle?</li>
	<ul><li>You may have noticed a red X button at the end of each bicycle entry. Pressing this button will bring up a prompt checking if you’re really, really, really sure that you want to delete that bicycle entry. Please actually be sure because deletion is permanent.</li></ul>
	<br><li>How do I edit my phone number?</li>
	<ul><li>Clicking on the underlined text after “Your Phone Number is” will allow you to edit your phone number.</li></ul>
	<br><li>Is it possible to edit my email address or name?</li>
	<ul><li>We currently use Queen’s SSO, that wonderful login system you passed through to get here, to retrieve your Queen’s email and the name Queen’s has you registered under. So no, sorry (not sorry, SSO reduced our workload a ton!), you can’t.</li></ul>
</ol>
<?php
}
?>

<?php
if (isset($_SERVER['HTTP_QUEENSU_NETID']) AND is_admin($dbc, $_SERVER['HTTP_QUEENSU_NETID'])) {
?>
<br>
<h3 style='padding-left:25%; font-weight:bold;'><a name="admin-faq"></a>Admin FAQ</h3>
<ol style='width:75%; padding-left:28%; font-size: 16px;'>
	<li>As an admin, can I also register bicycles with the system?</li>
	<ul><li>Absolutely! Clicking the Manage Personal Bicycles button will take you to the cyclist home page, where you can register your own bicycles. A button labeled Admin Panel will then allow you to navigate back to the Admin page.</li></ul>
	<br><li>How do I search for missing bicycles?</li>
	<ul><li>On the main Admin page, you will see three tabs. By default, the Bicycles tab will be selected. Simply enter the criteria you want to search by into the input text boxes and press Search. Pressing reset will reset the search criteria.</li></ul>
	<br><li>Can I search for anything else?</li>
	<ul><li>You can also search for Reports and Users. Simply click on the tab you wish to search for, enter your search criteria, and press search. Pressing reset will reset the search criteria.</li></ul>
	<br><li>What is this Download button I keep seeing?</li>
	<ul><li>The Download button allows you to save any of the searches you have made to your local computer.</li></ul>
	<br><li>What file format is used for the downloaded searches?</li>
	<ul><li>When downloaded, searches are saved in a <strong>CSV</strong> file.</li></ul>
	<br><li>How do I add another Admin? Wait, I can do that?</li>
	<ul><li>Yes, you can! To add another user as an Admin, simply press the Manage Administrators button to navigate to the Manage Administrators page. Here you will be able to enter the NetID of the user you want to add (or remove).</li></ul>
	<br><li>How do I choose whether or not I receive e-mails?</li>
	<ul><li>You can also do this on the Manage Administrators page. Simply toggle the checkbox based on whether or not you want to receive e-mails (checked means Yes and unchecked means No) and press save.</li></ul>
	<br><li>Why can’t I remove myself as an Admin or choose to not receive e-mails?</li>
	<ul><li>Unfortunately, you cannot remove yourself as an Admin as a security measure and to make sure that there is always at least one admin.</li></ul>
	<ul><li>As for not receiving e-mails, in order to ensure that QBRS runs at its maximum potential, there must always be at least one admin receiving e-mail.</li></ul>
	<br><li>How can I change the useful links?</li>
	<ul><li>You can edit, add, or remove any of the useful links by navigating to the Edit Useful Links page accessed by the button of the same name.</li></ul>
	<ul><li>To add a link, simply press Add Link and an empty link will be added to the Useful Links.</li></ul>
	<ul><li>To edit a link, press on current link or description to edit it inline.</li></ul>
	<ul><li>Removing a link is as simple as pressing the red X.</li></ul>
</ol>
<?php
}
?>

</div>



<?php
	include_once './includes/footer.php';
?>