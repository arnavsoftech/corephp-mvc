<?php
class Usermodel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAllUsers(): array
    {
        $sql = "SELECT * FROM ai_users LIMIT 10";
        $result = $this->db->query($sql)->result();
        return $result;
    }
}
