<?php

// Works on my box!

$encoded_encrypted = "TfWJ3VMgayJaBWiIf16ctbe1N+msdWkMQyo381eRuglwLKLutKBj/Nn4DBxQlnp44FBs26RJuPdahRegovNov5jgZkNIpOFDf6qJPoGbwfBsZpnwVm7slo7peobEQi64o8hjXZAkePxvlExPNSZv6elUpzq1/D3YOr0ki9+54Lw=";

$encrypted = base64_decode($encoded_encrypted);
$decrypted = "";

$private_key = <<<PRIVATEKEY
-----BEGIN PRIVATE KEY-----
MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAKFVDjZPSxRG3dsJ
f28pqV/4Q0SRVByz8aX+fO4G6iPsl7p9VYkIg+irhmMM8KJ5p7f4daULkMuogx5d
wOISZD/eTj1juULlLXDrOMRzoc9Yrrxc2L3osgPMHtoKDvGTk5/N2z/iSxXhHquz
IlSgqsDP2EFNBANJaj21GTikkXQlAgMBAAECgYBv7Q1mGk7RK3UhUA6L9ZBfV2J7
wINlQmXErrDHhh6Me8isBeYAotq44b7jGwgbAGGeXY5oyYRT9n245Hw7m1zWZIwB
YXIXQT0gWciISQDZKzUdcEikhhXiRG21ITHvovetQvokwZMVWpDsRoYgrk7Shl2m
aT04TxfGWUDKzpv5AQJBAMxJ/y8V2xBznqNm5Ss57Wi0R6j40zTDCa/emwE3ejY7
jn67zDFvYMh0fTsa0di4DUXNzzT/Wc5NW8neuvYQTMECQQDKK3FQ/ZoAijlNMSIu
UEGWWeNzlHyVe1BsauTQCR3YthEaSj1AZXlNiIBCj2xej1jjRuVBEmt3HV6vGwzV
cixlAkAcdN5IB8pZE1Hwvv+DMvGAGUS2I9r/yX9K8T40QC8U6NzjiHNcG4Cmy5s6
JXU/s/udUprfbgZrd1km2JDAf+rBAkAx98bMI8IafA9pmsk99SwgwxrKiFq6f34D
LfBb0sUDuQxFGTBGaE4w8Znx2Y0JWhi4I9+p06moCSRL1z22y79ZAkA0xMz7B9uH
f7k/ikRPTy4P94zMt8CscRAQ/wWVIHUnNOPNyzO1XDq22kp2w0Uo1L/UNmBlJIsn
diazJ02zGoL0
-----END PRIVATE KEY-----
PRIVATEKEY;
$key = openssl_get_privatekey($private_key);

openssl_private_decrypt($encrypted, $decrypted, $key);
echo "Decrypted Base64 String: " . $decrypted;

?>