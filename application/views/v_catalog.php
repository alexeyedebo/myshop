<table border='1px' width = '100%'>
    <thead>
    <tr>
        <td>Наименование</td>
        <td>Цена</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product => $cost):?>
    <tr>
        <td><?=$product?></td>
        <td><?=$cost?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>