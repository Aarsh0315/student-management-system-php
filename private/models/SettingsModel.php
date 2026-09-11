<?php

class SettingsModel extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GET ALL SETTINGS
    |--------------------------------------------------------------------------
    */

    public function getAll()
    {
        $query = "SELECT setting_key, setting_value
                  FROM system_settings
                  ORDER BY setting_key ASC";

        return $this->query($query);
    }


    /*
    |--------------------------------------------------------------------------
    | GET ONE SETTING
    |--------------------------------------------------------------------------
    */

    public function get($key)
    {
        $query = "SELECT setting_value
                  FROM system_settings
                  WHERE setting_key = :setting_key
                  LIMIT 1";

        $result = $this->query($query, [
            'setting_key' => $key
        ]);

        return $result[0]->setting_value ?? null;
    }


    /*
    |--------------------------------------------------------------------------
    | GET SETTINGS AS ASSOCIATIVE ARRAY
    |--------------------------------------------------------------------------
    */

    public function getAllAsArray()
    {
        $rows = $this->getAll();

        $settings = [];

        foreach ($rows as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }

        return $settings;
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE / UPDATE SETTING
    |--------------------------------------------------------------------------
    */

    public function set($key, $value)
    {
        $query = "INSERT INTO system_settings
                    (setting_key, setting_value)
                  VALUES
                    (:setting_key, :setting_value)
                  ON DUPLICATE KEY UPDATE
                    setting_value = VALUES(setting_value)";

        return $this->query($query, [
            'setting_key' => $key,
            'setting_value' => $value
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE MULTIPLE SETTINGS
    |--------------------------------------------------------------------------
    */

    public function setMultiple(array $settings)
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }

        return true;
    }
}