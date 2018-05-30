<h3>Portal de Trocas Agricolas</h3>

<h4>O seguinte usuário abriu negociação com você:
{{$remetente}}</h4>

<h4>Vá até o portal e continue a negociação ou finalize. enquanto a negociação em andamento, o seu anúncio não será exibido para os demais anunciantes.</h4>

<h4>Mensagem:</h4>
<p>
{{$mensagem}}
</p>
@isset($titulo)
<h4>O remetente sugeriu o seguinte anúncio:</h4>
Título: {{$titulo}} <br>
Validade: {{$validade}}<br>
@endisset
<p>Para responder está mensagem sem interção com o portal, envie e-mail para {{$remetente}}. Mensagens trocadas por e-mail não serão registradas na negociação dentro do portal.</p>