<?php
namespace Plinker\Cron {

    use RedBeanPHP\R;

    class Cron {

        public $config = array();
        private $tab;

        public function __construct(array $config = array(
            'config' => array(
                'taskfile' => './cron-task-file',
                'applyCrontab' => false
            ),
        )) {
            $this->config = $config;

            //check database construct values
            if (empty($this->config['config'])) {
                exit(json_encode($this->response(
                    'Bad Request',
                    400,
                    array('config construct error [database] empty')
                ), JSON_PRETTY_PRINT));
            } else {
                $this->tab = new lib\CronFileWriter($this->config['config']['taskfile']);
            }
        }

        private function response($data = null, $status = 200, $errors = array())
        {
            return array(
                'status' => $status,
                'errors' => $errors,
                'data'   => $data
            );
        }

        public function crontab()
        {
            return $this->dump();
        }

        public function applyCrontab()
        {
            if (!empty($this->config['config']['applyCrontab'])) {
                return exec('crontab '.$this->config['config']['taskfile']);
            }
            return false;
        }

        public function create(array $params = array())
        {
            $key = $params[0];
            $value = $params[1];
            $this->tab->create($key, $value);
        }

        public function read(array $params = array())
        {
            $key = $params[0];
            return $this->tab->read($key);
        }

        public function update(array $params = array())
        {
            $key = $params[0];
            $value = $params[1];
            $this->tab->update($key, $value);

        }

        public function delete(array $params = array())
        {
            $key = $params[0];
            $this->tab->delete($key);
        }

        public function drop(array $params = array())
        {
            $this->tab->drop();
        }

        public function dump(array $params = array())
        {
            return $this->tab->dump();
        }

        public function __destruct()
        {
            $this->applyCrontab();
        }
    }

}