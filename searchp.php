<!-- update 180522 sorting with respect to validated miRTarBase evidence -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>BiMiR - Search Results</title>
<link href="./index_files/base.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.comment {
  width: auto;
  margin: 0 auto;
}
a.morelink {
  outline: none;
  color: #0000ff !important;
}
.morecontent span {
  display: none;
}

.inline {
  display: inline;
}

.link-button {
  background: none;
  border: none;
  color: blue;
  text-decoration: underline;
  cursor: pointer;
  font-size: 1em;
  font-family: serif;
}
.link-button:focus {
  outline: none;
}
.link-button:active {
  color:red;
}
</style>
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: white;
   color: white;
   text-align: left;
}
</style>
<script>

function goBack() {
    window.history.back();
}
</script>
<!--<script src="./jquery-3.1.1.js"></script> -->
		<script language="javascript" type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>				
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="readmore.js"></script>
</head>
<body bgcolor="#ffffff" height="100%" width="100%" link="#000000" vlink="#000000" alink="#000000">
<div class="header">
<table border="0" width="100%"  style="border-spacing:0;" >
  <tbody>
  <tr valign="top" colspan="5" style="background-color:rgb(0, 0, 0);">
  <td height="20"> </td>
 </tr>
  <tr valign="top" colspan="4" style="background-color:rgb(3, 45, 67);">
    <th align='left' valign='middle' width="100%" colspan="100%" style="font-family:caribri;font-size:120%;font-weight:bold;color:#ffffff;background-color:rgb(3, 45, 67);height:80;padding:10;padding-left:15;">
	<font style="font-family:Arial;font-size:300%;font-weight:bold;color:#ffffff;background-color:rgb(3, 45, 67);color:rgb(20, 200, 200);">BI</font>
	<font style="font-family:Arial;font-size:300%;font-weight:bold;color:#ffffff;background-color:rgb(3, 45, 67); ">MIR</font><font style="font-family:Arial;"> 
	Condition-specific miRNA target prediction database</font></th>
 </tr>
 <tr >  
    <td style="padding:10;padding-left:30;background-color:white;">
      <a class="topMenu" href="http://btool.org/bimir_dir/index.html" style="font-size:200%;font-weight:normal;">Home</a> <font style="font-size:200%;font-weight:normal;"> |       </font>
      <a class="topMenu" href="http://btool.org/bimir_dir/default.php" style="font-size:200%;font-weight:normal;">Search</a> <font style="font-size:200%;font-weight:normal;"> |       </font>
      <a  class="topMenu" href="http://btool.org/bimir_dir/download.html"style="font-size:200%;font-weight:normal;text-decoration:none;">Download</a> <font style="font-size:200%;font-weight:normal;"> |       </font> 
	  <a class="topMenu" href="http://btool.org/bimir_dir/help.html"style="font-size:200%;font-weight:normal;">Help</a>  
   </td>         
   <td style="background-color:white;" align='right' valign='middle'  > 
   <a href='https://clustrmaps.com/site/1aneh'  title='Visit tracker'><img width="140"  height="80"  src='//clustrmaps.com/map_v2.png?cl=ffffff&w=150&t=tt&d=p7rMVHU-6NMgIb_CzJFxjcboIQd8GHyaJrwr-6mAlLg&co=0049b8&ct=ffffff'/></a>   
   </td>
   </tr>   
   <tr valign="top" colspan="4" style="background-color:rgb(130, 130, 130);"><td height="3"  colspan="4"> </td>  </tr>
 </table>
 </div>

 <div>
 <ul>
<?php
// $servername = "mysql.hostinger.co.uk";
// $username = "u717682070_admin";
// $password = "xhunter";
// $port = "3306";
// $dbname = "u717682070_mibic";

$servername="117.16.94.203";
$port=3306;
$socket="";
$username="root";
$password="Xhunter@84";
$dbname="bigbicluster";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port)
		or 
		die("Connection failed: " . $conn->connect_error);

// Retrieve data from Query String 
$name = ''; 
$keyword = ''; 
$specificgenes = '';
$empty_specgenes = 1;
$specgenelist = ''; 
$tissue = '';
$disease = '';
$empty_name = 1;
$empty_cond = 1;
$empty_tissue = 1;
$empty_disease = 1;
$query = '';
$qname = '';
$qtissue='';
$qdisease ='';
$qkeyword = '';
$qspecgenes = '';

//var_dump($_POST);

