


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $message = htmlspecialchars($_POST['message']);

    // إرسال البيانات إلى البريد الإلكتروني
    $to = "482300926@aswan1.moe.edu.eg"; // البريد الذي سيستقبل الرسائل
    $subject = "طلب دعم جديد من $first_name";
    $body = "اسم الأول: $first_name\nالبريد الإلكتروني: $email\nالعنوان: $address\nالرسالة: $message";
    $headers = "من: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "<p class='success'>تم إرسال الرسالة بنجاح. شكرًا للتواصل معنا.</p>";
    } else {
        echo "<p class='error'>حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة لاحقًا.</p>";
    }
} else {
    echo "<p class='error'>وصول غير مصرح به.</p>";
}
if (mail($to, $subject, $body, $headers)) {
    echo "<p class='success'>تم إرسال الرسالة بنجاح. شكرًا للتواصل معنا.</p>";
} else {
    echo "<p class='error'>حدث خطأ أثناء إرسال الرسالة. تأكد من إعدادات البريد أو حاول لاحقًا.</p>";
    error_log("Mail error: " . error_get_last()['message']);
}

?>
