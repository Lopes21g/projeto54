<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Pisos/Azulejos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Cálculo de Pisos/Azulejos</h1>
        <form id="tileForm">
            <div class="form-group">
                <label for="largura_comodo">Largura do cômodo (m):</label>
                <input type="number" step="0.01" class="form-control" id="largura_comodo" required>
            </div>
            <div class="form-group">
                <label for="comprimento_comodo">Comprimento do cômodo (m):</label>
                <input type="number" step="0.01" class="form-control" id="comprimento_comodo" required>
            </div>
            <div class="form-group">
                <label for="largura_piso">Largura do piso/azulejo (m):</label>
                <input type="number" step="0.01" class="form-control" id="largura_piso" required>
            </div>
            <div class="form-group">
                <label for="comprimento_piso">Comprimento do piso/azulejo (m):</label>
                <input type="number" step="0.01" class="form-control" id="comprimento_piso" required>
            </div>
            <div class="form-group">
                <label for="margem_extra">Porcentagem de margem extra (opcional):</label>
                <input type="number" step="0.01" class="form-control" id="margem_extra" value="0">
            </div>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        <div class="row mt-4" id="orderCards"></div>
    </div>

    <script>
        document.getElementById('tileForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const larguraComodo = parseFloat(document.getElementById('largura_comodo').value);
            const comprimentoComodo = parseFloat(document.getElementById('comprimento_comodo').value);
            const larguraPiso = parseFloat(document.getElementById('largura_piso').value);
            const comprimentoPiso = parseFloat(document.getElementById('comprimento_piso').value);
            const margemExtra = parseFloat(document.getElementById('margem_extra').value) || 0;

            // Cálculo da área
            const areaComodo = larguraComodo * comprimentoComodo;
            const areaPiso = larguraPiso * comprimentoPiso;

            // Cálculo da quantidade necessária de pisos/azulejos
            let quantidadeNecessaria = Math.ceil(areaComodo / areaPiso);
            if (margemExtra > 0) {
                quantidadeNecessaria += Math.ceil(quantidadeNecessaria * (margemExtra / 100));
            }

            const createdAt = new Date();

            // Criar o card do pedido
            const card = document.createElement('div');
            card.className = 'col-md-4 mb-4';
            card.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pedido de Pisos/Azulejos</h5>
                        <p class="card-text">Quantidade necessária: ${quantidadeNecessaria} unidades</p>
                        <p class="card-text">Pedido criado há <span class="time-ago"></span> minutos.</p>
                    </div>
                </div>
            ` ;

            // Adicionar o card à lista de pedidos
            document.getElementById('orderCards').appendChild(card);

            // Calcular o tempo desde a criação do pedido
            const updateTime = () => {
                const now = new Date();
                const minutesAgo = Math.floor((now - createdAt) / 60000);
                card.querySelector('.time-ago').textContent = minutesAgo;
            };

            // Atualizar o tempo a cada minuto
            setInterval(updateTime, 60000);
            updateTime(); // Atualizar imediatamente
        });
    </script>
</body>
</html>