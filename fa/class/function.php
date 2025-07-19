<?php
//fonksiyonlar


//
function resim_yukle($input_post){
  if(isset($input_post))
  {
    $dir=__dir__;
    $rand=rand();
    include_once "class.upload.php";
      $tarih = date("'d.m.Y H:i:s'");
      $image = new Upload( $input_post );
      if ( $image->uploaded ) {

          $isim=$rand.crc32($tarih);

          $image->file_new_name_body = $isim;
          $image->allowed = array ( 'image/*' );
          $image->image_convert = 'jpg';
          $image->Process('../upload/');
              if ( $image->processed ){
            return "upload/".$isim.".jpg";
          } else {
              return 'error';
          }

      }
  }
  else{

    return "0";
  }
}
//
function permalink($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function iller($il)
{
  switch ($il) {
  case 1:
  echo "Adana";
  break;
  case 2:
  echo "Adıyaman";
  break;
  case 3:
  echo "Afyonkarahisar";
  break;
  case 4:
  echo "Ağrı";
  break;
  case 5:
  echo "Amasya";
  break;
  case 6:
  echo "Ankara";
  break;
  case 7:
  echo "Antalya";
  break;
  case 8:
  echo "Artvin";
  break;
  case 9:
  echo "Aydın";
  break;
  case 10:
  echo "Balıkesir";
  break;
  case 11:
  echo "Bilecik";
  break;
  case 12:
  echo "Bingöl";
  break;
  case 13:
  echo "Bitlis";
  break;
  case 14:
  echo "Bolu";
  break;
  case 15:
  echo "Burdur";
  break;
  case 16:
  echo "Bursa";
  break;
  case 17:
  echo "Çanakkale";
  break;
  case 18:
  echo "Çankırı";
  break;
  case 19:
  echo "Çorum";
  break;
  case 20:
  echo "Denizli";
  break;
  case 21:
  echo "Diyarbakır";
  break;
  case 22:
  echo "Edirne";
  break;
  case 23:
  echo "Elazığ";
  break;
  case 24:
  echo "Erzincan";
  break;
  case 25:
  echo "Erzurum";
  break;
  case 26:
  echo "Eskişehir";
  break;
  case 27:
  echo "Gaziantep";
  break;
  case 28:
  echo "Giresun";
  break;
  case 29:
  echo "Gümüşhane";
  break;
  case 30:
  echo "Hakkâri";
  break;
  case 31:
  echo "Hatay";
  break;
  case 32:
  echo "Isparta";
  break;
  case 33:
  echo "Mersin";
  break;
  case 34:
  echo "İstanbul";
  break;
  case 35:
  echo "İzmir";
  break;
  case 36:
  echo "Kars";
  break;
  case 37:
  echo "Kastamonu";
  break;
  case 38:
  echo "Kayseri";
  break;
  case 39:
  echo "Kırklareli";
  break;
  case 40:
  echo "Kırşehir";
  break;
  case 41:
  echo "Kocaeli";
  break;
  case 42:
  echo "Konya";
  break;
  case 43:
  echo "Kütahya";
  break;
  case 44:
  echo "Malatya";
  break;
  case 45:
  echo "Manisa";
  break;
  case 46:
  echo "Kahramanmaraş";
  break;
  case 47:
  echo "Mardin";
  break;
  case 48:
  echo "Muğla";
  break;
  case 49:
  echo "Muş";
  break;
  case 50:
  echo "Nevşehir";
  break;
  case 51:
  echo "Niğde";
  break;
  case 52:
  echo "Ordu";
  break;
  case 53:
  echo "Rize";
  break;
  case 54:
  echo "Sakarya";
  break;
  case 55:
  echo "Samsun";
  break;
  case 56:
  echo "Siirt";
  break;
  case 57:
  echo "Sinop";
  break;
  case 58:
  echo "Sivas";
  break;
  case 59:
  echo "Tekirdağ";
  break;
  case 60:
  echo "Tokat";
  break;
  case 61:
  echo "Trabzon";
  break;
  case 62:
  echo "Tunceli";
  break;
  case 63:
  echo "Şanlıurfa";
  break;
  case 64:
  echo "Uşak";
  break;
  case 65:
  echo "Van";
  break;
  case 66:
  echo "Yozgat";
  break;
  case 67:
  echo "Zonguldak";
  break;
  case 68:
  echo "Aksaray";
  break;
  case 69:
  echo "Bayburt";
  break;
  case 70:
  echo "Karaman";
  break;
  case 71:
  echo "Kırıkkale";
  break;
  case 72:
  echo "Batman";
  break;
  case 73:
  echo "Şırnak";
  break;
  case 74:
  echo "Bartın";
  break;
  case 75:
  echo "Ardahan";
  break;
  case 76:
  echo "Iğdır";
  break;
  case 77:
  echo "Yalova";
  break;
  case 78:
  echo "Karabük";
  break;
  case 79:
  echo "Kilis";
  break;
  case 80:
  echo "Osmaniye";
  break;
  case 81:
  echo "Düzce";
  break;
  }
}


function cikis_yap(){
    session_start();
    session_destroy();
    $link=$_SERVER['HTTP_REFERER'];
    header("Location:$link");
}


function tarih(){
    $tarih = date("d.m.Y");
return $tarih;
}
//Saat
function saat(){
    $saat = date("H:i:s");
    return $saat;
}

function tarayici() {
 $tespit2=$_SERVER['HTTP_USER_AGENT'];
 if(stristr($tespit2,"MSIE")) { $tarayici="Internet Explorer"; }
 elseif(stristr($tespit2,"Firefox")) { $tarayici="Mozilla Firefox"; }
 elseif(stristr($tespit2,"YaBrowser")) { $tarayici="Yandex Browser"; }
 elseif(stristr($tespit2,"Chrome")) { $tarayici="Google Chrome"; }
 elseif(stristr($tespit2,"Safari")) { $tarayici="Safari"; }
 elseif(stristr($tespit2,"Opera")) { $tarayici="Opera"; }
 else {$tarayici="Bilinmiyor ?";}
 return $tarayici;
 }

function sifrele($str){
  if(empty($str))
  {
    return "";
  }
  else
  {
$str=crc32(md5(base64_encode($str)));
return $str;
}}

function gelgit()
{
  $url=$_SERVER['HTTP_REFERER'];
  $go=header("Location:$url");
  return $go;
}

function git($str){
  $str=header("Location:".$str."");
  return $str;
}

function guvenlik($result)
{
$bad=array("'","*","?","select","all","SELECT","ALL","concat","+","(",")","union",",","group");

$good=array("_","_","_","_","_","_","_","_","_","_","_","_","_","_");

$result=str_replace($bad,$good,$result);

$result=strip_tags(trim(addslashes($result)));
return $result;

}

function ip_al(){
 if(getenv("HTTP_CLIENT_IP")) {
   $ip = getenv("HTTP_CLIENT_IP");
 } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
   $ip = getenv("HTTP_X_FORWARDED_FOR");
   if (strstr($ip, ',')) {
     $tmp = explode (',', $ip);
     $ip = trim($tmp[0]);
   }
 } else {
 $ip = getenv("REMOTE_ADDR");
 }
 return $ip;
}

