<?php
ini_set('memory_limit','2000M');
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$dsn = "mysql:host=10.88.0.234;dbname=weike";
$db = new PDO($dsn, 'root', 'tikuserversee');
$db -> query('set names utf8');
$sql = 'select * from W_Tree where has_leaf = 0';
$d = $db -> query($sql) -> fetchAll();
foreach($d as $row){
    //$url = 'http://v.dearedu.com/list_g.php?xueduan='.$row['xueduan'].'&xueke='.$row['xueke'].'&uid='.$row['uidorbj'].'&zhuti='.$row['zhuti'];
    $url = 'http://v.dearedu.com/list_g.php?xueduan=3&xueke=2&uid=2&zhuti=1';
		echo $url."\n";
		$str = gets($url);
		$doc = new DOMDocument();
		$str = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$str;
		$doc -> loadHTML($str);
		$finder = new DomXPath($doc);
		$ondemands = $finder -> query("//*[contains(@class, 'ondemand')]");
		foreach($ondemands as $nd){
			$innerHTML = '';
			foreach ($nd->childNodes as $childNode){
					$innerHTML .= $childNode->ownerDocument->saveHTML($childNode);
			}
			$detailsurl = clears(preg_replace('/^[\s\S]*?(detail[\s\S]*?)"[\s\S]*$/uis','$1',$innerHTML));
			$detailsurl = 'http://v.dearedu.com/'.$detailsurl;
			$title = clears(preg_replace('/^[\s\S]*?title="([\s\S]*?)"[\s\S]*$/uis','$1',$innerHTML));
			$upload = preg_replace('/^[\s\S]*?display:none;">([\s\S]*?)<[\s\S]*$/uis','$1',$innerHTML);
			$detail = gets($detailsurl);
			$detail = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$detail;
			$doc -> loadHTML($detail);
			$finder = new DomXPath($doc);
			$buynow = $finder -> query("//*[@class='buynow']")->item(0);
			$buynowHTML = '';
			foreach ($buynow->childNodes as $childNode){
					$buynowHTML .= $childNode->ownerDocument->saveHTML($childNode);
			}
			$videourl = clears(preg_replace('/^[\s\S]*?(show[\s\S]*?)"[\s\S]*$/uis','$1',$buynowHTML));
            $videourl = 'http://v.dearedu.com/'.$videourl;
            $videourl = preg_replace('/&amp;/uis','&',$videourl);
			$teachername = clears(preg_replace('/^[\s\S]*?主讲：([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$grade = clears(preg_replace('/^[\s\S]*?学段：([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$subject = clears(preg_replace('/^[\s\S]*?学科：([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$zhicheng = clears(preg_replace('/^[\s\S]*?职称：([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$years = clears(preg_replace('/^[\s\S]*?教龄：([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$price_old = clears(preg_replace('/^[\s\S]*?text\-decoration:line\-through">￥([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$price_new = clears(preg_replace('/^[\s\S]*?em>￥([\s\S]*?)<[\s\S]*$/uis','$1',$buynowHTML));
			$price_instrction = preg_replace('/^[\s\S]*￥'.addcslashes($price_new,".").'([\s\S]*?)<\/span>[\s\S]*$/uis','$1',$buynowHTML);
            $price_instrction = clears(strip_tags($price_instrction));
			$brief= clears($doc->getElementById('con_qq_3') -> nodeValue);
			$sql = 'select id from W_Teacher where name=\''.addcslashes($teachername, "\000\n\r\\'\"\032").'\' and years=\''.$years.'\' and grade = \''.$grade.'\' and subject=\''.$subject.'\' and title=\''.$zhicheng.'\' and brief=\''.addcslashes($brief, "\000\n\r\\'\"\032").'\'';
			$tid = $db -> query($sql) -> fetch();
			if(empty($tid)){
				$sql = 'insert into W_Teacher(name,years,grade,subject,title,brief) values(\''.addcslashes($teachername, "\000\n\r\\'\"\032").'\',\''.$years.'\',\''.$grade.'\',\''.$subject.'\',\''.$zhicheng.'\',\''.addcslashes($brief, "\000\n\r\\'\"\032").'\')';
				$db -> query($sql);
				$sql = 'select id from W_Teacher where name=\''.addcslashes($teachername, "\000\n\r\\'\"\032").'\' and years=\''.$years.'\' and grade = \''.$grade.'\' and subject=\''.$subject.'\' and title=\''.$zhicheng.'\' and brief=\''.addcslashes($brief, "\000\n\r\\'\"\032").'\'';
				$tid = $db -> query($sql) -> fetch();
			}
			$cots = $finder -> query("//*[contains(@class, 'comment')]");
			$cs = array();
			foreach($cots as $xs){
				$outerHTML = $xs->ownerDocument->saveHTML($xs);
				$nn = clears(preg_replace('/^[\s\S]*?<h1>([\s\S]*?)<\/h1>[\s\S]*$/uis','$1',$outerHTML));
				$pp = clears(preg_replace('/^[\s\S]*?<p>([\s\S]*?)<\/p>[\s\S]*$/uis','$1',$outerHTML));
				$cs[$nn] = $pp;
            }
            $comments = '';
            if(!empty($cs))
			$comments = json_encode($cs);
			$plaess = $finder -> query("//*[contains(@class, 'plaes')]");
			foreach($plaess as $xss){
				$outerHTML = $xss->ownerDocument->saveHTML($xss);
				$turl = clears(preg_replace('/^[\s\S]*?(detail[\s\S]*?)"[\s\S]*$/uis','$1',$outerHTML));
				$turl = preg_replace('/zhuti=&amp;/uis','',$turl);
				$turl = 'http://v.dearedu.com/'.$turl;
				$tn = clears(preg_replace('/^[\s\S]*?讲师：([\s\S]*?)<[\s\S]*$/uis','$1',$outerHTML));
				$tt = clears(preg_replace('/^[\s\S]*?title="([\s\S]*?)"[\s\S]*$/uis','$1',$outerHTML));
				$ttime = clears(preg_replace('/^[\s\S]*?点播次数：([\s\S]*?)<[\s\S]*$/uis','$1',$outerHTML));
				$sql = 'insert ignore into W_Playtimes(title,teachername,url,playtimes) values(\''.addcslashes($tt, "\000\n\r\\'\"\032").'\',\''.addcslashes($tn, "\000\n\r\\'\"\032").'\',\''.addcslashes($turl, "\000\n\r\\'\"\032").'\','.$ttime.')';
				$db -> query($sql);
			}
			$videl = gets($videourl);
            $ac = clears(preg_replace('/^[\s\S]*?var video_url = guolv\(\'([\s\S]*?)\'[\s\S]*$/uis','$1',$videl));
            $ha = gets('http://192.168.90.51:8080/searcher/getadd?strs='.$ac);
			$sql = 'insert into W_Video(tree_id,detailsurl,teacher,upload,title,videourl,videoname,price_old,price_new,price_instrction,playtimes,comments) values('.$row['id'].',\''.$detailsurl.'\','.$tid['id'].',\''.$upload.'\',\''.addcslashes($title, "\000\n\r\\'\"\032").'\',\''.$videourl.'\',\''.$ha.'\',\''.$price_old.'\',\''.$price_new.'\',\''.$price_instrction.'\',0,\''.addcslashes($comments, "\000\n\r\\'\"\032").'\')';
			$db -> query($sql);
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

function clears($field){
	return preg_replace('/\s+|&nbsp;?/uis','',$field);
}
