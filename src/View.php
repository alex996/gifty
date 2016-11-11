<?php

class View {

    /**
     * Path to views/ directory.
     */
    private static $path = VIEWS_PATH;

    /**
     * Current block name.
     */
    private $current;

    /**
     * Declares a block. If no contents are
     * provides, turns output buffering on.
     * @param string $block Block name, e.g. 'contents'.
     * @param string|null $contents Block markup.
     */
    private function block($block, $contents = null) {
        // Store a given block name in the current block:
        $this->current = $block;
        // Store a class property with the same name
        // as the name of the given block:
        $this->$block = $contents;
        // If block contents are empty, turn buffering on:
        if ($contents == null)
            ob_start();
    }

    /**
     * Populates the block with buffer contents
     * and deletes current output buffer.
     */
    private function endblock() {
        // Get the current block name:
        $block = $this->current;
        // Get a class property with the name of 
        // the current block and set its contents:
        $this->$block = ob_get_clean(); 
    }

    /**
     * Feeds a block with its contents, if any.
     * @param string $block Block name, e.g. 'contents'.
     * @return string Block markup, e.g. PHP, HTML, CSS, or JS code.
     */
    private function feed($block) {
        return isset($this->$block) ? $this->$block : null;
    }

    /**
     * Renders a template and injects data to its scope.
     * @param string $view Template name.
     * @param array $data Data to be injected.
     * @return string Template markup, e.g. HTML, CSS, or JS.
     */
    private function display($view, $data = []) {
        // Check that the template file exists:
        if ( file_exists(self::$path.$view) ) {
            // Turn output buffering on:
            ob_start();
            // Import variables to the template scope:
            extract($data, EXTR_SKIP);
            // Include the template file:
            include_once self::$path.$view;
            // Close the buffer and return its contents:
            return ob_get_clean();
        } else {
            throw new Exception("No template file $view present in " . 
                                self::$path . " directory");
        }
    }

    /**
     * Renders a template with given data.
     * @param string $view Template name.
     * @param array $data Data to be injected.
     */ 
    public static function render($view, $data = []) {
        echo call_user_func([new View(), 'display'], $view, $data);
        //(new View())->display($view, $data);
    }
}