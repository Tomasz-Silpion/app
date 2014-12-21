<?php

$wgExtensionCredits['other'][] = array(
	'name' => 'RealtimeAnonTracking',
	'author' => 'Mateusz \'Warkot\' Warkocki'
);

$dir = __DIR__ . '/';

$wgAutoloadClasses['RealtimeAnonTrackingController'] = $dir . 'RealtimeAnonTrackingController.class.php';
$wgAutoloadClasses['RealtimeAnonTrackingHooks'] = $dir . 'RealtimeAnonTrackingHooks.class.php';

$wgHooks['OutputPageBeforeHTML'][] = 'RealtimeAnonTrackingHooks::onOutputPageBeforeHTML';
