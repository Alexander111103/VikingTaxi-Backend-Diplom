<?php

  $conn = new mysqli("localhost", "root", "", "VikingTaxi");
  $isAdmin = ($conn->query("SELECT COUNT(*) as 'count' FROM `users` WHERE `login_user` = '".$_COOKIE["userLogin"]."' AND `password_user` = '".$_COOKIE["userPassword"]."' AND `role_user` = 'admin';"))->fetch_array()['count'];

if($isAdmin != 1)
{
    header("Location:  /admin/form.php");
}

function table($table_name)
{  
?>
  <h2><?php echo $table_name;?></h2>
  <table id="<?php echo $table_name;?>" border="1">
    <tr class="header">
      <?php 
        global $conn;
        $table_data = $conn->query("SHOW COLUMNS FROM `".$table_name."`;");
        $index = 0;
        $columns = array();
        $types = array();

        foreach ($table_data as $t) 
        {
          array_push($columns, $t['Field']);
          array_push($types, $t['Type']);
        }

        foreach ($columns as $column)
        { 
      ?>
      <th name="th_<?php echo $index;?>"><p class="th_p" id="th_p_<?php echo $index;?>" onclick="open_search(this)"><?php echo $column;?></p><div class="th_search"><input type="text" class="th_input" id="th_input_<?php echo $index;?>" onkeyup="search(this)" placeholder="Поиск"><button class="th_button" id="th_button_<?php echo $index;?>" onclick="close_search(this)">X</button></div></th>
      <?php $index++; }?>
      <th class="th"><p>Удалить</p></th>
    </tr>
    <tr class="collapse"><td colspan="<?php echo count($columns)+1;?>"><button onclick="collapse(this)">^</button></td></tr> 
    <?php 
    
        $rows = $conn->query("SELECT * FROM `".$table_name."`");

        foreach ($rows as $row) 
        {
    ?>
    <tr id="tr_<?php echo $row[$columns[0]];?>">
          <?php
          $index = 0;
          
          foreach($row as $key => $value)
          {
          ?>
            <td onclick="open_change(this)"><input type="<?php if($types[$index] == 'int'){echo 'number';}else{echo 'text';}?>" value="<?php echo $value;?>" placeholder="<?php echo $key;?>" class="<?php echo $key;?> <?php echo $row[$columns[0]];?> td_input pointer-events-none" disabled onchange="set_change(this)" onblur="close_change(this)"></td>
          <?php $index++; }?>
          <td><button onclick="remove(<?php echo $row[$columns[0]]?>, this)">X</button></td>
    </tr>
    <?php }?>
    <tr class="add_new">
      <?php
        $index = 0;

        foreach($columns as $column)
        {
      ?>
          <td><input type="<?php if($types[$index] == 'int'){echo 'number';}else{echo 'text';}?>" placeholder="<?php echo $column;?>" class="<?php echo $column;?> td_input" style="background-color: yellow;" onchange="change_value_add(this)" required></td>
      <?php $index++; }?>
          <td><button onclick="add_new(this)">Добавить</button></td>
    </tr>
  </table><br>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../media/img/logo.png" rel="icon" type="image/x-icon">
    <title>Admin_hub</title>
    <style>
        th{
            cursor: pointer;
        }
        .th_input{
            display: none;
        }
        .th_button{
            display: none;
        }
        .th_search{
            display: flex;
            justify-content: space-between;
        }
        .th_p{
            height: inherit;
        }
        .pointer-events-none{
            pointer-events: none;
        }
        .td_input{
            cursor: pointer;
        }
        .collapse td button{
          width: 100%;
          cursor: pointer;
        }
    </style>
</head>
<body>
  <?php table('users');?>
  <?php table('drivers');?>
  <?php table('cars');?>
  <?php table('orders');?>
  <?php table('prices');?>
  <?php table('favoriteAddresses');?>
  <?php table('game');?>
</body>
</html>
<script>
    var isOpenSearch = false;

    function open_search(p)
    {
        if(isOpenSearch == false)
        {
            var id = p.id.replace("th_p_", "");
            var idTable = p.parentNode.parentNode.parentNode.parentNode.id;
            p.style.display = "none";
            document.getElementById(idTable).getElementsByClassName("th_button")[id].style.display = "block";
            document.getElementById(idTable).getElementsByClassName("th_input")[id].style.display = "block";
            isOpenSearch = true;
        }
        else
        {
          alert("У вас уже открыт поиск в 1 из таблиц");
        }
    }

    function close_search(button)
    {
        var id = button.id.replace("th_button_", "");
        var idTable = button.parentNode.parentNode.parentNode.parentNode.parentNode.id;
        button.style.display = "none";
        document.getElementById(idTable).getElementsByClassName("th_input")[id].value = "";
        document.getElementById(idTable).getElementsByClassName("th_input")[id].style.display = "none";
        document.getElementById(idTable).getElementsByClassName("th_p")[id].style.display = "block";
        search(document.getElementById(idTable).getElementsByClassName("th_input")[id]);
        isOpenSearch = false;
    }

    function search(obj)
    {
        var id = obj.id.replace("th_input_", "");
        var td;
        var txtValue;
        var table = document.getElementById(obj.parentNode.parentNode.parentNode.parentNode.parentNode.id);
        var input = table.querySelector("#th_input_"+id);
        var filter = input.value.toUpperCase();
        var tr = table.getElementsByTagName("tr");

        for (var i = 0; i < tr.length; i++) 
        {
            td = tr[i].getElementsByTagName("td")[id];

            if (td) 
            {
                txtValue =  td.innerHTML || td.textContent || td.getElementsByTagName("input")[0].value;

                if (txtValue.toUpperCase().indexOf(filter) > -1) 
                {
                    tr[i].style.display = "";
                } 
                else 
                {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function open_change(obj)
    {
        obj.getElementsByTagName("input")[0].classList.remove("pointer-events-none");
        obj.getElementsByTagName("input")[0].removeAttribute("disabled");
        obj.getElementsByTagName("input")[0].focus();
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

    function remove(id, obj)
    {
        var table = document.getElementById(obj.parentNode.parentNode.parentNode.parentNode.id);

        var isRemove = confirm('Вы точно хотите удалить?');

        if(isRemove)
        {
          rest_remove(id, table.id);
          table.querySelector("#tr_"+id).remove();
        }
    }

    function change_value_add(obj)
    {
        if(obj.value != "")
        {
          obj.setAttribute("style", "background-color: lime;");
        }
        else
        {
          obj.setAttribute("style", "background-color: yellow;");
        }
    }

    function add_new(obj)
    {
      var table = obj.parentNode.parentNode.parentNode.parentNode.id;
      var parent = obj.parentNode.parentNode;
      var array_td = parent.getElementsByTagName("td");
      var aimValues = array_td.length - 1;
      var nowValues = 0
      var data = [];

      data.push({key: 'table', value: table});

      for (let i = 0; i < array_td.length - 1; i++) 
      {
        if(array_td[i].querySelector("input"))
        {
          if(array_td[i].querySelector("input").value != "")
          {
            nowValues++;
            data.push({key: array_td[i].querySelector("input").classList[0], value: array_td[i].querySelector("input").value});
          }
        }
      }

      if(nowValues == aimValues)
      {
        rest_add(data);
        setTimeout(window.location.reload(), 3000);
      }
      else
      {
        alert('Вы не заполнили ключевое поле');
      }
    }

    function collapse(obj)
    {
      var table = obj.parentNode.parentNode.parentNode.parentNode;
      
      if(obj.innerHTML == "^")
      {
        for (let i = 2; i < table.getElementsByTagName("tr").length-1; i++)
        {
            table.getElementsByTagName("tr")[i].style.display = "none";
        }

        obj.innerHTML = "V";
      }
      else
      {
        for (let i = 2; i < table.getElementsByTagName("tr").length-1; i++)
        {
            table.getElementsByTagName("tr")[i].style.display = "";
        }

        obj.innerHTML = "^";
      }
    }

    function rest_change(obj)
    {
      var data = [];

      data.push({key: 'table', value: obj.parentNode.parentNode.parentNode.parentNode.id});
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

    function rest_remove(id, table)
    {
      var data = [];

      data.push({key: 'table', value: table});
      data.push({key: 'id', value: id});

      fetch('http://taxiviking.ru/admin/api/delete.php?Api_key=k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo', {
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

    function rest_add(data)
    {
      fetch('http://taxiviking.ru/admin/api/add.php?Api_key=k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo', {
        method: 'POST',
        body: JSON.stringify(data)
      }).then(async (response) => {alert(await response.text());});
    }
</script>