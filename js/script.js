// === PRODUTOS ===
async function listarProdutos() {
    const res = await fetch('api/produtos.php');
    const data = await res.json();
    document.getElementById('tabela-produtos').innerHTML = data.map(p => `
        <tr><td>${p.nome}</td><td>R$ ${parseFloat(p.preco).toFixed(2)}</td><td>${p.estoque}</td></tr>
    `).join('');
}
async function cadastrarProduto(e) {
    e.preventDefault();
    const obj = {nome: document.getElementById('nomeP').value, preco: document.getElementById('preco').value, estoque: document.getElementById('estoque').value};
    await fetch('api/produtos.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(obj)});
    alert('Produto cadastrado!'); window.location.href = 'listagem-produtos.html';
}

// === CLIENTES ===
async function listarClientes() {
    const res = await fetch('api/clientes.php');
    const data = await res.json();
    document.getElementById('tabela-clientes').innerHTML = data.map(c => `
        <tr><td>${c.nome}</td><td>${c.email}</td><td>${c.telefone}</td></tr>
    `).join('');
}
async function cadastrarCliente(e) {
    e.preventDefault();
    const obj = {nome: document.getElementById('nomeC').value, email: document.getElementById('email').value, telefone: document.getElementById('telefone').value};
    await fetch('api/clientes.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(obj)});
    alert('Cliente cadastrado!'); window.location.href = 'listagem-clientes.html';
}

// === PEDIDOS ===
async function listarPedidos() {
    const res = await fetch('api/pedidos.php');
    const data = await res.json();
    document.getElementById('tabela-pedidos').innerHTML = data.map(p => `
        <tr><td>Pedido #${p.id}</td><td>Cliente ${p.cliente_id}</td><td>R$ ${parseFloat(p.total).toFixed(2)}</td><td>${p.data_pedido}</td></tr>
    `).join('');
}
async function cadastrarPedido(e) {
    e.preventDefault();
    const obj = {cliente_id: document.getElementById('cliente_id').value, total: document.getElementById('total').value};
    await fetch('api/pedidos.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(obj)});
    alert('Pedido cadastrado!'); window.location.href = 'listagem-pedidos.html';
}