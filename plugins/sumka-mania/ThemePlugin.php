<?php

/**
 * Plugin Name: Sumka Mania
 * Version: 1.0
 * Author: YesTech
 * Author uri: https://t.me/drKeinakh
 */

require_once "includes/functions.php";
require_once "Theme.php";

function ThemeActivation()
{
    global $Theme;
    $Theme = new Theme();
}

ThemeActivation();