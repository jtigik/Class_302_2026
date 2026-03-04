// =============================================
// SCRIPT PRINCIPAL - Conexão Front-End com Back-End
// Todas as funções assíncronas (async/await) para evitar travamento
// =============================================

// === PRODUTOS ===
async function listarProdutos() {
    // Busca os produtos do banco via API
    const res = await fetch('api/produtos.php');
    const data = await res.json();
    document.getElementById('tabela-produtos').innerHTML = data.map(p => `
        <tr><td>${p.nome}</td><td>R$ ${parseFloat(p.preco).toFixed(2)}</td><td>${p.estoque}</td></tr>
    `).join('');
}

async function cadastrarProduto(e) {
    e.preventDefault();                     // Evita recarregar a página
    const obj = {
        nome: document.getElementById('nomeP').value,
        preco: document.getElementById('preco').value,
        estoque: document.getElementById('estoque').value
    };
    await fetch('api/produtos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(obj)
    });
    alert('Produto cadastrado com sucesso!');
    window.location.href = 'listagem-produtos.html';
}

// === CLIENTES e PEDIDOS seguem o mesmo padrão (funções listarClientes, cadastrarCliente, etc.)