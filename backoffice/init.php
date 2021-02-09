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

function slide_list()
{
	$sql	= "SELECT *
				FROM db_banner
				WHERE is_active = '1' AND banner_type = '1'
				ORDER BY id ASC
				LIMIT 10";
	
	return query($sql);
}

function slide_detail($id)
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

function slide_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_banner
				(banner_name, youtube, banner_type, created) 
				VALUE 
				('{$_POST['name']}', '{$_POST['ylink']}', '1', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$slide_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/banner/' . $slide_id . '/';
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

				$sql = "UPDATE db_banner SET img_cover = '{$file_name}' WHERE id = '{$slide_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function slide_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$slide_id 	= $_POST['slide_id'];

	$sql = "UPDATE db_banner
			SET banner_name = '{$_POST['name']}', youtube = '{$_POST['ylink']}', banner_type = '1', updated = '{$update_date}'
			WHERE id = '{$slide_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/banner/' . $slide_id . '/';
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
				$sql = "UPDATE db_banner SET img_cover = '{$file_name}' WHERE id = '{$slide_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}

function video_list()
{
	$sql	= "SELECT *
				FROM db_banner
				WHERE is_active = '1' AND banner_type = '2'
				ORDER BY id ASC
				LIMIT 1";
	
	return query($sql);
}

function video_detail($id)
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

function video_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$slide_id 	= $_POST['slide_id'];

	$sql = "UPDATE db_banner
			SET banner_name = '{$_POST['name']}', youtube = '{$_POST['ylink']}', banner_type = '2', updated = '{$update_date}'
			WHERE id = '{$slide_id}'";
	// exit;
	$updated = query($sql);

	return $updated;
}

