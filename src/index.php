<?php
echo "hi";
$db = new SQLite3('testing.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
echo "bye";

