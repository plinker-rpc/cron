<?php
namespace Plinker\Cron\Lib;

/**
 * Flatfile CRUD class
 *
 * @author Lawrence Cherone
 * @version 1.01
 */
class CronFileWriter
{
    public $file;
    private $handle;

    /**
     * construct loads [or creates] the file
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;

        try {
            // create file if not exist
            if (!file_exists($this->file)) {
                if (!$this->handle = fopen($this->file, 'w')) {
                    throw new Exception('Cannot create file');
                }
                flock($this->handle, LOCK_EX);
                fwrite($this->handle, '');
                flock($this->handle, LOCK_UN);
                fclose($this->handle);
            }

            //check file is readable
            if (!is_readable($this->file)) {
                throw new Exception('File is not readable');
            }

            //check file is writable
            if (!is_writable($this->file)) {
                throw new Exception('File is not writable');
            }
        } catch (Exception $e) {
            exit('Error: '.$e->getMessage());
        }
    }

    /**
     * Create or update an entry in the .htaccess file
     *
     * @param string $data
     * @param string $delim
     */
    public function create($delim = '#', $data = PHP_EOL)
    {
        //first check for existing then update
        if ($this->read($delim)) {
            $this->update($delim, $data);
        } else {
            //create new entry
            file_put_contents(
                $this->file,
                PHP_EOL.'# '.$delim.PHP_EOL.$data.PHP_EOL.'# \\'.$delim.PHP_EOL,
                FILE_APPEND
            );
        }
    }

    /**
     * Read entry from .htaccess file
     *
     * @param string $delim
     * @return mixed (bool|string)
     */
    public function read($delim = '#')
    {
        $file = file_get_contents($this->file);

        $delim = preg_quote($delim);
        if (preg_match("/#\s$delim\s(.*?)\s#\s\\\\$delim/s", $file, $matches)) {
            return trim($matches[1]);
        } else {
            return false;
        }
    }

    /**
     * Update entry in .htaccess file
     *
     * @param string $data
     * @param string $delim
     */
    public function update($delim = '#', $data = PHP_EOL)
    {
        $data = str_replace(
            array('$1','$2','$3','$4','$5'),
            array('\$1','\$2','\$3','\$4','\$5'),
            $data
        );

        $delim = preg_quote($delim);

        file_put_contents(
            $this->file,
            trim(
                preg_replace(
                    "/#\s$delim\s(.*?)\s#\s\\\\$delim/s",
                    '# '.$delim.PHP_EOL.$data.PHP_EOL.'# \\'.$delim,
                    file_get_contents($this->file)
                )
            )
        );
    }

    /**
     * Delete entry from .htaccess file
     *
     * @param string $delim
     * @return bool
     */
    public function delete($delim = '#')
    {
        $file = file_get_contents($this->file);

        $delim = preg_quote($delim);
        if (preg_match("/#\s$delim\s(.*?)\s#\s\\\\$delim/s", $file, $matches)) {
            file_put_contents(
                $this->file,
                str_replace(PHP_EOL.$matches[0].PHP_EOL, '', $file)
            );
            return true;
        } else {
            return false;
        }
    }

    public function dump()
    {
        return file_get_contents($this->file);
    }

    public function drop()
    {
        return file_put_contents($this->file, '');
    }
}
