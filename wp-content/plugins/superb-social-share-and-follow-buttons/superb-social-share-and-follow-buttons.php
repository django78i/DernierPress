<?php
/*
Plugin Name: Superb Social Share and Follow Buttons
Description: Social media share buttons & follow buttons, quick & easy! 25+ Social networks & 50+ options. Shortcodes. Floating Sidebar & More!
Version: 1.0.4
Author: SuPlugins
Author URI: https://superbthemes.com/
License: GPL2 or later
*/

defined('ABSPATH') || exit;

if (! defined('WPINC')) {
    die;
}

if (! class_exists('spbsm')) {
    include_once dirname(__FILE__) . '/plugin.php';
}

$spbsm_plugin = spbsm::GetInstance('1.0.4', __FILE__);
