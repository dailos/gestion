<?php

require_once(dirname(__FILE__).'/../config.inc.php');
require_once(dirname(__FILE__).'/../pipeline.class.php');

parse_config_file(dirname(__FILE__).'/../html2ps.config');

$g_config = array(
                  'cssmedia'     => 'screen',
                  'renderimages' => true,
                  'renderforms'  => true,
                  'renderlinks'  => true,
                  'mode'         => 'html',
                  'debugbox'     => false,
                  'draw_page_border' => false
                  );
require_once(dirname(__FILE__).'/../config.inc.php');
require_once(HTML2PS_DIR.'pipeline.class.php');
require_once(HTML2PS_DIR.'fetcher.url.class.php');
parse_config_file(HTML2PS_DIR.'html2ps.config');

$g_config = array(
                  'cssmedia'     => 'screen',
                  'renderimages' => true,
                  'renderforms'  => false,
                  'renderlinks'  => true,
                  'mode'         => 'html',
                  'debugbox'     => false,
                  'draw_page_border' => false
                  );

$media = Media::predefined('A4');
$media->set_landscape(false);
$media->set_margins(array('left'   => 0,
                          'right'  => 0,
                          'top'    => 0,
                          'bottom' => 0));
$media->set_pixels(1024);

$g_px_scale = mm2pt($media->width() - $media->margins['left'] - $media->margins['right']) / $media->pixels;
$g_pt_scale = $g_px_scale * 1.43; 


foreach($urls as $url) {
  $url_file = str_replace('http://' ,'', $url);
  $url_file = str_replace(':', '_', $url_file);
  $url_file = str_replace('/', '_', $url_file);
  $url_file = str_replace('.', '_', $url_file);

  $pipeline = new Pipeline;
  $pipeline->configure($g_config);
  $pipeline->fetchers[]     = new FetcherURL;
  $pipeline->data_filters[] = new DataFilterHTML2XHTML;
  $pipeline->parser         = new ParserXHTML;
  $pipeline->layout_engine  = new LayoutEngineDefault;
  $pipeline->output_driver  = new OutputDriverFPDF($media);
  $pipeline->destination    = new DestinationFile($url_file);


  if (!file_exists(dirname(__FILE__).'/../out/'.$url_file.'.pdf')) {
    print $url."\n";
    $pipeline->process($url, $media); 
  }
}
