<?php
/**
 * Класс для работы с файлом
 */
class FileReader implements SeekableIterator
{
    /**
     * Количество строк в файле
     * @var integer
     */
    private $lineCount = 0;

    /**
     * Путь к файлу с его названием
     * @var string
     */
    private $filename;

    /**
     * Обработчик для файла
     * @var [type]
     */
    private $handler;

    /**
     * Указатель на строку
     * @var integer
     */
    private $pointer = 0;

    /**
     * Указатели на номер байта в файле через каждые $checkpoint строк
     * @var array
     */
    private $bytePointers = [0];

    private $checkpoint = 10000;

    /**
     * Был ли оптимизирован объект
     * @var boolean
     */
    private $optimized = false;

    /**
     * Принимает название файла. Файл лежит в папке /misc
     */
    public function __construct(string $filename)
    {
        $this->filename = FILE_DIR . $filename;
        $this->handler = fopen($this->filename, "r");
    }

    public function seek($line, $fromCurrent = false)
    {
        if (!$fromCurrent) {
            $this->rewind();
        }
        $chunk = min((int)(($line + $this->pointer) / $this->checkpoint), count($this->bytePointers) - 1);
        $this->pointer = $chunk * $this->checkpoint;
        fseek($this->handler, $this->bytePointers[min($chunk, count($this->bytePointers) - 1)]);
        while (!feof($this->handler) and $this->pointer < $line) {
            fgets($this->handler);
            $this->pointer++;
        }
        return $chunk;
    }

    public function current()
    {
        return fgets($this->handler);
    }

    public function key()
    {
        return $this->pointer;
    }

    public function next()
    {
        $this->seek($this->pointer + 1, true);
        return fgets($this->handler);
    }

    public function rewind()
    {
        fseek($this->handler, 0);
        $this->pointer = 0;
    }

    public function valid()
    {
        return $this->pointer >= 0 and $this->pointer < $this->lineCount;
    }

    public function fseek($bytes)
    {
        fseek($this->handler, $bytes);
    }

    public function fgets()
    {
        return fgets($this->handler);
    }

    /**
     * Получает $index стоку из файла
     * @param  [type] $index номер строки
     * @return [type]        [description]
     */
    public function getItem($index)
    {
        $this->seek($index);
        return fgets($this->handler);
    }

    public function getLineCount()
    {
        return $this->optimized ? $this->lineCount : false;
    }

    /**
     * Считает количество строк в файле и записывает каждые $checkpoint строк количество пройденных байт
     * @return void
     */
    public function countLineNumber()
    {
        $bytePointer = 0;
        while (!feof($this->handler)) {
            $this->pointer++;
            $str = fgets($this->handler);
            if(($bytePointer += strlen($str/* . "\n"*/)) < PHP_INT_MAX) {
                if($this->pointer % $this->checkpoint == 0)
                    $this->bytePointers[] = min($bytePointer, PHP_INT_MAX);
            }
        }
        $this->lineCount = $this->key();
        $this->rewind();
    }

    public function optimize()
    {
        $this->countLineNumber();
        $this->optimized = true;
    }
}