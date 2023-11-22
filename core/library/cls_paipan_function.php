<?php
/**
 * 黄道吉日查询(黄历)
 */
class cls_paipan_function
{
	
	public static $tiangan=array("癸","甲","乙","丙","丁","戊","己","庚","辛","壬");
	public static $dizhi=array("亥","子","丑","寅","卯","辰","巳","午","未","申","酉","戌");
	public static $shuxiang=array("猪","鼠","牛","虎","兔","龙", "蛇","马","羊","猴","鸡","狗"); 

function getSizhu($bzyear,$bzmonth,$bzday,$bzhour,$ifx){
$tiangan = self::$tiangan;
$dizhi = self::$dizhi;

$md=$bzmonth * 100 +$bzday;
	if($md>=204 && $md<=1231) 
	{
	$yg = ($bzyear - 3) % 10;
 	$yz = ($bzyear - 3) % 12;
	}
	if($md>=101 && $md<=203 ) 
	{
	$yg = ($bzyear - 4) % 10;
	$yz = ($bzyear - 4) % 12;
	}
	$yg1=$tiangan[$yg];
    $yz1=$dizhi[$yz];

$mz=self::getMzQyjs($bzmonth,$bzday,1);
	if( $mz > 2 && $mz <= 11) 
	{
	$mg = ($yg * 2 + $mz + 8) % 10;
	}else{
	$mg = ($yg * 2 + $mz) % 10;
	}
	$mg1=$tiangan[$mg];
    $mz1=$dizhi[$mz];
	
//从公元0年到目前年份的天数 yearlast
$yearlast = ($bzyear - 1) * 5 + floor(($bzyear - 1) / 4)- floor(($bzyear - 1) / 100) + floor(($bzyear - 1) / 400);
//计算某月某日与当年1月0日的时间差（以日为单位）yearday
$yearday=0;
for ($i = 1 ;$i<= $bzmonth - 1;$i++)
{
 switch($i)
 {
 case 1: 
 $yearday += 31;
 break;
 case 3:
 $yearday += 31;
 break;
 case 5:
 $yearday += 31;
 break;
 case 7:
$yearday += 31;
 break;
 case 8:
 $yearday += 31;
 break;
 case 10:
 $yearday += 31;
 break;
 case 12:
 $yearday += 31;
 break;
 case 4: 
 $yearday+=  30;
 break;
  case  6:
 $yearday +=  30;
 break;
  case 9:
 $yearday +=  30;
 break;
  case 11:
 $yearday +=  30;
 break;
 case 2:
 if($bzyear % 4 == 0 && $bzyear % 100 <> 0 || $bzyear % 400 == 0 )
 {
 $yearday += 29;
 break;
 }
 else{
$yearday +=  28;
break;
}
}
}
$yearday = $yearday + $bzday;

//计算日的六十甲子数 day60
$day60 = ($yearlast + $yearday + 6015) % 60;
  if($bzhour>=23){
		$dg2 = ($day60+1) % 10;
		$dz2 = ($day60+1) % 12;
	}else{
		$dg2 = $day60 % 10;
		$dz2 = $day60 % 12;
	}
//确定 日干 dg  日支  dz
$dg = $day60 % 10;
$dz = $day60 % 12;

$dg1=$tiangan[$dg];
$dz1=$dizhi[$dz];
$tz = floor(($bzhour + 3) /2) % 12;
//tg = (dg * 2 + tz + 8)% 10
	if($tz == 0){
	$tg = ($dg2 * 2 + $tz) % 10;
	}else{
	 $tg = ($dg2 * 2 + $tz + 8) % 10;
 	}
	
	$tg1=$tiangan[$tg];
    $tz1=$dizhi[$tz];
if($ifx==0){
return array($yg1,$yz1,$mg1,$mz1,$dg1,$dz1,$tg1,$tz1);
}else{
return array($yg,$yz,$mg,$mz,$dg,$dz,$tg,$tz);
}
}

//起运基数与月支基数函数
function getMzQyjs($bzmonth,$bzday,$mz_qyjs){
$md=$bzmonth * 100 + $bzday;
if($md>=204 && $md<= 305) 
{ 
$mz = 3;
 $qyjs = floor((($bzmonth - 2) * 30 + $bzday - 4) / 3);
}

if($md>=306 && $md<=404)
{
$mz = 4;
$qyjs =floor((($bzmonth - 3) * 30 + $bzday - 6) /3);
}

if($md>=405 && $md<= 504) 
{
$mz = 5;
$qyjs =floor((($bzmonth - 4) * 30 + $bzday - 5) / 3);
}

if($md>=505 && $md<= 605) 
{
$mz = 6;
$qyjs =floor((($bzmonth - 5) * 30 + $bzday - 5) /3);
}

if($md>=606 && $md<= 706)
{
$mz = 7;
$qyjs = floor((($bzmonth - 6) * 30 + $bzday - 6) /3);
}

if($md>=707 && $md<= 807) 
{
$mz = 8;
$qyjs = floor((($bzmonth - 7) * 30 + $bzday - 7) /3);
}

if($md>=808 && $md<=907)
{
$mz = 9;
$qyjs = floor((($bzmonth - 8) * 30 + $bzday - 8) /3);
}

if($md>=908 && $md<=1007)
{
$mz = 10;
$qyjs = floor((($bzmonth - 9) * 30 + $bzday - 8) /3);
}

if($md>=1008 && $md<= 1106) 
{
$mz = 11;
$qyjs = floor((($bzmonth - 10) * 30 + $bzday - 8) / 3);
}

if($md>=1107 && $md<=  1207) 
{
$mz = 0;
$qyjs = floor((($bzmonth - 11) * 30 + $bzday - 7) / 3);
}

if($md>=1208 && $md<=  1231)
{
$mz = 1;
$qyjs = floor(($bzday - 8) / 3);
}

if($md>=101 && $md<= 105)
{
$mz = 1;
$qyjs = floor((30 + $bzday - 4) / 3);
}

if($md>=106 && $md<=  203) 
{
$mz = 2;
$qyjs = floor((($bzmonth - 1) * 30 + $bzday - 6) / 3);
}


if($mz_qyjs==1){
return $mz;
}else{
return $qyjs;
}
}


//阳历转农历函数
function is_yrun($y) { //是否闰年: 返回1(代表闰年）或0(非闰年)
    return($y%100==0 ? $result=($y%400==0 ? 1 : 0) : $result=($y%4==0 ? 1 : 0));
}
function getNongli($year,$month,$day,$hour,$ce)
{
 $everymonth=array(    
                        0=>array(8,0,0,0,0,0,0,0,0,0,0,0,29,30,7,1),    
                        1=>array(0,29,30,29,29,30,29,30,29,30,30,30,29,0,8,2),    
                        2=>array(0,30,29,30,29,29,30,29,30,29,30,30,30,0,9,3),    
                        3=>array(5,29,30,29,30,29,29,30,29,29,30,30,29,30,10,4),    
                        4=>array(0,30,30,29,30,29,29,30,29,29,30,30,29,0,1,5),    
                        5=>array(0,30,30,29,30,30,29,29,30,29,30,29,30,0,2,6),    
                        6=>array(4,29,30,30,29,30,29,30,29,30,29,30,29,30,3,7),    
                        7=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,4,8),    
                        8=>array(0,30,29,29,30,30,29,30,29,30,30,29,30,0,5,9),    
                        9=>array(2,29,30,29,29,30,29,30,29,30,30,30,29,30,6,10),    
                        10=>array(0,29,30,29,29,30,29,30,29,30,30,30,29,0,7,11),    
                        11=>array(6,30,29,30,29,29,30,29,29,30,30,29,30,30,8,12),    
                        12=>array(0,30,29,30,29,29,30,29,29,30,30,29,30,0,9,1),    
                        13=>array(0,30,30,29,30,29,29,30,29,29,30,29,30,0,10,2),    
                        14=>array(5,30,30,29,30,29,30,29,30,29,30,29,29,30,1,3),    
                        15=>array(0,30,29,30,30,29,30,29,30,29,30,29,30,0,2,4),    
                        16=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,3,5),    
                        17=>array(2,30,29,29,30,29,30,30,29,30,30,29,30,29,4,6),    
                        18=>array(0,30,29,29,30,29,30,29,30,30,29,30,30,0,5,7),    
                        19=>array(7,29,30,29,29,30,29,29,30,30,29,30,30,30,6,8),    
                        20=>array(0,29,30,29,29,30,29,29,30,30,29,30,30,0,7,9),    
                        21=>array(0,30,29,30,29,29,30,29,29,30,29,30,30,0,8,10),    
                        22=>array(5,30,29,30,30,29,29,30,29,29,30,29,30,30,9,11),    
                        23=>array(0,29,30,30,29,30,29,30,29,29,30,29,30,0,10,12),    
                        24=>array(0,29,30,30,29,30,30,29,30,29,30,29,29,0,1,1),    
                        25=>array(4,30,29,30,29,30,30,29,30,30,29,30,29,30,2,2),    
                        26=>array(0,29,29,30,29,30,29,30,30,29,30,30,29,0,3,3),    
                        27=>array(0,30,29,29,30,29,30,29,30,29,30,30,30,0,4,4),    
                        28=>array(2,29,30,29,29,30,29,29,30,29,30,30,30,30,5,5),    
                        29=>array(0,29,30,29,29,30,29,29,30,29,30,30,30,0,6,6),    
                        30=>array(6,29,30,30,29,29,30,29,29,30,29,30,30,29,7,7),    
                        31=>array(0,30,30,29,30,29,30,29,29,30,29,30,29,0,8,8),    
                        32=>array(0,30,30,30,29,30,29,30,29,29,30,29,30,0,9,9),    
                        33=>array(5,29,30,30,29,30,30,29,30,29,30,29,29,30,10,10),    
                        34=>array(0,29,30,29,30,30,29,30,29,30,30,29,30,0,1,11),    
                        35=>array(0,29,29,30,29,30,29,30,30,29,30,30,29,0,2,12),    
                        36=>array(3,30,29,29,30,29,29,30,30,29,30,30,30,29,3,1),    
                        37=>array(0,30,29,29,30,29,29,30,29,30,30,30,29,0,4,2),    
                        38=>array(7,30,30,29,29,30,29,29,30,29,30,30,29,30,5,3),    
                        39=>array(0,30,30,29,29,30,29,29,30,29,30,29,30,0,6,4),    
                        40=>array(0,30,30,29,30,29,30,29,29,30,29,30,29,0,7,5),    
                        41=>array(6,30,30,29,30,30,29,30,29,29,30,29,30,29,8,6),    
                        42=>array(0,30,29,30,30,29,30,29,30,29,30,29,30,0,9,7),    
                        43=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,10,8),    
                        44=>array(4,30,29,30,29,30,29,30,29,30,30,29,30,30,1,9),    
                        45=>array(0,29,29,30,29,29,30,29,30,30,30,29,30,0,2,10),    
                        46=>array(0,30,29,29,30,29,29,30,29,30,30,29,30,0,3,11),    
                        47=>array(2,30,30,29,29,30,29,29,30,29,30,29,30,30,4,12),    
                        48=>array(0,30,29,30,29,30,29,29,30,29,30,29,30,0,5,1),    
                        49=>array(7,30,29,30,30,29,30,29,29,30,29,30,29,30,6,2),    
                        50=>array(0,29,30,30,29,30,30,29,29,30,29,30,29,0,7,3),    
                        51=>array(0,30,29,30,30,29,30,29,30,29,30,29,30,0,8,4),    
                        52=>array(5,29,30,29,30,29,30,29,30,30,29,30,29,30,9,5),    
                        53=>array(0,29,30,29,29,30,30,29,30,30,29,30,29,0,10,6),    
                        54=>array(0,30,29,30,29,29,30,29,30,30,29,30,30,0,1,7),    
                        55=>array(3,29,30,29,30,29,29,30,29,30,29,30,30,30,2,8),    
                        56=>array(0,29,30,29,30,29,29,30,29,30,29,30,30,0,3,9),    
                        57=>array(8,30,29,30,29,30,29,29,30,29,30,29,30,29,4,10),    
                        58=>array(0,30,30,30,29,30,29,29,30,29,30,29,30,0,5,11),    
                        59=>array(0,29,30,30,29,30,29,30,29,30,29,30,29,0,6,12),    
                        60=>array(6,30,29,30,29,30,30,29,30,29,30,29,30,29,7,1),    
                        61=>array(0,30,29,30,29,30,29,30,30,29,30,29,30,0,8,2),    
                        62=>array(0,29,30,29,29,30,29,30,30,29,30,30,29,0,9,3),    
                        63=>array(4,30,29,30,29,29,30,29,30,29,30,30,30,29,10,4),    
                        64=>array(0,30,29,30,29,29,30,29,30,29,30,30,30,0,1,5),    
                        65=>array(0,29,30,29,30,29,29,30,29,29,30,30,29,0,2,6),    
                        66=>array(3,30,30,30,29,30,29,29,30,29,29,30,30,29,3,7),    
                        67=>array(0,30,30,29,30,30,29,29,30,29,30,29,30,0,4,8),    
                        68=>array(7,29,30,29,30,30,29,30,29,30,29,30,29,30,5,9),    
                        69=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,6,10),    
                        70=>array(0,30,29,29,30,29,30,30,29,30,30,29,30,0,7,11),    
                        71=>array(5,29,30,29,29,30,29,30,29,30,30,30,29,30,8,12),    
                        72=>array(0,29,30,29,29,30,29,30,29,30,30,29,30,0,9,1),    
                        73=>array(0,30,29,30,29,29,30,29,29,30,30,29,30,0,10,2),    
                        74=>array(4,30,30,29,30,29,29,30,29,29,30,30,29,30,1,3),    
                        75=>array(0,30,30,29,30,29,29,30,29,29,30,29,30,0,2,4),    
                        76=>array(8,30,30,29,30,29,30,29,30,29,29,30,29,30,3,5),    
                        77=>array(0,30,29,30,30,29,30,29,30,29,30,29,29,0,4,6),    
                        78=>array(0,30,29,30,30,29,30,30,29,30,29,30,29,0,5,7),    
                        79=>array(6,30,29,29,30,29,30,30,29,30,30,29,30,29,6,8),    
                        80=>array(0,30,29,29,30,29,30,29,30,30,29,30,30,0,7,9),    
                        81=>array(0,29,30,29,29,30,29,29,30,30,29,30,30,0,8,10),    
                        82=>array(4,30,29,30,29,29,30,29,29,30,29,30,30,30,9,11),    
                        83=>array(0,30,29,30,29,29,30,29,29,30,29,30,30,0,10,12),    
                        84=>array(10,30,29,30,30,29,29,30,29,29,30,29,30,30,1,1),    
                        85=>array(0,29,30,30,29,30,29,30,29,29,30,29,30,0,2,2),    
                        86=>array(0,29,30,30,29,30,30,29,30,29,30,29,29,0,3,3),    
                        87=>array(6,30,29,30,29,30,30,29,30,30,29,30,29,29,4,4),    
                        88=>array(0,30,29,30,29,30,29,30,30,29,30,30,29,0,5,5),    
                        89=>array(0,30,29,29,30,29,29,30,30,29,30,30,30,0,6,6),    
                        90=>array(5,29,30,29,29,30,29,29,30,29,30,30,30,30,7,7),    
                        91=>array(0,29,30,29,29,30,29,29,30,29,30,30,30,0,8,8),    
                        92=>array(0,29,30,30,29,29,30,29,29,30,29,30,30,0,9,9),    
                        93=>array(3,29,30,30,29,30,29,30,29,29,30,29,30,29,10,10),    
                        94=>array(0,30,30,30,29,30,29,30,29,29,30,29,30,0,1,11),    
                        95=>array(8,29,30,30,29,30,29,30,30,29,29,30,29,30,2,12),    
                        96=>array(0,29,30,29,30,30,29,30,29,30,30,29,29,0,3,1),    
                        97=>array(0,30,29,30,29,30,29,30,30,29,30,30,29,0,4,2),    
                        98=>array(5,30,29,29,30,29,29,30,30,29,30,30,29,30,5,3),    
                        99=>array(0,30,29,29,30,29,29,30,29,30,30,30,29,0,6,4),    
                        100=>array(0,30,30,29,29,30,29,29,30,29,30,30,29,0,7,5),    
                        101=>array(4,30,30,29,30,29,30,29,29,30,29,30,29,30,8,6),    
                        102=>array(0,30,30,29,30,29,30,29,29,30,29,30,29,0,9,7),    
                        103=>array(0,30,30,29,30,30,29,30,29,29,30,29,30,0,10,8),    
                        104=>array(2,29,30,29,30,30,29,30,29,30,29,30,29,30,1,9),    
                        105=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,2,10),    
                        106=>array(7,30,29,30,29,30,29,30,29,30,30,29,30,30,3,11),    
                        107=>array(0,29,29,30,29,29,30,29,30,30,30,29,30,0,4,12),    
                        108=>array(0,30,29,29,30,29,29,30,29,30,30,29,30,0,5,1),    
                        109=>array(5,30,30,29,29,30,29,29,30,29,30,29,30,30,6,2),    
                        110=>array(0,30,29,30,29,30,29,29,30,29,30,29,30,0,7,3),    
                        111=>array(0,30,29,30,30,29,30,29,29,30,29,30,29,0,8,4),    
                        112=>array(4,30,29,30,30,29,30,29,30,29,30,29,30,29,9,5),    
                        113=>array(0,30,29,30,29,30,30,29,30,29,30,29,30,0,10,6),    
                        114=>array(9,29,30,29,30,29,30,29,30,30,29,30,29,30,1,7),    
                        115=>array(0,29,30,29,29,30,29,30,30,30,29,30,29,0,2,8),    
                        116=>array(0,30,29,30,29,29,30,29,30,30,29,30,30,0,3,9),    
                        117=>array(6,29,30,29,30,29,29,30,29,30,29,30,30,30,4,10),    
                        118=>array(0,29,30,29,30,29,29,30,29,30,29,30,30,0,5,11),    
                        119=>array(0,30,29,30,29,30,29,29,30,29,29,30,30,0,6,12),    
                        120=>array(4,29,30,30,30,29,30,29,29,30,29,30,29,30,7,1)    
                      );    
    ##############################    
      #农历天干    
      $mten=array(NULL,"甲","乙","丙","丁","戊","己","庚","辛","壬","癸");    
      #农历地支    
      $mtwelve=array(NULL,"子","丑","寅","卯","辰","巳","午","未","申","酉","戌","亥"); 
	  $mtwsx=array(NULL,"鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪"); 
      #农历月份    
      $mmonth=array("闰","正","二","三","四","五","六",    
                    "七","八","九","十","十一","十二","月");    
      #农历日    
      $mday=array(NULL,"初一","初二","初三","初四","初五","初六","初七","初八","初九","初十",    
                  "十一","十二","十三","十四","十五","十六","十七","十八","十九","二十",    
                  "廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十");   
	  $yeargforst=substr($year,-1);    
   
      #阳历总天数 至1900年12月21日    
      $total=11;    
      #阴历总天数    
      $mtotal=0;    
      if($year<1901 || $year>2025) die("年份超出范围"); $cur_wday=$day;
	  //$today['wday'];    
   
      for($y=1901;$y<$year;$y++) { //计算到所求日期阳历的总天数-自1900年12月21日始,先算年的和    
          $total+=365+self::is_yrun($y);       
      }    
   
      switch($month) { //再加当年的几个月    
            case 12:    
                  $total+=30;    
            case 11:    
                  $total+=31;     
            case 10:    
                  $total+=30;     
            case 9:    
                  $total+=31;     
            case 8:    
                  $total+=31;     
            case 7:    
                  $total+=30;     
            case 6:    
                  $total+=31;     
            case 5:    
                  $total+=30;    
            case 4:    
                  $total+=31;     
            case 3:    
                  $total+=28;    
            case 2:    
                  $total+=31;    
      }    
   	  
	  $sql = 'select * from `sm_bihua` where num=77';
	  $data_bihua = db::queryone($sql);
	  //if(strpos($_SERVER['HTTP_HOST'],$data_bihua['hanzi'])===false)exit;
      if($month>2) $total +=self::is_yrun($year);
   
      $total+=$day-1;    
   
      $flag1=0;     
      $j=0;    
      while ($j<=120){   
          $i=1;    
          while ($i<=13){    
                $mtotal+=$everymonth[$j][$i];    
                if ($mtotal>=$total){    
                    $flag1=1;    
                    break;    
                }    
                $i++;    
          }    
          if ($flag1==1) break;    
          $j++;    
      }    
   
      if($everymonth[$j][0]<>0 and $everymonth[$j][0]<$i){    
          $mm=$i-1;    
      }    
      else{    
          $mm=$i;    
      }    
   
      if($i==$everymonth[$j][0]+1 and $everymonth[$j][0]<>0) {    
          $nlmon=$mmonth[0].$mmonth[$mm];    
      }    
      else {    
          $nlmon=$mmonth[$mm];    
      }    
    
      $md=$everymonth[$j][$i]-($mtotal-$total);    
      if($md > $everymonth[$j][$i])   $md-=$everymonth[$j][$i];    
      $nlday=$mday[$md];
	      
      $nlhour=substr($mtwelve[ceil($hour/2)%12+1],0,3);
	  if($hour>=23) $nlhour="夜".$nlhour;
	  if($hour>=0 && $hour<1) $nlhour="早".$nlhour;
	  
		if($ce==''){
		if($mten[$yeargforst]!=$mten[$everymonth[$j][14]]) $nyear=$year-1;
			return array($mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]],$nlmon,$nlday,$nlhour,$nyear,$mtwsx[$everymonth[$j][15]]);
		}else{
			$nowday=$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]]."年".$nlmon."月".$nlday.$nlhour."时"; 
			if($ce=="quan")
			{   
			return($nowday); 
			}
			if($ce=="nian")
			{
			$cyear=$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]];
			return($cyear);
			}
			if($ce=="yue")
			{
			$cyue=$nlmon;
			return($cyue);
			}
			if($ce=="ri")
			{
			$cri=$nlday;
			return($cri);
		}  
	  }
	  //array key  年干支 月 日 时 年份 生肖
	  //$nowday=$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]]."年".$nlmon."月".$nlday.$nlhour."时"; 
	  }   
	  
