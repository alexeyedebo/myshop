<h2>Лучшие товары</h2>
<br/>
<table width="100%">
<?foreach($products as $product):?>
    
    <td><img width="150" src="media/img/book.png">
        <br/><?=$product->title?></td>
<?endforeach?>
</table>
