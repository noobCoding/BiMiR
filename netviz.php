<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>BiMiR - Bicluster details</title>
<link href="./index_files/base.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<script>
function goBack() {
    window.history.back();
}
</script>
		<!--<script src="./jquery-3.1.1.js"></script> -->
		<script language="javascript" type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="http://btool.org/bimir_dir/arbor-v0.92/lib/arbor.js" ></script>		
        <script language="javascript" type="text/javascript" src="http://btool.org/bimir_dir/arbor-v0.92/demos/_/graphics.js" ></script>			
		<script language="javascript" type="text/javascript" src="http://btool.org/bimir_dir/arbor-v0.92/demos/_/jquery-1.6.1.min.js"></script>
		<script language="javascript" type="text/javascript" src="netviz.js" ></script>		

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

<ul> 
<br>
<br>

<?php 
  $bicpath = $_GET["bic"];   
  //var_dump($bicpath);  
  $bicpath = str_replace(".txt", "_subnetwork.txt", $bicpath);     
  //$bicpath = str_replace(".txt", "_animals.json", $bicpath); 
  $path = $bicpath; 	
  
  if( $bicpath){ 
	$tmp = explode("/", str_replace("biclusters/", "", str_replace("_subnetwork.txt", "", $bicpath)));
	echo "<h2> Network Visualization of <a style='color:0000FF;'>". $tmp[1]."@".$tmp[0] ."</a> </td></h2>"; 
  } 
  else { exit(); }

// load linked list data
$linkedList = file($bicpath) or die( "Error in opening file" );
array_splice($linkedList, 0, 1); // dumb header

$jsonobj = array();
$nodes = array();
$edges = array();
$degree = array();

$countdeg = 0;
$curGene = '';
$neighbor = array();

foreach($linkedList as $linkage){ 
	$tmp = explode("\t", trim($linkage));	
	$geneA = $tmp[0];	$geneB = $tmp[1];	$weight = $tmp[2]/300;
	if (strcmp($curGene, $geneA)){ // new gene detected
		if (strcmp($curGene, "")){	// not the first time
			$edges[$curGene]= $neighbor;	
			$degree[$curGene] = $countdeg;
			$countdeg = 0;
			$neighbor = array();
		}
		$curGene = $geneA;
		$nodes[$curGene] = array('color'=> '#dd0000','shape'=> 'box', 'label'=> $curGene);
	}
	$countdeg++;
	$neighbor[$geneB] = array('weight' => $weight);
}
$edges[$curGene] = $neighbor;	$degree[$curGene] = $countdeg;

$maxDegree = max($degree);
$minDegree = min($degree);

$jsonpath = str_replace("_subnetwork.txt", ".json", $bicpath);

/*
<div class='w3-sidebar w3-bar-block' style='width:10%;right:0'>
  <h5 class='w3-bar-item'><b>Highlight Options</b></h5>
  <a href='#' class='w3-bar-item w3-button' title='Top 20%'>Top nodes</a>   
  <a href='#' class='w3-bar-item w3-button'>Top degree:	</a> 
  <a href='#' class='w3-bar-item w3-button'>Specified degree: </a> 
</div>
*/
$display_scale = "<svg height='50' width='800'>
<text x='80' y='30'   text-anchor='middle' dominant-baseline='middle' font-family='Arial' font-size='13' fill='#000000' font-weight='bold'>Node degree scale: </text>  
<text x='200' y='30'   text-anchor='middle' dominant-baseline='middle' font-family='Arial' font-size='13' fill='#000000' font-weight='bold'>max=$maxDegree</text>  
<defs><linearGradient id='gradup' x1='0%' y1='0%' x2='100%' y2='0%'>	<stop offset='0%' style='stop-color:rgb(255,0,0);stop-opacity:1' />
																	<stop offset='100%' style='stop-color:rgb(51, 0, 0);stop-opacity:1' />     </linearGradient> </defs>
<rect x='240' y='10' width='400' height='30' stroke='black' stroke-width='0' fill='url(#gradup)' /> 
<text x='680' y='30'   text-anchor='middle' dominant-baseline='middle' font-family='Arial' font-size='13' fill='#000000' font-weight='bold'>min=$minDegree</text>
</svg>";

$frameContent = "

<div id='netviz' style='margin-right:15%'>
<canvas id='netsite' width='1200' height='900'></canvas><br>
</div>";

$loadNetScript = "
<script>
	(function() {
		var sys = arbor.ParticleSystem(868, 68, .86);
		sys.parameters({gravity:true});
		sys.renderer = Renderer('#netsite');
		
		var 
				htmlCanvas = document.getElementById('netsite'),			
			  	context = htmlCanvas.getContext('2d');
 
			// Start listening to resize events and
			// draw canvas.
			initialize();
 
			function initialize() {
				window.addEventListener('resize', resizeCanvas, false);
				
				// Draw canvas border for the first time.
				resizeCanvas();
			}						
							
			function resizeCanvas() {
				var canvW = 0.85 * window.innerWidth;
				var canvH = 0.85 * window.innerHeight;
				htmlCanvas.width = canvW;
				htmlCanvas.height = canvH;				
				$.getJSON('$jsonpath', function (data) { sys.graft(data);	});				
				sys.screenSize(canvW, canvH);
				sys.renderer.redraw();
			}
	})();
</script>
";

// footer
$footer = "<br><br><button onclick='goBack()'>Go Back</button><br><br>";
$footer .= "<a href='mailto:dougunam@gmail.com' target='_blank'><img src='./index_files/mail.png' align='middle' border='0'></a>&nbsp;&nbsp;<br><br><br><br>";

/*
Display session
<table border='0' cellpadding='0' cellspacing='0' align='left' style='margin-top:0;margin-bottom:0;margin-right:0;'><tbody>
<tr><td>".$loadNetScript."</td></tr>
<tr><td>".$footer."</td></tr>
</tbody></table>
*/
echo $display_scale;
echo $frameContent;
echo $footer;
echo $loadNetScript;
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