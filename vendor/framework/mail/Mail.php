<?

namespace vendor\framework\mail;

abstract class Mail
{
    public static function __callStatic($method, $parameters): Message
    {
        $object = new self;
        if (method_exists($object, $method)) {
            return $object::$method($parameters);
        } else {
            return (new Message())->$method(...$parameters);
        }
    }

    public static function to(array|string $users)
    {
        return (new Message())->to(...$users);
    }

    public static function cc(array|string $users)
    {
        return (new Message())->cc(...$users);
    }

    public static function bcc(array|string $users)
    {
        return (new Message())->bcc(...$users);
    }

    public static function from(array|string $address, array|string $name = null)
    {
        return (new Message())->from(...$address);
    }

    public static function subject(string $subject)
    {
        return (new Message())->subject($subject);
    }

    public static function text($view, array $data = [])
    {
        return (new Message())->text($view, $data);
    }

    public static function send($view = null, array $data = []): bool
    {
        return (new Message())->send($view, $data);
        return false;
    }
}
