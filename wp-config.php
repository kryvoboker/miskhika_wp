<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\OpenServer\domains\mishkina\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'mishkina_design' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Q} CsS,?;,6_)589ba483neB$UQJr?qj%7^tj=F;oWAfbC|qQ~(yi>8{ol/k*}q+' );
define( 'SECURE_AUTH_KEY',  '0Bd/QgAF]tpvz5Kk=!Pl QKz!9S!sXIvQac>H7Jg!v4m}pk)v.nDvPyDg0CLK}u0' );
define( 'LOGGED_IN_KEY',    'l|X+aHMqR{W|V_%mJmKnRpmSz6k+GfNEUU.S[3^QyAOO>b:n/kA>41.B_-t:l]/]' );
define( 'NONCE_KEY',        'pM5+gxRg~9>~Kj_p4tX~>[$P}LHfTd&Z7trS4`+1zUI[%RkP7D{]egXuCYo,!Vd_' );
define( 'AUTH_SALT',        'BLqAg+Y|kGako8iMjh(yY(OgjN}y,KR*%FO^4#~n2X*P6Q<RsRT^/lai%]e~n@9y' );
define( 'SECURE_AUTH_SALT', 'x?SF73dYM}q;7|H0J[H3*z-]&Yy>TL%J28gi+I6@MZAzmo_19~,mT3e D9n_CM|A' );
define( 'LOGGED_IN_SALT',   'DY`7>GNN@c9DM^hV${&4&l!&E3?{PPqto&,hTP(~>)T;zji%3MGti~Ahp^ZfElD0' );
define( 'NONCE_SALT',       'u7N1R!{mIJb$`LZ_}V!/)1$O?Sl!ZDWrNF8UDp`Wj]xe]&qhA58jA/#Y6|JSi/d}' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
