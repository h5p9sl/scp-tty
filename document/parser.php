<?php
include 'vendor/autoload.php';

class DocumentParser extends Parsedown {
    protected $vars = Array();

    function parse_document_page($page) {
        include 'vendor/autoload.php';

        // Clear variables, if any
        $this->vars = Array();

        $body = $page['body'];
        // Replace ($SCP) variables with page title
        $body = preg_replace('/\(\$(scp|SCP)\)/', $page['title'], $body);
        // Replace |spoilers| with "&block;"s;
        $body = preg_replace_callback(
            '/(?<!\\\\)\|[ a-zA-Z0-9_-]+\|/',
            function ($matches) {
                return str_repeat('&block;', strlen($matches[0]) - 2);
            },
            $body
        );
        // Extract any remaining variables
        $body = $this->extract_variables($body);

        $this->setSafeMode(true);
        return $this->text($body);
    }

    function get_var($var_name) {
        if (isset($this->vars[$var_name])) {
            return $this->vars[$var_name];
        }
        return NULL;
    }

    protected function extract_variables($text) {
        $text = preg_replace_callback(
            '/\(\$[a-zA-Z0-9-_]+=.*\)/',
            function ($m) {
                $m = $m[0];
                $keynval = substr($m, strpos($m, '$') + 1, strpos($m, ')') - 2);
                $keynval = explode('=', $keynval);
                $this->vars[$keynval[0]] = $keynval[1];
                return '';
            },
            $text
        );
        return $text;
    }

    protected function inlineImage($Excerpt)
    {
        if ( ! isset($Excerpt['text'][1]) or $Excerpt['text'][1] !== '[')
        {
            return;
        }


        $Excerpt['text']= substr($Excerpt['text'], 1);


        $Link = $this->inlineLink($Excerpt);


        if ($Link === null)
        {
            return;
        }


        $Inline = array(
            'extent' => $Link['extent'] + 1,
            'element' => array(
                'name' => 'img',
                'attributes' => array(
                    'class' => 'infobox',
                    'style' => 'max-width: 300px',
                    'src' => $Link['element']['attributes']['href'],
                    'title' => $Link['element']['text'],
                ),
            ),
        );


        $Inline['element']['attributes'] += $Link['element']['attributes'];


        unset($Inline['element']['attributes']['href']);


        return $Inline;
    }
}
?>
