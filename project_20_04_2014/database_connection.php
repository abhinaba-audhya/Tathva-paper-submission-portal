<?php

/*Define constant to connect to database */
DEFINE('DATABASE_USER', 'papersubmission');
DEFINE('DATABASE_PASSWORD', 'George@91');
DEFINE('DATABASE_HOST', 'papersubmission.db.11374925.hostedresource.com');
DEFINE('DATABASE_NAME', 'papersubmission');
/*Default time zone ,to be able to send mail */
//date_default_timezone_set('UTC');

/*You might not need this */
//This is the address that will appear coming from ( Sender )
//define('EMAIL', 'ismaakeel@gmail.com');
define('EMAIL', 'server_norply@allstuffcodes.info');
/*Define the root url where the script will be found such as http://website.com or http://website.com/Folder/ */
DEFINE('WEBSITE_URL', 'http://allstuffcodes.info/paper_submission');


// Make the connection:
$dbc = @mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD,
    DATABASE_NAME);

if (!$dbc) {
    trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}

?>