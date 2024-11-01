<h1>Pedido Criado</h1>
<p>Olá, {{ $pedido->cliente->nome }}!</p>
<p>Seu pedido foi criado com sucesso. Aqui estão os detalhes:</p>
<ul>
    @foreach ($pedido->produtos as $produto)
        <li>{{ $produto->nome }} - Quantidade: {{ $produto->pivot->quantidade }}</li>
    @endforeach
</ul>
<p>Obrigado por comprar conosco!</p>
