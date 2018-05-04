<?php
namespace Plinker\Cron {

    /**
     * Cron Plinker class
     */
    class Cron
    {
        public $config = [];
        private $tab;

        /**
         * Construct
         *
         * @param array $config
         */
        public function __construct(array $config = [])
        {
            // merge in config with default
            $this->config = array_merge([
                'config' => [
                    'journal' => './.plinker/crontab.journal',
                    'apply'   => false
                ],
            ], $config);

            // init CronFileWriter
            $this->tab = new Lib\CronFileWriter(
                (!empty($this->config['config']['journal']) ? $this->config['config']['journal'] : './.plinker/crontab.journal')
            );
        }
 
        /**
         * Get current user
         */
        public function user()
        {
            return `whoami`;
        }
        
        /**
         * Get current crontab.
         */
        public function crontab()
        {
            return `/usr/bin/crontab -l`;
        }

        /**
         * Get current crontab journal
         */
        public function dump(array $params = array())
        {
            return $this->tab->dump();
        }

        /**
         * Create a crontab entry
         *
         * @param string $key   Key to match cron entry
         * @param string $value Cron task line
         */
        public function create($key = '', $value = '')
        {
            $this->tab->create($key, $value);
        }

        /**
         * Get a single crontab entrys value
         *
         * @param string $key Key to match cron entry
         */
        public function get($key = '')
        {
            return $this->tab->read($key);
        }
        
        /**
         * Alias of get
         *
         * @param string $key Key to match cron entry
         */
        public function read($key = '')
        {
            return $this->get($key);
        }

        /**
         * Update a crontab entry
         *
         * @param string $key   Key to match cron entry
         * @param string $value Cron task line
         */
        public function update($key = '', $value = '')
        {
            $this->tab->update($key, $value);
        }

        /**
         * Delete a crontab entry
         *
         * @param string $key Key to match cron entry
         */
        public function delete($key = '')
        {
            $this->tab->delete($key);
        }

        /**
         * Drop crontab journal
         */
        public function drop()
        {
            $this->tab->drop();
        }
        
        /**
         * Apply journal file to crontab
         */
        public function apply($force = true)
        {
            if (!empty($this->config['config']['apply']) || $force) {
                exec('/usr/bin/crontab '.$this->config['config']['journal'], $output, $status);
                return [$this->config['config']['journal'], $output, $status];
            }
            
            return false;
        }

        /**
         * Upon class destruct apply crontab but dont force
         */
        public function __destruct()
        {
            $this->apply(false);
        }
    }

}
