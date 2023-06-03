<?php
include'config.php';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=subscriber_list.csv');
$output = fopen("php://output"; "w");
fputcsv($output, array('SL', 'Subscriber Email'));
$statement = $pdo->prepare("SELECT * FROM subscriber WHERE status=?");
$statement->execute(['Active']);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row){
    fputcsv($output, array($row['id'],$row['email']));
}
fclose($output);
?>