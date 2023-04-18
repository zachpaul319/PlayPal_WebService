<?php

class Config {
    static private function loadConfig() {
        $config = parse_ini_file("/home/stu/zpaul20/www/config.cfg", true);
        return $config;
    }
    static public function getConfigValue($stanza, $key) {
        $config = self::loadConfig();
        return $config[$stanza][$key];
    }
}