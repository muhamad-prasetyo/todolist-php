<!-- // * MEMBUAT APLIKASI TODOLIST WEB SEDERHANA DENGAN PHP NATIVE  -->

<?php

    // * membuat variable array 
    $todos = [];
    // ? cek apakah file todo.txt sudah ada atau belum 
    if(file_exists('todo.txt')) {
        $file = file_get_contents('todo.txt');
        $todos = unserialize($file);
    }

    // ? cek apakah ada data terkirim 
    if(isset($_POST['todo'])) {
        $data = $_POST['todo'];
        $todos[] = [
            'todo' => $data,
            'status' => 0
        ];
        file_put_contents('todo.txt', serialize($todos));
        
        header('Location: index.php');
        exit();
        
    }

    if(isset($_GET['status'])) {
        $todos[$_GET['key']]['status'] = $_GET['status'];
        file_put_contents('todo.txt', serialize($todos));
        header('Location: index.php');
        exit();
    }

    print_r($todos);
?>

<h1>TODO LIST</h1>

<form action="" method="POST">
    <label for="todo">Apa Planingmu hari ini.</label> <br>
    <input type="text" name="todo">
    <button type="submit">SIMPAN</button>
</form>

<ul>
    <?php foreach($todos as $key => $value) : ?>
    <li>
        <input type="checkbox" name="todo" onclick="window.location.href ='index.php?status=<?php echo ($value['status'] == 1) ? '0' : '1'; ?>&key=<?php echo $key; ?>'" <?php if($value['status'] == 1) echo 'checked'; ?>>
        <label>
            <?php
                if($value['status'] == 1 ) {

                    echo '<del>' . $value['todo'] . '</del>';
                } else {
                    echo $value['todo'];
                }

                    
            ?>
        </label>
        <a href="#">Hapus</a>
    </li>
    <?php endforeach; ?>
    
</ul>