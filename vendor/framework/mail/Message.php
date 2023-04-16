<?

namespace vendor\framework\mail;

use PHPMailer\PHPMailer\PHPMailer;

class Message
{
    private $phpMailer;
    private string $view = "";

    public function __construct()
    {
        $this->phpMailer = new PHPMailer(true);
        return $this;
    }

    public function build()
    {
    }

    public function to(string $mail, $name = null): Message
    {
        $this->phpMailer->addAddress($mail, $name); // получатель
        return $this;
    }

    public function from($adress = SMTP_MAIL, $name = null): Message
    {
        $this->phpMailer->setFrom($adress, $name); // отправитель
        return $this;
    }

    public function sender($adress, $name = null): Message
    {
        return $this;
    }

    public function cc($adress, $name = null): Message
    {
        return $this;
    }

    public function bcc($adress, $name = null): Message
    {
        return $this;
    }

    public function replayTo($adress, $name = null): Message
    {
        return $this;
    }

    public function subject($subject): Message
    {
        $this->phpMailer->Subject = $subject; // тема письма
        return $this;
    }

    public function priority($level): Message
    {
        return $this;
    }

    public function returnPath($address): Message
    {
        return $this;
    }

    public function view($view, array $data = []): Message
    {
        ob_start();
        include_once $view;
        $html = ob_get_contents();
        ob_end_clean();
        $this->phpMailer->Body = '<h1>Привет, мир!</h1>'; // содержимое письма в формате HTML
        return $this;
    }

    public function text(): Message
    {
        return $this;
    }

    public function attach($path, array $options = []): Message
    {
        return $this;
    }

    public function getPHPMailer(): PHPMailer
    {
        return $this->phpMailer;
    }

    public function send(): bool
    {
        $mail = $this->phpMailer;
        $mail->isSMTP(); // использование SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host = SMTP_HOST; // адрес SMTP-сервера
        $mail->SMTPAuth = true; // авторизация на SMTP-сервере
        $mail->Username = SMTP_MAIL; // имя пользователя для авторизации
        $mail->Password = SMTP_PASSWORD; // пароль для авторизации
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // шифрование TLS
        $mail->Port = SMTP_PORT; // порт SMTP-сервера

        // $mail->setFrom(SMTP_MAIL, SMTP_NAME); // отправитель
        // $mail->addAddress($this->to); // получатель
        $mail->addReplyTo(SMTP_MAIL, SMTP_NAME); // адрес для ответа
        $mail->isHTML(true); // используем HTML-формат письма
        // $mail->Subject = $this->subject; // тема письма
        // $mail->Body = '<h1>Привет, мир!</h1>'; // содержимое письма в формате HTML
        $mail->AltBody = 'Привет, мир!'; // содержимое письма в текстовом формате
        return $mail->send();
    }
}
