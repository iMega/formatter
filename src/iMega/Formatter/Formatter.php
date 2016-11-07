<?php

namespace iMega\Formatter;

class Formatter
{
    protected $fields = [];

    public function __construct(array $meta)
    {
        foreach ($meta as $item) {
            if (empty($item) || !is_array($item)) {
                throw new \RuntimeException('Wrong type');
            }
            list($name, $default, $type, $error) = $item;
            if (0 !== $error) {
                throw new \RuntimeException('Wrong field name');
            }
            if (get_parent_class($type) == GenericType::class) {
                $this->fields[$name] = [$default, $type];
            } else {
                throw new \RuntimeException('Wrong instance');
            }
        }
    }

    public function getData($name, $value)
    {
        $type = $this->getType($name);
        try {
            return $type::getData($value);
        } catch (\Exception $e) {
            return $type::getData($this->getDefaultValue($name));
        }
    }

    public function getValue($name, $value)
    {
        $type = $this->getType($name);
        try {
            return $type::getValue($value);
        } catch (\Exception $e) {
            return $this->getDefaultValue($name);
        }
    }

    /**
     * @param string $name
     *
     * @return GenericType
     */
    protected function getField($name)
    {
        if (array_key_exists($name, $this->fields)) {
            return $this->fields[$name];
        } else {
            throw new \RuntimeException('Field not exists');
        }
    }

    protected function getDefaultValue($name)
    {
        list($default, $type) = $this->getField($name);

        return $default;
    }

    /**
     * @param $name
     *
     * @return \iMega\Formatter\Typer
     */
    protected function getType($name)
    {
        list($default, $type) = $this->getField($name);

        return $type;
    }
}
