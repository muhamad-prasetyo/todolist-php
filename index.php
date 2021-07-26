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
    }

?>


<h1>TODO LIST</h1>

<form action="" method="POST">
    <label for="todo">Apa Planingmu hari ini.</label> <br>
    <input type="text" name="todo">
    <button type="submit">SIMPAN</button>
</form>

<ul>
    <?php foreach($todos as $todo) : ?>
    <li>
        <input type="checkbox" name="todo">
        <label><?php echo $todo['todo']; ?></label>
        <a href="#">Hapus</a>
    </li>
    <?php endforeach; ?>
    
</ul>