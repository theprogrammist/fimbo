<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Подтверждение электронной почты для регистрации</h2>

<div>
    Благодарим за регистрацию на портале Юный Предприниматель,
    перейдите по ссылке ниже для окончательного этапа - подтверждения
    электронной почты.
    {{ URL::to('register/verify/' . $confirmation_code) }}<br/>

</div>

</body>
</html>