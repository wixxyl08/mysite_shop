<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'shop' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'admin' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '12345' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'kjF|2clm~p]h HtqX6OMW391Pz]4RkhH5x>`+vv!Us&OTsN!9q1zBE=AZ!YVdkLe' );
define( 'SECURE_AUTH_KEY',  'tE-SyPT*3S;EMvTm|.IU@F{~rTwFYFh ]<ke|,$#sqmm0S!t%3<MDyRZl5jGxH^E' );
define( 'LOGGED_IN_KEY',    'Q{14Ze5kUl9vNxpvxjqGlUR7!4{N8J*s$OJ(tmXUz-];/?rlsGvp%|[=xy<JcUo5' );
define( 'NONCE_KEY',        '[;8%tQ3eg[Q}VUj>)^_u3b4_*]KTkd^^UX(Dp}TyhW5j4#-hf2sO)2$GH{p(|bvk' );
define( 'AUTH_SALT',        'O6,;g8D9rSag)7w}(HGw`z!S}]9q4)}2TRR{mUJ(Og^5%L@3:yF;5dDtCMRI*DzO' );
define( 'SECURE_AUTH_SALT', '}ub>o~6W@r%a/$:oSLWPPtN;+-,oJe$~1;P;jvDy8CQ<TO=D8L%OY;W{=q-0VZL[' );
define( 'LOGGED_IN_SALT',   '9<f&}8>IJK&c@^<Q2o}}sYr}(eP11^Jb*$_KxE>,IzV@Px4#| Fy9%6-W;`t,ORh' );
define( 'NONCE_SALT',       '<ugQGblB;+tbHhJ}5j91Q7Nx6.6Jm^O2+elzF_#KT<g@:G+o&0i.orz/rry$Ga(O' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 *
 * В процессе установки указанный префикс добавляется к именам таблиц базы данных.
 * Если изменить это значение после установки WordPress, то сайт снова перейдёт
 * в режим установки.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
