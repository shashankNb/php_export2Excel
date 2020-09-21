<?php

class Export
{

    public $dbcon = null;
    public $db = 'angular-jwt';
    public $host = 'localhost';
    public $username = 'root';
    public $password = null;

    public function __construct()
    {
        try {
            $this->dbcon = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . ";", $this->username, $this->password);
            $this->dbcon->query("SET NAMES 'utf8'");
            $this->dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // If database connection occurs log and error
            error_log($e->getMessage());
            die("Cannot make connetion to database");
        }
    }

    public function exportCSV($sql, $columns = NULL, $metaData = NULL, $isShowHeader = false)
    {
        // fetch Record Count
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);

        if (isset($data[0]->recordCount)) {
            $metaData['Record Count'] = $data[0]->recordCount;
        }

        ob_start();
        $filename = 'download_' . time() . '.xls';
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=$filename");
        header('Cache-Control: must-revalidate');

        // Print Meta Data
        if ($metaData != null) {
            foreach ($metaData as $key => $meta) {
                echo $key . "\t" . $meta . "\n";
            }
            echo "\n";
        }

        foreach ($data as $row) {
            $row = (array) $row;
            $rowData = [];

            if ($columns != null) {
                foreach ($columns as $key => $head)
                    $rowData[$key] = $row[$key];
            } else {
                $rowData = $row;
            }

            if ($isShowHeader) {
                echo implode("\t", $columns == null ? array_keys($row) : $columns) . "\n";
                $isShowHeader = false;
            }
            echo implode("\t", array_values($rowData)) . "\n";
        }
        ob_end_flush();
        exit();
    }
}

$obj = new Export();
