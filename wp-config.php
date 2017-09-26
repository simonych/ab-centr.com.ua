<?php
/**
 * �������� ��������� WordPress.
 *
 * ���� ���� �������� ��������� ���������: ��������� MySQL, ������� ������,
 * ��������� �����, ���� WordPress � ABSPATH. �������������� ���������� ����� �����
 * �� �������� {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} �������. ��������� MySQL ����� ������ � �������-����������.
 *
 * ���� ���� ������������ ��������� �������� wp-config.php � �������� ���������.
 * ������������� ������������ ���-���������, ����� ����������� ���� ����
 * � ������ "wp-config.php" � ��������� ��������.
 *
 * @package WordPress
 */

// ** ��������� MySQL: ��� ���������� ����� �������� � ������ �������-���������� ** //
/** ��� ���� ������ ��� WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/abcentr/ab-centr.com.ua/www/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'abcentr_db');

/** ��� ������������ MySQL */
define('DB_USER', 'abcentr_db');

/** ������ � ���� ������ MySQL */
define('DB_PASSWORD', 'gm8p110j');

/** ��� ������� MySQL */
define('DB_HOST', 'abcentr.mysql.ukraine.com.ua');

/** ��������� ���� ������ ��� �������� ������. */
define('DB_CHARSET', 'utf8');

/** ����� �������������. �� �������, ���� �� �������. */
define('DB_COLLATE', '');

/**#@+
 * ���������� ����� � ���� ��� ��������������.
 *
 * ������� �������� ������ ��������� �� ���������� �����.
 * ����� ������������� �� � ������� {@link https://api.wordpress.org/secret-key/1.1/salt/ ������� ������ �� WordPress.org}
 * ����� �������� ��, ����� ������� ������������ ����� cookies �����������������. ������������� ����������� ����� ��������������.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '#VIq-/8?Ior^4G/YS.=GWlWj/Q~bn>JFn6Y[H+nC@-vuv0-=bkx@)D}ZW@aX#O=1');
define('SECURE_AUTH_KEY',  'Lv3A:{37?N<Wfp+*^V}RS6S-IOl4y~n1Sz3s&~#+6f$Un@pAtywo4?,Q~LYr9Ps@');
define('LOGGED_IN_KEY',    '/b,r#l-di^ FAmsz@?aG5X8`nf4V-|qM*FlP(?xu+w>#V9iHfx)t$*sG$9s7b}jP');
define('NONCE_KEY',        'S+da-&-4@_HPZhPS&*;};Wj*q:.H6RoqE<(_4?=_PG&x2jc-OC8=*f@9bXI&T+H+');
define('AUTH_SALT',        'bMZ]K>/oQ}|=yeh!CK,cE~m5zGq)*[fiqAn^5B=kFcDOLI_`B nftF8Uu@n%>/g4');
define('SECURE_AUTH_SALT', 'a3=Pv)Iuh4 Sp>|fHoeK#oCuEFpiJM4Z_CPQeV1v/3{[lFIu>:G(||+!XK[[Rw]|');
define('LOGGED_IN_SALT',   '3x:O1JM_&*:f/&vy@-%t>N1p6z2>T-.10cc9i~g6#4NqFD^07.[rW[ngQ&eF&k}3');
define('NONCE_SALT',       '3gHb>,J=HFB3jJX&SU4<$JU2|5)toYR{UkzA7K_Ct4%&*x!^lwM27RQaa{TKl#gs');

/**#@-*/

/**
 * ������� ������ � ���� ������ WordPress.
 *
 * ����� ���������� ��������� ������ � ���� ���� ������, ���� �� ������ ������������
 * ������ ��������. ����������, ���������� ������ �����, ����� � ���� �������������.
 */
$table_prefix  = 'abc_';

/**
 * ���� ����������� WordPress, �� ��������� ����������.
 *
 * �������� ���� ��������, ����� ��������� �����������. ��������������� MO-����
 * ��� ���������� ����� ������ ���� ���������� � wp-content/languages. ��������,
 * ����� �������� ��������� �������� �����, ���������� ru_RU.mo � wp-content/languages
 * � ��������� WPLANG �������� 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * ��� �������������: ����� ������� WordPress.
 *
 * �������� ��� �������� �� true, ����� �������� ����������� ����������� ��� ����������.
 * ������������ �������������, ����� ������������ �������� � ��� ������������ WP_DEBUG
 * � ���� ������� ���������.
 */
define('WP_DEBUG', false);

/* ��� ��, ������ �� �����������. �������! */

/** ���������� ���� � ���������� WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** �������������� ���������� WordPress � ���������� �����. */
require_once(ABSPATH . 'wp-settings.php');