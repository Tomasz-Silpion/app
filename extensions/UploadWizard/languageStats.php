<?php

require( 'UploadWizard.i18n.php' );

$langsToTest = array_slice( $argv, 1 );

$wikipediaSize = getWikipediaSize();

$total = count( $messages['en'] );

foreach ( $wikipediaSize as $lang => $size ) {
	if ( count($langsToTest) and (! in_array( $lang, $langsToTest ) ) ) {
		continue;
	}	
	$percentComplete[$lang] = 0;
	$translated = 0;
	if ( array_key_exists( $lang, $messages ) ) { 
		$langDict = $messages[$lang];
		foreach( $messages['en'] as $key => $val ) {
			if ( array_key_exists( $key, $langDict ) ) {
				$translated++;
			}
		}
	}
	$percentage = (int)( 100 * $translated / $total );
	echo "Language: $lang  Wiki size: $size  Translated: $translated   Percentage: $percentage\n";

}


# taken from stats.wikimedia.org/EN/TablesArticlesTotal.htm May 2011
function getWikipediaSize() { 
	return array(
		'en' => 3600000,
		'de' => 1200000,
		'fr' => 1100000,
		'it' => 796000,
		'pl' => 793000,
		'ja' => 748000,
		'es' => 747000,
		'ru' => 697000,
		'pt' => 680000,
		'nl' => 680000,
		'sv' => 392000,
		// hack -- don't know what the right thing is here
		'zh-hans' => 344000,
		'zh-hant' => 344000,
		'ca' => 316000,
		'no' => 297000,
		'uk' => 272000,
		'fi' => 266000,
		'vi' => 210000,
		'cs' => 191000,
		'hu' => 187000,
		'ko' => 160000,
		'tr' => 159000,
		'ro' => 159000,
		'id' => 159000,
		'da' => 146000,
		'eo' => 143000,
		'sr' => 141000,
		'ar' => 138000,
		'lt' => 131000,
		'sk' => 122000,
		'fa' => 122000,
		'vo' => 119000,
		'he' => 118000,
		'ms' => 117000,
		'bg' => 115000,
		'sl' => 109000,
		'war' => 102000,
		'hr' => 100000,
		'et' => 83000,
		'hi' => 82000,
		'new' => 71000,
		'simple' => 70000,
		'gl' => 70000,
		'th' => 67000,
		'eu' => 66000,
		'nn' => 65000,
		'roa-rup' => 62000,
		'el' => 61000,
		'az' => 56000,
		'ht' => 54000,
		'tl' => 52000,
		'la' => 52000,
		'te' => 48000,
		'ka' => 48000,
		'mk' => 45000,
		'ceb' => 43000,
		'sh' => 41000,
		'pms' => 37000,
		'br' => 37000,
		'mr' => 34000,
		'lv' => 34000,
		'be_x_old' => 34000,
		'jv' => 33000,
		'sq' => 32000,
		'lb' => 32000,
		'cy' => 32000,
		'is' => 31000,
		'bs' => 31000,
		'ta' => 30000,
		'be' => 29000,
		'bpy' => 25000,
		'an' => 25000,
		'oc' => 24000,
		'io' => 22000,
		'bn' => 22000,
		'sw' => 21000,
		'lmo' => 20000,
		'gu' => 19000,
		'fy' => 19000,
		'ml' => 18000,
		'ur' => 17000,
		'scn' => 17000,
		'nds' => 17000,
		'af' => 17000,
		'qu' => 16000,
		'ku' => 16000,
		'zh_yue' => 15000,
		'su' => 15000,
		'ne' => 14000,
		'hy' => 14000,
		'ast' => 14000,
		'yo' => 13000,
		'nap' => 13000,
		'bat_smg' => 13000,
		'wa' => 12000,
		'ga' => 12000,
		'cv' => 12000,
		'pnb' => 11000,
		'kn' => 11000,
		'tg' => 9400,
		'yi' => 9300,
		'kk' => 9200,
		'vec' => 8900,
		'roa_tara' => 8900,
		'tt' => 8700,
		'als' => 8500,
		'zh-min-nan' => 8400,
		'gd' => 8400,
		'uz' => 8000,
		'os' => 7700,
		'pam' => 7600,
		'si' => 7500,
		'sah' => 7500,
		'arz' => 7500,
		'bug' => 7100,
		'am' => 7100,
		'mi' => 6700,
		'li' => 6600,
		'nah' => 6500,
		'hsb' => 6500,
		'sco' => 6300,
		'glk' => 6300,
		'my' => 6100,
		'mn' => 6100,
		'gan' => 6000,
		'co' => 6000,
		'ia' => 5400,
		'bcl' => 5000,
		'fiu-vro' => 4700,
		'fo' => 4700,
		'sa' => 4500,
		'nds_nl' => 4400,
		'vls' => 4300,
		'tk' => 4300,
		'bar' => 4100,
		'dv' => 4000,
		'mg' => 3900,
		'map_bms' => 3800,
		'gv' => 3800,
		'pag' => 3500,
		'nrm' => 3500,
		'ckb' => 3500,
		'ug' => 3400,
		'se' => 3200,
		'rm' => 3200,
		'mzn' => 3200,
		'diq' => 3200,
		'wuu' => 3100,
		'hif' => 3100,
		'ps' => 2900,
		'fur' => 2900,
		'bo' => 2900,
		'mt' => 2800,
		'lij' => 2800,
		'ilo' => 2800,
		'bh' => 2700,
		'sc' => 2600,
		'nov' => 2600,
		'km' => 2600,
		'csb' => 2600,
		'ang' => 2600,
		'zh_classical' => 2500,
		'lad' => 2500,
		'cbk_zam' => 2400,
		'pi' => 2300,
		'szl' => 2200,
		'stq' => 2100,
		'mrj' => 2100,
		'kw' => 2100,
		'ksh' => 2100,
		'hak' => 2100,
		'frp' => 2100,
		'so' => 2000,
		'rue' => 2000,
		'pa' => 2000,
		'nv' => 2000,
		'mhr' => 1900,
		'ky' => 1900,
		'xal' => 1800,
		'ie' => 1800,
		'haw' => 1800,
		'udm' => 1700,
		'pdc' => 1700,
		'ext' => 1700,
		'ace' => 1700,
		'to' => 1600,
		'rw' => 1600,
		'ln' => 1600,
		'kv' => 1600,
		'krc' => 1600,
		'crh' => 1600,
		'pcd' => 1500,
		'myv' => 1400,
		'gn' => 1400,
		'eml' => 1300,
		'ce' => 1300,
		'ba' => 1300,
		'pap' => 1200,
		'kab' => 1200,
		'ay' => 1200,
		'arc' => 1200,
		'wo' => 1100,
		'mwl' => 1100,
		'kl' => 1100,
		'jbo' => 1100,
		'frr' => 1100,
		'bjn' => 1100,
		'tpi' => 1000,
		'dsb' => 964,
		'lo' => 941,
		'srn' => 875,
		'ty' => 869,
		'zea' => 810,
		'ab' => 721,
		'koi' => 707,
		'or' => 706,
		'ig' => 671,
		'mdf' => 650,
		'av' => 618,
		'kg' => 608,
		'tet' => 596,
		'rmy' => 508,
		'lbe' => 500,
		'cu' => 497,
		'ks' => 467,
		'sd' => 465,
		'ltg' => 464,
		'sm' => 450,
		'kaa' => 431,
		'mo' => 401,
		'kbd' => 396,
		'bm' => 392,
		'got' => 383,
		'ik' => 356,
		'bxr' => 349,
		'iu' => 348,
		'bi' => 348,
		'as' => 343,
		'na' => 339,
		'pih' => 337,
		'chr' => 332,
		'pnt' => 331,
		'ss' => 323,
		'cdo' => 311,
		'cr' => 300,
		'ee' => 259,
		'ha' => 255,
		'rn' => 235,
		'om' => 214,
		'zu' => 213,
		'ti' => 203,
		'za' => 200,
		'ts' => 186,
		'tum' => 162,
		've' => 157,
		'sg' => 149,
		'dz' => 145,
		'ch' => 133,
		'ny' => 129,
		'fj' => 127,
		'lg' => 126,
		'st' => 120,
		'ki' => 114,
		'ff' => 111,
		'xh' => 110,
		'tn' => 101,
		'sn' => 98,
		'chy' => 60,
		'ak' => 49,
		'tw' => 48,
		'ng' => 25,
		'cho' => 20,
		'ii' => 14,
		'mh' => 11,
	);
}
