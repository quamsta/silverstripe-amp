<?php

/**
 * Google AMP Pages
 *
 * Renders Pages conforming to Google's AMP HTML stnadard
 *
 *
 * @package amp
 */

class AmpController extends Extension
{

    private static $allowed_actions = array ('amp');

    private static $url_handlers = array(
        'amp.html' => 'amp'
    );

    public function amp() {
        $class = Controller::curr()->ClassName;
        $page = $this->owner->renderWith(array("Amp$class", "Amp"));

        return $this->AmplfyHTML($page);

    }

    public function AmplfyHTML($content) {
        if(!$content) {
            return false;
        }

        //All AMP filters:
        $content = str_replace("<img", "<amp-img", $content);
        $content = str_replace('src="assets/', 'src="'.Director::BaseURL().'/assets/', $content);
        $content = str_replace('data-src', 'src', $content);

        return $content;

    }

}