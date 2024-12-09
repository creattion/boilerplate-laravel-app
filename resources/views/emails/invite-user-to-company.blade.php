<!doctype html>
<html lang="pt-br">
<head>
  <title>Convite</title>
</head>
<body style="font-family: 'Arial', sans-serif; font-size: 16px; text-align: center; padding: 20px;">

<h1 style="font-size: 24px; font-weight: bold;">
  {{ config('app.name') }}
</h1>

<br/>
<br/>

Você foi convidado para se juntar à equipe <strong>{{ $company->name }}</strong> no {{ config('app.name') }}.

<br/>
<br/>
Se você não tem uma conta, você pode criar uma clicando no botão abaixo. Após criar uma conta, você pode clicar no botão
de aceitação de convite neste e-mail para aceitar o convite da equipe:

<br/>
<br/>

<a href="{{ route('register') }}"
   style="display: inline-block; padding: 10px 20px; background-color: #a855f7; color: #fff; text-decoration: none; border-radius: 5px;">
  Criar conta
</a>

<br/>
<br/>

Se você já tem uma conta, você pode aceitar este convite clicando no botão abaixo:

<br/>
<br/>

<a href="{{ $url }}"
   style="display: inline-block; padding: 10px 20px; background-color: #a855f7; color: #fff; text-decoration: none; border-radius: 5px;">
  Clique aqui para aceitar
</a>

<br/>
<br/>
Se você não esperava receber um convite para esta equipe, você pode descartar este e-mail.

<br/>
<br/>

<div style="font-size: 12px;">
  <p>
    <strong>Atenciosamente,</strong><br/>
    Equipe {{ config('app.name') }}
  </p>
</div>

</body>
</html>
