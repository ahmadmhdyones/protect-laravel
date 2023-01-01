# Protect PHP Source Code

## Introduction

Many PHP developers need to protect their application source code before they distribute it to their customers and make it difficult for others to modify it without their permission.

- There are couple of techniques to protect PHP source code:

  - Making the code difficult to read – which involves in minification & obfuscation

  - **Encoding the source code.**

- There are list  of commercial PHP encoders (Zend, ionCube, SourceGuardian, NuCoder, etc).

- A free encoder called **phpBolt** saves you from buying commercial encoders. phpBolt helps to protect your PHP source code by encrypting and decrypting code using a key.

### Benifits of Encoding

- Anyone can reuse your PHP script to any web server or localhost. phpBolt will encrypt your source code with a key.
- Advance Protection -- Generate a specific key for each customer.
- Online Encryption -- Encrypt source code from online also possible.
- Encrypt PHP source code and obfuscate the PHP source code.
- Prevent your PHP product from the nulled world.

## phpBolt encoder

- The author doesn't care about issues! The author will help you only if you pay for that[^1]. (he cannot provide free support[^2])
- phpBolt loader is an extension used to load PHP files protected and encoded using PHP encoder.

### Guide

1. **Download phpBolt extension**

    - In order to use phpBolt, you need to [download loader extension](https://phpbolt.com/download-phpbolt/). Look for `bolt.so` inside the corresponding platform folder. ([extension](./assets/phpBolt-extension-1.0.3.zip))

    - Or, directly using following wget command:

        ```sh
        cd /tmp
        # For 64-bit System
        wget https://phpbolt.com/wp-content/uploads/2019/09/phpBolt-extension-1.0.1.zip
        ```

    - Then unzip the downloaded file using the tar command and move into the decompressed folder.

    - This is a mandatory step. Because PHP engine needs to identify then functions `bolt_encrypt` and `bolt_decrypt` functions.

2. **Install bolt.so extension for PHP**

    - There will be different phpBolt loader files for various PHP versions, you need to select the right phpBolt loader for your installed PHP version on your server.

    - Next, find the location of the extension directory for PHP version **7.4.28** (for example), it is where the phpBolt loader file will be installed. The specified directory from the output of this command:

        ```sh
        php -i | grep extension_dir
        # output:
        # extension_dir => /usr/lib/php/20190902 => /usr/lib/php/20190902
        ```

    - Copy `bolt.so` from the respective platform folder into the folder where all PHP extensions are stored. In my case, `/usr/lib/php/20190902` was the folder that stores all PHP extensions.

3. **Configure phpBolt Loader for PHP**

    - Find the `php.ini` file and add `extension='/usr/lib/php/20190902/bolt.so'` in `php.ini` file. Then restart your server. Please choose correct `bolt.so` file. `bolt.so` is diffrent for each version and OS.

    - Open `php.ini` as following: `sudo nano /etc/php.ini`

    - Add `blot.so` extension: `extension='/absolute-path/bolt.so'`

    - ==Note:== You will be encrypting using CLI, then you have to add extension in: `/etc/php/7.2/cli/php.ini` file, and in: `php/7.2/apache2/php.ini` file to decode the source code[^3]. (*Don't forget to restart server*)
    - Remember to replace absolute-path with the path of the extension. In my case: `extension='/usr/lib/php/20190902/bolt.so'`

    - Now we need to restart the Apache, Nginx, or php-fpm web server for the phpBolt loaders to come into effect.

    - Now you have successfully setup bolt loader extension.

4. **Test phpBolt Loader**

    - Test sample encrypted file. Download sample encrypted php file for testing. It is "hellow world" program.

    - [Encrypted file](./assets/phpBolt-encrypt.zip) (before any modification)

    - See the encryption file after modifications [here](./tests/Feature/phpBolt-encrypt/index.php).

    - Run the decrypted file `php test/phpBolt-encrypt/encrypted/hello/index.php`, it should print "hellow world" statement.

5. **Encrypt PHP code**

    - See the encrypted sample in **`/tests`** [here](./tests/Feature/phpBolt-encrypt/).

## Protect Larave Source Code

- It is based on phpBolt extension, it encrypts your php code with phpBolt.

- To install and use it in your Laravel project, follow this guide [here](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/blob/master/README.md).

- There is no way to encrypt blade files[^4]. (*blade files are not real PHP files*)
  - [Blade file is not decrypted](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/21)
  - [Cannot convert resources/views folder](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/20)

- There is no way to decrypt the source code, the **only one who will have the source code is you**[^5].

- You may face some problems/issues when you use encryption commands:

  - [failed to open stream: No such file or directory](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/13) (*just modify the `Laravel-Source-Encrypter/src/SourceEncryptCommand.php` file*[^6])

  - You may run the encryption command and everything went well, but you got an exception about `.gitignore`. You don't have to worry about that. Keep going and ignore that exception.

## See Also

### phpBolt

- [Is phpBolt encoder is better than commercial encoders?](https://techglimpse.com/php-encoders-protect-source-code/#is-phpbolt-encoder-is-better-than-commercial-encoders)
- [Will this make application slow?](https://github.com/arshidkv12/phpBolt/issues/16)
- [bolt_decrypt function will get the original code?](https://github.com/arshidkv12/phpBolt/issues/5)
- [Use of undefined constant PHP_BOLT_KEY - assumed 'PHP_BOLT_KEY'](https://github.com/arshidkv12/phpBolt/issues/17)
- [Codeigniter encrypt Controller file](https://github.com/arshidkv12/phpBolt/issues/2)
- [Namespace declaration statement has to be the very first statement or after any declare call in the script](https://github.com/arshidkv12/phpBolt/issues/4). (*this is a common issue, which appears when we encrypt laravel code by manual encryption file*)

### Laravel-Source-Encrypter

- [Will this make application slow?](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/11)
- [Cron stuck when code encrypted](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/19)
- [.env or config file Encryption](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/4) (#upcoming)

## Run project

- Install packages and dependencies

    ```sh
    composer install
    ```

- Add environment variables file `.env`
  - copy the `.env.example` file and past it as `.env`
  - Generate app key

    ```sh
    php artisan key:generate
    ```

- You have to install Laravel-Source-Encrypter to be able run `php artisan serve`.

- You cannot run the project if you don't configure the phpBolt, because the `/app` directory is encrypted, and it needs to be decrypted if you want to run it.

## References

- [phpBolt – Website](https://phpbolt.com/)
- [phpBolt – GitHub](https://github.com/arshidkv12/phpBolt)
- [Laravel-Source-Encrypter – GitHub](https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter)
- [phpBolt – Download The Encryption Source Code](https://phpbolt.com/how-to-encrypt-php-source-code/)
- [How to Install phpBolt Loader in CentOS 7](https://www.appteam.it/how-to-install-phpbolt-loader-in-centos-7/) (#full_guide)
- [Using PHP encoders to Protect Source Code [phpBolt example]](https://techglimpse.com/php-encoders-protect-source-code/)

[^1]: https://github.com/arshidkv12/phpBolt/issues/4#issuecomment-665661712
[^2]: https://github.com/arshidkv12/phpBolt/issues/1#issuecomment-527397984
[^3]: https://github.com/arshidkv12/phpBolt/issues/1#issuecomment-1279435602
[^4]: https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/25#issuecomment-1310626116
[^5]: https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/27#issuecomment-1313151901
[^6]: https://github.com/SiavashBamshadnia/Laravel-Source-Encrypter/issues/13#issuecomment-1118414546
