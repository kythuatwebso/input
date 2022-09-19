<?php

namespace Webso;

class Input
{
    protected $attributes = [];

    protected $fileView;

    /**
     * Các fiels được phép
     *
     * @var array
     */
    protected $fieldAllow = [
        'title',
        'name',
        'help',
        'size',
        'prepend',
        'type',
        'class',
        'placeholder',
        'value',
        'append',
    ];

    public function __construct($name)
    {
        $this->attributes['name'] = $name;
    }

    /**
     * Cài đặt file View
     *
     * @param string $fileView
     * @return $this
     */
    public function setView($fileView)
    {
        if (is_file($fileView)) {
            $this->fileView = $fileView;
        }

        return $this;
    }

    /**
     * Instance \Webso\Input
     *
     * @param string $name
     * @return static
     */
    public static function make($name)
    {
        return new static($name);
    }

    /**
     * Gán các thuộc tính
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    protected function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Set attribute boolean
     *
     * @param boolean $value
     * @return $this
     */
    protected function setAttributeBool($boolean = true)
    {
        if (is_bool($boolean)) {
            $this->setAttribute('horizontal', $boolean);
        }

        return $this;
    }

    /**
     * Set label & input two 2 row
     *
     * @param boolean $horizontal
     * @return $this
     */
    public function horizontal($horizontal = true)
    {
        return $this->setAttributeBool($horizontal);
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return $this
     */
    public function required($required = true)
    {
        return $this->setAttributeBool($required);
    }

    /**
     * Render Template Input
     *
     * @return void
     */
    public function render()
    {
        if (blank($this->fileView)) {
            $this->fileView = __DIR__.'/view/input.tpl';
        }

        if (! function_exists('render_template')) {
            throw new \RuntimeException("function render_template not exitst");
        }

        return render_template(
            $this->fileView,
            ['attributes' => $this->attributes]
        );
    }

    public function __call($method, $params)
    {
        if (! in_array($method, $this->fieldAllow)) {
            return $this;
        }

        if (func_num_args() < 2) {
            return $this;
        }

        if (method_exists(static::class, $method)) {
            return $this->{$method}(...$params);
        }

        $this->setAttribute(
            $method,
            Arr::last($params),
        );

        return $this;
    }
}
