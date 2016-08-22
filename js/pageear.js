/********************************************************************************************
* PageEar advertising CornerAd by Webpicasso Media
* Leave copyright notice.  
*
* Lizenzvereinbarung / License agreement
* http://www.webpicasso.de/blog/lizenzvereinbarungen-license-agreements/
*
* @copyright www.webpicasso.de
* @author    christian harz <pagepeel-at-webpicasso.de>
* อธิบายการใช้งานเป็นภาษาไทย โดย http://www.codetukyang.com
*********************************************************************************************/

/* ตั้งค่าการทำงานดังต่อไปนี้  */ 

// ใส่ URL ของภาพ pageear_s.jpg (ซึ่งเป็นภาพขนาด 100x100 Pixel ซึ่งเป็นภาพที่จะแสดงตอนก่อนเปิดมุมออกมา)
//var pagearSmallImg = 'images/pageear_s.jpg'; 
var pagearSmallImg = 'images/naivoi_s.jpg'; 

// ใส่ URL ของไฟล์ pageear_s.swf
var pagearSmallSwf = 'images/pageear_s.swf';
//var pagearSmallSwf = 'images/pageear_s.swf';  

// ใส่ URL ของภาพ pageear_b.jpg (ซึ่งเป็นภาพขนาด 500x500 Pixel ซึ่งเป็นภาพใหญ่ ที่จะแสดงตอนเปิดมุมออกมาแล้ว)
//var pagearBigImg = 'images/pageear_b.jpg'; 
var pagearBigImg = 'images/naivoi_b.jpg'; 

// ใส่ URL ของไฟล์ pageear_b.swf
//var pagearBigSwf = 'http://www.thamwebsite.com/cty/tip/tipsinternet/images/pagepeel/pageear_b.swf'; 
var pagearBigSwf = 'images/pageear_b.swf'; 

// Movement speed of small pageear 1-4 (2=Standard)
var speedSmall = 1; 

// ใช้คุณสมบัติกระจกไหม ( ใส่ true หรือ false )
var mirror = 'true'; 

// สีของมุมกระดาษ
var pageearColor = 'ffffff';  

// URL ของหน้าที่ต้องการให้ไปเมื่อคลิ๊กที่แถวมุมกระดาษ
var jumpTo = 'http://www.naivoi.com'

// รูปแบบของ Browser target  (new) หรือ self (self)
var openLink = 'new'; 

// Opens pageear automaticly (false:deactivated | 0.1 - X seconds to open) 
//var openOnLoad = 3; 
var openOnLoad = 'false'; 

// Second until pageear close after openOnLoad
var closeOnLoad = 3; 
//var closeOnLoad = false;

// ตำแหน่งที่ต้องการให้แสดงมุมกระดาษ (lt: มุมบนซ้าย | rt: มุมบนขวา )
var setDirection = 'rt'; 

// Fade in pageear if image completly loaded (0-5: 0=off, 1=slow, 5=fast )
var softFadeIn = 4; 

// Plays background music once abspielen (ใส่ false : ไม่ใช้เสียง | ใส่ URL ของไฟล์เสียง : กรณีต้องการให้มีเสียง (เช่น www.domain.de/mysound.mp3) 
var playSound = 'false'; 

// มีเสียงตอนเปิดแผ่นกระดาษ (ใส่ false : ไม่ใช้เสียง | ใส่ URL ของไฟล์เสียง : กรณีต้องการให้มีเสียง (เช่น www.domain.de/mysound.mp3) 
//var playOpenSound = 'http://www.thamwebsite.com/cty/tip/tipsinternet/images/pagepeel/zoom.mp3'; 
var playOpenSound = 'false'; 

// มีเสียงตอนปิดแผ่นกระดาษ (ใส่ false : ไม่ใช้เสียง | ใส่ URL ของไฟล์เสียง : กรณีต้องการให้มีเสียง (เช่น www.domain.de/mysound.mp3) 
var playCloseSound = 'false'; 

// ต้องการให้มี Link เพื่อปิดหรือไม่ ( true : มี , false : ไม่มี คือปิดเองอัตโนมัติ )
var closeOnClick = 'false';

// ข้อความว่า "ปิด" แต่ต้องเป็นภาษาอังกฤษเท่านั้น
var closeOnClickText = 'Close';
  
/* Do not change anything after this line  */ 

// Flash check vars
var requiredMajorVersion = 6;
var requiredMinorVersion = 0;
var requiredRevision = 0;

// Copyright
var copyright = 'Webpicasso Media, www.webpicasso.de';

// Size small peel 
var thumbWidth  = 100;
var thumbHeight = 100;

// Size big peel
var bigWidth  = 500;
var bigHeight = 500;

// Css style default x-position
var xPos = 'right';


