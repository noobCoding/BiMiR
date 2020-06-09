<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>BiMiR - Bicluster details</title>
<link href="./index_files/base.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--width: 500px;-->
<style type="text/css">	
		#wrapper {
				width: 333px;
                color:#0066FF;
                padding: 10px;
                border: 1px solid #FF0000;
                text-align:center;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border-radius: 4px;
            }	
		.tag_cloud { padding: 3px; text-decoration: none;}
		.tag_cloud:link  { color: #000000; }
		.tag_cloud:visited { color: #019c05; }
		.tag_cloud:hover { color: #FF0000; background: #FFFF00; }
		.tag_cloud:active { color: #000000; background: #33FFFF; }	
		p {
  border-bottom: 1px solid black;
  padding: 20px;
}

.hide {
  display: none;
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

  $numTarget = $_GET["nta"];
  $numCondition = $_GET["nco"];
  $filename = $_GET["add"]; 
  $bimirFold = trim($_GET["fld"]);
  $delimiter = '/';  
    
  $tmparr = explode($delimiter, $filename);  
  $tmparr[2] = str_replace(".txt", "", $tmparr[2]);    
  $biname = trim($tmparr[2]);   
  $bimir = trim($tmparr[1]); 
  
  if( $filename){   
	echo "<h2><a style='color:blue;'>". $tmparr[2] . "</a>@<a style='color:green;'>". $tmparr[1]. "</a>		<a style='color:red;'>#". str_replace('_', '.', $tmparr[0]). "</a></h2>"; 
  } 
  else {
	  exit();
	  }

$script = getcwd();			//echo $script. "<br>";
//$path = $script. "/" . $filename; 		
$path = $filename; 		
$myfile = fopen($path , 'r' ) or die( "Error in opening file" ); 
$filesize = filesize( $filename ); 
echo ( "File size : $filesize bytes <br> Details:" ); 
//$filetext = fread( $myfile, $filesize );
//echo "<pre>$filetext</pre><br>";
rewind($myfile); 							//fseek($file,0); // samesame
$targetList = fgets($myfile);				/* echo ("$targets <br>");while ($line = fgets($file)) {	echo ("$line <br>");} */
$condition = '';
while ($line = fgets($myfile)){	
	$tmp = explode(' ', $line);
	$condition .= $tmp[0]." ";
}
fclose( $myfile );  

$targets = explode(" ",trim($targetList));
$targetSize = count($targets);
if (strlen($condition) == 0) exit();

// $servername = "localhost";
// $username = "root";
// $password = "pass";
// $port = "3306";
// $dbname = "bigbicluster";

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

$qcondition = '';
$term = explode(' ', trim($condition));	
$count = sizeof ($term);
$i = 0;
foreach($term as $t){
	$t = trim(str_replace("p_","", $t));
	$qcondition .= "conSymbol='$t'";
	if ($i < $count - 1){
		$qcondition .= ' OR ';
	}
	$i++;
}

$qcondition = trim($qcondition); // remove whitespace trailed	
$query = "SELECT * FROM totalcondition WHERE $qcondition";
$result = $conn->query($query);
echo "<br><br>";

$conditionList = array();
$conditionFullText = "";
//Build Result String 
$display_condition = "<br><br><table style='border: 1px solid black;margin-top:0;margin-bottom:0;align:center'><tbody><tr><th style='border: 0px solid black;' colspan='5'><a style='color:FF0000; background:#FFFFFF'>Experimental Conditions</a></th></tr>
					<tr><th style='border: 1px solid black;'>Symbol</th><th></th><th style='border: 1px solid black;'>Control</th><th></th> <th style='border: 1px solid black;'>Test</th></tr>";  
if ($result->num_rows > 0) { 
// Insert a new row in the table for each person returned 
	while($row = $result->fetch_assoc()) {         	
	$tmp2 = explode('_', $row["conSymbol"]);
	$geoseries = trim($tmp2[0]);
	$display_condition .= "<tr><td> <a href='http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE$geoseries'>"
									. $row["conSymbol"]. "</a> </td><td></td><td>"									
									. str_replace('"""', '', $row["conControl"]). "</td><td></td><td>" 
									. str_replace('"""', '', $row["conTest"]). "</td></tr>";									
	array_push($conditionList, $row["conSymbol"]);
	$conditionFullText .= str_replace('"""', '', $row["conControl"]). ' ' . str_replace('"""', '', $row["conTest"]). ' ';
	} 
}
$display_condition .= "</tbody></table>"; // end of condition

////// Enriched Information   
function roundFloatString($someFloatString, $precision){
	// scientific or not
	
	$parts = explode('e', $someFloatString);	
	if (sizeof($parts) > 1){ // yes
		$base = round((float)$parts[0], $precision);
		$power = $parts[1];
		return strval($base).'e'.strval($power);
	} else{ // round to the last $precision meaningful digits		
		$base = (float)$parts[0];
		$power = 0;		
		while ($base < pow(10, $precision)){
			$base *= 10;
			$power -= 1;
		}
		$base = round ($base /pow(10, $precision), $precision);		
		$power += $precision;
		if ($power < 10){
			$power = substr_replace(strval($power), '0', 1, 0);
		}
		return strval($base).'e'.strval($power);
	}	
	return 0.0;
}
$display_enrichinfo =""; 
$enrich_content ="";
$filename = $_GET["add"]; 
$enriched_c2 = str_replace(".txt", "_c2_enriched.txt", $filename);
$enriched_c5 = str_replace(".txt", "_c5_enriched.txt", $filename);

if (file_exists($enriched_c2)){
	$enrichedContent = fopen($enriched_c2 , 'r' ) or die( "Error in opening file" );
	$tmp = fgets($enrichedContent); // remove header line
	while ($line = fgets($enrichedContent)){	
		$tmp = preg_split('/\s+/', trim($line));
		$enrich_content .= "<tr><td> <a href='http://software.broadinstitute.org/gsea/msigdb/cards/".$tmp[0].".html'>".$tmp[0]." (C2)</a> </td><td></td><td align='center'>"
									. roundFloatString($tmp[1], 3). "</td><td></td><td align='center'>" . roundFloatString($tmp[2], 3). "</td></tr>";
	}
	fclose( $enrichedContent );  	
}

if (file_exists($enriched_c5)){
	$enrichedContent = fopen($enriched_c5 , 'r' ) or die( "Error in opening file" );
	$tmp = fgets($enrichedContent); // remove header line
	while ($line = fgets($enrichedContent)){	
		$tmp = preg_split('/\s+/', trim($line));
		$enrich_content .= "<tr><td> <a href='http://software.broadinstitute.org/gsea/msigdb/cards/".$tmp[0].".html'>".$tmp[0]." (C5)</a> </td><td></td><td align='center'>"
									. roundFloatString($tmp[1], 3). "</td><td></td><td align='center'>" .roundFloatString($tmp[2], 3). "</td></tr>";
	}
	fclose( $enrichedContent );  		
}	

if (file_exists($enriched_c2) || file_exists($enriched_c2))
{
	$display_enrichinfo .= "<br><br><table style='border: 1px solid black;margin-top:0;margin-bottom:0;;align:center'><tbody><tr><th style='border: 0px solid black;' colspan='5'><a style='color:FF0000; background:#FFFFFF'>Functional Enrichment Test</a></th></tr>
						<tr><th style='border: 1px solid black;'>Pathway</th><th></th><th style='border: 1px solid black;'>p-value</th><th></th><th style='border: 1px solid black;'>Adjusted p-value</th></tr>";  
	$display_enrichinfo .= $enrich_content;
	$display_enrichinfo .= "</tbody></table>"; // end of enriched information
}

////////////////////////////////////////////////////////////////////////////////////////////
$query = "SELECT * FROM bicluster WHERE Name='$biname' AND miRNA='$bimir' AND bimirFold='$bimirFold'";
//echo $query."<br>";
$result = $conn->query($query);
$row = $result->fetch_assoc() ;
$numTarget = $row['numTarget']; //echo $numTarget."<br>";
$numCondition = $row['numCondition']; //echo $numCondition."<br>";
$mapContent = explode(',', $row['Heatmap']); //echo $row['mapContent']."<br>"; echo sizeof($mapContent)."<br>";
$j = 0; $i = 0;
$map_content ='<tr>';
$avaColor = array();
foreach($mapContent as $tmp){	
	$map_content .= "<td bgcolor='#".$tmp."'><font color='#".$tmp."'> </font></td>";
	array_push($avaColor, $tmp);
	$j ++;
	if ($j == $numTarget){
		$tmp3 = explode('_', $conditionList[$i]);
		$geoseries = trim($tmp3[0]);
		$map_content .= "<td><a href='http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE$geoseries'>&nbsp;$conditionList[$i]</a></td>";			
		$i ++;	
		$map_content.= "</tr><tr>";	
		$j = 0;
	}
}
$map_content.= "</tr>";

// scale
$colorscale = "";
asort($avaColor);
$avaColor = array_unique($avaColor);
foreach($avaColor as $tmp){	
$colorscale .= "<a style='color:#".$tmp."; background:#".$tmp.">&#9608</a>";	
}
$scaleSize = sizeof($avaColor);
//$display_scale  = "<table><tbody>"; 
//$display_scale .= "<tr><td colspan='$scaleSize'><div>$colorscale</div></td></tr>";
//$display_scale .= "</tr></tbody></table></table>"; 
$display_scale = "<svg height='50' width='800'>
<text x='30' y='30'   text-anchor='middle' dominant-baseline='middle' font-family='Arial' font-size='13' fill='#000000' font-weight='bold'>up</text>  
<defs><linearGradient id='gradup' x1='0%' y1='0%' x2='100%' y2='0%'>	<stop offset='0%' style='stop-color:rgb(255,0,0);stop-opacity:1' />
																	<stop offset='100%' style='stop-color:rgb(255, 255, 255);stop-opacity:1' />     </linearGradient> </defs>
<defs><linearGradient id='graddown' x1='0%' y1='0%' x2='100%' y2='0%'>	<stop offset='0%' style='stop-color:rgb(255,255,255);stop-opacity:1' />
																	<stop offset='100%' style='stop-color:rgb(0, 255, 0);stop-opacity:1' />     </linearGradient> </defs>
<rect x='50' y='10' width='200' height='30' stroke='black' stroke-width='0' fill='url(#gradup)' /> 
<rect x='250' y='10' width='200' height='30' stroke='black' stroke-width='0' fill='url(#graddown)' /> 
<text x='480' y='30'   text-anchor='middle' dominant-baseline='middle' font-family='Arial' font-size='13' fill='#000000' font-weight='bold'>down</text>
</svg>";

// heatmap
$display_map = "<table><tbody>"; 
$display_map .= "<tr><th align='left' style='border: 0px solid black;' colspan='$targetSize'>Heat Map</th></tr>
				$map_content";
				
//// node degree
$nodeDegree = explode(',', $row['nodeDegree']);
$display_map .= "<tr>";
$idx = 0;
foreach($nodeDegree as $nd){
	$display_map .=	"<td align='center' bgcolor='#000000'><a style='color:FFFF00; background:#000000' >$nd</a></td>";
	$idx ++;
}
$display_map .= "<td align='left' bgcolor='#000000'><a style='color:FFFF00; background:#000000'> Node Degree </a></td>";
$display_map .='</tr><tr>';

//// evidence
$filename = $_GET["add"]; 
$evidencePath = str_replace(".txt", "_mtb_evidence.txt", $filename);
$evidenceContent = fopen($evidencePath , 'r' ) or die( "Error in opening file" ); 
$eviMap = array();
while ($line = fgets($evidenceContent)){	
	$tmp = preg_split('/\s+/', trim($line));	
	$eviMap[$tmp[0]] = $tmp[1];
}
fclose( $evidenceContent );  

/// link to evidence
$filename = 'miRTarBase_ID/'.$tmparr[1]; 
$mirtarLink = fopen($filename , 'r' ) or die( "Error in opening file" ); 
$mirtarID = array();
$line = fgets($mirtarLink); // header line
while ($line = fgets($mirtarLink)){	
	$tmp = preg_split('/\s+/', trim($line));
	$mirtarID[$tmp[1]] = $tmp[0];
}
fclose( $mirtarLink );  
for($i = 0; $i < $targetSize; $i++) {
	if (array_key_exists($targets[$i], $mirtarID)){
		$display_map .= "<td align='center' bgcolor='#000000'><a href=http://mirtarbase.mbc.nctu.edu.tw/php/detail.php?mirtid=".$mirtarID[$targets[$i]]."#evidence style='color:00FF00;'>".$eviMap[$targets[$i]]."</a></td>";		
	}else{
		$display_map .= "<td align='center' bgcolor='#eeeeee'><a href=http://mirtarbase.mbc.nctu.edu.tw/php/ style='color:000000;'>".$eviMap[$targets[$i]]."</a></td>";
	}	
}
$display_map .= "<td align='left' bgcolor='#000000'><a style='color:00FF00; background:#000000'> miRTarBase Evidence </a></td>";
$display_map .='</tr><tr>';
//// targets
for($i = 0; $i < $targetSize; $i++) {
	$display_map .= "<td style='height:155'><div class='rotate'> <a href=http://www.genecards.org/cgi-bin/carddisp.pl?gene=$targets[$i]&keywords=$targets[$i]>$targets[$i]</a></div></td>";
}
$display_map .= "<td align='top' bgcolor='#FFFFFF'><div class='rotate'> <a style='color:#FFFFFF; background:#FF00FF' href=http://btool.org/bimir_dir/netviz.php?bic=$path><br><br><br>&nbsp;&nbsp;&nbsp;Bicluster&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;Network&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;Review&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div></td>";
$display_map .= "</tr></tbody></table>"; 

/**
 * Tag cloud demo based on word frequency
 */
$freqData = array(); 
$conditionFullText = strtolower($conditionFullText); 
$stopsign = array("+", "?", ",", "(", ")", ";", ":", "<", ">", "?", "'", '"', "!", "&", ".", "-");
$common = array("the", "of", "and", "to", "in", "I", "that", "was", "his",  //boring words
   "he", "it", "with", "is", "for", "as", "had", "you", "not", "be", 
   "her", "on", "at", "by", "which", "have", "or", "from", "this", 
   "him", "but", "all", "she", "they", "were", "my", "are", "me", 
   "one", "their", "so", "an", "said", "them", "we", "who", "would", 
   "been", "will", "no", "when", "there", "if", "more", "out", "up", 
   "into", "do", "any", "your", "what", "has", "man", "could", 
   "other", "than", "our", "some", "very", "time", "upon", "about", 
   "may", "its", "only", "now", "like", "little", "then", "can", 
   "should", "made", "did", "us", "such", "a", "great", "before", 
   "must", "two", "these", "see", "know", "over", "much", "down", 
   "after", "first", "mr", "good", "men", "vector", "from", "partial", 
   "vectors", "vector", "line", "cell", "cells", "control", "days", "day", "using", "normal", "um", "treated", "stem", "derived", "human");
   
$conditionFullText = str_replace($stopsign, "", $conditionFullText);
$conditionFullText = preg_replace('/\b\d+\b/', '', $conditionFullText);
$conditionFullText = preg_replace('/\b\w\b\s?/', '', $conditionFullText);
$tagarr = preg_split('/\s+/', $conditionFullText);		array_pop($tagarr);
$stopword = array();
foreach ($common as $word){
		$stopword[$word] = 0;
}
// Get individual words and build a frequency table
foreach( $tagarr as $word )
{
	// For each word found in the frequency table, increment its value by one
	if (!array_key_exists($word, $stopword)){
		array_key_exists( $word, $freqData ) ? $freqData[ $word ]++ : $freqData[ $word ] = 1;
	}	
}
 
// ==============================================================
// = Function to actually generate the cloud from provided data =
// ==============================================================
function getCloud( $data = array(), $minFontSize = 11, $maxFontSize = 33 )
{	
	$topN = array();	
	$countntop = 0;
	$nn = 13;
	arsort($data);
	foreach($data as $key => $val){
		if ($val > 1 && $countntop < $nn) {
			$topN[$key] = $val;
			$countntop++;
		}
	}
	
	$minimumCount = min( array_values( $topN ) );
	$maximumCount = max( array_values( $topN ) );
	$normailizeScale = $minimumCount - 1;	
	$minimumCount -= $normailizeScale;
	$maximumCount -= $normailizeScale;	
	$spread       = $maximumCount - $minimumCount;
	$cloudHTML    = '';
	$cloudTags    = array();
 
	$spread == 0 && $spread = 1;
	
	$randarr = array();
	foreach( $topN as $tag => $count )	{
		array_push($randarr, array($tag, $count));
	}	
	shuffle($randarr);
	
	foreach( $randarr as $apair ) {
		$tag = $apair[0];
		$count = $apair[1];
		$size = $minFontSize + ( $count - $minimumCount - $normailizeScale ) 
			* ( $maxFontSize - $minFontSize ) / $spread;
		$cloudTags[] = '<a style="font-size: ' . floor( $size ) . 'px' 
		. '" class="tag_cloud" href="http://www.google.com/search?q=' . $tag 
		. '" title="\'' . $tag  . '\' returned a count of ' . $count . '">' 
		. htmlspecialchars( stripslashes( $tag ) ) . '</a>';
	} 
	return join( "\n", $cloudTags ) . "\n";
}

// format tagcloud
$cloud_content = getCloud( $freqData );
$display_cloud = "<table><tbody>"; 
$display_cloud .='<tr>';					
$display_cloud .= "<td><div id='wrapper'> $cloud_content </div></td>";
$display_cloud .= "</tr></tbody></table>"; 

// footer
$footer = "<br><br><button onclick='goBack()'>Go Back</button><br><br>";
$footer .= "<a href='mailto:dougunam@gmail.com' target='_blank'><img src='./index_files/mail.png' align='middle' border='0'></a>&nbsp;&nbsp;<br><br><br><br><br>";

/*
Display session
*/
echo $display_scale."<br>";
echo "<table border='0' cellpadding='0' cellspacing='0' align='left' style='margin-top:0;margin-bottom:0;margin-right:0;'><tbody>
<tr><td>".$display_map."</td></tr>
<tr><td>".$display_cloud."</td></tr>
<tr><td>".$display_condition."</td></tr>
<tr><td>".$display_enrichinfo."</td></tr>
<tr><td>".$footer."</td></tr>
</tbody></table>";

?>
</ul>
</div>

<div class="footer">
<table border="0" width="100%" colspan="100%" style="border-spacing:0;" >
 <tr valign="top" style="background-color:rgb(20, 120, 120);">	
	<td height="15"> </td>    
 </tr>  
 <tr valign="top" style="background-color:rgb(3, 45, 67);">
  <td height="30"> </td>    
 </tr>
 </table> 
 </div>
</body></html>