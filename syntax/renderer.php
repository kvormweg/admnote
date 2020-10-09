<?php
/**
 * DokuWiki Plugin admnote (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Klaus Vormweg <klaus.vormweg@gmx.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
    die();
}

class syntax_plugin_admnote_renderer extends DokuWiki_Syntax_Plugin {
    /* possible note types */
    var $types = array('abstract','bug','danger','example','failure','information',
                       'note','question','quote','achievement','tip','warning');
    /* default type */
    var $deftype = 'note';
    /* title switch */
    var $handletitle = FALSE;

    /**
     * @return string Syntax mode type
     */
    public function getType() {
        return 'container';
    }

    /**
     * @return string Paragraph type
     */
    public function getPType() {
        return 'stack';
    }

    /**
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort() {
        return 0;
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode) {
        $this->Lexer->addEntryPattern('<adm ?[^>]*>', $mode, 'plugin_admnote_renderer');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('</adm>', 'plugin_admnote_renderer');
    }

    /**
     * Allowed modes inside admnotes
     *
     * @return array allowed modes
     */
    public function getAllowedTypes() {
        return array('container','formatting','substition','protected','disabled','paragraphs');
    }

    /**
     * Handle matches of the admnote syntax
     *
     * @param string       $match   The match of the syntax
     * @param int          $state   The state of the handler
     * @param int          $pos     The position in the document
     * @param Doku_Handler $handler The handler
     *
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler $handler) {
        global $conf;
        if(is_file(DOKU_PLUGIN.'admnote/lang/'.$conf['lang'].'/lang.php')) {
            require DOKU_PLUGIN.'admnote/lang/'.$conf['lang'].'/lang.php';
        } else {
            require DOKU_PLUGIN.'admnote/lang/en/lang.php';
        }

        $data = array();
        $cssClass = '';
        $heading = '';
        switch($state) {
            case DOKU_LEXER_ENTER:
                $match = trim(str_replace(array('<','>'),'',$match));
                $match = preg_replace('/ +/',' ',$match);
                $words = explode(' ',$match);
                array_shift($words);
                if($words[0] and in_array(strtolower($words[0]), $this->types)) {
                    $cssClass = strtolower(array_shift($words));
                } else {
                    $cssClass = $this->deftype;
                }
                if($words) {
                    $heading = implode(' ',$words);
                } else {
                    $heading = $lang['adm_'.$cssClass];
                }
                $data = array($state, $cssClass.'#'.$heading);
                break;

            case DOKU_LEXER_UNMATCHED:
                $data = array($state, $match);
                break;

            case DOKU_LEXER_EXIT:
                $data = array($state, $match);
                break;

            default:
                $data = array($state, '');
        }
        return $data;
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string        $mode     renderer mode (supported modes: xhtml)
     * @param Doku_renderer $renderer The renderer
     * @param array         $data     The data from the handler() function
     *
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_renderer $renderer, $data) {
      if($mode == 'xhtml') {
          list($state, $text) = $data;

          switch($state) {
              case DOKU_LEXER_ENTER:
                  list($cssClass, $heading) = explode('#',$text);
                  $renderer->doc .= '<div class="admonition '.$cssClass.'">'."\n";
                  $renderer->doc .= '<p class="admonition-title">'.
                                    $renderer->_xmlEntities($heading)."</p>\n";
                  break;

              case DOKU_LEXER_UNMATCHED:
                  $renderer->doc .= $renderer->_xmlEntities($text);
                  break;

              case DOKU_LEXER_EXIT:
                  $renderer->doc .= "\n</div>";
                  break;
          }
          return true;
      }

      // unsupported $mode
      return false;
    }
}
