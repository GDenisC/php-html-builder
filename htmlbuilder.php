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
     * Summary of attrs
     * @var mixed
     */
    public mixed $anonimousAttrs;
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
    function __construct(string $tag, mixed $attrs, mixed $anonimousAttrs, ?string $value = null, ?bool $full = null) {
        $this->tag = $tag;
        $this->attrs = $attrs;
        $this->value = $value;
        $this->full = $full;
        $this->anonimousAttrs = $anonimousAttrs;
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
                $attrs .= ' '.$key.'="'.(string)$value.'"';
            }
        }
        if (count($this->anonimousAttrs) > 0)
        {
            foreach ($this->anonimousAttrs as $value)
            {
                $attrs .= ' '.$value;
            }
        }
        if ($format == true)
        {
            return sprintf(
                '<%s%s%s>%s%s',
                $this->tag,
                /* auto ' ' */$attrs,
                ($this->full == true) ? '' : ' /',
                $this->value ? $this->value : '',
                $this->full ? '</'.$this->tag.'>' : ''
            );
        }
        else
        {
            return '<'.$this->tag./* auto ' ' */$attrs.' '.($this->full ? '' : ' /').'>'.($this->value ? (string)$this->value : '').($this->full ? '</'.$this->tag.'>' : '');
        }
    }
}

class HTMLTagBuilder
{
    protected string $tag;
    private ?string $value;
    private mixed $attrs;
    private mixed $annoAttrs;
    private bool $full;
    private bool $format;

    protected function __construct()
    {
        $this->tag = '';
        $this->value = null;
        $this->full = false;
        $this->attrs = [];
        $this->format = false;
        $this->annoAttrs = [];
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

    public function setAttr(string $valueOrName, ?string $value = null): HTMLTagBuilder
    {
        if (is_null($value))
        {
            array_push($this->annoAttrs, $value);
        }
        else
        {
            $this->attrs[$valueOrName] = $value;
        }
        return $this;
    }

    public function setFull(bool $full = null): HTMLTagBuilder
    {
        if (is_null($full)) $full = true;
        if ($this->value) return $this;
        $this->full = $full;
        return $this;
    }

    public function addTag(HTMLTagBuilder $tag): HTMLTagBuilder
    {
        if (is_null($this->value))
        {
            $this->setValue($tag->getHTML());
        }
        else
        {
            $this->value = $this->value.$tag->getHTML();
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

    public function getHTML(): string
    {
        return (new HTMLTag($this->tag, $this->attrs, $this->annoAttrs, $this->value, $this->full))->toHTML($this->format);
    }

    public function end(): void
    {
        echo $this->getHTML();
    }
}

/**
 * Alias of `HTMLTagBuilder`
 */
class HTMLBuilder extends HTMLTagBuilder {}
?>