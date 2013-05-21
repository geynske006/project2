<?php
include_once("../classes/Twit.class.php");
if(isset($_POST['update']))
{
$tweet = new Tweet();
try
{
$tweet->Text = $_POST['update'];
$tweet->UserId = 1; //get this from session instead of hardcoded!
$tweet->Save();
$feedback['text'] = "Your tweet has been posted!";
$feedback['status'] = "success";
}
catch(Exception $e)
{
$feedback['text'] = $e->getMessage();
$feedback['status'] = "error";
}
}
header('Content-type: application/json');
echo json_encode($feedback);
?>