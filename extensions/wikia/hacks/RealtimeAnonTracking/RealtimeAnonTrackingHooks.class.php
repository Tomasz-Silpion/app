<?php

/**
 * Class RealtimeAnonTrackingHooks
 */
class RealtimeAnonTrackingHooks {

	/**
	 * Load JS needed to display the RealtimeAnonTracking at the bottom of the article content
	 * @param OutputPage $out
	 * @param string $text
	 * @return bool
	 */
	static public function onOutputPageBeforeHTML( OutputPage $out, &$text ) {
		wfProfileIn(__METHOD__);

		Wikia::addAssetsToOutput( 'realtime_anon_tracking_js' );

		wfProfileOut(__METHOD__);
		return true;
	}
}
