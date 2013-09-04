<?php

/**
 * Class LicensedVideoSwapHooksHelper
 */
class LicensedVideoSwapHooksHelper {

	/**
	 * Handler for the hook that allows HTML to be placed after the main <h1> page title.  Use this to add the history
	 * page button
	 * @param $response
	 * @return bool
	 */
	public static function onPageHeaderIndexExtraButtons( $response ) {
		$app = F::app();

		$user = $app->wg->User;
		if ( !$user->isAllowed( 'licensedvideoswap' ) ) {
			return true;
		}

		if ( $app->wg->Title->getFullText() == 'Special:LicensedVideoSwap' ) {

			// Get the user preference skin, not the current skin of the page
			$skin = $app->wg->User->getOption( 'skin' );

			// for monobook users, specify wikia skin in querystring
			$query = "";
			if( $skin == "monobook" ) {
				$query = "useskin=wikia";
			}

			$href = SpecialPage::getTitleFor( "LicensedVideoSwap/History" )->escapeLocalURL( $query );
			$extraButtons = $response->getVal( 'extraButtons' );

			$extraButtons[] = '<a class="button lvs-history-btn" href="'.$href.'" rel="tooltip" title="'.wfMessage( "lvs-tooltip-history" )->plain().'">'.wfMessage( "lvs-history-button-text" )->plain().'</a>';
			$response->setVal( 'extraButtons', $extraButtons );
		}

		return true;
	}
}
