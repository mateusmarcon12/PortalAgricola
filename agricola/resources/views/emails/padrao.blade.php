<h3>Portal de Trocas Agricolas</h3>

<h4>O seguinte usuário abriu negociação com você:
{{$remetente}}</h4>

<h4>Vá até o portal e continue a negociação ou finalize. enquanto a negociação estiver em aberto, o seu anuncio não será exibido para os demais anunciantes.</h4>

<h4>Mensagem:</h4>
<p>
{{$mensagem}}
</p>
@isset($titulo)
<h4>O remetente sugeriu o seguinte anúncio:</h4>
Título: {{$titulo}} <br>
Validade: {{$validade}}<br>
@endisset
<p>Para responder a mensagem ao usuário envie e-mail para {{$remetente}}</p>