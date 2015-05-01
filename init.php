<?php
require_once dirname(__FILE__).'/library/database.php';

$db = Database::instance();
$sql = 
<<<SQL
create table merchandise (
    mid integer primary key autoincrement,
    type text not null,
    character text not null,
    item text not null,
    num integer not null,
    cost integer not null,
	closed integer default 0,
	deleted integer default 0,
	delete_code integer not null,
    comment text,
	created default CURRENT_TIMESTAMP,
	updated text
);
create table bid (
    bid integer primary key autoincrement,
    mid integer not null,
    character text not null,
    num integer not null,
	deleted integer default 0,
	closed integer default 0,
	delete_code integer not null,
    comment text,
	created default CURRENT_TIMESTAMP,
	updated text
);
SQL;

$db->execute($sql);

exit;
