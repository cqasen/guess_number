<html>
<head>
    <title>猜数字</title>
</head>
<body>
<form method="post" action="javascript:void(0)">
    <label>猜数字 1 - 20:</label>
    <input name="num">
    <input type="hidden" name="uid" value="1">
    <button type="button" id="but">提交</button>
    <br/>
    <span id="result"></span>
</form>
</body>

<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.js"></script>
<script>
    $(document).ready(function () {
        var uid = $("input[name='uid']").val();
        $.post('do.php', {'do': 'generate', 'num': 0, 'uid': uid}, function (data) {
            console.info(data);
        });
    });
    $("#but").on('click', function () {
        var num = $("input[name='num']").val();
        var uid = $("input[name='uid']").val();
        $.post('do.php', {'do': 'guess', 'num': num, 'uid': uid}, function (data) {
            console.info(data);
            $("#result").html(data);
        });
    });
</script>
</html>