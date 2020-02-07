<?php
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

  echo "Plain value: $plaintext\n";
  echo "Encrypted value:\n";
  echo base64_encode($ciphertext);
?>