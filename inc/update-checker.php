<?php
/**
 * Update Checker
 * 
 * @package delennerd-elements
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$delennedBlocksUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/delennerd/delennerd-elements',
	DELENNERD_ELEMENTS_PATH . '/delennerd-elements.php',
	'delennerd-elements'
);

$delennedBlocksUpdateChecker->setBranch('master');
$delennedBlocksUpdateChecker->getVcsApi()->enableReleaseAssets();