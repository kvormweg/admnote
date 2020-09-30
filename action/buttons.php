<?php
/**
 * DokuWiki Plugin admnote (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Klaus Vormweg <klaus.vormweg@gmx.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
    die();
}

class action_plugin_admnote_buttons extends DokuWiki_Action_Plugin {
    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     *
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'handle_toolbar', array());
    }

    /**
     * Event handler which performs action
     *
     * Called for event:
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     *
     * @return void
     */
    function handle_toolbar(Doku_Event $event, $param) {
        $event->data[] = array (
            'type' => 'picker',
            'title' => $this->getLang('adm'),
            'icon' => '../../plugins/admnote/images/notepicker.png',
            'list' => array(
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_abstract'),
                    'icon'   => '../../plugins/admnote/images/abstract.png',
                    'open'   => '<adm abstract>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_bug'),
                    'icon'   => '../../plugins/admnote/images/bug.png',
                    'open'   => '<adm bug>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_danger'),
                    'icon'   => '../../plugins/admnote/images/danger.png',
                    'open'   => '<adm danger>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_example'),
                    'icon'   => '../../plugins/admnote/images/example.png',
                    'open'   => '<adm example>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_failure'),
                    'icon'   => '../../plugins/admnote/images/failure.png',
                    'open'   => '<adm failure>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_information'),
                    'icon'   => '../../plugins/admnote/images/information.png',
                    'open'   => '<adm information>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_note'),
                    'icon'   => '../../plugins/admnote/images/note.png',
                    'open'   => '<adm note>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_question'),
                    'icon'   => '../../plugins/admnote/images/question.png',
                    'open'   => '<adm question>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_quote'),
                    'icon'   => '../../plugins/admnote/images/quote.png',
                    'open'   => '<adm quote>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_achievement'),
                    'icon'   => '../../plugins/admnote/images/achievement.png',
                    'open'   => '<adm achievement>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_tip'),
                    'icon'   => '../../plugins/admnote/images/tip.png',
                    'open'   => '<adm tip>',
                    'close'  => '</adm>'
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('adm_warning'),
                    'icon'   => '../../plugins/admnote/images/warning.png',
                    'open'   => '<adm warning>',
                    'close'  => '</adm>'
                )
            )
        );
    }
}
