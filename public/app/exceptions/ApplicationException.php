<?php
namespace App\Exceptions;

class ApplicationException extends \Exception
{

   public const MISSING_CREDENTIALS = 0001;

    function __construct($errorType) {
        switch ($errorType) {
            case self::MISSING_CREDENTIALS:
                // lança a exeção customizada
                throw new \Exception('As credenciais para integração com API não foram encontradas');
                break;
            default:
                throw new \Exception($errorType);
                break;
        }
    }

    public function __destruct() {}
}
?>
