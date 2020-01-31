<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  // include 'File/X509.php';
  include 'Crypt/RSA.php';

  $rsa = new Crypt_RSA();

  $publicKeyFile = 'public_key.pem';
  if (!file_exists($publicKeyFile) || !is_readable($publicKeyFile)) {
    throw new \Exception('Public key file does not exist or is not readable.');
  }
  $public_key = file_get_contents($publicKeyFile);
  $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_OAEP);
  $rsa->setMGFHash('sha1');
  $rsa->setHash('sha256');
  $plaintext = '999';

  $rsa->loadKey($public_key);
  $ciphertext = $rsa->encrypt($plaintext);

  echo base64_encode($ciphertext);
?>