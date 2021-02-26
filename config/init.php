<?php 

require_once 'config/database.conf.php';
$db_config  = $config['database'][$config['database']['connect_type']];
$db_connected = mysqli_connect($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database_name']);

mysqli_set_charset($db_connected, $config['database']['charset']);

function query($command_sql)
{
 GLOBAL $db_connected;

 if(!empty($db_connected) and is_object($db_connected) and (get_class($db_connected) == 'mysqli'))
    {
        $query_resource = mysqli_query($db_connected, $command_sql);
    }
    
    if(preg_match('/^\s*(select)\s*/i', $command_sql))
    {
        if(!empty($query_resource))
            {
                $i  = 0;
                $result = array();
                while($row = mysqli_fetch_object($query_resource))
                {
                    $result[$i] = $row;
                    $i++;
                }

                mysqli_free_result($query_resource);

                return $result;
            }
    }
    else
        {
            if(!empty($query_resource)) return true;
        }
    
 return false;
}

date_default_timezone_set("Asia/Bangkok");

function banner_list()
{
	$sql = "SELECT *
			FROM db_banner
            WHERE is_active = '1'
			ORDER BY id ASC";

	return query($sql);
}

function best_index()
{
	$sql = "SELECT *
			FROM db_product
            WHERE is_best = '1'  AND is_active = '1'
            ORDER BY id DESC
            LIMIT 8";

	return query($sql);
}

function customer_index()
{
	$sql = "SELECT *
			FROM db_review
            WHERE is_active = '1'
            ORDER BY id DESC
            LIMIT 3";

	return query($sql);
}

function product_list()
{
	$page	= (!empty($_GET['page'])) ? $_GET['page'] : 1;
	$limit 	= 8;
	$start 	= ($page * $limit) - $limit;
    
	$sql = "SELECT *
			FROM db_product
            WHERE is_active = '1'
            ORDER BY id DESC
            LIMIT {$start}, {$limit}";

	return query($sql);
}

function product_count()
{

    $wheres[] = "is_active = '1'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode(' AND ', $wheres) : null;

	$sql	= "SELECT count(1) AS counter
				FROM db_product
				{$where}";

	$result = query($sql);
	
	return (!empty($result)) ? current($result) : false;
}

function product_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_product
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function product_img_list()
{
	if (!empty($_GET['id'])) {
		$wheres[] = "product_id = '{$_GET['id']}'";
	}
	
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_product_img
				{$where}
				ORDER BY order_id ASC";
	
	$result = query($sql);

	return $result;
}

function product_related()
{
	$sql = "SELECT *
			FROM db_product
			WHERE is_active = '1'
			ORDER BY RAND()
			LIMIT 6";

	return query($sql);
}

function customer_list()
{
	$page	= (!empty($_GET['page'])) ? $_GET['page'] : 1;
	$limit 	= 6;
    $start 	= ($page * $limit) - $limit;

	$sql = "SELECT *
			FROM db_review
            WHERE is_active = '1'
            ORDER BY id DESC
            LIMIT {$start}, {$limit}";

	return query($sql);
}

function customer_count()
{
    $wheres[] = "is_active = '1'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode(' AND ', $wheres) : null;

	$sql	= "SELECT count(1) AS counter
				FROM db_review
				{$where}";

	$result = query($sql);
	
	return (!empty($result)) ? current($result) : false;
}

function about_us_text()
{
	$sql = "SELECT *
			FROM db_about_us
			WHERE is_active = '1'
			LIMIT 1";

	return query($sql);
}

function contact_list()
{
	$sql = "SELECT *
			FROM db_contact
			WHERE is_active = '1'
			LIMIT 1";

	return query($sql);
}

function pagination( $total, $limit = 12 )
{
	$page 	= ( !empty($_GET['page']) ) ? $_GET['page'] : 1;
	$total 	= ceil( $total / $limit );
	$prev 	= $page - 1;
	$next 	= $page + 1;

	return array(
		'total'		=> $total
		,'page'		=> $page
		,'prev'		=> $prev
		,'next'		=> $next
	);
}

?>

