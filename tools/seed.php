<?php
/** Idempotent content initialization, ordered by dependencies. @package Avenor */
defined( 'ABSPATH' ) || exit;

require __DIR__ . '/seed/helpers.php';
require __DIR__ . '/seed/pages.php';
require __DIR__ . '/seed/services.php';
require __DIR__ . '/seed/solutions.php';
require __DIR__ . '/seed/insights.php';
require __DIR__ . '/seed/settings.php';

echo "AVENOR business content ready. Existing records were preserved.\n";
require __DIR__ . '/upgrade-experience.php';

require __DIR__ . '/publish-sections.php';
require __DIR__ . '/compact-home.php';
require __DIR__ . '/refine-navigation.php';
