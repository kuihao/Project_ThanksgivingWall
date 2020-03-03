<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';//引入文件:可能包含"phpmailer/class.phpmailer.php") 

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);//宣告一個PHPMailer物件

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP//設定使用SMTP發送 $mail->IsSMTP();
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through//指定SMTP的服務器位址
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication//設定為安全驗證方式
    $mail->Username   = 'testing.pckh@gmail.com';                     // SMTP username: //SMTP的帳號
    $mail->Password   = 'Password=123';                               // SMTP password: //SMTP的密碼
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    //$mail->SMTPSecure = "ssl";  
    $mail->Port       = /*465*/587;                                    //*465? 587?* TCP port to connect to//設定SMTP服務的POST

    //Recipients
    $mail->setFrom('testing.pckh@gmail.com', '感恩牆');//寄件人信箱、名稱
    //$mail->addAddress('41053A041@gms.ndhu.edu.tw', 'You(custimize name)');     // Add a recipient//設定收件人的另一種格式("Email","收件人名稱")
    $mail->addAddress('41053A041@gms.ndhu.edu.tw');               // Name is optional//收件人Email
    $mail->addReplyTo('testing.pckh@gmail.com', '感恩牆');//回信Email及名稱
    //$mail->addCC('cc@example.com');//設定副本
    //$mail->addBCC('bcc@example.com');//設定密件副本
    $mail->CharSet="utf-8";//設定信件字元編碼
    //$mail->Encoding = "base64";//設定信件編碼，大部分郵件工具都支援此編碼方式

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments//傳送附檔
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name//傳送附檔的另一種格式，可替附檔重新命名

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML//設置郵件格式為HTML
    $mail->Subject = '感恩牆測試信';//郵件標題
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';//郵件內容
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';//附加內容
    //$mail->WordWrap = 50;//每50字自動換行

    $mail->send();//寄送郵件
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>