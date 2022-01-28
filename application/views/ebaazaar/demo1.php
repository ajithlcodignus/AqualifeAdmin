<html>
<head>
    <title>The Materialize Dialogs Example</title>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet"
          href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet"
          href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript"
            src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
    </script>

    <script>
        $(function()
        {
            alert("HARI");
            Materialize.toast('Login successful!', 3000, 'rounded');
        });
        function showToast(message, duration) {
            Materialize.toast(message, duration);
        }

        function showToast1(message, duration) {
            Materialize.toast('<i>'+ message + '</i>', duration);
        }

        function showToast2(message, duration) {
            Materialize.toast(message, duration, 'rounded');
        }

        function showToast3(message, duration) {
            Materialize.toast('Hello World!', duration, '', function toastCompleted() {
                alert('Toast dismissed!');
            });
        }
    </script>
</head>

<body class = "container">
<h4>Toasts</h4>
<a class = "btn" onclick = "showToast('Hello World!', 3000)">Normal Alert!</a>
<a class = "btn" onclick = "showToast1('Hello World!', 3000)">Italic Alert!</a>
<a class = "btn" onclick = "showToast2('Hello World!', 3000)">Rounded Alert!</a>
<br/><br/>
<a class = "btn" onclick = "showToast3('Hello World!', 3000)">Callback Alert!</a>

<h4>Tooltips</h4>
<a class = "btn tooltipped" data-position = "bottom" data-delay = "50"
   data-tooltip = "I am in bottom!">Bottom</a>
<a class = "btn tooltipped" data-position = "left" data-delay = "50"
   data-tooltip = "I am in left!">Left</a>
<a class = "btn tooltipped" data-position = "right" data-delay = "50"
   data-tooltip = "I am in right!">Right</a>
<a class = "btn tooltipped" data-position = "top" data-delay = "50"
   data-tooltip = "I am in top!">Top</a>
</body>
</html>