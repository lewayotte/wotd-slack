<?php
	
error_reporting( E_ERROR | E_WARNING );
	
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();

$wotd = get_wotd();

if ( !empty( $wotd ) ) {
	send_to_slack( $wotd );
}

function get_wotd() {
	$rss = new DOMDocument();
	$rss->load( 'https://www.merriam-webster.com/wotd/feed/rss2' );
	$link = '';
	foreach ($rss->getElementsByTagName('item') as $node) {
		$link = $node->getElementsByTagName('link')->item(0)->nodeValue;
		break;
	}
	return str_replace( ' ', '%20', $link );
}

function send_to_slack( $message ) {
	$ch = curl_init( 'https://slack.com/api/chat.postMessage' );
	$data = http_build_query([
		'token'        => $_ENV['SLACK_TOKEN'],
		'channel'      => $_ENV['SLACK_CHANNEL'], 
		'text'         => $message, //'Hello, Foo-Bar channel message.',
		'unfurl_links' => true
	]);
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	$result = curl_exec( $ch );
	curl_close( $ch);
	
	return $result;
}

