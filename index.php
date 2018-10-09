<?php
$method = $_SERVER['REQUEST_METHOD'];
// Process only when method is POST
if($method == 'POST'){
  // medapatkan hasil dari dialogflow
  $requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
  $kalimat = $json->result->parameters->kalimat;
  $tujuan =  $json->result->parameters->tujuan;

  //mengubah teks biasa ke urlencode
  $text = urlencode($kalimat);


  //kunci dari yandex
  $key =  'trnsl.1.1.20180813T070557Z.382026d958e1e46f.420c2c6ee5e27d51a26c6a052a70dd0b995c3d94';
  //dukungan basasa
		include 'languageSupport.php';

//kirim data ke yandex
		$language_from = "https://translate.yandex.net/api/v1.5/tr.json/detect?key=$key&text=$text";
//dapat balasan dari yandex
    $url_from = file_get_contents($language_from);
//deteksi awal bahasa
		$obj_language_from = json_decode($url_from);
		$asal = $obj_language_from->lang;

//jawaban dukungan bahasa
		if($kode_bahasa == 'null'){
      //kalau bahasa tidak di dukung
			$hasil = 'sorry, aku belum bisa kalau pake bahasa itu, mungkin besok udah bisa :v';
		}else {
      // kalau bahasa di dukung
      //kirim data ke yandx
			$situs = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=$key&text=$text&lang=$asal-$kode_bahasa";
      //dapat balasan
      $url = file_get_contents($situs);
      //ubah ke json
      $obj = json_decode($url);
			// dapat hasiknya
			$hasil = $obj->text[0];
		}

    //balas ke dialogflow
		$response = new \stdClass();
		$response->speech = $hasil;
		$response->displayText = $hasil;
		$response->source = "webhook";
		echo json_encode($response);
//method harus POST kalau tidak ya balas dengan ini saja
}else{
	echo "Method not allowed";
}
?>