if (isset($_POST['mirna'])){
	$name = $_POST['mirna']; 
	$empty_name = 0;
	if ($name == "") {
		$name = "ALL";
		$qname = "1";
	} else {
		$qname = "miRNA='".trim($name)."'";		
	}
}
if (isset($_POST['tissue'])){
	$tissue = $_POST['tissue'];	
	$qtissue = trim($tissue);
	if ($qtissue != '')
		$empty_tissue = 0;
} 
if (isset($_POST['disease'])){
	$disease = $_POST['disease'];	//echo $disease."<BR><BR>";	
	$qdisease= trim($disease);
	if ($qdisease != '')
		$empty_disease = 0;
}
if (isset($_POST['specificgenes'])){
	$specificgenes = $_POST['specificgenes'];	// remove whitespace trailed\	
	$qspecgenes = trim($specificgenes);	//echo $qspecgenes."<BR><BR>";	
	if ($qspecgenes != '')
		$empty_specgenes = 0;
} 
if (isset($_POST['keyword'])){
	$keyword = $_POST['keyword'];	// remove whitespace trailed\	
	$qkeyword = trim($keyword);	//echo $qkeyword."<BR><BR>";	
	if ($qkeyword != '')
		$empty_cond = 0;
}

$query = "";
if ($empty_tissue && $empty_cond && $empty_disease && $empty_specgenes) {
	$query .= "SELECT * FROM bicluster WHERE $qname";
	echo "Selected options: <br>miRNA: $name<br><br>";
} 
else{
	echo "Selected options: <br>* miRNA: $name<br>";	
	$query .= "SELECT DISTINCT b.* FROM (SELECT * FROM bicluster WHERE $qname ";		
	if (!$empty_specgenes){
		$query .= "AND MATCH (Target) AGAINST ('$qspecgenes' IN BOOLEAN MODE)";
		echo "* Specific Genes: $specificgenes<br>";
	}	
	$query .= ") b JOIN (SELECT * FROM totalcondition WHERE 1 ";
		
	$qcond = "";
	if (!$empty_tissue){
		$qcond .= "AND (conTest LIKE '%$qtissue%' OR conControl LIKE '%$qtissue%' OR conTissue LIKE '%$qtissue%') ";
		echo "* Tissue: $tissue<br>";	
	}
	if (!$empty_disease){
		$qcond .= "AND (conTest LIKE '%$qdisease%' OR conControl LIKE '%$qdisease%' OR conDisease LIKE '%$qdisease%') ";
		echo "* Disease: $disease<br>";
	}	
	if (!$empty_cond){
		$qcond .= "AND (MATCH (conTest, conControl) AGAINST ('$qkeyword' IN BOOLEAN MODE)) ";
		echo "* Keywords: $keyword<br>";	
	}
	
	$qcond .= ") t ON FIND_IN_SET (t.conSymbol, b.conSymbol) > 0";	
	$query .= $qcond;
	//echo $query."<BR>";
}

set_time_limit(1000);
ini_set('memory_limit', '256M');
$result = $conn->query($query);	//		echo "SQL query:<br>$query<br>";
$display_string = '';

