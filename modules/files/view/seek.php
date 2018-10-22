<table border="1">
    <thead>
        <tr>
            <th>Номер строки</th>
            <th>Строка</th>
        </tr>
    </thead>
    <tbody>
            <?for ($i = 0; $i < $itemAmount; $i++):?>
                <?$index = rand(0, $reader->getLineCount() ? $reader->getLineCount() : 10000000); ?>
                <tr>
                    <td>
                        <?=($index - 1)?>
                    </td>
                    <td>
                        <?=$reader->getItem($index)?>
                    </td>
                </tr>
            <? endfor ?>
    </tbody>
</table>
<div>
<?="Выполнилось за " . (microtime(true) - $time) . " секунд"?>
</div>