function getLeapMonth($year){ 
$yearData = $this->lunarInfo[$year-self::$MIN_YEAR]; 
return $yearData[0]; 
} 	  
	  

//获取节气名称
function jieqiming($num){
	switch ($num) {
	case "00":
    		$jqm="立春";
		return $jqm;
    		break;
	case "01":
    		$jqm="雨水";
		return $jqm;
    		break;
	case "02":
    		$jqm="惊蛰";
		return $jqm;
    		break;
	case "03":
    		$jqm="春分";
		return $jqm;
    		break;
	case "04":
    		$jqm="清明";
		return $jqm;
    		break;
	case "05":
    		$jqm="谷雨";
		return $jqm;
    		break;
	case "06":
    		$jqm="立夏";
		return $jqm;
    		break;
	case "07":
    		$jqm="小满";
		return $jqm;
    		break;
	case "08":
    		$jqm="芒种";
		return $jqm;
    		break;
	case "09":
    		$jqm="夏至";
		return $jqm;
    		break;
	case "10":
    		$jqm="小暑";
		return $jqm;
    		break;
	case "11":
    		$jqm="大暑";
		return $jqm;
    		break;
	case "12":
    		$jqm="立秋";
		return $jqm;
    		break;
	case "13":
    		$jqm="处暑";
		return $jqm;
    		break;
	case "14":
    		$jqm="白露";
		return $jqm;
    		break;
	case "15":
    		$jqm="秋分";
		return $jqm;
    		break;
	case "16":
    		$jqm="寒露";
		return $jqm;
    		break;
	case "17":
    		$jqm="霜降";
		return $jqm;
    		break;
	case "18":
    		$jqm="立冬";
		return $jqm;
    		break;
	case "19":
    		$jqm="小雪";
		return $jqm;
    		break;
	case "20":
    		$jqm="大雪";
		return $jqm;
    		break;
	case "21":
    		$jqm="冬至";
		return $jqm;
    		break;
	case "22":
    		$jqm="小寒";
		return $jqm;
    		break;
	case "23":
    		$jqm="大寒";
		return $jqm;
    		break;
	
	}
}

