<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/abcentr/ab-centr.com.ua/www/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'abcentr_db');

/** Имя пользователя MySQL */
define('DB_USER', 'abcentr_db');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'gm8p110j');

/** Имя сервера MySQL */
define('DB_HOST', 'abcentr.mysql.ukraine.com.ua');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
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
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'abc_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');