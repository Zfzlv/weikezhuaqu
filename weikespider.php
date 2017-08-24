<?php
ini_set('memory_limit','2000M');
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$dsn = "mysql:host=10.88.0.234;dbname=weike";
$db = new PDO($dsn, 'root', 'tikuserversee');
$db -> query('set names utf8');
$sql = 'select * from W_Subject';
$d = $db -> query($sql) -> fetchAll();
foreach($d as $row){
	$sql = 'select * from W_Moudle';
	$dx = $db -> query($sql) -> fetchAll();
	foreach($dx as $drow){
		$url = 'http://v.dearedu.com/list_g.php?xueduan='.$drow['xueduan'].'&xueke='.$row['xueke'].'&zhuti='.$drow['zhuti'];
		echo $url."\n";
		$str = gets($url);
		$doc = new DOMDocument();
		$str = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$str;
		$doc -> loadHTML($str);
		$node = $doc->getElementById('lTREEMenuDEMO');
		//$outerHTML = $node->ownerDocument->saveHTML($node); 
		$innerHTML = '';
        foreach ($node->childNodes as $childNode){
                $innerHTML .= $childNode->ownerDocument->saveHTML($childNode);
        }
		$innerHTML = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$innerHTML;
		$doc -> loadHTML($innerHTML);
		$finder = new DomXPath($doc);
		$mgh1 = $finder -> query("//*[contains(@class, 'mgh1_1')]");
		foreach($mgh1 as $nd){
			//$outerHTML = $nd->ownerDocument->saveHTML($nd);
			$outerHTML = '';
			foreach ($nd->childNodes as $childNode){
					$outerHTML .= $childNode->ownerDocument->saveHTML($childNode);
			}
			if(preg_match('/mgh1\_2/uis',$outerHTML)){
				$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML);
				$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
				$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
				$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].',0,1,'.$uid.',1)';
				$db -> query($sql);
				$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = 0 and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 1 and xueduan = '.$drow['xueduan'];
				$qid = $db -> query($sql) -> fetch();
				$innerHTML1 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML;
				$doc -> loadHTML($innerHTML1);
				$finder = new DomXPath($doc);
				$mgh2 = $finder -> query("//*[contains(@class, 'mgh1_2')]");
				foreach($mgh2 as $ndx){
					//$outerHTML2 = $ndx->ownerDocument->saveHTML($ndx);
					$outerHTML2 = '';
					foreach ($ndx->childNodes as $childNode){
							$outerHTML2 .= $childNode->ownerDocument->saveHTML($childNode);
					}
					if(preg_match('/mgh1\_3/uis',$outerHTML2)){
						$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML2);
						$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
						$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
						$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid['id'].',1,'.$uid.',2)';
						$db -> query($sql);
						$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = '.$qid['id'].' and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 2 and xueduan = '.$drow['xueduan'];
						$qid_2 = $db -> query($sql) -> fetch();
						$innerHTML2 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML2;
						$doc -> loadHTML($innerHTML2);
						$finder = new DomXPath($doc);
						$mgh3 = $finder -> query("//*[contains(@class, 'mgh1_3')]");
						foreach($mgh3 as $ndxz){
							//$outerHTML3 = $ndxz->ownerDocument->saveHTML($ndxz);
							$outerHTML3 = '';
							foreach ($ndxz->childNodes as $childNode){
									$outerHTML3 .= $childNode->ownerDocument->saveHTML($childNode);
							}
							if(preg_match('/mgh1\_4/uis',$outerHTML3)){
								$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML3);
								$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
								$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
								$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_2['id'].',1,'.$uid.',3)';
								$db -> query($sql);
								$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = '.$qid_2['id'].' and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 3 and xueduan = '.$drow['xueduan'];
								$qid_3 = $db -> query($sql) -> fetch();
								$innerHTML3 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML3;
								$doc -> loadHTML($innerHTML3);
								$finder = new DomXPath($doc);
								$mgh4 = $finder -> query("//*[contains(@class, 'mgh1_4')]");
								foreach($mgh4 as $ndxzv){
									//$outerHTML4 = $ndxzv->ownerDocument->saveHTML($ndxzv);
									$outerHTML4 = '';
									foreach ($ndxzv->childNodes as $childNode){
											$outerHTML4 .= $childNode->ownerDocument->saveHTML($childNode);
									}
									if(preg_match('/mgh1\_5/uis',$outerHTML4)){
										$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML4);
										$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
										$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
										$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_3['id'].',1,'.$uid.',4)';
										$db -> query($sql);
										$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = '.$qid_3['id'].' and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 4 and xueduan = '.$drow['xueduan'];
										$qid_4 = $db -> query($sql) -> fetch();
										$innerHTML4 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML4;
										$doc -> loadHTML($innerHTML4);
										$finder = new DomXPath($doc);
										$mgh5 = $finder -> query("//*[contains(@class, 'mgh1_5')]");
										foreach($mgh5 as $ndxzxv){
											$outerHTML5 = '';
											foreach ($ndxzxv->childNodes as $childNode){
													$outerHTML5 .= $childNode->ownerDocument->saveHTML($childNode);
											}
											if(preg_match('/mgh1\_6/uis',$outerHTML5)){
												$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML5);
												$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
												$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
												$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_4['id'].',1,'.$uid.',5)';
												$db -> query($sql);
												$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = '.$qid_4['id'].' and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 5 and xueduan = '.$drow['xueduan'];
												$qid_5 = $db -> query($sql) -> fetch();
												$innerHTML5 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML5;
												$doc -> loadHTML($innerHTML5);
												$finder = new DomXPath($doc);
												$mgh6 = $finder -> query("//*[contains(@class, 'mgh1_6')]");
												foreach($mgh6 as $ndexzxv){
													$outerHTML6 = '';
													foreach ($ndexzxv->childNodes as $childNode){
															$outerHTML6 .= $childNode->ownerDocument->saveHTML($childNode);
													}
													if(preg_match('/mgh1\_7/uis',$outerHTML6)){
														$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML6);
														$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
														$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
														$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_5['id'].',1,'.$uid.',6)';
														$db -> query($sql);
														$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = '.$qid_5['id'].' and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 6 and xueduan = '.$drow['xueduan'];
														$qid_6 = $db -> query($sql) -> fetch();
														$innerHTML6 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML6;
														$doc -> loadHTML($innerHTML6);
														$finder = new DomXPath($doc);
														$mgh7 = $finder -> query("//*[contains(@class, 'mgh1_7')]");
														foreach($mgh7 as $ndrttxv){
															$outerHTML7 = '';
															foreach ($ndrttxv->childNodes as $childNode){
																	$outerHTML7 .= $childNode->ownerDocument->saveHTML($childNode);
															}
															if(preg_match('/mgh1\_8/uis',$outerHTML7)){
																$xx = preg_replace('/^[\s\S]*?check\(\'([\s\S]*?)\'\)[\s\S]*$/uis','$1',$outerHTML7);
																$uid =  preg_replace('/^[\s\S]*?\',\'(\d+)[\s\S]*$/uis','$1',$xx);
																$title = preg_replace('/^([\s\S]*?)\',\'\d+[\s\S]*$/uis','$1',$xx);
																$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_6['id'].',1,'.$uid.',7)';
																$db -> query($sql);
																$sql = 'select id from W_Tree where title = \''.addcslashes($title, "\000\n\r\\'\"\032").'\' and p_id = '.$qid_6['id'].' and zhuti = '.$drow['zhuti'].' and uidorbj = '.$uid.' and xueke = '.$row['xueke'].' and level = 7 and xueduan = '.$drow['xueduan'];
																$qid_7 = $db -> query($sql) -> fetch();
																$innerHTML7 = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$outerHTML7;
																$doc -> loadHTML($innerHTML7);
																$finder = new DomXPath($doc);
																$mgh8 = $finder -> query("//*[contains(@class, 'mgh1_8')]");
																foreach($mgh8 as $ndrxxttxv){
																	$outerHTML8 = '';
																	foreach ($ndrxxttxv->childNodes as $childNode){
																			$outerHTML8 .= $childNode->ownerDocument->saveHTML($childNode);
																	}
																	$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML8));
																	$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML8);
																	$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_7['id'].',0,'.$uid.',8)';
																	$db -> query($sql);
																}
															}else{
																$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML7));
																$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML7);
																$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_6['id'].',0,'.$uid.',7)';
																$db -> query($sql);
															}
														}
													}else{
														$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML6));
														$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML6);
														$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_5['id'].',0,'.$uid.',6)';
														$db -> query($sql);
													}
												}
											}else{
												$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML5));
												$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML5);
												$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_4['id'].',0,'.$uid.',5)';
												$db -> query($sql);
											}
										}
									}else{
										$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML4));
										$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML4);
										$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_3['id'].',0,'.$uid.',4)';
										$db -> query($sql);
									}
								}
							}else{
								$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML3));
								$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML3);
								$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid_2['id'].',0,'.$uid.',3)';
								$db -> query($sql);
							}
						}
					}else{
						$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML2));
						$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML2);
						$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].','.$qid['id'].',0,'.$uid.',2)';
						$db -> query($sql);
					}
				}
			}else{
				$title = preg_replace('/\s+|&nbsp;?/uis','',strip_tags($outerHTML));
				$uid = preg_replace('/^[\s\S]*?uid=(\d+)[\s\S]*$/uis','$1',$outerHTML);
				$sql = 'insert into W_Tree(title,xueduan,xueke,zhuti,p_id,has_leaf,uidorbj,level) values(\''.addcslashes($title, "\000\n\r\\'\"\032").'\','.$drow['xueduan'].','.$row['xueke'].','.$drow['zhuti'].',0,0,'.$uid.',1)';
				$db -> query($sql);
			}
		}
	}
}

function gets($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_REFERER, "http://v.dearedu.com/list_g.php?xueduan=3&xueke=2&title=%E4%B8%93%E9%A2%98%E5%8D%81%E7%AE%97%E6%B3%95%E4%B8%8E%E7%A8%8B%E5%BA%8F%E6%A1%86%E5%9B%BE&bj=32&zhuti=1"); 
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36");  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
	curl_setopt($curl, CURLOPT_HTTPHEADER,array('Host: v.dearedu.com','Upgrade-Insecure-Requests: 1','Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Accept-Encoding:gzip, deflate, sdch','Accept-Language:zh-CN,zh;q=0.8','Connection:keep-alive'));
	curl_setopt($curl, CURLOPT_COOKIE,'__jsluid=bd77fd0cbe3f96661bc2af6652cab375; UM_distinctid=15e08c3a57f205-03667f1d2ded3c-3a3e5e06-232800-15e08c3a581e58; skyuc_sessionhash=ec998c99fa038e7aabb3eb4d1616de11; CNZZDATA1254442515=859288047-1503383759-%7C1503389200; skyuc_lastvisit=1503385180; skyuc_lastactivity=0');  
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}