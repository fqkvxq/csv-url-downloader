<?

$lines = file('./yomikomi.csv');
foreach($lines as $line) {
    $line = trim($line);
    $line_exploded = explode(",", $line);
    $toryou_name = $line_exploded[0];
    $toryou_url = $line_exploded[1];

    // URLよりダウンロード
    file_download($toryou_url, 'pdf', $toryou_name);

}

function file_download($url, $dir='.', $save_base_name='' ){
	if ( ! is_dir($dir) ){ die("ディレクトリ({$dir})が存在しません。");}
	$dir = preg_replace("{/$}","",$dir);
	$p = pathinfo($url);
	$local_filename = '';
	if ( $save_base_name ){ $local_filename = "{$dir}/{$save_base_name}.{$p['extension']}"; }
	else{ $local_filename = "{$dir}/{$p['filename']}.{$p['extension']}"; }
	if ( is_file( $local_filename ) ){ print "すでにファイル({$local_filename})が存在します<br>\n";}
	$tmp = file_get_contents($url);
	$fp = fopen($local_filename, 'w');
	fwrite($fp, $tmp);
	fclose($fp);
}