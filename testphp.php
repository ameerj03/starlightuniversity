<?php
include "action.php";
$select_accepted_users_nationality = "SELECT nationality FROM application WHERE fin_status = 'paid'";
$select_accepted_nationality_query = $conn->query($select_accepted_users_nationality);
$nationalities = [];

while($row = $select_accepted_nationality_query->fetch_assoc()){
 echo $row['nationality'];
 $nationalities[] = $row['nationality'];
}
echo json_encode($nationalities);

$counts = array_count_values($nationalities);
$names = array_keys($counts);
echo json_encode(['names' => $names, 'counts' => $counts]);

$onlyCounts = array_values($counts);
echo json_encode($onlyCounts);
?>