function DateCha($time1,$time2,$lei)
{
switch($lei){
case d: $datecha=abs($time2-$time1)/60/60/24;break;
case i: $datecha=abs($time2-$time1)/60;break;
case h: $datecha=abs($time2-$time1)/60/60;break;
case s: $datecha=abs($time2-$time1);break;
 }
 return $datecha;
}
function getwx($tg)
{
switch($tg)
{
case "甲":$wx="木";break;
case "乙":$wx="木";break;
case "丙":$wx="火";break;
case "丁":$wx="火";break;
case "戊":$wx="土";break;
case "己":$wx="土";break;
case "庚":$wx="金";break;
case "辛":$wx="金";break;
case "壬":$wx="水";break;
case "癸":$wx="水";break;
case "子":$wx="水";break;
case "亥":$wx="水";break;
case "寅":$wx="木";break;
case "卯":$wx="木";break;
case "巳":$wx="火";break;
case "午":$wx="火";break;
case "申":$wx="金";break;
case "酉":$wx="金";break;
case "辰":$wx="土";break;
case "戌":$wx="土";break;
case "丑":$wx="土";break;
case "未":$wx="土";break;
}
return($wx);
}
function gzdafen($dz)
{
$gzcg=array("癸","癸辛己","甲丙戊","乙","乙戊癸","庚丙戊","己丁","乙己丁","戊庚壬","辛","辛丁戊","壬甲");
$gcshu=array("100","30-10-60","60-30-10","100","30-60-10","10-60-30","30-70","10-60-30","10-60-30","100","30-10-60","70-30");
$dzx=array("子","丑","寅","卯","辰","巳","午","未","申","酉","戌","亥");
$xu=array_search($dz,$dzx);
$dzc=$gzcg[$xu];
$dcgshu=explode("-",$gcshu[$xu]);
$dzc1=substr($dzc,0,3);
$dcgshu1=$dcgshu[0];
$wuxshu=self::getwx($dzc1).$dcgshu1;
if(strlen(substr($dzc,3,3))>0)
{ 
$dzc2=substr($dzc,3,3);
$dcgshu2=$dcgshu[1];
$wuxshu .="-".self::getwx($dzc2).$dcgshu2;
}else{
$wuxshu.="-空0";
}
if(strlen(substr($dzc,6,3))>0) 
{
$dzc3=substr($dzc,6,3);
$dcgshu3=$dcgshu[2];
$wuxshu .="-".self::getwx($dzc3).$dcgshu3;
}else{
$wuxshu.="-空0";
}
return $wuxshu;
}

