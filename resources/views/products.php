<h1>
    Hola soy el producto

    <table>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>description</td>
            <td>price</td>
        </tr>

        <?php foreach($pro as $p){ ?>
        <tr>
            <td><?php echo $p->id ?></td>
            <td><?php echo $p->name ?></td>
            <td><?php echo $p->description ?></td>
            <td><?php echo $p->price ?></td>
        </tr>
        <?php } ?>
</h1>