if ($result->num_rows <= 0) {	 
	$display_string .= "0 result(s)";
} else {	
	echo "<br>";
	echo "Total ".$result->num_rows." cluster(s) retrieved.<br><br>";
	
	//Build Result String 
	$display_string .= "<table style='border: 1px solid black;'><tr><th style='border: 1px solid black;'>Name</th><th style='border: 1px solid black;'>miRNA</th><th style='border: 1px solid black;'>Fold</th><th style='border: 1px solid black;'>Size</th>";		
	
	$forward_post = "";
	if (isset($_POST['mirna'])){
		$forward_post .= "<input type='hidden' name='mirna' value='".$_POST['mirna']."'>";
	}
	if (isset($_POST['tissue'])){
		$forward_post .= "<input type='hidden' name='tissue' value='".$_POST['tissue']."'>";			
	} 
	if (isset($_POST['disease'])){
		$forward_post .= "<input type='hidden' name='disease' value='".$_POST['disease']."'>";			
	}
	if (isset($_POST['specificgenes'])){
		$forward_post .= "<input type='hidden' name='specificgenes' value='".$_POST['specificgenes']."'>";
	} 
	if (isset($_POST['keyword'])){
		$forward_post .= "<input type='hidden' name='keyword' value='".$_POST['keyword']."'>";			
	}		
	$display_string .="<th align='center' style='border: 1px solid black;'>		
	<form method='post' action='search.php' class='inline'>".$forward_post.  
	"<button type='submit' name='submit_param' value='submit_value' class='link-button' style='text-decoration:none; color:black;font-family:Tahoma;font-size:16;font-weight:bold;'> Validated </button></form></th>";
		
	if (!$empty_tissue){
		$display_string .="<th align='center' style='border: 1px solid black;'>Proportion</th>";
	}elseif (!$empty_disease){
		$display_string .="<th align='center' style='border: 1px solid black;'>Proportion</th>";
	}		
	$display_string .="<th align='center' style='border: 1px solid black;'>Targets</th><th align='left' style='border: 1px solid black;'>Enriched Pathways</th>";
	
	$row2sort = array();
	// Insert a new row in the table for each item returned 
	$odd_line = 1; // 
	while($row = $result->fetch_assoc()) {         
		$onerow = "<tr><td valign='top'>" 	. "<a href='showbc.php?src=j9as1dfhk234cuiihasdfvnkasdh000hkjasdfjkhe89045009345nksaaaajf232hkjasdjfaslkfjalsdf03209234jfllasdfjc09340945&add=".$row["Link"]."&nta=".$row["numTarget"]."&nco=".$row["numCondition"]."&fld=".$row["bimirFold"]."&pas=40zcvzafdaavcljluyinbz19asdfaf81zerqwr413kioiojuooyi41a23sdq54779erq114erqf2354a1239vbcn'>"								
										. str_replace("_hex_value",'', $row["Name"]). "</a></td><td style='color:red;' valign='top'>" 
										. str_replace("-", "_", $row["miRNA"]). "</td><td style='color:blue;' align='center' valign='top'>" 
										. str_replace("_", ".", $row["bimirFold"])
										. "</td><td style='color:green;' align='center' valign='top'>".$row["numCondition"]."x".$row["numTarget"]
										. "</td><td valign='top' align='center' style='color:magenta;border: 1px solid black;'  bgcolor='#FFFFFF'>";
																	

       //// evidence
		$evidence_rate = 0.0;
		$filename = str_replace('-', '.', $row["bimirFold"]).'/'.$row["miRNA"].'/'.str_replace("_hex_value",'', $row["Name"]).'.txt';		//echo $filename;
		$evidencePath = str_replace(".txt", "_mtb_evidence.txt", $filename);
		$evidenceContent = fopen($evidencePath , 'r' ) or die( "Error in opening file" ); 
		$eviMap = array();
		while ($line = fgets($evidenceContent)){
			$tmp = preg_split('/\s+/', trim($line));	
			$eviMap[$tmp[0]] = $tmp[1];
		}
		fclose( $evidenceContent );
		
		$validatedScore = 0.0;
		$curTarget = explode(",", trim($row["Target"]));		
		foreach ($curTarget as $tg){					
			if (!strcmp($eviMap[$tg], "S")){
				$validatedScore = $validatedScore + 1.0;
			}				
			if (!strcmp($eviMap[$tg], "W")){
				$validatedScore = $validatedScore + .6;
			}
			// if (!strcmp($eviMap[$tg], "-")){
				// $validatedScore = $validatedScore + 0;
			// }			
		}
		$validatedScore = round($validatedScore / sizeof($curTarget), 4);				
		$onerow .= $validatedScore."</td>";
		
		if (!$empty_disease || !$empty_tissue){
			$onerow .= "<td align='center' valign='top' style='color:orange;border: 1px solid black;'>"; // proportion here
		}else
			$onerow .= "<td align='center' valign='top' style='color:black;border: 1px solid black;'>"; // proportion here				
		
		 // proportion here		
		$rate  = 0.0;
		if (!$empty_tissue){
			$tmp1 = explode(';', trim($row["proportion"]));
			foreach($tmp1 as $item){
				$term = explode(":", $item);	//echo $term[0]."\t".$tissue."<BR>";
				if (!strcmp(trim($term[0]), trim($tissue))){
					$rate = round((float)$term[1], 4);	//echo $rate."<BR>";
					break;
				}
			}			
			$onerow .= $rate."</td><td valign='top' style='border: 1px solid black;'>"; // proportion here
		} elseif (!$empty_disease){
			$tmp1 = explode(';', trim($row["disease"]));
			if ($disease === "Alzheimer")		$disease = "Alzheimer's disease";
			foreach($tmp1 as $item){
				$term = explode(":", $item);	//echo $term[0]."\t".$tissue."<BR>";var_dump($term);
				if ($term[0] !== '') {				//var_dump($disease);
					if (!strcmp(trim($term[0]), trim($disease))){
						$rate = round((float)$term[1], 4);	//echo $rate."<BR>";
						break;
					}
				}
			}			
			$onerow .= $rate."</td><td valign='top' style='border: 1px solid black;'>"; // proportion here
		}		
		
		// highlight $qspecgenes 		
		$curTarget = explode(",", trim($row["Target"]));		
		$globalSpecGenes = explode(" ", str_replace(array('+', '-'),'',trim($qspecgenes)));
		$resTarget = "";
		
		foreach ($curTarget as $tg){
			$matchhere = 0;
			foreach ($globalSpecGenes as $sg){
				if (!strcmp(trim($tg), trim($sg))){
					$resTarget .= "<mark><b>".$tg."</b></mark>, ";
					$matchhere = 1;					
					break;
				}
			}
			if (!$matchhere){
				$resTarget .= $tg.", ";
			}
		}			
		$onerow .= $resTarget. "</td><td valign='top' style='border: 1px solid black;' bgcolor='#FFFFFF'>";
						

		// enriched pathways
		$onerow .= "<div class='comment more'>";		
		$filename = $row["Link"]; 
		$enriched_c2 = str_replace(".txt", "_c2_enriched.txt", $filename);
		$enriched_c5 = str_replace(".txt", "_c5_enriched.txt", $filename);		
		$long_or_not = 0; /// 1 is long
		if (file_exists($enriched_c2)){
			$enrichedContent = fopen($enriched_c2 , 'r' ) or die( "Error in opening file" );
			$tmp = fgets($enrichedContent); // remove header line
			$count_to_N = 0; // N = 3
			while ($line = fgets($enrichedContent)){	
				$tmp = preg_split('/\s+/', trim($line));												
				$onerow .= $tmp[0]." (C2)<br>";//"<a href='http://software.broadinstitute.org/gsea/msigdb/cards/".$tmp[0].".html'>".$tmp[0]." (C2)</a> <br>";				
				if (++$count_to_N == 3){
					$onerow .= "<span class='morecontent'><span>";					
				}
			}
			if ($count_to_N > 3){
				$onerow .= "</span><div class='text-center margin_top_10'><a href='' class='morelink'>More (+)</a></div></span></div>";			
			}
			fclose( $enrichedContent );  	
		}
		
		if (file_exists($enriched_c5)){
			$enrichedContent = fopen($enriched_c5 , 'r' ) or die( "Error in opening file" );
			$tmp = fgets($enrichedContent); // remove header line
			$count_to_N = 0; // N = 3 
			while ($line = fgets($enrichedContent)){	
				$tmp = preg_split('/\s+/', trim($line));												
				$onerow .= $tmp[0]." (C5)<br>";//"<a href='http://software.broadinstitute.org/gsea/msigdb/cards/".$tmp[0].".html'>".$tmp[0]." (C5)</a> <br>";				
				if (++$count_to_N == 3){
					$onerow .= "<span class='morecontent'><span>";
				}
			}	
			if ($count_to_N > 3) {
				$onerow .= "</span><div class='text-center margin_top_10'><a href='' class='morelink'>More (+)</a></div></span></div>";			
			}
			fclose( $enrichedContent );  	
		}
		
		// finish a row
		$onerow .="</td><td valign='top'></td></tr>";		
		
		////////////////////////////////////////////////////////
		// selection
		$row2sort["$onerow"] = $rate;
	}	
	
	// Sorting based on proportion high to low
	arsort($row2sort);
	foreach($row2sort as $key => $val){
		$display_string .= $key;
	}
	
	$display_string .= "</table>"; 
}
$conn->close();
echo $display_string; 
?>  

<br><br>
<button onclick="goBack()">Go Back</button><br><br>
<a href="mailto:dougunam@gmail.com" target="_blank"><img src="./index_files/mail.png" align="middle" border="0" ></a>&nbsp;&nbsp;
</ul>
<br>
<br>
<br>
</div>


<div class="footer">  
<table border="0" width="100%" colspan="100%" style="border-spacing:0;" >
 <tr valign="top" style="background-color:rgb(20, 120, 120);">	
	<td height="15"> </td>    
 </tr>  
 <tr valign="top" colspan="2" style="background-color:rgb(3, 45, 67);">
  <td height="30"> </td>    
 </tr>
 </table> 
</div>
</body></html>