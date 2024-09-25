<?php

namespace App\Traits;

trait Trans
{


    public function getTransFirstNameAttribute()
    {
        if ($this->first_name) {
            return json_decode($this->first_name, true)[app()->currentLocale()];
        }
        return $this->first_name;
    }

    public function getFirstNameArAttribute()
    {
        if ($this->first_name) {
            return json_decode($this->first_name, true)['ar'];
        }
        return $this->first_name;
    }


    public function getFirstNameEnAttribute()
    {
        if ($this->first_name) {
            return json_decode($this->first_name, true)['en'];
        }
        return $this->first_name;
    }

    public function getTransLastNameAttribute()
    {
        if ($this->last_name) {
            return json_decode($this->last_name, true)[app()->currentLocale()];
        }
        return $this->last_name;
    }
    public function getLastNameArAttribute()
    {
        if ($this->last_name) {
            return json_decode($this->last_name, true)['ar'];
        }
        return $this->last_name;
    }
    public function getLastNameEnAttribute()
    {
        if ($this->last_name) {
            return json_decode($this->last_name, true)['en'];
        }
        return $this->last_name;
    }

    public function getTransFullNameAttribute()
    {
        if ($this->first_name && $this->last_name) {
            $fullName = json_decode($this->first_name, true)[app()->currentLocale()] . ' ' . json_decode($this->last_name, true)[app()->currentLocale()];

            return $fullName;
        }
        return $this->first_name;
    }

    public function getTransNameAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)[app()->currentLocale()];
        }
        return $this->name;
    }
    public function getNameArAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)['ar'];
        }
        return $this->name;
    }
    public function getNameEnAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)['en'];
        }
        return $this->name;
    }
    public function getTransAddressAttribute()
    {
        if ($this->address) {
            return json_decode($this->address, true)[app()->currentLocale()];
        }
        return $this->address;
    }
    public function getAddressArAttribute()
    {
        if ($this->address) {
            return json_decode($this->address, true)['ar'];
        }
        return $this->address;
    }
    public function getAddressEnAttribute()
    {
        if ($this->address) {
            return json_decode($this->address, true)['en'];
        }
        return $this->address;
    }
    public function getTransDescriptionAttribute()
    {
        if ($this->description) {
            return json_decode($this->description, true)[app()->currentLocale()];
        }
        return $this->description;
    }

    public function getDescriptionArAttribute()
    {
        if ($this->description) {
            return json_decode($this->description, true)['ar'];
        }
        return $this->description;
    }
    public function getDescriptionEnAttribute()
    {
        if ($this->description) {
            return json_decode($this->description, true)['en'];
        }
        return $this->description;
    }


  
}
