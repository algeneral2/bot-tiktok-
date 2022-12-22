<?php
ob_start();
define('API_KEY', '5864068567:AAG_qjKmvmRJjdmKpnLVcikPfFT9a2fAr4M');
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);

function bot($method, $datas = [])
  {
  $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
  $res = curl_exec($ch);
  if (curl_error($ch))
    {
    var_dump(curl_error($ch));
    }
    else
    {
    return json_decode($res);
    }
  }
$update      = json_decode(file_get_contents('php://input'));
$admin = 5321637533;
if(isset($update->message)){
$chat_id     = $update->message->chat->id;
$from_id     = $update->message->from->id;
$text        = $update->message->text;
$msg_id      = $update->message->message_id;
$name        = $update->message->from->first_name;
$message     = $update->message;
}

if(isset($update->callback_query)){
  $chat_id       = $update->callback_query->message->chat->id;  
  $from_id       = $update->callback_query->from->id;  
  $data           = $update->callback_query->data;  
  $msg_id       = $update->callback_query->message->message_id;
}

$SeroBots = json_decode(file_get_contents("http://sero2link.ml/API/V1/TikTok.php?URL=$text"));
$TikTok = $SeroBots->url;
$TikTok2 = $SeroBots->Veiws;
$TikTok3 = $SeroBots->Likes;
$TikTok4 = $SeroBots->Download;
$TikTok5 = $SeroBots->Comments;
$TikTok6 = $SeroBots->Explore;
$TikTok7 = $SeroBots->Title;
$TikTok8 = $SeroBots->Likes;
$TikTok9 = $SeroBots->Music;
$TikFake = $SeroBots->TikFake;
$TikSpeed = $SeroBots->Speed;

$TikkTok = json_decode(file_get_contents("TikkTok.json"),true);

$urls = explode("\n",file_get_contents("urls.txt"));
$Count = $TikkTok["Count"]["Videos"];
$CountMsg = $TikkTok["Count"]["Msg"];

if (!file_exists("TikkTok.json")) {
#	$put = [];
$TikkTok["Count"]["Videos"]="0";
$TikkTok["Count"]["Msg"]="0";
file_put_contents("TikkTok.json", json_encode($TikkTok));
}

if($text == $TikFake){
if($chat_id == $admin){
	bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"*
اهلا بك عزيزي المطور .
هذه قائمتك الخاصه بلبوت .
*

احصائيات التنزيل : *$Count* تنزيلات
سرعه الايبي : $TikSpeed
عدد الرسائل داخل البوت : *$CountMsg*

*اخر 5 روابط تم تنزيلها .*
1 - $urls[0]
2 - $urls[1]
3 - $urls[2]
4 - $urls[3]
5 - $urls[4]
",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Cʜᴀɴɴᴇʟッ",'url'=>"https://t.me/SeroBots"]],
],
])
]); 
}
}





    if($text == $TikFake){
	bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"
• اهلا بك $name
• بوت تحميل من التيك توك . 
• لتحميل فديو وصوت ارسل رابك المنشور .
• التحميل بدون علامة مائية او اي حقوق اخرى.
",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Cʜᴀɴɴᴇʟッ",'url'=>"https://t.me/SeroBots"]],
],
])
]); 
$TikkTok["Count"]["Msg"]+=1; 
file_put_contents("TikkTok.json", json_encode($TikkTok));
}

if(preg_match('(https://vm.tiktok.com/)',$text)){
    file_put_contents("urls.txt", $text."\n",FILE_APPEND);
bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"يرجي الانتضار . .",
]); 
    bot('sendvideo',[
        'chat_id'=>$chat_id,
         'video'=>$TikTok,
         'caption'=>"*✮ وصف الفيديو :*  `$TikTok7`",
         'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
         'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عدد اللايكات :",'callback_data'=>"like"],['text'=>"( $TikTok3 )",'callback_data'=>"To"]],
[['text'=>"المشاركات : ",'callback_data'=>"like"],['text'=>"( $TikTok6 )",'callback_data'=>"To"]],
[['text'=>"عدد المشاهدات :",'callback_data'=>"se"],['text'=>"( $TikTok2 )",'callback_data'=>"do"]],
[['text'=>"عدد التعليقات : ",'callback_data'=>"se"],['text'=>"( $TikTok5 )",'callback_data'=>"do"]],
[['text'=>"عدد التحميلات :",'callback_data'=>"like"],['text'=>"( $TikTok4 )",'callback_data'=>"To"]],
],
])
]);
bot('sendaudio',[
'chat_id'=>$chat_id,
'audio'=>$TikTok9,
'caption'=>$TikTok7,
]);
$TikkTok["Count"]["Videos"]+=1; 
file_put_contents("TikkTok.json", json_encode($TikkTok));
}

if(!preg_match('(https://vm.tiktok.com/)',$text)){
if($text !== $TikFake){
	bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"عذرًا، لم أفهم هذه الرسالة. يُرجى إرسال الأمر:
/start",
]); 
$TikkTok["Count"]["Msg"]+=1; 
file_put_contents("TikkTok.json", json_encode($TikkTok));
}
}
