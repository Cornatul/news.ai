<?php

namespace Cornatul\Social\Objects;

/**
 * Class Message
 * @todo Improve this class by using maybe the spatie data transfer object package
 * @package Cornatul\Social\Objects
 */
class Message
{

    public string $title;
    public string $body;
    public string $url;
    public string $image;
    public string $summary;
    public array | string $tags = [];

    const SIGNATURE = ' This post was create by https://lzomedia.com';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        //todo add tags to this message
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getTagsAsString(): string
    {
        return implode(", #",$this->tags);
    }

    public function getTagsAsArray(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTagsAsString(array $tags): void
    {
        $this->tags = implode(" #", $tags);
    }

    public function setTagsAsArray(array $tags): void
    {
        $this->tags = $tags;
    }

}
