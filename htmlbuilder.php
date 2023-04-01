<?php
/**
 * Summary of HTMLTag
 */
class HTMLTag
{
    /**
     * Summary of tag
     * @var string
     */
    public string $tag;
    /**
     * Summary of value
     * @var string|null
     */
    public ?string $value;
    /**
     * Summary of attrs
     * @var mixed
     */
    public mixed $attrs;
    /**
     * Summary of full
     * @var bool
     */
    public bool $full;

    /**
     * Summary of __construct
     * @param string $tag
     * @param mixed $attrs
     * @param string|null $value
     * @param bool|null $full
     */
    function __construct(string $tag, mixed $attrs, ?string $value = null, ?bool $full = null) {
        $this->tag = $tag;
        $this->attrs = $attrs;
        $this->value = $value;
        $this->full = $full;
    }

    /**
     * Summary of toHTML
     * @param bool|null $format
     * @return string
     */
    public function toHTML(?bool $format = null): string
    {
        $attrs = '';
        if ($this->attrs)
        {
            foreach ($this->attrs as $key => $value)
            {
                $attrs .= ' '.$key.'='.(string)$value;
            }
        }
        if ($format == true)
        {
            return sprintf(
                '<%s%s%s>%s%s',
                $this->tag,
                /* auto ' ' */$attrs,
                $this->full ? '' : ' /',
                $this->value ? $this->value : '',
                $this->full ? '</'.$this->tag.'>' : ''
            );
        }
        else
        {
            return '<'.$this->tag./* auto ' ' */$attrs.' '.($this->full ? '/'  : '').'>'.($this->value ? (string)$this->value : '').($this->full ? '</'.$this->tag.'>' : '');
        }
    }
}

class HTMLTagBuilder
{
    protected string $tag;
    private ?string $value;
    private mixed $attrs;
    private bool $full;
    private bool $format;

    protected function __construct()
    {
        $this->tag = '';
        $this->value = null;
        $this->full = false;
        $this->attrs = [];
        $this->format = false;
    }

    public static function start(string $tag): HTMLTagBuilder
    {
        $builder = new HTMLTagBuilder();
        $builder->tag = $tag;
        return $builder;
    }

    public function toggleFormat(): HTMLTagBuilder
    {
        $this->format = !$this->format;
        return $this;
    }

    public function setValue(string $value): HTMLTagBuilder
    {
        $this->value = $value;
        $this->full = true;
        return $this;
    }

    public function setAttr(string $name, mixed $value): HTMLTagBuilder
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    public function setFull(bool $full): HTMLTagBuilder
    {
        if ($this->value) return $this;
        $this->full = $full;
        return $this;
    }

    public function addTag(HTMLTagBuilder $tag): HTMLTagBuilder
    {
        if (is_null($this->value))
        {
            $this->setValue($tag->toHTML($this->format));
        }
        else
        {
            $this->value = $this->value.$tag->toHTML($this->format);
        }
        return $this;
    }

    public function addTags(HTMLTagBuilder ...$tags): HTMLTagBuilder
    {
        foreach ($tags as $tag)
        {
            $this->addTag($tag);
        }
        return $this;
    }

    public function toHTML(?bool $format = null): string
    {
        return (new HTMLTag($this->tag, $this->attrs, $this->value, $this->full))->toHTML($format);
    }
}

class HTMLBuilder
{
    private string $html;
    private bool $format;
    public function __construct()
    {
        $this->html = '';
        $this->format = false;
    }

    public static function start(): HTMLBuilder
    {
        return new HTMLBuilder();
    }

    public function toggleFormat(): HTMLBuilder
    {
        $this->format = !$this->format;
        return $this;
    }

    public function addTag(HTMLTagBuilder $tag): HTMLBuilder
    {
        $this->html .= $tag->toHTML($this->format);
        return $this;
    }

    public function addTags(HTMLTagBuilder ...$tags): HTMLBuilder
    {
        foreach ($tags as $tag)
        {
            $this->addTag($tag);
        }
        return $this;
    }

    public function getHTML(): string
    {
        return $this->html;
    }

    public function end(): void
    {
        echo $this->getHTML();
    }
}
?>