// GET - Params
var queryParams = 'pagearSmallImg='+escape(pagearSmallImg); 
queryParams += '&pagearBigImg='+escape(pagearBigImg); 
queryParams += '&pageearColor='+pageearColor; 
queryParams += '&jumpTo='+escape(jumpTo); 
queryParams += '&openLink='+escape(openLink); 
queryParams += '&mirror='+escape(mirror); 
queryParams += '&copyright='+escape(copyright); 
queryParams += '&speedSmall='+escape(speedSmall); 
queryParams += '&openOnLoad='+escape(openOnLoad); 
queryParams += '&closeOnLoad='+escape(closeOnLoad); 
queryParams += '&setDirection='+escape(setDirection); 
queryParams += '&softFadeIn='+escape(softFadeIn); 
queryParams += '&playSound='+escape(playSound); 
queryParams += '&playOpenSound='+escape(playOpenSound); 
queryParams += '&playCloseSound='+escape(playCloseSound);  
queryParams += '&closeOnClick='+escape(closeOnClick); 
queryParams += '&closeOnClickText='+escape(utf8encode(closeOnClickText)); 
queryParams += '&lcKey='+escape(Math.random()); 
queryParams += '&bigWidth='+escape(bigWidth); 
queryParams += '&thumbWidth='+escape(thumbWidth); 

function openPeel(){
	document.getElementById('bigDiv').style.top = '0px'; 
	document.getElementById('bigDiv').style[xPos] = '0px';
	document.getElementById('thumbDiv').style.top = '-1000px';
}

function closePeel(){
	document.getElementById("thumbDiv").style.top = "0px";
	document.getElementById("bigDiv").style.top = "-1000px";
}

function writeObjects () { 
    
    // Get installed flashversion
    var hasReqestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
    
    // Check direction 
    if(setDirection == 'lt') {
        xPosBig = 'left:-1000px';  
        xPos = 'left';   
    } else {
        xPosBig = 'right:1000px';
        xPos = 'right';              
    }
    
    // Write div layer for big swf
    document.write('<div id="bigDiv" style="position:absolute;width:'+ bigWidth +'px;height:'+ bigHeight +'px;z-index:9999;'+xPosBig+';top:-100px;">');    	
    
    // Check if flash exists/ version matched
    if (hasReqestedVersion) {    	
    	AC_FL_RunContent(
    				"src", pagearBigSwf+'?'+ queryParams,
    				"width", bigWidth,
    				"height", bigHeight,
    				"align", "middle",
    				"id", "bigSwf",
    				"quality", "high",
    				"bgcolor", "#FFFFFF",
    				"name", "bigSwf",
    				"wmode", "transparent",
    				"scale", "noscale",
    				"salign", "tr",
    				"allowScriptAccess","always",
    				"type", "application/x-shockwave-flash",
    				'codebase', 'http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab',
    				"pluginspage", "http://www.adobe.com/go/getflashplayer"
    	);
    } else {  // otherwise do nothing or write message ...    	 
    	document.write('no flash installed');  // non-flash content
    } 
    // Close div layer for big swf
    document.write('</div>'); 
    
    // Write div layer for small swf
    document.write('<div id="thumbDiv" style="position:absolute;width:'+ thumbWidth +'px;height:'+ thumbHeight +'px;z-index:9999;'+xPos+':0px;top:0px;">');
    
    // Check if flash exists/ version matched
    if (hasReqestedVersion) {    	
    	AC_FL_RunContent(
    				"src", pagearSmallSwf+'?'+ queryParams,
    				"width", thumbWidth,
    				"height", thumbHeight,
    				"align", "middle",
    				"id", "smallSwf",
    				"scale", "noscale",
    				"quality", "high",
    				"bgcolor", "#FFFFFF",
    				"name", "bigSwf",
    				"wmode", "transparent",
    				"allowScriptAccess","always",
    				"type", "application/x-shockwave-flash",
    				'codebase', 'http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab',
    				"pluginspage", "http://www.adobe.com/go/getflashplayer"
    	);
    } else {  // otherwise do nothing or write message ...    	 
    	document.write('no flash installed');  // non-flash content
    } 
    document.write('</div>');  
    setTimeout('document.getElementById("bigDiv").style.top = "-1000px";',100);
}

function utf8encode(txt) { 
    txt = txt.replace(/\r\n/g,"\n");
    var utf8txt = "";
    for(var i=0;i<txt.length;i++) {        
        var uc=txt.charCodeAt(i); 
        if (uc<128) {
            utf8txt += String.fromCharCode(uc);        
        } else if((uc>127) && (uc<2048)) {
            utf8txt += String.fromCharCode((uc>>6)|192);
            utf8txt += String.fromCharCode((uc&63)|128);
        } else {
            utf8txt += String.fromCharCode((uc>>12)|224);
            utf8txt += String.fromCharCode(((uc>>6)&63)|128);
            utf8txt += String.fromCharCode((uc&63)|128);
        }        
    }
    return utf8txt;
}