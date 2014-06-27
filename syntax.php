<?php
/**
 * DokuWiki Plugin Doku Clippy (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Derek Chafin <infomaniac50@gmail.com>
 */

// must be run within Dokuwiki
if ( !defined( 'DOKU_INC' ) ) die();

class syntax_plugin_clippy extends DokuWiki_Syntax_Plugin {
  /**
   *
   *
   * @return string Syntax mode type
   */
  public function gettype() {
    return 'substition';
  }
  /**
   *
   *
   * @return string Paragraph type
   */
  public function getPType() {
    return 'normal';
  }
  /**
   *
   *
   * @return int Sort order - Low numbers go before high numbers
   */
  public function getSort() {
    return 999;
  }

  /**
   * Connect lookup pattern to lexer.
   *
   * @param string  $mode Parser mode
   */
  public function connectTo( $mode ) {
    $this->Lexer->addSpecialPattern( '<clippy>\n.*?\n</clippy>', $mode, 'plugin_clippy' );
  }

  // public function postConnect() {
  //   $this->Lexer->addExitPattern( '</clippy>', 'plugin_clippy' );
  // }

  /**
   * Handle matches of the clippy syntax
   *
   * @param string  $match   The match of the syntax
   * @param int     $state   The state of the handler
   * @param int     $pos     The position in the document
   * @param Doku_Handler $handler The handler
   * @return array Data for the renderer
   */
  public function handle( $match, $state, $pos, Doku_Handler &$handler ) {
    // <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="110" height="14" class="clippy" >
    //   <param name="movie" value="lib/clippy.swf"/>
    //   <param name="allowScriptAccess" value="always" />
    //   <param name="quality" value="high" />
    //   <param name="scale" value="noscale" />
    //   <param NAME="FlashVars" value="text={$text}">
    //   <param name="bgcolor" value="#FFFFFF">
    //   <embed src="lib/clippy.swf"
    //     width="110"
    //     height="14"
    //     name="clippy"
    //     quality="high"
    //     allowScriptAccess="always"
    //     type="application/x-shockwave-flash"
    //     pluginspage="http://www.macromedia.com/go/getflashplayer"
    //     FlashVars="text={$text}"
    //     bgcolor="#FFFFFF"
    //   />
    // </object>

    $lines = explode( $match, "\n" );
    $text = array_shift( $lines );

    $data = array(
      'width'  => 110,
      'height' => 14,
      'allowScriptAccess' => 'always',
      'quality' => 'high',
      'scale' => 'noscale',
      'bgcolor' => '#FFFFFF',
      'text' => $text,
    );

    return $data;
  }

  /**
   * Render xhtml output or metadata
   *
   * @param string  $mode     Renderer mode (supported modes: xhtml)
   * @param Doku_Renderer $renderer The renderer
   * @param array   $data     The data from the handler() function
   * @return bool If rendering was successful.
   */
  public function render( $mode, Doku_Renderer &$renderer, $data ) {
    if ( $mode != 'xhtml' ) return false;
    $movie = "lib/clippy.swf";
    $flashvar = array( "text" => $data['text'] );

    unset( $data['text'] );
    $renderer->doc .= html_flashobject( DOKU_PLUGIN.'clippy/'.$movie, $data['width'], $data['height'], $data, $flashvars );
    return true;
  }
}

// vim:ts=4:sw=4:et:
