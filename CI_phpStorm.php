<?php  die('OIN');

/**
 * ------------- DO NOT UPLOAD THIS FILE TO LIVE SERVER ---------------------
 *
 * Implements code completion for CodeIgniter in phpStorm
 * phpStorm indexes all class constructs, so if this file is in the project it will be loaded.
 * -------------------------------------------------------------------
 * Drop the following file into a CI project in phpStorm
 * You can put it in the project root and phpStorm will load it.
 * (If phpStorm doesn't load it, try closing the project and re-opening it)
 * 
 * Under system/core/
 * Right click on Controller.php and set Mark as Plain Text
 * Do the same for Model.php
 * -------------------------------------------------------------------
 * This way there is no editing of CI core files for this simple layer of code completion.
 *
 * PHP version 5
 *
 * LICENSE: GPL http://www.gnu.org/copyleft/gpl.html
 *
 * Created 1/28/12, 11:06 PM
 *
 * @category
 * @package    CodeIgniter CI_phpStorm.php
 * @author     Jeff Behnke
 * @copyright  2009-11 Valid-Webs.com
 * @license    GPL http://www.gnu.org/copyleft/gpl.html
 * @version    2012.01.28
 */

/**
 *requests_model
 *
 * @property Quizquestion_model $quizquestion_model custom model
 * @property Bookmark_model $bookmark_model custom model
 * @property Dashboardshutdown_model $dashboardshutdown_model custom model
 * @property Dashboardimportdetail_model $dashboardimportdetail_model custom model
 * @property Dashboardimport_model $dashboardimport_model custom model
 * @property Alert_model $alert_model custom model
 * @property Helpfile_model $helpfile_model custom model
 * @property Templateindicator_model $templateindicator_model custom model
 * @property Indicatordashboard_model $indicatordashboard_model custom model
 * @property Template_model $template_model custom model
 * @property Service_model $service_model custom model
 * @property Occurrence_model $occurrence_model custom model
 * @property Gravity_model $gravity_model custom model
 * @property Impactedbusiness_model $impactedbusiness_model custom model
 * @property Responsible_model $responsible_model custom model
 * @property Impactedcustomers_model $impactedcustomers_model custom model
 * @property Incidentlog_model $incidentlog_model custom model
 * @property Incidentfile_model $incidentfile_model custom model
 * @property Incidentcorrection_model $incidentcorrection_model custom model
 * @property Incidentdiagnostic_model $incidentdiagnostic_model custom model
 * @property Incident_model $incident_model custom model
 * @property Causecorrection_model $causecorrection_model custom model
 * @property Correction_model $correction_model custom model
 * @property Diagnostic_model $diagnostic_model custom model
 * @property Causediagnostic_model $causediagnostic_model custom model
 * @property Cellule_model $cellule_model custom model
 * @property Causeindicator_model $causeindicator_model custom model
 * @property Indicatorstatus_model $indicatorstatus_model custom model
 * @property Indicator_model $indicator_model custom model
 * @property Cause_model $cause_model custom model
 * @property Useravatar_model $useravatar_model custom model
 * @property Groupstore_model $groupstore_model custom model
 * @property Emojistore_model $emojistore_model custom model
 * @property Favorite_model $favorite_model custom model
 * @property Userquizanswer_model $userquizanswer_model custom model
 * @property Quiz_model $quiz_model custom model
 * @property Beebotlog_model $beebotlog_model custom model
 * @property Postcomment_model $postcomment_model custom model
 * @property Beebot_model $beebot_model custom model
 * @property Chatparticipant_model $chatparticipant_model custom model
 * @property Chatuser_model $chatuser_model custom model
 * @property Userfield_model $userfield_model custom model
 * @property Customfield_model $customfield_model custom model
 * @property Categorypost_model $categorypost_model custom model
 * @property Team_model $team_model custom model
 * @property Userstore_model $userstore_model custom model
 * @property Iconpost_model $iconpost_model custom model
 * @property Quizpost_model $quizpost_model custom model
 * @property Fileassociator_model $fileassociator_model custom model
 * @property Groupuser_model $groupuser_model custom model
 * @property Quizanswer_model $quizanswer_model custom model
 * @property Helplog_model $helplog_model custom model
 * @property Level_model $level_model custom model
 * @property Store_model $store_model custom model
 * @property Mention_model $mention_model custom model
 * @property Help_model $help_model custom model
 * @property Helpcategory_model $helpcategory_model custom model
 * @property Fileuser_model $fileuser_model custom model
 * @property Dmtray_model $dmtray_model custom model
 * @property File_model $file_model custom model
 * @property Emoji_model $emoji_model custom model
 * @property Custom_model $custom_model custom model
 * @property Chatinfo_model $chatinfo_model custom model
 * @property Chat_model $chat_model custom model
 * @property Grouppost_model $grouppost_model custom model
 * @property Dm_model $dm_model custom model
 * @property Admin_model $admin_model custom model
 * @property Group_model $group_model custom model
 * @property User_model $user_model custom model
 * @property Useraccess_model $useraccess_model custom model
 * @property Post_model $post_model custom model
 * @property Postrate_model $postrate_model custom model
 * @property CI_DB_query_builder $db              This is the platform-independent base Active Record implementation class.
 * @property CI_DB_forge $dbforge                 Database Utility Class
 * @property CI_Benchmark $benchmark              This class enables you to mark points and calculate the time difference between them.<br />  Memory consumption can also be displayed.
 * @property CI_Calendar $calendar                This class enables the creation of calendars
 * @property CI_Cart $cart                        Shopping Cart Class
 * @property CI_Config $config                    This class contains functions that enable config files to be managed
 * @property CI_Controller $controller            This class object is the super class that every library in.<br />CodeIgniter will be assigned to.
 * @property CI_Email $email                      Permits email to be sent using Mail, Sendmail, or SMTP.
 * @property CI_Encrypt $encrypt                  Provides two-way keyed encoding using XOR Hashing and Mcrypt
 * @property CI_Exceptions $exceptions            Exceptions Class
 * @property CI_Form_validation $form_validation  Form Validation Class
 * @property CI_Ftp $ftp                          FTP Class
 * @property CI_Hooks $hooks                      Provides a mechanism to extend the base system without hacking.
 * @property CI_Image_lib $image_lib              Image Manipulation class
 * @property CI_Input $input                      Pre-processes global input data for security
 * @property CI_Lang $lang                        Language Class
 * @property CI_Loader $load                      Loads views and files
 * @property CI_Log $log                          Logging Class
 * @property CI_Model $model                      CodeIgniter Model Class
 * @property CI_Output $output                    Responsible for sending final output to browser
 * @property CI_Pagination $pagination            Pagination Class
 * @property CI_Parser $parser                    Parses pseudo-variables contained in the specified template view,<br />replacing them with the data in the second param
 * @property CI_Profiler $profiler                This class enables you to display benchmark, query, and other data<br />in order to help with debugging and optimization.
 * @property CI_Router $router                    Parses URIs and determines routing
 * @property CI_Session $session                  Session Class
 * @property CI_Sha1 $sha1                        Provides 160 bit hashing using The Secure Hash Algorithm
 * @property CI_Table $table                      HTML table generation<br />Lets you create tables manually or from database result objects, or arrays.
 * @property CI_Trackback $trackback              Trackback Sending/Receiving Class
 * @property CI_Typography $typography            Typography Class
 * @property CI_Unit_test $unit_test              Simple testing class
 * @property CI_Upload $upload                    File Uploading Class
 * @property CI_URI $uri                          Parses URIs and determines routing
 * @property CI_User_agent $user_agent            Identifies the platform, browser, robot, or mobile devise of the browsing agent
 * @property CI_Validation $validation            //dead
 * @property CI_Xmlrpc $xmlrpc                    XML-RPC request handler class
 * @property CI_Xmlrpcs $xmlrpcs                  XML-RPC server class
 * @property CI_Zip $zip                          Zip Compression Class
 * @property CI_Javascript $javascript            Javascript Class
 * @property CI_Jquery $jquery                    Jquery Class
 * @property CI_Utf8 $utf8                        Provides support for UTF-8 environments
 * @property CI_Security $security                Security Class, xss, csrf, etc...
 */
