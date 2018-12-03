<?php


namespace App\Services;
use App\Services\Factories\Redis;

class AliPayCode
{
    /**
     * @var \Predis\Client
     */
    private $redis;


    private $codeKeyPrefix = 'code_index_';
    private $orderkeyPrefix = 'user_id_';

    public function __construct()
    {
        $this->redis = Redis::getCacheRedis();
    }

    private $mo_indexs = array('10_1','10_2','10_3');
    private $qu_indexs = array('30_1','30_2','30_3');
    private $ye_indexs = array('100_1','100_2','100_3');

    public function get($time,$uid)
    {
        $indexs = null;
        switch ($time) {
            case 1:
                $indexs = $this->mo_indexs;
                break;
            case 3:
                $indexs = $this->qu_indexs;
                break;
            case 12:
                $indexs = $this->ye_indexs;
                break;
        }
        if ($indexs != null) {
            for ($i=0; $i < count($indexs); $i++) { 
                $key = $this->codeKeyPrefix.$indexs[$i];
                if($this->redis->exists($key))
                {
                    if ($this->redis->get($key) == $uid) {
                        $this->redis->setex($key,300,$uid);
                        return $indexs[$i];
                    }
                }
                else
                {
                    $this->redis->setex($key,300,$uid);
                    return $indexs[$i];
                }
            }
        }
        return '';
    }

    public function isOrderExist($userid)
    {
        $key = $this->orderkeyPrefix.(string)$userid;
        if($this->redis->exists($key))
        {
            $this->redis->del($key);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getUserID($amount)
    {
        $key = '';
        switch ($amount) {
            case 10:
                $key = $this->codeKeyPrefix.$this->mo_indexs[0];
                break;
            case 9.99:
                $key = $this->codeKeyPrefix.$this->mo_indexs[1];
                break;
            case 10.01:
                $key = $this->codeKeyPrefix.$this->mo_indexs[2];
                break;
            case 30:
                $key = $this->codeKeyPrefix.$this->qu_indexs[0];
                break;
            case 29.99:
                $key = $this->codeKeyPrefix.$this->qu_indexs[1];
                break;
            case 30.01:
                $key = $this->codeKeyPrefix.$this->qu_indexs[2];
                break;
            case 100:
                $key = $this->codeKeyPrefix.$this->ye_indexs[0];
                break;
            case 99.99:
                $key = $this->codeKeyPrefix.$this->ye_indexs[1];
                break;
            case 100.01:
                $key = $this->codeKeyPrefix.$this->ye_indexs[2];
                break;
        }
        if($key == '')
        {
            return null;
        }
        else
        {
            if($this->redis->exists($key))
            {
                $uid = $this->redis->get($key);
                $this->redis->del($key);
                $this->redis->setex($this->orderkeyPrefix.(string)$uid,180,$amount);
                return $uid;
            }
        }
    }

}