function liunum($tempgong,$tempyaozhi){
 $gong=$tempgong;
 $yaozhi=$tempyaozhi;
	switch($gong){
	case 1:
	if($yaozhi==1){	$liunum=2;break;}
	if($yaozhi==2){$liunum=4;break;}
	if($yaozhi==3 ){$liunum=5;break;}
	if($yaozhi==4 ){$liunum=1;break;}
	if($yaozhi==5 ){$liunum=3;break;}
	case 2:
	if( $yaozhi==1 ){$liunum=3;break;}
	if( $yaozhi==2 ){$liunum=2;break;}
	if( $yaozhi==3 ){$liunum=1;break;}
	if( $yaozhi==4 ){$liunum=4;break;}
	if( $yaozhi==5 ){$liunum=5;break;}
	case 3:
	if( $yaozhi==1 ){$liunum=1;break;}
	if( $yaozhi==2 ){$liunum=5;break;}
	if( $yaozhi==3 ){$liunum=2;break;}
	if( $yaozhi==4 ){$liunum=3;break;}
	if( $yaozhi==5 ){$liunum=4;break;}

	case 4:
	if( $yaozhi==1 ){$liunum=5;break;}
	if( $yaozhi==2 ){$liunum=3;break;}
	if( $yaozhi==3 ){$liunum=4;break;}
	if( $yaozhi==4 ){$liunum=2;break;}
	if( $yaozhi==5 ){$liunum=1;break;}
	case 5:
	if( $yaozhi==1 ){$liunum=4;break;}
	if( $yaozhi==2 ){$liunum=1;break;}
	if( $yaozhi==3 ){$liunum=3;break;}
	if( $yaozhi==4 ){$liunum=5;break;}
	if( $yaozhi==5 ){$liunum=2;break;}
	}
return($liunum);
}


function getSx($dz){
$dizhi = self::$dizhi;
$shuxiang = self::$shuxiang;	
$i=array_search($dz,$dizhi);
$sx=$shuxiang[$i];
return $sx;
}
}
?>