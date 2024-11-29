<?php
// تأكد من تحميل PHPMailer بشكل صحيح
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// تأكد من تضمين ملف autoload لمكتبة PHPMailer
require 'vendor/autoload.php'; // تأكد من مسار autoload إذا كنت تستخدم Composer

// إنشاء كائن PHPMailer
$mail = new PHPMailer(true);

try {
    // إعدادات الخادم
    $mail->isSMTP();                                           // استخدام SMTP
    $mail->Host       = 'smtp.gmail.com';                        // خادم البريد Gmail
    $mail->SMTPAuth   = true;                                    // تمكين المصادقة SMTP
    $mail->Username   = 'your-email@gmail.com';                  // عنوان البريد الإلكتروني
    $mail->Password   = 'your-email-password';                   // كلمة المرور الخاصة بالبريد
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // تفعيل التشفير TLS
    $mail->Port       = 587;                                     // المنفذ 587 لتشفير TLS

    // المستلمين
    $mail->setFrom('your-email@gmail.com', 'Your Name');         // من البريد الإلكتروني
    $mail->addAddress('evico.corp@gmail.com', 'Evico Corp');     // تغيير البريد الإلكتروني إلى الجديد

    // محتوى الرسالة
    $mail->isHTML(true);                                         // تحديد أن الرسالة بتنسيق HTML
    $mail->Subject = 'رسالة من صفحة الاتصال';                    // العنوان
    $mail->Body    = 'الاسم: ' . $_POST['name'] . '<br>Email: ' . $_POST['email'] . '<br>Message: ' . $_POST['message'];  // محتوى الرسالة

    // إرسال الرسالة
    $mail->send();

    // إرسال رسالة شكر للمستخدم
    echo '<script>alert("شكراً على رسالتك، تم إرسالها بنجاح!");</script>';

    // يمكنك إعادة توجيه المستخدم إلى صفحة شكر أو صفحة أخرى
    // echo '<script>window.location.href = "thankyou.html";</script>';

} catch (Exception $e) {
    echo "حدث خطأ أثناء إرسال الرسالة: {$mail->ErrorInfo}";  // عرض رسالة الخطأ إذا فشل الإرسال
}
?>
