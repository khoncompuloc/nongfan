var msMonth=new Array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
var msMonth_small=new Array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
var msDays=new Array(31, 0, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
var msDOW=new Array("อา", "จ", "อ", "พ", "พฤ", "ศ", "ส");
var intLine
function makeCalendar(intWhatMonth,intWhatYear)
{
	intWhatMonth = parseInt(intWhatMonth);
	intWhatYear = parseInt(intWhatYear);

	msDays[1]=(intWhatYear%4 == 0)?29:28;
	
	strOutput = '<table width="230" border="3" class="cal-Table" cellspacing="0" cellpadding="0">';
	strOutput += '<tr><td class="cal-HeadCell" align="center" width="100%">&nbsp;';
	strOutput += '<a href="javascript:scrollMonth(-1);" class="cal-DayLink">&lt;&lt;</a>';
	strOutput += '&nbsp;&nbsp;&nbsp;<select class="cal-ComboBox" id="cboMonth" onChange="change();">';

	for (i=0; i<12; i++)
	{
		if (i == intWhatMonth) strOutput += '<option value="' + i + '" selected>' + msMonth[i] + '</option>';
		else  strOutput += '<option value="' + i + '">' + msMonth[i] + '</option>';
	}

	strOutput += '</select>&nbsp;<select class="cal-ComboBox" id="cboYear" onChange="change();">';

	startYear = intWhatYear-10;
	for (i=startYear; i<=(startYear+20); i++)
	{
		if (i == intWhatYear) strOutput += '<option value="' + i + '" selected>' + (i+543) + '</option>';
		else  strOutput += '<option value="' + i + '">' + (i+543) + '</option>';
	}

	strOutput += '</select>&nbsp;&nbsp;&nbsp;';
	strOutput += '<a href="javascript:scrollMonth(1);" class="cal-DayLink">&gt;&gt;</a>';
	strOutput += '&nbsp;</td></tr>';

	strOutput += '<tr><td width="100%" align="center">';
	strOutput += '	<table width="230" cellspacing="1" cellpadding="2" border="0">';
	strOutput += '	<tr><td class="cal-HeadCell" width="15%" align="center" valign="middle">'+msDOW[0]+'</td>';
	strOutput += '	<td class="cal-HeadCell" width="14%" align="center" valign="middle">'+msDOW[1]+'</td>';
	strOutput += '	<td class="cal-HeadCell" width="14%" align="center" valign="middle">'+msDOW[2]+'</td>';
	strOutput += '	<td class="cal-HeadCell" width="14%" align="center" valign="middle">'+msDOW[3]+'</td>';
	strOutput += '	<td class="cal-HeadCell" width="14%" align="center" valign="middle">'+msDOW[4]+'</td>';
	strOutput += '	<td class="cal-HeadCell" width="14%" align="center" valign="middle">'+msDOW[5]+'</td>';
	strOutput += '	<td class="cal-HeadCell" width="15%" align="center" valign="middle">'+msDOW[6]+'</td></tr><tr>';

	intLastMonth = intWhatMonth - 1;
	intLastYear = intWhatYear;
	if (intLastMonth == -1) { intLastMonth = 11; intLastYear=intLastYear-1; }
	intLastDays = msDays[intLastMonth];

	dt = new Date(intWhatYear,intWhatMonth,1);
	startDay = dt.getDay();
	intColumn = 0;
	for (i=0; i<startDay; i++, intColumn++)
	{
		strOutput += '<td align="center" class="cal-GreyDate">'+(intLastDays-startDay+i+1)+'</td>';
	}

	dt = new Date();
	nowDate = dt.getDate();
	nowMonth = dt.getMonth();
	nowFullYear = dt.getFullYear();
	for (i=1; i<=msDays[intWhatMonth]; i++, intColumn++)
	{		
		strOutput += '<td align="center" class="cal-DayCell">';
		strOutput += '<a class="'+((nowDate==i && nowMonth==intWhatMonth && nowFullYear==intWhatYear)?'cal-TodayLink':'cal-DayLink')+'" ';
		strOutput += 'href="javascript:changeDay('+i+');">'+i+'</a></td>';
		if (intColumn == 6)
		{
			strOutput += '</tr><tr>';
			intColumn = -1;
		}
	}

	for (i=1; intColumn<7; i++, intColumn++)
	{
		strOutput += '<td align="center" class="cal-GreyDate">'+i+'</td>';
	}
	strOutput += '</tr></table></td></tr></table>';
	document.getElementById('pCalendar').innerHTML=strOutput;
	//document.getElementById('txt').value=strOutput;
}

function changeDay(day)
{
	month = document.getElementById('cboMonth').options[document.getElementById('cboMonth').selectedIndex].value;
	year = document.getElementById('cboYear').options[document.getElementById('cboYear').selectedIndex].value;
	month_small = msMonth_small[month];
	month = parseInt(month)+1 ;
	month = month.toString();
	year_thai = parseInt(year)+543 ;
     if(month.length==1){
	 //month = typeof('0'+ month) ;
	 month = '0'+ month ;
     //alert(month);	 
	 } 
	 lday = day.toString();
     if(lday.length==1){
	 //month = typeof('0'+ month) ;
	 lday = '0'+ lday ;
     //alert(day);	 
	 } 	 
	 //else {
	 //month = '10'+ month ;
	 //alert(month);
	 //}
	//alert('lday='+lday); 
	document.getElementById('tCalendar_'+intLine).value=day+' '+month_small+' '+year_thai;
	document.getElementById('sh_date_'+intLine).value=year+'-'+month+'-'+lday;
	document.getElementById('pCalendar').style.visibility="hidden";
}

function showCalendar(btn,line)
{
    //alert(scr);
	intLine = line ;
	if (btn.offsetParent) {
		Left = btn.offsetLeft
		Top = btn.offsetTop
		while (btn = btn.offsetParent) {
			Left += btn.offsetLeft
			Top += btn.offsetTop
		}
	}

	obj = document.getElementById('pCalendar');
	obj.style.visibility=(obj.style.visibility == "visible")?"hidden":"visible";
	obj.style.left=Left;
	obj.style.top=Top+20;
}

function change()
{
	month = parseInt(document.getElementById('cboMonth').options[document.getElementById('cboMonth').selectedIndex].value);
	year = parseInt(document.getElementById('cboYear').options[document.getElementById('cboYear').selectedIndex].value);
	makeCalendar(month, year);
}

function scrollMonth(num)
{
	month = parseInt(document.getElementById('cboMonth').options[document.getElementById('cboMonth').selectedIndex].value);
	year = parseInt(document.getElementById('cboYear').options[document.getElementById('cboYear').selectedIndex].value);

	month += num;
	if (month == -1) { month = 11; year=year-1; }
	if (month == 12) { month = 0; year=year+1; }	
	makeCalendar(month, year);
}
