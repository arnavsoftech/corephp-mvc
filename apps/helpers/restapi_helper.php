<?php
class RestApi
{
    public $success = false;
    public $fields = '';
    public $message = '';
    public $data = '';

    public function setOK(string $message = ''): void
    {
        $this->success = true;
        if ($message != '')
            $this->message = $message;
    }

    public function setError(string $message = ''): void
    {
        $this->success = false;
        if ($message != '')
            $this->message = $message;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function setMessage(string $msg): void
    {
        $this->message = $msg;
    }

    public function checkINPUT($keys, $data = [])
    {
        $this->fields = implode(',', $keys);
        $flag = true;
        if (count($keys) > 0) {
            foreach ($keys as $key) {
                if (!isset($data[$key])) {
                    $flag = false;
                }
            }
        }
        if ($flag == false) {
            $this->missing();
        }
        return $flag;
    }

    public function checkPOST($keys)
    {
        $this->fields = implode(',', $keys);
        $flag = true;
        if (count($keys) > 0) {
            foreach ($keys as $key) {
                if (!isset($_POST[$key])) {
                    $flag = false;
                }
            }
        }
        if ($flag == false) {
            $this->missing();
        }
        return $flag;
    }

    public function check($keys)
    {
        $this->fields = implode(',', $keys);
        $flag = true;
        if (count($keys) > 0) {
            foreach ($keys as $key) {
                if (!isset($_GET[$key])) {
                    $flag = false;
                }
            }
        }
        if ($flag == false) {
            $this->missing();
        }
        return $flag;
    }

    public function missing()
    {
        $this->setError("Required Parameter Missing !!");
    }

    public function render()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
        echo json_encode($this, JSON_PRETTY_PRINT);
        exit();
    }
}
