<html lang="ru_RU">
    <body>
        <h1>LIB</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>ISBN</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <?php /** @var array $books */
                    foreach ($books as $book):?>
                    <tr>
                        <td><?php echo $book["title"]?></td>
                        <td><?php echo $book["isbn"]?></td>
                        <td><?php echo $book["price"]?></td>
                    </tr>
                    <?php endforeach;?>
            </table>
        </div>
    </body>
</html>