class CI_Controller{}

/**
 * @property CI_DB_query_builder $db              This is the platform-independent base Active Record implementation class.
 * @property CI_DB_forge $dbforge                 Database Utility Class
 * @property CI_Benchmark $benchmark              This class enables you to mark points and calculate the time difference between them.<br />  Memory consumption can also be displayed.
 * @property CI_Calendar $calendar                This class enables the creation of calendars
 * @property CI_Cart $cart                        Shopping Cart Class
 * @property CI_Config $config                    This class contains functions that enable config files to be managed
 * @property CI_Controller $controller            This class object is the super class that every library in.<br />CodeIgniter will be assigned to.
 * @property CI_Email $email                      Permits email to be sent using Mail, Sendmail, or SMTP.
 * @property CI_Encrypt $encrypt                  Provides two-way keyed encoding using XOR Hashing and Mcrypt
 * @property CI_Exceptions $exceptions            Exceptions Class
 * @property CI_Form_validation $form_validation  Form Validation Class
 * @property CI_Ftp $ftp                          FTP Class
 * @property CI_Hooks $hooks                      Provides a mechanism to extend the base system without hacking.
 * @property CI_Image_lib $image_lib              Image Manipulation class
 * @property CI_Input $input                      Pre-processes global input data for security
 * @property CI_Lang $lang                        Language Class
 * @property CI_Loader $load                      Loads views and files
 * @property CI_Log $log                          Logging Class
 * @property CI_Model $model                      CodeIgniter Model Class
 * @property CI_Output $output                    Responsible for sending final output to browser
 * @property CI_Pagination $pagination            Pagination Class
 * @property CI_Parser $parser                    Parses pseudo-variables contained in the specified template view,<br />replacing them with the data in the second param
 * @property CI_Profiler $profiler                This class enables you to display benchmark, query, and other data<br />in order to help with debugging and optimization.
 * @property CI_Router $router                    Parses URIs and determines routing
 * @property CI_Session $session                  Session Class
 * @property CI_Sha1 $sha1                        Provides 160 bit hashing using The Secure Hash Algorithm
 * @property CI_Table $table                      HTML table generation<br />Lets you create tables manually or from database result objects, or arrays.
 * @property CI_Trackback $trackback              Trackback Sending/Receiving Class
 * @property CI_Typography $typography            Typography Class
 * @property CI_Unit_test $unit_test              Simple testing class
 * @property CI_Upload $upload                    File Uploading Class
 * @property CI_URI $uri                          Parses URIs and determines routing
 * @property CI_User_agent $user_agent            Identifies the platform, browser, robot, or mobile devise of the browsing agent
 * @property CI_Validation $validation            //dead
 * @property CI_Xmlrpc $xmlrpc                    XML-RPC request handler class
 * @property CI_Xmlrpcs $xmlrpcs                  XML-RPC server class
 * @property CI_Zip $zip                          Zip Compression Class
 * @property CI_Javascript $javascript            Javascript Class
 * @property CI_Jquery $jquery                    Jquery Class
 * @property CI_Utf8 $utf8                        Provides support for UTF-8 environments
 * @property CI_Security $security                Security Class, xss, csrf, etc...
 */
class CI_Model{}
/**
 */