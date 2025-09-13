<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar e sanitizar os dados do formulário
    $nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $produto = filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validar os dados
    $erros = [];

    if (empty($nome)) {
        $erros[] = "O campo nome é obrigatório.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Por favor, forneça um e-mail válido.";
    }

    if (empty($mensagem)) {
        $erros[] = "A mensagem é obrigatória.";
    }

    // Se não houver erros, enviar o e-mail
    if (empty($erros)) {
        $destinatario = "casa.aureastore@gmail.com"; 
        $assunto = "Novo contato do site - Casa Áurea Store: " . $produto;

        $corpo = "Você recebeu uma nova mensagem do formulário de contato:\n\n";
        $corpo .= "Nome: " . $nome . "\n";
        $corpo .= "E-mail: " . $email . "\n";
        $corpo .= "Produto de Interesse: " . $produto . "\n";
        $corpo .= "Mensagem: " . $mensagem . "\n";

        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Enviar e-mail
        if (mail($destinatario, $assunto, $corpo, $headers)) {
            // Redirecionar com mensagem de sucesso
            header('Location: index.html?status=sucesso');
            exit;
        } else {
            header('Location: index.html?status=erro');
            exit;
        }
    } else {
        // Se houver erros, redirecionar com mensagem de erro
        header('Location: index.html?status=erro_validacao');
        exit;
    }
} else {
    // Se não for POST, redirecionar para o formulário
    header('Location: index.html');
    exit;
}
?>