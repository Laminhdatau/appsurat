<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail = 'devminjeey.web@gmail.com';
    public string $fromName = 'WEB DEV';
    public string $recipients = ''; 

    public string $userAgent = 'CodeIgniter';

    public string $protocol = 'smtp';

    public string $mailPath = '/usr/sbin/sendmail';

    public string $SMTPHost = 'smtp.gmail.com'; 

    public string $SMTPUser = 'devminjeey.web@gmail.com';
    public string $SMTPPass = 'ffmfeicartlelybn';

    public int $SMTPPort = 465;
    public int $SMTPTimeout = 60;
    public bool $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'ssl';

    public bool $wordWrap = true;
    public int $wrapChars = 76;

    public string $mailType = 'html';
    public string $charset = 'UTF-8';
    public bool $validate = false;
    public int $priority = 3;

    public string $CRLF = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;
}
