<?php
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    

   // Lê o JSON enviado no corpo da requisição
    $data = json_decode(file_get_contents("php://input"));

    // Verifica se o JSON contém os valores esperados
    if (isset($data->numero1) && isset($data->numero2)) {
        // Realiza a soma
        $soma = $data->numero1 + $data->numero2;
        
        // Retorna a resposta em JSON
        echo json_encode(["soma" => $soma]);
    } else {
        // Retorna um erro se os valores não foram enviados corretamente
        echo json_encode(["erro" => "Valores numero1 e numero2 são necessários."]);
    }
} else {
    echo json_encode(['erro' => 'Método não suportado. Use o POST']);
}
?>