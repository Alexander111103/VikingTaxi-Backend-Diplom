<?php
if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo") 
{
    $conn = new mysqli("localhost", "root", "", "VikingTaxi");

    function form()
    { 
        global $conn;
        $isAccount = ($conn->query("SELECT COUNT(*) as 'count' FROM `users` WHERE `login_user` = '".$_COOKIE["login"]."' AND `password_user` = '".$_COOKIE["password"]."';"))->fetch_array()["count"];
        if($isAccount == '1'){

            $info = ($conn->query("SELECT `name_user`, `lastName_user`, `phone_user`, `password_user` FROM `users` WHERE `login_user` = '".$_COOKIE["login"]."' AND `password_user` = '".$_COOKIE["password"]."';"))->fetch_array();
    ?>
    <div class="form">
    <?php
        $idUser = ($conn->query("SELECT `id_user` FROM `users` WHERE `login_user` = '".$_COOKIE["login"]."';"))->fetch_array()["id_user"];
        $count = 0;
        foreach($info as $key => $value){
            if($count == 1){
    ?>
    <div onclick="open_change(this)"><input type="text" value="<?php echo $value;?>" placeholder="<?php echo $key;?>" class="<?php echo $key;?> <?php echo $idUser;?> input pointer-events-none" disabled onchange="set_change(this)" onblur="close_change(this)"></div>
    <?php
        $count = 0;
        }
        else
        {
            $count++;
        }
    }
?>
</div>
<?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <style>
        body{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }
        .pointer-events-none{
            pointer-events: none;
        }
    </style>
</head>
<body>
<?php form();?>
</body>
</html>
<script>
    function open_change(obj)
    {
        obj.getElementsByTagName("input")[0].classList.remove("pointer-events-none");
        obj.getElementsByTagName("input")[0].removeAttribute("disabled");
    }

    function close_change(obj)
    {
        obj.classList.add("pointer-events-none")
        obj.setAttribute("disabled", "");
        obj.setAttribute("value", obj.value);
    }

    function set_change(obj)
    {
        close_change(obj);
        rest_change(obj);
    }

    function rest_change(obj)
    {
      var data = [];

      data.push({key: 'table', value: 'users'});
      data.push({key: 'field', value: obj.classList[0]});
      data.push({key: 'id', value: obj.classList[1]});
      data.push({key: 'value', value: obj.value});

      fetch('http://taxiviking.ru/admin/api/change.php?Api_key=k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo', {
        method: 'POST',
        body: JSON.stringify(data)
      }).then(async (response) => {
        var text = await response.text();
        alert(text);

        if(text.split(' ')[0] == 'Ошибка:' || text.split(' ')[0] == '<br')
        {
          window.location.reload();
        }
      });
    }
</script>
<?php
}
?>