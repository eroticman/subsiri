<?php 
session_start();

function check_login()
{
	if(!empty($_SESSION['user']))
	{
		return true;
	}

	return false;
}

require_once '../config/database.conf.php';
$db_config  = $config['database'][$config['database']['connect_type']];
$db_connected = mysqli_connect($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database_name']);

mysqli_set_charset($db_connected, $config['database']['charset']);

if ( isset( $_POST['is_login'] ) ) {

	$password = md5( $_POST['password'] );
	$sql = "
		select *
		from db_admin
		where username = '{$_POST['username']}' and password = '{$password}' and is_active = '1'
	";

	$result = query($sql);

	if (!empty($result)) {
		$_SESSION['user']['user_id']   	= $result[0]->id;
		$_SESSION['user']['username']  	= $result[0]->username;
		$_SESSION['user']['group_id']  	= $result[0]->group_id;
		$_SESSION['user']['first_name'] = $result[0]->first_name;
		$_SESSION['user']['last_name'] 	= $result[0]->last_name;
		header('location: index.php');
	}
}

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
	$sql	= "SELECT *
				FROM db_banner
				WHERE is_active = '1'
				ORDER BY id ASC
				LIMIT 5";
	
	return query($sql);
}

function banner_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_banner
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function banner_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_banner
				(banner_name, created) 
				VALUE 
				('{$_POST['name']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$banner_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/banner/' . $banner_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE db_banner SET img_cover = '{$file_name}' WHERE id = '{$banner_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function banner_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$banner_id 	= $_POST['banner_id'];

	$sql = "UPDATE db_banner
			SET banner_name = '{$_POST['name']}', updated = '{$update_date}'
			WHERE id = '{$banner_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/banner/' . $banner_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				/*$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				resizeImg( $originalFile, $targetFile, $file_extension, 1000, 1000 );*/
				$sql = "UPDATE db_banner SET img_cover = '{$file_name}' WHERE id = '{$banner_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}

function about_us_list()
{
	$sql	= "SELECT *
				FROM db_about_us
				WHERE is_active = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function about_us_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_about_us
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function about_us_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_about_us
				(about_name, description, created) 
				VALUE 
				('{$_POST['name']}', '{$_POST['description']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$about_us_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/about_us/' . $about_us_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE db_about_us SET img_cover = '{$file_name}' WHERE id = '{$about_us_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function about_us_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$about_us_id 	= $_POST['about_us_id'];

	$sql = "UPDATE db_about_us
			SET about_name = '{$_POST['name']}', description = '{$_POST['description']}', updated = '{$update_date}'
			WHERE id = '{$about_us_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/about_us/' . $about_us_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				/*$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				resizeImg( $originalFile, $targetFile, $file_extension, 1000, 1000 );*/
				$sql = "UPDATE db_about_us SET img_cover = '{$file_name}' WHERE id = '{$about_us_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}

function review_list()
{
	$sql	= "SELECT *
				FROM db_review
				WHERE is_active = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function review_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_review
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function review_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_review
				(review_name, description, created) 
				VALUE 
				('{$_POST['name']}', '{$_POST['description']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$review_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/review/' . $review_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE db_review SET img_cover = '{$file_name}' WHERE id = '{$review_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function review_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$review_id 	= $_POST['review_id'];

	$sql = "UPDATE db_review
			SET review_name = '{$_POST['name']}', description = '{$_POST['description']}', updated = '{$update_date}'
			WHERE id = '{$review_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/review/' . $review_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				/*$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				resizeImg( $originalFile, $targetFile, $file_extension, 1000, 1000 );*/
				$sql = "UPDATE db_review SET img_cover = '{$file_name}' WHERE id = '{$review_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}


function product_list()
{
	$sql	= "SELECT *
				FROM db_product
				WHERE is_active = '1'
				ORDER BY id ASC";
	
	return query($sql);
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

function product_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_product
				(url_name, keyword, product_name, price, size, description, created) 
				VALUE 
				('{$_POST['urlname']}', '{$_POST['keyword']}', '{$_POST['name']}', '{$_POST['price']}', '{$_POST['product_size']}', '{$_POST['description']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$product_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/product/cover/' . $product_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE db_product SET img_cover = '{$file_name}' WHERE id = '{$product_id}'";
				query($sql);
			}
		}

		if (!empty($_FILES['pdImg'])) {
			include('vendor/upload/class.fileuploader.php');

			$filePath 	= '../img/product/' . $product_id . '/';
			$path 		= realpath($filePath);

			if ( !is_dir($path) ) {
				mkdir($filePath);
			}

			// initialize FileUploader
		    $FileUploader = new FileUploader('pdImg', array(
		        'uploadDir' => $filePath,
		        'title' 	=> 'name'
		    ));

		    // call to upload the files
    		$data = $FileUploader->upload();

    		// if uploaded and success
		    if($data['isSuccess'] && count($data['files']) > 0) {
		        // get uploaded files
		        $uploadedFiles = $data['files'];
		    }

		    // get the fileList
			$fileList = $FileUploader->getFileList();			

			if ( !empty($fileList) ) {
				$i = 1;
				foreach ($fileList as $img) {
					$sql = "INSERT INTO db_product_img (product_id, img_name, order_id, created) VALUE ('{$product_id}', '{$img['name']}', '{$i}', '{$created}')";
					query($sql);

					$i++;
				}
				// print_r($sql);
				// exit();
			}
		}
	}

	return $added;
}

function product_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$product_id 	= $_POST['product_id'];

	$sql = "UPDATE db_product
			SET url_name = '{$_POST['urlname']}', keyword = '{$_POST['keyword']}', product_name = '{$_POST['name']}', price = '{$_POST['price']}', size = '{$_POST['product_size']}', description = '{$_POST['description']}', updated = '{$update_date}'
			WHERE id = '{$product_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/product/cover/' . $product_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				/*$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				resizeImg( $originalFile, $targetFile, $file_extension, 1000, 1000 );*/
				$sql = "UPDATE db_product SET img_cover = '{$file_name}' WHERE id = '{$product_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}


function changStatus() {
	$pid	= $_POST['p_best'];
	$status	= $_POST['is_best'];

	$sql = "UPDATE db_product
			SET is_best = '{$_POST['is_best']}'
			WHERE id = '{$pid}'";
	// exit;
	if ($status == '0') {
		$sqlA	= "UPDATE db_product 
					SET is_best = '0' 
					WHERE id = '{$pid}'";
	} elseif ($status == '1') {
		$sqlA	= "UPDATE db_product 
					SET is_best = '1' 
					WHERE id = '{$pid}'";
	}
	query($sqlA);

	$updated = query($sql);

	return $updated;
}

function contact_us_list()
{
	$sql	= "SELECT *
				FROM db_contact
				WHERE is_active = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function contact_us_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_contact
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function contact_us_edit() 
{
	$update_date 	= date('Y-m-d H:i:s');
	$contact_id 	= $_POST['contact_id'];

		$sql = "UPDATE db_contact
				SET contact_name = '{$_POST['name']}', contact_address = '{$_POST['contact_address']}', date_time = '{$_POST['date_time']}', 
				phone_1 = '{$_POST['phone_1']}', 
				phone_2 = '{$_POST['phone_2']}',
				phone_3 = '{$_POST['phone_3']}',
				phone_4 = '{$_POST['phone_4']}',
				phone_5 = '{$_POST['phone_5']}', 
				google_map = '{$_POST['google_map']}', updated = '{$update_date}'
				WHERE id = '{$contact_id}'";
	// exit;
	$updated = query($sql);

	return $updated;
}

?>