function isletimsistemi() {
 $tespit=$_SERVER['HTTP_USER_AGENT'];
 if(stristr($tespit,"Windows 95")) { $os="Windows 95"; }
 elseif(stristr($tespit,"Windows 98")) { $os="Windows 98"; }
 elseif(stristr($tespit,"Windows NT 5.0")) { $os="Windows 2000"; }
 elseif(stristr($tespit,"Windows NT 5.1")) { $os="Windows XP"; }
 elseif(stristr($tespit,"Windows NT 6.0")) { $os="Windows Vista"; }
 elseif(stristr($tespit,"Windows NT 6.1")) { $os="Windows 7"; }
 elseif(stristr($tespit,"Windows NT 6.2")) { $os="Windows 8"; }
 elseif(stristr($tespit,"Mac")) { $os="Mac"; }
 elseif(stristr($tespit,"Linux")) { $os="Linux"; }
 else {$os="Windows";}
 return $os;
 }
 function cevir($sayi, $separator) {
  $sayarr = explode($separator,$sayi);

  $str = "";
  $items = array(
      array("", ""),
      array("BIR", "ON"),
      array("IKI", "YIRMI"),
      array("UC", "OTUZ"),
      array("DORT", "KIRK"),
      array("BES", "ELLI"),
      array("ALTI", "ALTMIS"),
      array("YEDI", "YETMIS"),
      array("SEKIZ", "SEKSEN"),
      array("DOKUZ", "DOKSAN")
  );

  for ($eleman = 0; $eleman<count($sayarr); $eleman++) {

      for ($basamak = 1; $basamak <=strlen($sayarr[$eleman]); $basamak++) {
          $basamakd = 1 + (strlen($sayarr[$eleman]) - $basamak);


          try {
              switch ($basamakd) {
                  case 6:
                      $str = $str . " " . $items[substr($sayarr[$eleman],$basamak - 1,1)][0] . " YUZ";
                      break;
                  case 5:
                      $str = $str . " " . $items[substr($sayarr[$eleman],$basamak - 1,1)][1];
                      break;
                  case 4:
                      if ($items[substr($sayarr[$eleman],$basamak - 1,1)][0] != "BIR") $str = $str . " " . $items[substr($sayarr[$eleman],$basamak - 1,1)][0] . " BIN";
                      else $str = $str . " BIN";
                      break;
                  case 3:
                      if($items[substr($sayarr[$eleman],$basamak - 1,1)][0]=="") {
                          $str.=" ";
                      }
                      elseif ($items[substr($sayarr[$eleman],$basamak - 1,1)][0] != "BIR" ) $str = $str . " " . $items[substr($sayarr[$eleman],$basamak - 1,1)][0] . " YUZ";

                      else $str = $str . " YUZ";
                      break;
                  case 2:
                      $str = $str . " " . $items[substr($sayarr[$eleman],$basamak - 1,1)][1];
                      break;
                  default:
                      $str =  $str . " " . $items[substr($sayarr[$eleman],$basamak - 1,1)][0];
                      break;
              }
          } catch (Exception $err) {
              echo $err->getMessage();
              break;
          }
      }
      if ($eleman< 1) $str = $str . " TL";
      else {
          if ($sayarr[1] != "00") $str = $str . " KRS";
      }
  }
  return $str;
}

function dtarih($str){
  $p=explode("-",$str);
  $yeni=$p[2].".".$p[1].".".$p[0];
  return $yeni;
}
function starih($str){
  $p=explode(".",$str);
  $yeni=$p[2]."-".$p[1]."-".$p[0];
  return $yeni;
}




function logg($durum,$islem){
  global $db;
  $ip=ip_al();
  $zaman=tarih()." ".saat();
  $tarayici=tarayici();
  $sistem=isletimsistemi();
  $db->query("insert into log (user, ip, tarayici, sistem, zaman, durum, islem) VALUES ('user','$ip','$tarayici','$sistem','$zaman','$durum','$islem')");


}
