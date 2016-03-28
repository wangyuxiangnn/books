<?php 
	//content-type:text/html;charset=utf8
	header('content-type:text/html;charset=utf8');
	//连接数据库
	include_once('public/mysqliConnect.php');
	$action = $_REQUEST['action'];
	if($action == 'recordsList'){
		$sql = "select * from records";
		if (!mysql_query($sql,$con)){
			die('Error: ' . mysql_error());
		}
		//如果查询执行不正确则返回false
		$res = mysql_query($sql);
		$records = array();
		//mysql_fetch_row失败返回false
		//$row = mysql_fetch_row($res);
		//取出每个字段
		while ($row = mysql_fetch_row($res)) {
			//获取到id后，分别去各自表查询详细信息
			//查询书籍详细信息
			$record = array(
				'recordId' => $row[0],
				'memberId' => $row[1],
				'memberNum' => $row[2],
				'memberName' => $row[3],
				'memberRank' => $row[4],
				'memberCreateTime' => $row[5],
				'bookId' => $row[6],
				'bookIsbn' => $row[7],
				'bookName' => $row[8],
				'bookImg' => $row[9],
				'borrowTime' => $row[10],
				'returnTime' => $row[11]
			);
			$records[] = $record;
		}
		mysql_close($con);
		die(json_encode($records));
	}elseif($action == 'serachByIsbn'){
		//根据书籍isbn码查询记录
		$bookIsbn = $_REQUEST['bookIsbn'];
		$sql = "select * from records, books, members 
		where records.bookId = books.bookId and records.memberId = members.memberId and records.returnTime = '0000-00-00' and books.bookIsbn like '%".$bookIsbn."'";
		$results = $mysqli->query($sql);
		//如果查询执行不正确则返回false
		if(!$results){
			die(json_encode($result['state']=500));
		}
		$records = array();
		while($row = $results->fetch_assoc()){
			//var_dump($row);
			$record = array(
				'recordId' => $row['recordId'],
				'memberId' => $row['memberId'],
				'memberNum' => $row['memberNum'],
				'memberName' => $row['memberName'],
				'memberRank' => $row['memberRank'],
				'memberCreateTime' => $row['memberCreateTime'],
				'bookId' => $row['bookId'],
				'bookIsbn' => $row['bookIsbn'],
				'bookTitle' => $row['bookTitle'],
				'bookImg' => $row['bookImg'],
				'borrowTime' => $row['borrowTime']
			);
			$records[] = $record;
		}
		if(count($records) == 0){
			$result['state'] = 404;
		}else{
			$result['state'] = 200;
			$result['data'] = $records;
		}
		$mysqli->close();
		die(json_encode($result));
	}elseif($action == 'searchByTitle'){
		//echo 'hello world';
		//exit;
		$result = array();
		//根据书籍名查询记录
		$bookTitle = $_REQUEST['bookTitle'];
		$sql = "select * from records, books, members 
		where records.bookId = books.bookId and records.memberId = members.memberId and records.returnTime = '0000-00-00' and books.bookTitle like '%".$bookTitle."%'";
		//echo $sql;
		$results = $mysqli->query($sql);
		//如果查询执行不正确则返回false
		if(!$results){
			die(json_encode($result['state']=500));
		}
		$records = array();
		while($row = $results->fetch_assoc()){
			//var_dump($row);
			$record = array(
				'recordId' => $row['recordId'],
				'memberId' => $row['memberId'],
				'memberNum' => $row['memberNum'],
				'memberName' => $row['memberName'],
				'memberRank' => $row['memberRank'],
				'memberCreateTime' => $row['memberCreateTime'],
				'bookId' => $row['bookId'],
				'bookIsbn' => $row['bookIsbn'],
				'bookTitle' => $row['bookTitle'],
				'bookImg' => $row['bookImg'],
				'borrowTime' => $row['borrowTime']
			);
			$records[] = $record;
		}
		if(count($records) == 0){
			$result['state'] = 404;
		}else{
			$result['state'] = 200;
			$result['data'] = $records;
		}
		$mysqli->close();
		die(json_encode($result));
	}elseif($action == 'searchByName'){
		$result = array();
		//根据会员名查询记录
		$memberName = $_REQUEST['memberName'];
		$sql = "select * from records, books, members 
		where records.bookId = books.bookId and records.memberId = members.memberId and records.returnTime = '0000-00-00' and members.memberName like '%".$memberName."'";
		$results = $mysqli->query($sql);
		//如果查询执行不正确则返回false
		if(!$results){
			die(json_encode($result['state']=500));
		}
		$records = array();
		while($row = $results->fetch_assoc()){
			//var_dump($row);
			$record = array(
				'recordId' => $row['recordId'],
				'memberId' => $row['memberId'],
				'memberNum' => $row['memberNum'],
				'memberName' => $row['memberName'],
				'memberRank' => $row['memberRank'],
				'memberCreateTime' => $row['memberCreateTime'],
				'bookId' => $row['bookId'],
				'bookIsbn' => $row['bookIsbn'],
				'bookTitle' => $row['bookTitle'],
				'bookImg' => $row['bookImg'],
				'borrowTime' => $row['borrowTime']
			);
			$records[] = $record;
		}
		if(count($records) == 0){
			$result['state'] = 404;
		}else{
			$result['state'] = 200;
			$result['data'] = $records;
		}
		$mysqli->close();
		die(json_encode($result));
	}elseif($action == 'searchByNumber'){
		$result = array();
		//根据会员学号查询记录
		$memberNum = $_REQUEST['memberNum'];
		$sql = "select * from records, books, members 
		where records.bookId = books.bookId and records.memberId = members.memberId and records.returnTime = '0000-00-00' and members.memberNum like '%".$memberNum."'";
		$results = $mysqli->query($sql);
		//如果查询执行不正确则返回false
		if(!$results){
			die(json_encode($result['state']=500));
		}
		$records = array();
		while($row = $results->fetch_assoc()){
			//var_dump($row);
			$record = array(
				'recordId' => $row['recordId'],
				'memberId' => $row['memberId'],
				'memberNum' => $row['memberNum'],
				'memberName' => $row['memberName'],
				'memberRank' => $row['memberRank'],
				'memberCreateTime' => $row['memberCreateTime'],
				'bookId' => $row['bookId'],
				'bookIsbn' => $row['bookIsbn'],
				'bookTitle' => $row['bookTitle'],
				'bookImg' => $row['bookImg'],
				'borrowTime' => $row['borrowTime']
			);
			$records[] = $record;
		}
		if(count($records) == 0){
			$result['state'] = 404;
		}else{
			$result['state'] = 200;
			$result['data'] = $records;
		}
		$mysqli->close();
		die(json_encode($result));
	}elseif($action == 'update'){
		$recordId = $_REQUEST['recordId'];
		$time = date('Y-m-d');
		//UPDATE `records` SET `returnTime` = '2015-12-30' WHERE `records`.`recordId` =7
		$sql = "UPDATE `records` SET `returnTime` = '$time' WHERE `records`.`recordId` =" . $recordId;
		$results = $mysqli->query($sql);
		if($results){
			$result['state'] = 200;
		}else{
			$result['state'] = 500;
		}
		$mysqli->close();
		die(json_encode($result));
	}
?>