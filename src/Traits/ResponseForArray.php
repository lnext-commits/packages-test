<?php


namespace Lnext\ServiceFacades\Traits;

use Illuminate\Support\Arr;

trait ResponseForArray
{
    private function returnArray(array $arr, string|bool $option, null|string $key, bool|string $nameArray = false): array|string
    {
        if (is_null($key)) {
            return $this->outValue($arr, $option);
        } elseif (isset($arr[$key])) {
            return $this->outValue($arr[$key], $option);
        } elseif (str($key)->contains('.')) {
            $value = $this->getValue($arr, $key, $nameArray);
            return $this->outValue($value, $option);
        } else {
            return $this->getError($key, $nameArray);
        }
    }

    private function outValue($value, $option): array|string
    {
        return is_array($value) ? $this->arrOption($value, $option) : $value;
    }

    private function arrOption(array $arr, string|bool $option): array|string
    {
        $search = false;
        if (str($option)->contains('.')) {
            list($option, $search) = explode('.', $option);
        }
        return
            match ($option) {
                'key' => $search ? array_keys($arr, $search) : array_keys($arr),
                'value' => $search ? array_flip($arr)[$search] : array_values($arr),
                'dot' => Arr::dot($arr),
                default => $arr
            };
    }

    private function getError($key, $nameArray): string
    {
        return "the required key ($key) is not in the array".($nameArray ? " ({$nameArray})" : '').' signature:%^$*!@$!';
    }

    private function getValue($arr, $stringKey, $nameArray)
    {
        $keys = explode('.', $stringKey);
        foreach ($keys as $key) {
            if (isset($arr[$key])) {
                $arr = $arr[$key];
            } else {
                $arr = $this->getError($stringKey, $nameArray);
                break;
            }
        }
        return $arr;
    }
}
