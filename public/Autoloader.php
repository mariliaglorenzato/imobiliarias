<?php
/**
 * Autload app directory
 */
class Autoloader
{

    public function __construct()
    {
        foreach (scandir(__DIR__ . '/app') as $key => $fileInfo) {
            if ($key === 0 || $key === 1) continue;
            if ($fileInfo === 'Application.php') continue;
            if(strpos($fileInfo, '.php') > -1) {
                require __DIR__ . '/app/' . $fileInfo;
            } else {
                foreach (scandir(__DIR__ . '/app/' . $fileInfo) as $keySub => $fileInfoSub) {
                    if ($keySub === 0 || $keySub === 1) continue;
                    if(strpos($fileInfoSub, '.php') > -1) {
                        require_once __DIR__ . '/app/' . $fileInfo . '/' . $fileInfoSub;
                    } else {
                        foreach (scandir(__DIR__ . '/app/' . $fileInfo . '/' . $fileInfoSub) as $keySubSub => $fileInfoSubSub) {
                            if ($keySubSub === 0 || $keySubSub === 1) continue;
                            if(strpos($fileInfoSubSub, '.php') > -1) {
                                require_once __DIR__ . '/app/' . $fileInfo . '/' . $fileInfoSub . '/' . $fileInfoSubSub;
                            }
                        }
                    }
                }
            }
        }
    }

    public function __destruct() {}
}
?>