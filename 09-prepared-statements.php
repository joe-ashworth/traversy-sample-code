<?php
$db_user = 'root';
$db_pass = '';
$db_name = 'php101';
$db_host = 'localhost';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$id = 1;

$stmt = $mysqli->prepare("SELECT * FROM objects WHERE ID=?");
$stmt->bind_param("d", $id);

$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_object()) {
	$results[] = $row;
}

print_r($results);

$stmt = $mysqli->prepare("INSERT INTO objects VALUES (?, ?, ?, ?)");
$stmt->bind_param('sssd', $code, $language, $official, $percent);

$stmt = $mysqli->prepare("UPDATE objects SET post_title = ?, some2 = ?, some3 = ?, some4 = ? WHERE ID = ?"); 
$stmt->bind_param('sssdd', "something", "something2", "something3", "123", $id);

$stmt = $mysqli->prepare("DELETE FROM objects WHERE ID = ?"); 
$stmt->bind_param('d', $id);


// try {
// 	$conn = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
// 	$stmt = $conn->prepare('SELECT * FROM objects WHERE ID = :id');
// 	$stmt->execute(array(':id' => 1));
	
// 	while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
// 		$results[] = $row;
// 	}
	
// 	print_r($results);
// } catch(PDOException $e) {
//     echo 'ERROR: ' . $e->getMessage();
// }

// $stmt = $conn->prepare("INSERT INTO objects VALUES (:title, :content, :name, NOW())");
// $stmt->execute(array(':title' => 'Test title', ':content' => 'Test content', ':name' => 'test', ));

// $stmt = $conn->prepare("UPDATE objects SET (post_title = :title, post_content = :content, post_name = :name) WHERE ID = :id");
// $stmt->execute(array(':title' => 'Test title', ':content' => 'Test content', ':name' => 'test', ':id' => 8 ));

// $stmt = $conn->prepare("DELETE FROM objects WHERE ID = :id");
// $stmt->execute(array(':id' => 8 ));
