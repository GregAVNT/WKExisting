<?php

define( 'DISALLOW_FILE_EDIT', true );
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
* The base configurations of the WordPress.
*
* This file has the following configurations: MySQL settings, Table Prefix,
* Secret Keys, WordPress Language, and ABSPATH. You can find more information
* by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
* wp-config.php} Codex page. You can get the MySQL settings from your web host.
*
* This file is used by the wp-config.php creation script during the
* installation. You don't have to use the web site, you can just copy this file
* to "wp-config.php" and fill in the values.
*
* @package WordPress
*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bookprom_wordpress');

/** MySQL database username */
define('DB_USER', 'bookprom_lww_wp');

/** MySQL database password */
define('DB_PASSWORD', 'JewelsRompsTibiasSlack91');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY',         '/Zc*|;+ZoVdmwZG.U4qw[k{+>wQe9gNI-U& +|+hgXc#i?f][a<S4?jgV$x7iCw(');
define('SECURE_AUTH_KEY',  'rBL|E}(!U#wFP$Y<9piP(p[[acK0KRZE|heTs&+Bn+1k45$@cc|zwzBZ.=ufVQLG');
define('LOGGED_IN_KEY',    '3Wcc~LjhbL])W=t5u7*/@oIo3;aW6ZuqbK6CS[c1&dq]|+CK~$N!c[n$66$>t;,?');
define('NONCE_KEY',        'WX]}yB63g|C+2K({FP~:+D Z_AohCDT-MFd))Xm3~#gbeABBVgfvNB5YB<+U/T|+');
define('AUTH_SALT',        '+6d,~]Cn9?mVTAL,7ETg)/C&$5+xp3e3VfqcJdFSH%l#3 :XJ;PA3ig@>y+|f7f.');
define('SECURE_AUTH_SALT', 'bY;=yKmii*g?YIXS l{t-ke!Pyr|_ezUWG[jZah1>=aA D7P<deX{%YM;&Wk$+%_');
define('LOGGED_IN_SALT',   'v3WNmU0U}_EZ:v<It^rK|0^~xn;BZ=t+{U1bRs+nPba8+d-|!eCG0la)%33(bOa}');
define('NONCE_SALT',       '|*V1OrZq1j;G(acy`18g/Km)+rZ =<i`?Pzd9yvhl7fX{d=r`Dd*.4`=5.(FT|-(');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'wno2pm_';

/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/
define('WPLANG', '');

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/
define('WP_DEBUG', false);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
