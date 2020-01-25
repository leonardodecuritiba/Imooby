<html>
<head>
    <meta charset="utf-8">
    <title>Título da Mensagem</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700|Merriweather" rel="stylesheet" type="text/css">
    <style>h1, h2, h3 {
            font-family: "Raleway", serif;
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: "Raleway", sans-serif;
            color: #333;
            padding: 0px;
            margin: 0px;
        }</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr align="center">
        <td bgcolor="#00A7ED">
            <table width="500px" border="0" cellpadding="10">
                <tr align="center">
                    <td><img src="assets_site/img/logo_fundo_escuro.jpg" alt="logo" style="width: 100%"></td>
                </tr>
                <tr align="center">
                    <td style="padding: 40px;"><h1 style="color: #fff;">@yield('title_message')</h1></td>
                </tr>
                <tr align="center" bgcolor="#fff" style="box-shadow: 0 5px 10px rgba(0,0,0,.05)">
                    @yield('body_message')
                </tr>
            </table>
            <br>
    <tr align="center">
        <td bgcolor="#ccc"><p style="padding: 30px; font-size: 11px;">Esta é uma mensagem automática gerada pelo
                Sistema. Desconsidere respondê-la.</p></td>
    </tr>
</table>
</body>
</html>