<?php
// PHP code

header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache");                         // HTTP 1.0.
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
$db = new SQLite3('testing.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

$db->query(
    'CREATE TABLE IF NOT EXISTS "users" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" VARCHAR)'
);

$test = isset($_POST['btnClick']);
echo "$test";

$userCount = $db->querySingle('SELECT COUNT(DISTINCT "id") FROM "users"');
echo("<h2>User count: $userCount</h2>");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buttonName'])) {
        if ($_POST['buttonName'] === 'button1') {
            echo "Button 1 clicked";
            exit;
        }
        if ($_POST['buttonName'] === 'button2') {
            echo "Button 2 clicked";
            $db->query('INSERT INTO "users" ("name") VALUES ("BJ")');
            $db->query('INSERT INTO "users" ("name") VALUES ("Adam")');
            $db->query('INSERT INTO "users" ("name") VALUES ("Bruce")');
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>LAMBO STEP 1</title>
    <script>
        async function sendPost(buttonName) {
            const formData = new FormData();
            formData.append('buttonName', buttonName);

            const response = await fetch('', {
                method: 'POST',
                body: formData
            });

            const text = await response.text();
            alert(text);
        }
    </script>
</head>
<body>
<button onclick="sendPost('button1')">Button 1</button>
<button onclick="sendPost('button2')">Button 2</button>
</body>
</html>
