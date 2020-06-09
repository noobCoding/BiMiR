<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>BiMiR - Search options</title>
<link href="./index_files/base.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script>
function radio_check(){
	if(document.search_option.choice[0].checked){
		document.getElementById("tissue").disabled=false;
		document.getElementById("disease").disabled=true;		
		document.getElementById("specificgenes").disabled=true;		
		document.getElementById("keyword").disabled=true;		
	}
	else if(document.search_option.choice[1].checked){
		document.getElementById("tissue").disabled=true;
		document.getElementById("disease").disabled=false;			
		document.getElementById("specificgenes").disabled=true;		
		document.getElementById("keyword").disabled=true;		
	}
	else if(document.search_option.choice[2].checked){
		document.getElementById("tissue").disabled=true;
		document.getElementById("disease").disabled=true;
		document.getElementById("specificgenes").disabled=false;		
		document.getElementById("keyword").disabled=true;			
	}
	else if(document.search_option.choice[3].checked){
		document.getElementById("tissue").disabled=true;
		document.getElementById("disease").disabled=true;
		document.getElementById("specificgenes").disabled=true;		
		document.getElementById("keyword").disabled=false;			
	}
}

function checkbox_tick(){
	if(document.search_option.choice[0].checked)
		document.getElementById("tissue").disabled=false;
	else
		document.getElementById("tissue").disabled=true;
	
	if(document.search_option.choice[1].checked)		
		document.getElementById("disease").disabled=false;					
	else 
		document.getElementById("disease").disabled=true;
		
	if(document.search_option.choice[2].checked)		
		document.getElementById("specificgenes").disabled=false;	
	else 
		document.getElementById("specificgenes").disabled=true;
		
	if(document.search_option.choice[3].checked)
		document.getElementById("keyword").disabled=false;
	else
		document.getElementById("keyword").disabled=true;
}

function data_check(){
	var tissue=document.getElementById("tissue").value;
	var disease=document.getElementById("disease").value;
	var specificgenes = document.getElementById("specificgenes").value;	
	var keyword = document.getElementById("keyword").value;	
	
	// if(document.search_option.choice[0].checked){
		// if(tissue.length <=0){
			// alert("Please select some option!");
			// return false;
		// }
	// }	
	// if(document.search_option.choice[2].checked){
		// if(keyword.length <=0){
			// alert("Please insert keywords!");
			// return false;
		// }
	// }		
	return true;
}
</script>
<style>

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: none;
   color: none;
   text-align: left;
}
</style>
</head>

<body bgcolor="#ffffff" bgcolor="#ffffff" height="100%" width="100%" link="#000000" vlink="#000000" alink="#000000" onload="var e=document.getElementsByTagName('input');var i=0;while(i<e.length){if(e[i].type=='checkbox'){e[i].checked=false;} i++;} e=document.getElementsByTagName('select');var i=0;while(i<e.length){e[i++].value='';}" ><a name="top"></a>
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
<form name="search_option" method='POST' action="search.php" id="option_form" onsubmit="return data_check();"> 

<table>
<tr>
<td><th align='left' style="color:rgb(210, 0, 60);" >Search options </th></td><td></td>
</tr>
<tr>
<td><input type="radio" name="miRNA" value="000" checked>miRNA</td>
<td>
<?php 
$filename = 'mir';
$mir = file($filename);
$select = "<select name='mirna' id='mirna'> <option value='' selected></option>"; //<option value='ALL'>ALL</option>";
foreach ($mir as $item) {
    $select .= "<option value='$item'>$item</option>";
}
echo $select. '</select>';
?>
</td>
</tr>
<tr>
<td><input type="checkbox" name="choice" value="111" onClick="checkbox_tick();";>Organ/Tissue</td> <td>	<select name="tissue" id="tissue" disabled>
<?php 
$filename = 'key_180521';
$mir = file($filename);
$select = "<option value='' selected></option>";
foreach ($mir as $item) {
    $select .= "<option value='$item'>$item</option>";
}
echo $select. '</select>';
?>
</td>
</tr>
<tr>
<td><input type="checkbox" name="choice" value="222" onClick="checkbox_tick();";>Disease</td> <td>	<select name="disease" id="disease" disabled>
<?php 
$filename = 'disease_180521';
$mir = file($filename);
$select = "<option value='' selected></option>";
foreach ($mir as $item) {
    $select .= "<option value='$item'>$item</option>";
}
echo $select. '</select>';
?>
</td>
</tr>
<tr>
<td><input type="checkbox" name="choice" value="333" onClick="checkbox_tick();";>Specific Genes</td> <td><input type="text" name="specificgenes" id="specificgenes" disabled> </td> 
</tr>
<tr>
<td><input type="checkbox" name="choice" value="444" onClick="checkbox_tick();";>Keywords</td> <td><input type="text" name="keyword" id="keyword" disabled> <br></td> 
</tr>

<tr>
<td></td>	<td><input type='submit' name='submit' value='Query Bicluster'/> </td>
</tr>

<tr>
<td> </td>
<td>
<br>
<h4 style='font-family:"Verdana",sans-serif;color:rgb(210, 0, 60);'>Keyword Options</h4>
<p style="color:#888;font-size:100%;"> 
<ul>
	<li><i><b><a style="color:blue;"> + </a>: must have keyword </li>
	<li><a style="color:blue;"> -  </a>: must not have keyword <br> </li>
	<li><a style="color:blue;">(no sign)</a>: optional keyword <br> </li>
	<li><a style="color:blue;">"xYz" </a>: looking for an exact keyword or phrase "xYz"</b><br></li>
	<li><b>terms are separated by <a style="color:blue;">space/tab</a> characters</b></li>
	<br><br>
</ul>
</td>
</tr>

<tr>
<td></td><td>
<h4 style='font-family:"Verdana",sans-serif;color:rgb(210, 0, 60);'>Examples for keyword-based search option</h4>

<b>blood cancer</b><br>
 ->Find rows that contain at least one of the two words.<br><br>

<b>+blood lung</b><br>
->Find rows that contain the word “blood”, but rank rows higher if they also contain “lung”.<br><br>

<b>+blood +cancer</b><br>
->Find rows that contain both words.<br><br>

<b>+blood -lung</b><br>
->Find rows that contain the word “blood” but not “lung”.<br><br>

<b>"some words"</b><br>
->Find rows that contain the exact phrase “some words” <br>(i.e. rows that contain “some words of wisdom” but not “some noise words”).<br><br></i> 
</p>
</td>
</tr>
</table>
</form>
</ul>
</div>
<div class="footer">  
<ul><a href="mailto:dougunam@gmail.com" target="_blank"><img src="./index_files/mail.png" align="middle" border="0" ></a>&nbsp;&nbsp; </ul>
<table border="0" width="100%" style="border-spacing:0;" >
 <tr valign="top" style="background-color:rgb(20, 120, 120);">	
	<td height="15"> </td>    
 </tr>  
 <tr valign="top" colspan="2" style="background-color:rgb(3, 45, 67);">
  <td height="30"> </td>    
 </tr>
 </table> 
</div> 
</html>