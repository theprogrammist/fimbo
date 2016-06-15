<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Подтверждение электронной почты для регистрации</h2>

<div>
    Благодарим за регистрацию на портале Fimbo.ru. Перейдите по ссылке ниже для завершения регистрации.<br/><br/>
    {{ URL::to('register/verify/' . $confirmation_code) }}<br/>

</div>

</body>
</html>