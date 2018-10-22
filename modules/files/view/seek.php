<table>
    <tbody>
            <?for ($i = 0; $i < $itemAmount; $i++):?>
                <?$index = rand(0, $reader->getLineCount() ? $reader->getLineCount() : 10000000); ?>
                <tr>
                    <td>
                        <?=$index?>
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