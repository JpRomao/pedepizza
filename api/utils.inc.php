<?php

function transformCamelCaseToKebabCase(string $string)
{
  return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $string));
}

function makePathByClass(string $class)
{
  $archiveName = explode('\\', $class);

  foreach ($archiveName as $key => $value) {
    $archiveName[$key] = transformCamelCaseToKebabCase($value);
  }

  $lastIndex = count($archiveName) - 1;

  if (strpos($archiveName[$lastIndex], 'use-case') !== false) {
    $archiveName[$lastIndex] = str_replace('-use-case', '', $archiveName[$lastIndex]);
  }


  $archiveName = implode('/', $archiveName);
  $archiveName = strtolower($archiveName);

  return $archiveName;
}
