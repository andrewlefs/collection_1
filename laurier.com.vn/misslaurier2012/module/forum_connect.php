<?
$server = '112.213.88.47';
//server=112.213.88.47;database=admin_forum;uid=admin_forum;pwd=L@urI3r2010@
// Connect to MSSQL
$link = mssql_connect($server, 'admin_forum', 'L@urI3r2010@');

if (!$link) {
    die('Something went wrong while connecting to MSSQL');
}
$query = mssql_query('select * from yaf_user where userid=1');
$user=array();
if (!mssql_num_rows($query)) {
    echo 'No records found';
} else {
    while ($row = mssql_fetch_array($query, MSSQL_ASSOC)) {
    $user[]=$row;
	}
}
print_r($user);
?>