Website Ferienwohnung Armbruster
================================

Installation
------------

- Make sure that [composer](https://getcomposer.org/) is installed. The
  projects' PHP dependencies are listed in the `composer.json` configuration
  file. Next invoke

    ```
    composer update
    ```

  inorder to install the required PHP dependencies into the `vendor/`
  directory. For further information, please refer to the [Composer
  documentation](https://getcomposer.org/doc/01-basic-usage.md).


- Besides, configure the correct SMTP password within the
  `booking_request.php` file.


Contact-Form
------------

The contact form uses the `booking@ferienwohnung-armbruster.de` email account
and relies on the [PHPMailer](https://github.com/PHPMailer/PHPMailer) package.