function article_list()
{
	$sql	= "SELECT *
				FROM db_article
				WHERE is_active = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function article_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_article
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function article_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_article
				(url_name, keyword, article_name, youtube, description, created) 
				VALUE 
				('{$_POST['urlname']}', '{$_POST['keyword']}', '{$_POST['name']}', '{$_POST['ylink']}', '{$_POST['description']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$article_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/article/' . $article_id . '/';
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

				$sql = "UPDATE db_article SET img_cover = '{$file_name}' WHERE id = '{$article_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function article_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$article_id 	= $_POST['article_id'];

	$sql = "UPDATE db_article
			SET url_name = '{$_POST['urlname']}', keyword = '{$_POST['keyword']}', article_name = '{$_POST['name']}', description = '{$_POST['description']}', youtube = '{$_POST['ylink']}', updated = '{$update_date}'
			WHERE id = '{$article_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../img/article/' . $article_id . '/';
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
				$sql = "UPDATE db_article SET img_cover = '{$file_name}' WHERE id = '{$article_id}'";
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
				(review_name, youtube, created) 
				VALUE 
				('{$_POST['name']}', '{$_POST['ylink']}', '{$created}')";
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
			SET review_name = '{$_POST['name']}', youtube = '{$_POST['ylink']}', updated = '{$update_date}'
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

function category_list()
{
	$sql	= "SELECT *
				FROM db_category
				WHERE is_active = '1'
				ORDER BY category_id ASC";
	
	return query($sql);
}

function fuel_list()
{
	$sql	= "SELECT *
				FROM db_fuel
				WHERE is_active = '1'
				ORDER BY fuel_id ASC";
	
	return query($sql);
}

function color_list()
{
	$sql	= "SELECT *
				FROM db_color
				WHERE is_active = '1'
				ORDER BY color_id ASC";
	
	return query($sql);
}


function product_list()
{
	$sql	= "SELECT p.*, c.category_name
				FROM db_product p
				INNER JOIN db_category c ON c.category_id = p.category
				WHERE p.is_active = '1' AND p.product_type = '1'
				ORDER BY p.id ASC";
	
	return query($sql);
}

function bproduct_list()
{
	$sql	= "SELECT p.*
				FROM db_product p
				WHERE p.is_active = '1' AND p.product_type = '2'
				ORDER BY p.id ASC";
	
	return query($sql);
}

function product_detail($id)
{	
	$wheres[] = "p.id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT p.*, c.category_name AS cname, cl.color_name, f.fuel_name
				FROM db_product p
				INNER JOIN db_category c ON c.category_id = p.category
				INNER JOIN db_color cl ON cl.color_id = p.color
				INNER JOIN db_fuel f ON f.fuel_id = p.fuel
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function product_add() {
	$created = date('Y-m-d H:i:s');
	$product_name = $_POST['brand'] . ' ' . $_POST['model'] . ' ' . $_POST['sub_model'] . ' ' . $_POST['makeover'];

	// $sql	 = "INSERT INTO db_product
	// 			(url_name, keyword, product_name, category, product_type, price, mileage, license, license_province, body_num, chassis_num, description, guarantee, offer, finance, created) 
	// 			VALUE 
	// 			('{$_POST['urlname']}', '{$_POST['keyword']}', '{$_POST['name']}', '{$_POST['category']}', '1', '{$_POST['price']}', '{$_POST['mileage']}', '{$_POST['licenseP']}', '{$_POST['liprovince']}', '{$_POST['bodyno']}', '{$_POST['chassis']}', '{$_POST['description']}', '{$_POST['guarantee']}', '{$_POST['offer']}', '{$_POST['finance']}', '{$created}')";

	$sql	 = "INSERT INTO db_product
				(url_name, keyword, code_product, product_name, brand, model, sub_model, makeover, category, product_type, price, mileage, license, license_province, body_num, chassis_num, gear, color, drive_sys, fuel, engine_size, description, guarantee, offer, finance, vehicle_regis, import_date, car_year, old_owner, owner_address, owner_tel, owner_id, is_note, created) 
				VALUE 
				('{$_POST['urlname']}', '{$_POST['keyword']}', '{$_POST['code_product']}', '{$product_name}', '{$_POST['brand']}', '{$_POST['model']}', '{$_POST['sub_model']}', '{$_POST['makeover']}', '{$_POST['category']}', '1', '{$_POST['price']}', '{$_POST['mileage']}', '{$_POST['licenseP']}', '{$_POST['liprovince']}', '{$_POST['bodyno']}', '{$_POST['chassis']}', '{$_POST['gear']}', '{$_POST['color']}', '{$_POST['drive_sys']}', '{$_POST['fuel']}', '{$_POST['engine_size']}', '{$_POST['description']}', '{$_POST['guarantee']}', '{$_POST['offer']}', '{$_POST['finance']}', '{$_POST['vehicle_regis']}', '{$_POST['import_date']}', '{$_POST['car_year']}', '{$_POST['old_owner']}', '{$_POST['owner_address']}', '{$_POST['owner_tel']}', '{$_POST['owner_id']}', '{$_POST['is_note']}', '{$created}')";
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
	$product_name = $_POST['brand'] . ' ' . $_POST['model'] . ' ' . $_POST['sub_model'] . ' ' . $_POST['makeover'];

	$sql = "UPDATE db_product
			SET url_name = '{$_POST['urlname']}', keyword = '{$_POST['keyword']}', code_product = '{$_POST['code_product']}', product_name = '{$product_name}', brand = '{$_POST['brand']}', model = '{$_POST['model']}', sub_model = '{$_POST['sub_model']}', makeover = '{$_POST['makeover']}', category = '{$_POST['category']}', product_type = '1', price = '{$_POST['price']}', mileage = '{$_POST['mileage']}', license = '{$_POST['licenseP']}', license_province = '{$_POST['liprovince']}', body_num = '{$_POST['bodyno']}', chassis_num = '{$_POST['chassis']}', gear = '{$_POST['gear']}', color = '{$_POST['color']}', drive_sys = '{$_POST['drive_sys']}', fuel = '{$_POST['fuel']}', engine_size = '{$_POST['engine_size']}', description = '{$_POST['description']}', guarantee = '{$_POST['guarantee']}', offer = '{$_POST['offer']}', finance = '{$_POST['finance']}', vehicle_regis = '{$_POST['vehicle_regis']}', import_date = '{$_POST['import_date']}', car_year = '{$_POST['car_year']}', old_owner = '{$_POST['old_owner']}', owner_address = '{$_POST['owner_address']}', owner_tel = '{$_POST['owner_tel']}', owner_id = '{$_POST['owner_id']}', is_note = '{$_POST['is_note']}', updated = '{$update_date}'
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

function bproduct_detail($id)
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

function bproduct_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO db_product
				(product_name, product_type, created) 
				VALUE 
				('{$_POST['name']}', '2', '{$created}')";
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
	}

	return $added;
}

function bproduct_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$product_id 	= $_POST['product_id'];

	$sql = "UPDATE db_product
			SET product_name = '{$_POST['name']}', product_type = '2', updated = '{$update_date}'
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

function user_list()
{
	$sql	= "SELECT *
				FROM db_admin
				WHERE is_active = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function user_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_admin
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function user_add() {

	$created = date('Y-m-d H:i:s');
	$fullname = $_POST['fname'];
	$username = $_POST['username'];
	$password = md5( $_POST['password'] );

	$sql	 = "INSERT INTO db_admin
				(full_name, username, password, group_id, created) 
				VALUE 
				('{$fullname}', '{$username}', '{$password}', '{$_POST['status']}', '{$created}')";
	// exit;
	$added = query($sql);

	return $added;
}

function user_edit() {
	
	$user_id 	= $_POST['user_id'];
	$fullname 	= $_POST['fname'];
	$password = md5($_POST['password']);

	if(!empty($_POST['password'])){ 
		$sql = "UPDATE db_admin
				SET full_name = '{$fullname}', password ='{$password}', group_id = '{$_POST['status']}'
				WHERE id = '{$user_id}'";
	}  else {
		$sql = "UPDATE db_admin
				SET full_name = '{$fullname}', group_id = '{$_POST['status']}'
				WHERE id = '{$user_id}'";
	}
	// exit;
	$updated = query($sql);

	return $updated;
}

function sale_customer_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_customer
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}



function salecus_img_list($id)
{
	if (!empty($_GET['id'])) {
		$wheres[] = "customer_id = '{$_GET['id']}'";
	}
	
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM db_customer_img
				{$where}
				ORDER BY order_id ASC
				LIMIT 1";
	
	$result = query($sql);

	return $result;
}

function sale_customer_add() {
	$created = date('Y-m-d H:i:s');
	$user = $_POST['user_id'];

	$sql	 = "INSERT INTO db_customer
				(first_name, last_name, id_num, address1, swine, alley, street, district, county, province, post_code, birthday, tel, email, facebook, line_id, ig, create_by, created) 
				VALUE 
				('{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['id_num']}', '{$_POST['address1']}', '{$_POST['swine']}', '{$_POST['alley']}', '{$_POST['street']}', '{$_POST['district']}', '{$_POST['county']}', '{$_POST['province']}', '{$_POST['postcode']}', '{$_POST['birthday']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['facebook']}', '{$_POST['line_id']}', '{$_POST['ig']}', '{$user}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$customer_id = mysqli_insert_id($db_connected);

		if (!empty($_FILES['cusImg'])) {
			include('vendor/upload/class.fileuploader.php');

			$filePath 	= '../img/customer/' . $customer_id . '/';
			$path 		= realpath($filePath);

			if ( !is_dir($path) ) {
				mkdir($filePath);
			}

			// initialize FileUploader
		    $FileUploader = new FileUploader('cusImg', array(
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
					$sql = "INSERT INTO db_customer_img (customer_id, img_name, order_id, created) VALUE ('{$customer_id}', '{$img['name']}', '{$i}', '{$created}')";
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

function sale_customer_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$customer_id 	= $_POST['customer_id'];

	$sql = "UPDATE db_customer
			SET first_name = '{$_POST['fname']}', last_name = '{$_POST['lname']}', id_num = '{$_POST['id_num']}', address1 = '{$_POST['address1']}', swine = '{$_POST['swine']}', alley = '{$_POST['alley']}', street = '{$_POST['street']}', district = '{$_POST['district']}', county = '{$_POST['county']}', province = '{$_POST['province']}', post_code = '{$_POST['postcode']}', birthday = '{$_POST['birthday']}', tel = '{$_POST['tel']}', email = '{$_POST['email']}', facebook = '{$_POST['facebook']}', line_id = '{$_POST['line_id']}', ig = '{$_POST['ig']}', updated = '{$update_date}'
			WHERE id = '{$customer_id}'";
	// exit;
	$updated = query($sql);

	return $updated;
}

function cost_order($pid)
{
	if (!empty($pid)) {
		$wheres[] = "c.product_id = '{$pid}'";
	}
	$wheres[] = "c.is_active = '1'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode(' AND ', $wheres) : null;

	$sql = "SELECT c.*, ad.full_name
			FROM db_cost c
			INNER JOIN db_admin ad ON ad.id = c.create_by
			{$where}
			ORDER BY c.cost_id ASC";

	return query($sql);
}

function cost_add() {
	$created = date('Y-m-d H:i:s');
	$user = $_POST['user_id'];
	$pid = $_POST['product_id'];

	$sql	 = "INSERT INTO db_cost
				(product_id, order_name, cost, create_by, im_date, created) 
				VALUE 
				('{$pid}', '{$_POST['order_name']}', '{$_POST['cost']}', '{$user}', '{$_POST['im_date']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$cost_id = mysqli_insert_id($db_connected);

		if (!empty($_FILES['cusImg'])) {
			include('vendor/upload/class.fileuploader.php');

			$filePath 	= '../img/cost/' . $cost_id . '/';
			$path 		= realpath($filePath);

			if ( !is_dir($path) ) {
				mkdir($filePath);
			}

			// initialize FileUploader
		    $FileUploader = new FileUploader('cusImg', array(
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
				foreach ($fileList as $img) {
				$sql = "UPDATE db_cost SET img_name = '{$img['name']}' WHERE cost_id = '{$cost_id}'";
					query($sql);
				}
			}
		}
	}

	return $added;
}

function salecustomer_list($uid)
{
	if (!empty($uid)) {
		$wheres[] = "create_by = '{$uid}'";
	}
	$wheres[] = "is_active = '1'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode(' AND ', $wheres) : null;

	$sql = "SELECT *
			FROM db_customer
			{$where}
			ORDER BY id ASC";

	return query($sql);
}

function admincustomer_list()
{
	$wheres[] = "is_active = '1'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode(' AND ', $wheres) : null;

	$sql = "SELECT *
			FROM db_customer
			{$where}
			ORDER BY id ASC";

	return query($sql);
}

function finance_list()
{
	$sql	= "SELECT *
				FROM db_finance
				WHERE is_active = '1'
				ORDER BY finance_id ASC";
	
	return query($sql);
}

function booking_detail($id)
{	
	$wheres[] = "b.booking_id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT b.*, c.*, p.brand, p.model, p.sub_model, p.makeover, p.license, p.license_province, f.finance_name, cl.color_name
				FROM db_booking b
				INNER JOIN db_customer c ON c.id = b.customer_id
				INNER JOIN db_product p ON p.id = b.product_id
				INNER JOIN db_finance f ON f.finance_id = b.finance
				INNER JOIN db_color cl ON cl.color_id = p.color
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function booking_add() {
	$created = date('Y-m-d H:i:s');
	$user = $_POST['user_id'];
	$pid = $_POST['product_id'];

	$sql	 = "INSERT INTO db_booking
				(product_id, customer_id, category_fi, finance, deposit, sale_price, price, discount, amount_fi, ins, tax_fi, total_fi, amount, amount_d, ins_price, fi_fee, trans_fee, payment, sumtotal, balance, sale_date, is_note, is_status, create_by, created) 
				VALUE 
				('{$pid}', '{$_POST['customer_id']}', '{$_POST['category']}', '{$_POST['finance']}', '{$_POST['deposit']}', '{$_POST['sale_price']}', '{$_POST['price']}', '{$_POST['discount']}', '{$_POST['amount_fi']}', '{$_POST['ins']}', '{$_POST['tax_fi']}', '{$_POST['total_fi']}', '{$_POST['amount']}', '{$_POST['amount_d']}', '{$_POST['ins_price']}', '{$_POST['fi_fee']}', '{$_POST['trans_fee']}', '{$_POST['payment']}', '{$_POST['sumtotal']}', '{$_POST['balance']}', '{$_POST['sale_date']}', '{$_POST['is_note']}', '3', '{$user}', '{$created}')";

	$sqlA	= "UPDATE db_product SET is_status = '2' WHERE id = '{$pid}'";
	query($sqlA);

	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$booking_id = mysqli_insert_id($db_connected);

		if (!empty($_FILES['pdImg'])) {
			include('vendor/upload/class.fileuploader.php');

			$filePath 	= '../img/booking/' . $booking_id . '/';
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
				foreach ($fileList as $img) {
				$sql = "UPDATE db_booking SET img_name = '{$img['name']}' WHERE booking_id = '{$booking_id}'";
					query($sql);
				}
			}
		}
	}

	return $added;
}

function booking_edit() {
	$booking_id 	= $_POST['booking_id'];

	$sql = "UPDATE db_booking
			SET customer_id = '{$_POST['customer_id']}', category_fi = '{$_POST['category']}', finance = '{$_POST['finance']}', deposit = '{$_POST['deposit']}', sale_price = '{$_POST['sale_price']}', price = '{$_POST['price']}', discount = '{$_POST['discount']}', amount_fi = '{$_POST['amount_fi']}', ins = '{$_POST['ins']}', tax_fi = '{$_POST['tax_fi']}', total_fi = '{$_POST['total_fi']}', amount = '{$_POST['amount']}', amount_d = '{$_POST['amount_d']}', ins_price = '{$_POST['ins_price']}', fi_fee = '{$_POST['fi_fee']}', trans_fee = '{$_POST['trans_fee']}', payment = '{$_POST['payment']}', sumtotal = '{$_POST['sumtotal']}', sumtotal = '{$_POST['sumtotal']}', balance = '{$_POST['balance']}', sale_date = '{$_POST['sale_date']}', is_note = '{$_POST['is_note']}'
			WHERE booking_id = '{$booking_id}'";
	// exit;
	$updated = query($sql);

	return $updated;
}

function changStatus() {
	$bid 	= $_POST['bid'];
	$pid	= $_POST['pid'];
	$status	= $_POST['is_status'];

	$sql = "UPDATE db_booking
			SET is_status = '{$_POST['is_status']}'
			WHERE booking_id = '{$bid}'";
	// exit;
	if ($status == '2') {
		$sqlA	= "UPDATE db_product 
					SET is_status = '1' 
					WHERE id = '{$pid}'";
	} elseif ($status == '1') {
		$sqlA	= "UPDATE db_product 
					SET is_status = '3' 
					WHERE id = '{$pid}'";
	} elseif ($status == '3') {
		$sqlA	= "UPDATE db_product 
					SET is_status = '2' 
					WHERE id = '{$pid}'";
	}
	query($sqlA);

	$updated = query($sql);

	return $updated;
}

?>

