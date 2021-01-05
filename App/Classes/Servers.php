<?php

/**
 *
 * @class Servers
 * @created 1.1.2021 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Servers
{
    protected $db;

    /**
     * Servers constructor.
     */
    public function __construct()
    {
        $this->db = new Queries();
    }

    /**
     * @throws Exception
     */
    public function addServer()
    {
        if (isset($_POST['addServer'])) {
            if (empty($_POST['IPAdress'])) {
                Redirect::MSG("/add_server", "danger", "IP адресът е задължителен.");
            } elseif ($this->checkPort(htmlspecialchars($_POST['IPAdress'])) === false) {
                Redirect::MSG('/add_server', 'danger', 'Сървърът трябва задължително да има порт.');
            } elseif (empty($_POST['website'])) {
                $website = "Няма добавен";
            } else {
                $website = $_POST['website'];
            }

            $this->db->create(Config::GET('prefixs/project') . "_servers", [
                "ip" => htmlspecialchars($_POST['IPAdress']),
                "game" => htmlspecialchars($_POST['type']),
                "addedby" => htmlspecialchars($_POST['owner']),
                "website" => htmlspecialchars($website),
                "vip" => 0,
                "date" => time(),
            ]);
            Redirect::MSG("/add_server", "success", "Сървъра е добавен успешно към системата.");
        }
    }

    /**
     * @param $much
     * @return array
     * @throws Exception
     */
    public function getAdServers($much)
    {
        if ($much === "all") {
            $servers = $this->db->orderAll(Config::GET('prefixs/project') . '_servers', 'id', 'DESC');
        } else {
            $servers = $this->db->orderAll(Config::GET('prefixs/project') . '_servers', 'id', 'LIMIT ' . $much);
        }

        $GameQ = new \GameQ\GameQ();
        foreach ($servers as $server) {
            $GameQ->addServer([
                'type' => $server->game,
                'host' => $server->ip
            ]);
        }
        $GameQ->setOption('timeout', 5);
        $GameQ->addFilter('normalize');
        $results = $GameQ->process();

        $return = [];
        foreach ($results as $result) {
            if ($result['gq_online'] == '1') {
                $status = 'Online';
            } elseif ($result['gq_online'] == '0') {
                $status = 'Offline';
            } else {
                $status = 'Unknown';
            }

            $return[] = [
                'icon' => (isset($result['gq_type']) && $result['gq_type'] != "" ? "/assets/img/" . $result['gq_type'] . ".png" : "/assets/img/icon_unknown.png"),
                'status' => $status,
                'hostName' => (isset($result['gq_hostname']) && $result['gq_hostname'] != "" ? $result['gq_hostname'] : 'N/A'),
                'maxPlayers' => (isset($result['gq_maxplayers']) && $result['gq_maxplayers'] != "" ? $result['gq_maxplayers'] : '0'),
                'onlinePlayers' => (isset($result['gq_numplayers']) && $result['gq_numplayers'] != "" ? $result['gq_numplayers'] : '0'),
                'serverIP' => (isset($result['gq_address']) && $result['gq_address'] != "" ? $result['gq_address'] . ':' . $result['gq_port_client'] : '0.0.0.0'),
                'map' => (isset($result['gq_mapname']) && $result['gq_mapname'] != "" ? $result['gq_mapname'] : 'N/A'),
                'game' => (isset($result['gq_gametype']) && $result['gq_gametype'] != "" ? $result['gq_gametype'] : 'N/A'),
                'added' => $servers[0]->date,
                'owner' => $servers[0]->addedby
            ];
        }

        return $return;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getVIPServers()
    {
        $getVIPs = $this->db->getWhere(Config::get('prefixs/project') . '_servers', ['VIP', '=', '1']);

        $GameQ = new \GameQ\GameQ();
        foreach ($getVIPs as $server) {
            $GameQ->addServer([
                'type' => $server->game,
                'host' => $server->ip
            ]);
        }
        $GameQ->setOption('timeout', 5);
        $GameQ->addFilter('normalize');
        $results = $GameQ->process();

        $return = [];
        foreach ($results as $result) {
            if ($result['gq_online'] == '1') {
                $status = 'Online';
            } elseif ($result['gq_online'] == '0') {
                $status = 'Offline';
            } else {
                $status = 'Unknown';
            }

            $return[] = [
                'icon' => (isset($result['gq_type']) && $result['gq_type'] != "" ? "/assets/img/" . $result['gq_type'] . ".png" : "/assets/img/icon_unknown.png"),
                'status' => $status,
                'hostName' => (isset($result['gq_hostname']) && $result['gq_hostname'] != "" ? $result['gq_hostname'] : 'N/A'),
                'maxPlayers' => (isset($result['gq_maxplayers']) && $result['gq_maxplayers'] != "" ? $result['gq_maxplayers'] : '0'),
                'onlinePlayers' => (isset($result['gq_numplayers']) && $result['gq_numplayers'] != "" ? $result['gq_numplayers'] : '0'),
                'serverIP' => (isset($result['gq_address']) && $result['gq_address'] != "" ? $result['gq_address'] . ':' . $result['gq_port_client'] : '0.0.0.0'),
                'map' => (isset($result['gq_mapname']) && $result['gq_mapname'] != "" ? $result['gq_mapname'] : 'N/A'),
                'game' => (isset($result['gq_gametype']) && $result['gq_gametype'] != "" ? $result['gq_gametype'] : 'N/A'),
                'added' => $getVIPs[0]->date,
                'owner' => $getVIPs[0]->addedby,
                'VIP' => $getVIPs[0]->vip,
                'StartVIP' => $getVIPs[0]->startvip,
                'ExpireVIP' => $getVIPs[0]->expirevip
            ];
        }

        return $return;
    }

    /**
     * @param $ip
     * @return array
     * @throws Exception
     */
    public function getDetails($ip): array
    {
        $getdetails = $this->db->getWhere(Config::get('prefixs/project') . '_servers', ['ip', '=', $ip]);

        if (!$ip) {
            Redirect::TO("/home/");
        }

        $GameQ = new \GameQ\GameQ();
        foreach ($getdetails as $server) {
            $GameQ->addServer([
                'type' => $server->game,
                'host' => $server->ip
            ]);
        }
        $GameQ->setOption('timeout', 5);
        $GameQ->addFilter('normalize');
        $results = $GameQ->process();

        $return = [];
        foreach ($results as $result) {
            if ($result['gq_online'] == '1') {
                $status = 'Online';
            } elseif ($result['gq_online'] == '0') {
                $status = 'Offline';
            } else {
                $status = 'Unknown';
            }

            $return[] = [
                'id' => $getdetails[0]->id,
                'icon' => (isset($result['gq_type']) && $result['gq_type'] != "" ? "/assets/img/" . $result['gq_type'] . ".png" : "/assets/img/icon_unknown.png"),
                'status' => $status,
                'hostName' => (isset($result['gq_hostname']) && $result['gq_hostname'] != "" ? $result['gq_hostname'] : 'N/A'),
                'maxPlayers' => (isset($result['gq_maxplayers']) && $result['gq_maxplayers'] != "" ? $result['gq_maxplayers'] : '0'),
                'onlinePlayers' => (isset($result['gq_numplayers']) && $result['gq_numplayers'] != "" ? $result['gq_numplayers'] : '0'),
                'serverIP' => (isset($result['gq_address']) && $result['gq_address'] != "" ? $result['gq_address'] . ':' . $result['gq_port_client'] : '0.0.0.0'),
                'map' => (isset($result['gq_mapname']) && $result['gq_mapname'] != "" ? $result['gq_mapname'] : 'N/A'),
                'game' => (isset($result['gq_gametype']) && $result['gq_gametype'] != "" ? $result['gq_gametype'] : 'N/A'),
                'gamesmall' => (isset($result['game_dir']) && $result['game_dir'] != "" ? $result['game_dir'] : 'N/A'),
                'players' => (isset($result['players']) && $result['players'] != "" ? $result['players'] : 'N/A'),
                'added' => $getdetails[0]->date,
                'owner' => $getdetails[0]->addedby,
                'VIP' => $getdetails[0]->vip,
                'StartVIP' => $getdetails[0]->startvip,
                'ExpireVIP' => $getdetails[0]->expirevip
            ];
        }

        return $return;
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function boost($id)
    {

        if (isset($_POST['boost'])) {

            if (empty($_POST['ip'])) {
                Redirect::MSG("/boost/" . $id, "danger", "IP:Port адресът е задължителен.");
            } elseif ($this->checkPort(htmlspecialchars($_POST['ip'])) === false) {
                Redirect::MSG('/boost/' . $id, 'danger', 'Сървърът трябва задължително да има порт.');
            } elseif (empty($_POST['sms'])) {
                Redirect::MSG("/boost/" . $id, "danger", "SMS кода е задължителен.");
            } elseif (empty($id)) {
                Redirect::msg("/boost/" . $id, "danger", "Нещо се обърка при опита за boost, моля опитай отново.");
            } elseif (!is_numeric($id)) {
                Redirect::msg("/boost/" . $id, "danger", "Нещо се обърка при опита за boost, моля опитай отново.");
            } elseif (Mobio::CheckCode(Config::GET("boost/smsID"), $_POST['sms'], 0) == 1) {

                $startvip = time();
                $endvip = $startvip + 604800;

                $this->db->update(Config::get('prefixs/project') . "_servers", $id, [
                    'ip' => htmlspecialchars($_POST['ip']),
                    'vip' => 1,
                    'startvip' => $startvip,
                    'expirevip' => $endvip,
                ]);

            } else {
                Redirect::msg("/boost/" . $id, "danger", "SMS кода е грешен, моля свържете се с администратора");
            }
        }
        return $this->db->getWhere(Config::get('prefixs/project') . "_servers", ['id', '=', $id])[0];
    }

    /**
     * @param $ip
     * @return bool
     */
    public static function checkPort($ip): bool
    {
        if (!strstr($ip, ':')) {
            return false;
        }
        return true;
    }
}