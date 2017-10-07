<?php
namespace Plinker\Cron {

    use RedBeanPHP\R;

    /**
     * Cron Plinker class
     */
    class Cron
    {
        public $config = array();
        private $tab;

        /**
         * Construct
         *
         * @param array $config
         */
        public function __construct(array $config = array(
            'config' => array(
                'journal' => './crontab.journal',
                'apply'   => false
            ),
        ))
        {
            $this->config = $config;

            $this->tab = new lib\CronFileWriter(
                (!empty($this->config['config']['journal']) ? $this->config['config']['journal'] : './crontab.journal')
            );
        }

        /**
         * Return current crontab
         */
        public function dump(array $params = array())
        {
            return $this->tab->dump();
        }
        
        /**
         * Alias of dump
         */
        public function crontab()
        {
            return $this->dump();
        }

        /**
         * Apply journal file to crontab
         */
        public function apply()
        {
            if (!empty($this->config['config']['apply'])) {
                return exec('crontab '.$this->config['config']['journal']);
            }
            return false;
        }

        /**
         * Create a crontab entry
         *
         * @param string $params[0] - Key to match cron entry
         * @param string $params[1] - Cron task line
         */
        public function create(array $params = array())
        {
            $key = $params[0];
            $value = $params[1];
            $this->tab->create($key, $value);
        }

        /**
         * Get a single crontab entrys value
         *
         * @param string $params[0] - Key to match cron entry
         */
        public function get(array $params = array())
        {
            $key = $params[0];
            return $this->tab->read($key);
        }
        
        /**
         * Alias of get
         *
         * @param string $params[0] - Key to match cron entry
         */
        public function read(array $params = array())
        {
            return $this->get($params);
        }

        /**
         * Update a crontab entry
         *
         * @param string $params[0] - Key to match cron entry
         * @param string $params[1] - Cron task line
         */
        public function update(array $params = array())
        {
            $key = $params[0];
            $value = $params[1];
            $this->tab->update($key, $value);
        }

        /**
         * Delete a crontab entry
         *
         * @param string $params[0] - Key to match cron entry
         */
        public function delete(array $params = array())
        {
            $key = $params[0];
            $this->tab->delete($key);
        }

        /**
         * Drop crontab journal
         */
        public function drop(array $params = array())
        {
            $this->tab->drop();
        }

        /**
         *
         */
        public function __destruct()
        {
            $this->apply();
        }
    }

}
