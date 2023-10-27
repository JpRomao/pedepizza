<?php
function generateKey()
{
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $chars .= '!@#$%^&*()_-=+;:,.?';

  $key = '';
  for ($i = 0; $i < 32; $i++) {
    $key .= $chars[rand(0, strlen($chars) - 1)];
  }

  return $key;
}

function verifyKeyIsValid($key)
{
  if (!isset($key) || empty($key) || !is_string($key) || strlen($key) !== 32) {
    return false;
  }

  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $chars .= '!@#$%^&*()_-=+;:,.?';

  for ($i = 0; $i < 32; $i++) {
    if (strpos($chars, $key[$i]) === false) {
      return false;
    }
  }

  return true;
}
