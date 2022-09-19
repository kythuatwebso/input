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
        'icon',
        'accept',
        'gutters',
        'rowClass',
        'wrapClass',
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
     * Set Attribute input
     *
     * @param string $key
     * @param mixed $value
     * @param string $keyTag
     * @return $this
     */
    public function setAttr($key, $value, $keyTag = 'attr')
    {
        $key   = (string) e(Str::of($key)->trim()->stripTags());
        $value = (string) e(Str::of($value)->trim()->stripTags());

        $this->attributes[$keyTag] = sprintf('%s="%s"', $key, $value);

        return $this;
    }

    /**
     * set data attribute
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function dataAttr($key, $value)
    {
        if (! Str::contains($key, 'data-')) {
            $key = sprintf('data-%s', $key);
        }

        return $this->setAttr($key, $value, 'dataAttr');
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
    protected function setAttributeBool($key, $value = true)
    {
        if (is_bool($value)) {
            $this->setAttribute($key, $value);
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
        return $this->setAttributeBool('horizontal', $horizontal);
    }

    /**
     * Set label & input two 2 row
     *
     * @param boolean $stacked
     * @return $this
     */
    public function stacked($stacked = true)
    {
        return $this->horizontal($stacked);
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return $this
     */
    public function required($required = true)
    {
        return $this->setAttributeBool('required', $required);
    }

    /**
     * Help text to bottom
     *
     * @param boolean $helpBottom
     * @return $this
     */
    public function helpBottom($helpBottom = true)
    {
        return $this->setAttributeBool('helpBottom', $helpBottom);
    }

    /**
     * Đặt icon bên trong ô input
     *
     * @param boolean $iconInside
     * @return $this
     */
    public function iconInside($iconInside = true)
    {
        return $this->setAttributeBool('iconInside', $iconInside);
    }

    /**
     * Xử lý dữ liệu Alias
     *
     * @return void
     */
    public function aliasExec()
    {
        if (! Arr::get($this->attributes, 'label') && Arr::get($this->attributes, 'title')) {
            Arr::set($this->attributes, 'label', Arr::get($this->attributes, 'title'));
        }

        if (! Arr::get($this->attributes, 'title') && Arr::get($this->attributes, 'label')) {
            Arr::set($this->attributes, 'title', Arr::get($this->attributes, 'label'));
        }

        if (Arr::get($this->attributes, 'icon')) {
            $awesomeHasPrefix = Str::contains($this->attributes['icon'], ['fa fa-', 'fas fa-', 'far fa-', 'fal fa-','fad fa-',]);

            if (! $awesomeHasPrefix) {
                $this->attributes['icon'] = sprintf('fa %s', $this->attributes['icon']);
            }
        }

        if (! Arr::get($this->attributes, 'gutters') && Arr::get($this->attributes, 'rowClass')) {
            $this->attributes['gutters'] = Arr::get($this->attributes, 'rowClass');
        }
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

        $this->aliasExec();

        return render_template(
            $this->fileView,
            ['fields' => collect($this->attributes)]
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
