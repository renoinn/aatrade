<?php
// DATABASEの設定
define('DATABASE_HOST', 'loaclhost');
define('DATABASE_NAME', 'aatrade');
define('DATABASE_USER', '');
define('DATABASE_PASSWARD', '');

// pdo
define('PDO_DNS', 'sqlite:'.dirname(__FILE__).'/data/'.DATABASE_NAME.'.sqlite3');
