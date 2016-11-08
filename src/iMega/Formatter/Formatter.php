<?php

namespace iMega\Formatter;

class Formatter
{
    protected $fields = [];

    public function __construct(array $meta)
    {
        foreach ($meta as $item) {
            if (empty($item) || !is_array($item)) {
                throw new FormatterException('Wrong type');
            }
            list($name, $default, $type, $error) = $item;
            if (0 !== $error) {
                throw new FormatterException('Wrong field name');
            }
            if (get_parent_class($type) == GenericType::class) {
                $this->fields[$name] = [$default, $type];
            } else {
                throw new FormatterException('Wrong instance');
            }
        }
    }

    public function getData($name, $value)
    {
        $type = $this->getType($name);
        try {
            return $type::getData($value);
        } catch (FormatterException $e) {
            return $type::getData($this->getDefaultValue($name));
        }
    }

    public function getValue($name, $value)
    {
        $type = $this->getType($name);
        try {
            return $type::getValue($value);
        } catch (FormatterException $e) {
            return $this->getDefaultValue($name);
        }
    }

    public function getDataCollection(array $values)
    {
        $ret = [];
        foreach ($this->getFileds() as $name => $v) {
            if (array_key_exists($name, $values)) {
                $ret[$name] = $this->getData($name, $values[$name]);
            } else {
                $type = $this->getType($name);
                $ret[$name] = $type::getData($this->getDefaultValue($name));
            }
        }

        return $ret;
    }

    public function getValueCollection(array $values)
    {
        $ret = [];
        foreach ($this->getFileds() as $name => $v) {
            if (array_key_exists($name, $values)) {
                $ret[$name] = $this->getValue($name, $values[$name]);
            } else {
                $ret[$name] = $this->getDefaultValue($name);
            }
        }

        return $ret;
    }

    /**
     * @return array
     */
    public function getFileds()
    {
        return $this->fields;
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
            throw new FormatterException('Field not exists');
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
