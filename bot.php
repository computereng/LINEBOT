<?php
$access_token = 'LZArldUUHwHc6ROvqoAeGz5Kdft2ShdvagfCoiaoPaTpxqjvtA4ImaLk6hbkVguSX6pqlYaJFRB/pLt/q/Ct5w4chCz8hShgIVBOzZYuYM1YPHg8FJ0KS4G8GD3T0iFv7qAbmBvIfFYElhJ+MRgXtQdB04t89/1O/w1cDnyilFU=';
 $dbhost = 'vcu626he9dq4mjrhpja1uclh8e@ds129090.mlab.com:29090/heroku_zpxln9vv';
 $dbname = 'heroku_zpxln9vv';
 $m = new Mongo("mongodb://heroku_zpxln9vv:vcu626he9dq4mjrhpja1uclh8e@ds129090.mlab.com:29090/heroku_zpxln9vv");
 $db = $m->'heroku_zpxln9vv';

// access collection
$collection = $db->CMD;



// Get POST body content
$content = file_get_contents('php://input');
$collection->insert($content);
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			

			// Build message to reply back
			if ($text == 'Hello')
			$messages = [
				'type' => 'text',
				'text' => 'Hi'
			];
			else if ($text == 'What your name')
			$messages = [
				'type' => 'text',
				'text' => 'My Name Is Proxima'
			];

			else if ($text == 'How are you')
			$messages = [
				'type' => 'text',
				'text' => 'I am Fine'
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			

			echo $result . "\r\n";
		}
	}
}
echo "OK";
