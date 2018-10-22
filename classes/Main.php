<?
/**
* Основной класс для управления системой.
*/
class Main 
{
    /**
    * Подключает часть подмодуль $name модуля $module. Это основная функция для отображения контента страницы. В файле /modules/$type/model/$name.php выстраевается итоговый массив, который затем передается файлу /modules/$type/view/$name.php для отображения итоговой части страницы. 
    * @param string $name название подключаемой части.
    * @param array $settings параметры для подключения. В зависимости от этих данных может меняться контент на странице.
    * @return array $result полученный массив, который можно использовать далее на странице и передавать его (или его части) как параметр для следующего элемента (например, какие разделы показывать, исходя из доступных разделов меню)
    */
    public static function includeSubmodule($module, $name, $settings = array())
    {
        $result = array();
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/modules/$module/model/$name.php"))
            include $_SERVER['DOCUMENT_ROOT']."/modules/$module/model/$name.php";
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/modules/$module/view/$name.php"))
            include $_SERVER['DOCUMENT_ROOT']."/modules/$module/view/$name.php";
        return $result;
    }

    /**
     * Пересылает пользователя на указанную страницу
     * @param  string $link URL страницы, на которую нужно перенаправить пользователя
     */
    public static function redirect(string $link, int $delay = 0)
    {
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='".$delay."; URL=$link'>";
        die;
    }
}
?>